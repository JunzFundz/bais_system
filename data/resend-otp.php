<?php
header('Content-Type: application/json; charset=utf-8');
include("../model/Auth.php");

$sup = new Signup();
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['resend_otp'])) {

    $email = $data['email'] ?? '';

    if (empty($email)) {
        echo json_encode(['error' => 'Email is required']);
        exit;
    }

    $input = $sup->resendOtp($email);

    if ($input) {
        echo json_encode(['success' => "OTP sent"]);
        exit;
    } else {
        echo json_encode(['error' => 'Problem occured during resending otp please try again later']);
        exit;
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
    exit;
}
