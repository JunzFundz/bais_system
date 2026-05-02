<?php

header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../model/Client.php';
$set = new Client();

$response = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response = ['status' => 'error', 'message' => 'Invalid request method'];
    echo json_encode($response);
    exit;
}

// Parse JSON input
$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!$data || !is_array($data)) {
    $response = ['status' => 'error', 'message' => 'Invalid JSON data'];
    echo json_encode($response);
    exit;
}

// Sanitize and validate inputs
$keyId = trim($data['cert_id'] ?? '');
$purpose = trim($data['purpose'] ?? '');
$fname = trim($data['fname'] ?? '');
$mname = trim($data['mname'] ?? '');
$lname = trim($data['lname'] ?? '');
$citizen = trim($data['citizen'] ?? '');
$sex = trim($data['sex'] ?? '');
$civil = trim($data['civilstatus'] ?? '');
$age = trim($data['age'] ?? '');
$contact = trim($data['contact'] ?? '');
$email = trim($data['email'] ?? '');
$street = trim($data['street'] ?? '');
$brgy = trim($data['Barangay'] ?? '');
$city = trim($data['city'] ?? '');
$type = trim($data['type'] ?? '');
$photo = $data['photo'] ?? '';
$signature = $data['signature'] ?? '';
$letter = $data['letter'] ?? '';
$userid = $data['userId'] ?? '';
$pid = $data['pid'] ?? '';
$old_signature = $data['old_signature'] ?? '';

if (empty($keyId)) {
    $response = ['error' => 'Invalid key'];
    echo json_encode($response);
    exit;
}

if (empty($purpose)) {
    $response = ['error' => 'Purpose is empty!'];
    echo json_encode($response);
    exit;
}

// Basic validation
if (!$fname || !$lname || !$contact || !$email || !$brgy) {
    $response = ['error' => 'Please fill all required fields'];
    echo json_encode($response);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response = ['error' => 'Invalid email format'];
    echo json_encode($response);
    exit;
}

$uploadDir = __DIR__ . '/../uploads/';

if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        error_log("Failed to create uploads directory");
        $response = ['error' => 'Failed to create upload directory'];
        echo json_encode($response);
        exit;
    }
    error_log("Created uploads directory");
}

$sigImageDir = __DIR__ . '/../uploads/signatures/';

if (!is_dir($sigImageDir)) {
    if (!mkdir($sigImageDir, 0755, true)) {
        error_log("Failed to create uploads directory");
        $response = ['error' => 'Failed to create upload directory'];
        echo json_encode($response);
        exit;
    }
    error_log("Created uploads directory");
}

function imgsave($base64Data, $prefix, $sigImageDir, $oldFile = '')
{
    // ❗ If no new image → keep old
    if (empty($base64Data)) {
        error_log("No image data for $prefix");
        return $oldFile;
    }

    // Validate base64
    if (!preg_match('/^data:image\/(\w+);base64,/', $base64Data, $matches)) {
        error_log("Invalid base64 format for $prefix");
        return $oldFile;
    }

    // ✅ DELETE OLD FILE FIRST
    if (!empty($oldFile)) {
        $oldPath = $sigImageDir . basename($oldFile);

        if (file_exists($oldPath)) {
            unlink($oldPath);
            error_log("Deleted old file: $oldPath");
        }
    }

    $imageType = $matches[1];
    $extension = ($imageType === 'jpeg') ? 'jpg' : $imageType;

    $imageData = preg_replace('#^data:image/\w+;base64,#i', '', $base64Data);
    $imageData = str_replace(' ', '+', $imageData);

    $filename = $prefix . '_users_' . time() . '_' . uniqid() . '.' . $extension;
    $fullPath = $sigImageDir . $filename;

    error_log("📸 Saving $prefix → $filename");

    $decodedData = base64_decode($imageData);
    if ($decodedData === false) {
        error_log("Base64 decode failed");
        return $oldFile;
    }

    if (file_put_contents($fullPath, $decodedData) === false) {
        error_log("File write failed");
        return $oldFile;
    }

    return $filename;
}

function saveImage($base64Data, $prefix, $uploadDir)
{
    if (empty($base64Data)) {
        error_log("No image data for $prefix");
        return '';
    }

    if (!preg_match('/^data:image\/(\w+);base64,/', $base64Data, $matches)) {
        error_log("Invalid base64 format for $prefix");
        return '';
    }

    $imageType = $matches[1];
    $extension = ($imageType === 'jpeg') ? 'jpg' : $imageType;
    $imageData = preg_replace('#^data:image/\w+;base64,#i', '', $base64Data);
    $imageData = str_replace(' ', '+', $imageData);

    // Generate unique filename
    $filename = $prefix . '_users_' . time() . '_' . uniqid() . '.' . $extension;
    $fullPath = $uploadDir . $filename;

    error_log("📸 Saving $prefix → $filename");

    // Decode and save
    $decodedData = base64_decode($imageData);
    if ($decodedData === false) {
        error_log("Base64 decode failed for $prefix");
        return '';
    }

    // Write file
    if (file_put_contents($fullPath, $decodedData) === false) {
        error_log("File write failed: $fullPath");
        return '';
    }

    // Verify file exists
    if (!file_exists($fullPath)) {
        error_log("File not found after save: $fullPath");
        return '';
    }

    $fileSize = filesize($fullPath);
    error_log("Saved $filename ($fileSize bytes)");
    return $filename;
}

// Save images
$photoFilename = saveImage($photo, 'photo', $uploadDir);
$letterFilename = saveImage($letter, 'letter', $uploadDir);

$signatureFilename = imgsave(
    $signature,
    'signature',
    $sigImageDir,
    $old_signature
);

if ($type == "2" && empty($letterFilename)) {
    echo json_encode([
        'error' => 'Authorization letter upload failed'
    ]);
    exit;
}

error_log("Attempting database insert...");

if (($keyId === 3 || $keyId === 4) && (empty($photoFilename) || empty($signatureFilename))) {
    echo json_encode(['error' => 'Photo and signature required']);
    exit;
}

$result = $set->insertPersonalInfo($pid, $purpose, $userid, $keyId, $fname, $mname, $lname, $citizen, $sex, $civil, $age, $contact, $email, $street, $brgy, $city, $type, $photoFilename, $signatureFilename, $letterFilename);

error_log("Database result code: $result");

if (is_numeric($result) && $result > 4) {
    $response = [
        'success' => 'Form submitted successfully!',
        'user_id' => $result,
        'images' => [
            'photo' => $photoFilename,
            'signature' => $signatureFilename
        ]
    ];
} else {
    $errorMessages = [
        1 => "Failed to prepare Personal Info insert statement",
        2 => "Failed to execute Personal Info insert",
        3 => "Failed to prepare Request insert statement",
        4 => "Failed to execute Request insert"
    ];

    $msg = $errorMessages[$result] ?? "Unknown database error ($result)";
    $response = [
        'error' => $msg,
        'debug_code' => $result
    ];
}



echo json_encode($response);
exit;
