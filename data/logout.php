<?php

header("Content-Type: application/json");
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy session
session_destroy();

echo json_encode([
    "status" => "success",
    "redirect" => "../../index.php"
]);