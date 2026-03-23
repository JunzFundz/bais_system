<?php include 'header.php' ?>

<?php if (isset($_GET['id'])) {
    $key = 'certificate-id';
    $method = 'AES-256-CBC';

    $encryptedCertId = $_GET['id'];
    $decoded = base64_decode($encryptedCertId);

    $iv_length = openssl_cipher_iv_length($method);
    $iv = substr($decoded, 0, $iv_length);
    $encrypted = substr($decoded, $iv_length);

    $certId = openssl_decrypt($encrypted, $method, $key, 0, $iv);

    $_SESSION['encryptedCertId'] = $encryptedCertId;
    $_SESSION['certId'] = $certId;

} 
?>


<?php

switch ($certId) {
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