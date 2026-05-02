<?php
session_start();
header('Content-Type: application/json');

require_once '../model/Client.php';

$staff = new Client();

try {
    $id      = $_POST['user_id'];
    $fname   = trim($_POST['fname'] ?? '');
    $mname   = trim($_POST['mname'] ?? '');
    $lname   = trim($_POST['lname'] ?? '');
    $dob     = $_POST['dob'] ?? '';
    $pob     = trim($_POST['pob'] ?? '');
    $cs      = $_POST['cs'] ?? '';
    $gender  = $_POST['gender'] ?? '';
    $email   = trim($_POST['uemail'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $brgy    = $_POST['brgy'] ?? '';
    $street  = trim($_POST['street'] ?? '');
    $city    = trim($_POST['city'] ?? '');
    $signature = $_POST['signature'] ?? '';

    $old_signature = $_POST['old_signature'] ?? null;
    $old_pp        = $_POST['old_pp'] ?? null;

    if (!$id || !$fname || !$lname) {
        echo json_encode(['success' => false, 'error' => 'Missing required fields']);
        exit;
    }

    // $signaturePath = $old_signature;
    $avatarPath    = $old_pp;

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {

        $avatarDir = __DIR__ . '/../profiles/';
        if (!is_dir($avatarDir)) {
            mkdir($avatarDir, 0755, true);
        }

        $avatar = $_FILES['avatar'];
        $avatarExt = pathinfo($avatar['name'], PATHINFO_EXTENSION);

        $avatarFilename = 'avatar_' . $id . '_' . time() . '.' . $avatarExt;
        $avatarFullPath = $avatarDir . $avatarFilename;

        if (move_uploaded_file($avatar['tmp_name'], $avatarFullPath)) {
            if (!empty($old_pp) && file_exists(__DIR__ . '/../profiles/' . basename($old_pp))) {
                unlink(__DIR__ . '/../profiles/' . basename($old_pp));
            }
            $avatarPath = '../profiles/' . $avatarFilename;
        } else {
            echo json_encode(['success' => false, 'error' => 'Avatar upload failed']);
            exit;
        }
    }

    $imgDir = __DIR__ . '/../uploads/signatures/';

    if (!is_dir($imgDir)) {
        if (!mkdir($imgDir, 0755, true)) {
            error_log("Failed to create uploads directory");
            $response = ['error' => 'Failed to create upload directory'];
            echo json_encode($response);
            exit;
        }
        error_log("Created uploads directory");
    }

    function signature($base64Data, $prefix, $imgDir, $oldFile = '')
    {
        if (empty($base64Data)) {
            error_log("No image data for $prefix");
            return $oldFile; // keep old if no new
        }

        // Extract image type
        if (!preg_match('/^data:image\/(\w+);base64,/', $base64Data, $matches)) {
            error_log("Invalid base64 format for $prefix");
            return $oldFile;
        }

        // ✅ DELETE OLD FILE FIRST
        if (!empty($oldFile)) {
            $oldPath = $imgDir . basename($oldFile);

            if (file_exists($oldPath)) {
                unlink($oldPath);
                error_log("Deleted old signature: $oldPath");
            }
        }

        $imageType = $matches[1];
        $extension = ($imageType === 'jpeg') ? 'jpg' : $imageType;

        $imageData = preg_replace('#^data:image/\w+;base64,#i', '', $base64Data);
        $imageData = str_replace(' ', '+', $imageData);

        $filename = $prefix . '_users_' . time() . '_' . uniqid() . '.' . $extension;
        $fullPath = $imgDir . $filename;

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

    $signaturePath = signature(
        $signature,
        'signature',
        $imgDir,
        $old_signature
    );

    $saved = $staff->updateInfo($id, $fname, $mname, $lname, $dob, $pob, $cs, $gender, $email, $contact, $brgy, $street, $city, $signaturePath, $avatarPath);

    if ($saved) {
        echo json_encode([
            'success' => 'Saved successfully!',
            'signature' => $signaturePath,
            'avatar' => $avatarPath
        ]);
    } else {
        echo json_encode(['success' => 'Database insert failed']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => $e->getMessage()]);
}
