<?php
require_once __DIR__ . "/../model/Staff.php";
$staff = new Staff();

$brgy_id = $_POST['brgy_id'];
$removedFiles = json_decode($_POST['removed_files'] ?? '[]', true);

$uploadDir = __DIR__ . '/../uploads/activities/';

$current = $staff->getPost($brgy_id);
$currentFiles = json_decode($current['FILES'] ?? '[]', true);

$updatedFiles = array_values(array_diff($currentFiles, $removedFiles));

foreach ($removedFiles as $file) {
    $filePath = $uploadDir . basename($file);
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

if (!empty($_FILES['files']['name'][0])) {
    foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
        $originalName = $_FILES['files']['name'][$key];
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);

        $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName);
        $newName = time() . '_' . uniqid() . '.' . $ext;

        $destination = $uploadDir . $newName;

        if (move_uploaded_file($tmpName, $destination)) {
            $updatedFiles[] = $newName;
        }
    }
}

$staff->updateFiles($brgy_id, json_encode($updatedFiles));

echo json_encode([
    'success' => true,
    'files' => $updatedFiles
]);