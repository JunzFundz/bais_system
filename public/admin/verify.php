<?php 
// include 'header.php';

$uid = $_SESSION['USER_ID'];
$pid = $_SESSION['PI_ID'];
$rid = $_SESSION['REQ_ID'];
$cid = $_SESSION['CERT_ID'];

$d = $admin->generate($uid, $pid, $rid, $cid);
?>


<?php

switch ($cid) {
    case 1:
        require_once 'templates/financial_assistance.php';
        break;

    case 2:
        require_once 'templates/embalming.php';
        break;
    case 3:
        require_once 'templates/barangay_clearance.php';
        break;
    case 4:
        require_once 'templates/loan.php';
        break;
    case 5:
        require_once 'templates/burial_assistance.php';
        break;

    default:

    echo "invalid";
    break;

}


?>

<?php include 'footer.php' ?>







