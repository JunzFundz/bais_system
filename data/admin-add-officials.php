<?php
session_start();

header('Content-Type: application/json');

require_once "../model/AdminModel.php";

$admin = new AdminModel();

if (isset($_POST['addOfficial'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $pob = $_POST['pob'];
    $cs = $_POST['cs'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $position = $_POST['position'];
    $brgy = $_POST['brgy'];
    $title = $_POST['otitle'];

    $insert = $admin->addOfficials($fname, $lname, $mname, $dob, $pob, $cs, $email, $contact, $position, $brgy, $title);

    if ($insert) {
        $response = [
            'success' => "Successfully added"
        ];
    } else {
        $response = [
            'error' => "Error db"
        ];
    }

    echo json_encode($response);
    exit;
}
