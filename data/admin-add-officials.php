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
    $emp_id = $_POST['emp_id'];

    $uploadDir = "../profiles/";
    $photoName = '';

    if (!empty($_FILES['photo']['name'])) {

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

        $fileType = $_FILES['photo']['type'];
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

        if (!in_array($fileType, $allowedTypes) || !in_array($ext, $allowedExt)) {
            echo json_encode(['error' => 'Only image files are allowed']);
            exit;
        }

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if ($_FILES['photo']['error'] === 0) {
            $photoName = time() . "_" . basename($_FILES['photo']['name']);
            $filePath = $uploadDir . $photoName;

            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $filePath)) {
                echo json_encode(['error' => 'Upload failed']);
                exit;
            }
        } else {
            echo json_encode(['error' => 'Upload error']);
            exit;
        }
    }

    $insert = $admin->addOfficials($fname, $lname, $mname, $dob, $pob, $cs, $email, $contact, $position, $brgy, $title, $photoName, $emp_id);

    if ($insert) {
        echo json_encode(['success' => "Successfully added"]);
    } else {
        echo json_encode(['error' => "Error db"]);
    }

    exit;
}
