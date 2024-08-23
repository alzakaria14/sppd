<?php

use Ramsey\Uuid\Nonstandard\Uuid;

require '../auth/access.php';
require '../../vendor/autoload.php';

$filename = $_FILES['dasar_surat']['name'];
$file = $_FILES['dasar_surat']['tmp_name'];
$type = $_FILES['dasar_surat']['type'];
$fileNameCmps = explode(".", $filename);
$extension = end($fileNameCmps);
$fileExtension = strtolower($extension);
// $fileExtension = strtolower($fileExtension);
$newFilename = Uuid::uuid1()->toString() . '.' . $fileExtension;

// echo $fileExtension;

$allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
if (in_array($fileExtension, $allowedExtensions)) {
    $uploadFileDir = '../../views/assets/dasar-surat/';
    $dest_path = $uploadFileDir . $newFilename;

    move_uploaded_file($file, $dest_path);
    $response = array(
        'status' => true,
        'filename' => $newFilename,
        'originalFilename' => $filename
    );
} else {
    $response = array(
        'status' => false
    );
}

echo json_encode($response);
