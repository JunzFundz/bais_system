<?php include 'header.php' ?>

<?php if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $_SESSION['certId'] =  $id;
}
?>


<?php
require_once 'confirm.php';
require_once 'alert.php';
switch ($id) {
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