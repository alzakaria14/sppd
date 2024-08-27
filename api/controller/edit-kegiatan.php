<?php


require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

$id_kegiatan = $_POST['id_kegiatan'];
$updated_at = $datenow;
$kegiatan = [];

for ($i = 0; $i < count($_POST['kegiatan']); $i++) {
    $kegiatan[] = array(
        'kegiatan' => $_POST['kegiatan'][$i],
        'tanggal' => $_POST['tanggal'][$i],
        'tempat' => $_POST['tempat'][$i]
    );
}

$kegiatan = json_encode($kegiatan);

mysqli_query(
    $connection,
    "UPDATE tb_kegiatan SET kegiatan = '$kegiatan' WHERE id_kegiatan = '$id_kegiatan'"
);
