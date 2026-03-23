<?php
require_once __DIR__ . '/../model/AdminModel.php';

$model = new AdminModel();

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';

    // Check files
    if(!empty($_FILES['files'])){
        $uploadedFiles = $_FILES['files'];
        $fileCount = count($uploadedFiles['name']);
        $savedFiles = [];

        for($i = 0; $i < $fileCount; $i++){
            $tmpName = $uploadedFiles['tmp_name'][$i];
            $fileName = $uploadedFiles['name'][$i];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowed = ['jpg','jpeg','png','pdf','docx'];
            if(!in_array($fileExt, $allowed)){
                continue; // skip invalid file types
            }

            $destination = __DIR__ . '/../uploads/' . time() . "_$fileName";
            if(move_uploaded_file($tmpName, $destination)){
                $savedFiles[] = $destination;
            }
        }

        if(!empty($savedFiles)){
            // Call your AdminModel method to save post info
            $inserted = $model->insertPost($title, $description, $savedFiles);

            if($inserted){
                $response['success'] = true;
                $response['message'] = 'Post uploaded successfully!';
            } else {
                $response['message'] = 'Failed to save post to database.';
            }
        } else {
            $response['message'] = 'No valid files uploaded.';
        }
    } else {
        $response['message'] = 'No files uploaded.';
    }

    echo json_encode($response);
}
?>