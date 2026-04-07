<?php
session_start();
require_once __DIR__ . '/../../model/Staff.php';

$required_sessions = ['token_login', 'user_role', 'u_id', 'OFFICIALS_LOG_ID'];
$session_valid = true;

foreach ($required_sessions as $key) {
    if (!isset($_SESSION[$key]) || empty($_SESSION[$key])) {
        $session_valid = false;
        break;
    }
}

if (!$session_valid) {
    session_unset();
    session_destroy();
    header('Location: ../../index.php');
    exit;
}

$_SESSION['user_role'];
$_SESSION['u_id'];
$_SESSION['OFFICIALS_LOG_ID'];
$off_id = $_SESSION['OFFICIAL_ID'];

$brgyID = $_SESSION['BRGY_ID'];

include('modal-update-official.php');
include('modal-mail.php');
include('modal-requests.php');
include('add-activity.php');

$admin = new Staff();

$brgy = $admin->getBrgy();
$users = $admin->getAllUsers();
$req = $admin->getAllReq();
$viewbrgy = $admin->getAllBrgy($brgyID);
$viewofficials = $admin->getOfficialsBrgy($brgyID);
$offs = $admin->getOfficialInfo($off_id);

?>