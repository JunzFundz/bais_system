<?php

header("Content-Type: application/json");
session_start();

require __DIR__ . '/../model/Client.php';

$userModel = new Client();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
    exit;
}

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid JSON"
    ]);
    exit;
}

if (empty($_SESSION['userEmail'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Session expired. Please login again."
    ]);
    exit;
}

if (empty($data['fname']) || empty($data['lname'])) {
    echo json_encode([
        "status" => "error",
        "message" => "First name and last name required"
    ]);
    exit;
}

try {

    $updated = $userModel->update($data);

    if ($updated) {
        echo json_encode([
            "status" => "success",
            "message" => "Profile updated"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Nothing updated"
        ]);
    }

} catch (Exception $e) {

    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);

}