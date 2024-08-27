<?php

use Ramsey\Uuid\Nonstandard\Uuid;

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

$id_kegiatan = Uuid::uuid1()->toString();
$id_sppd = $_POST['id_sppd'];
$created_at = $datenow;
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
    "INSERT INTO tb_kegiatan VALUES ('$id_kegiatan','$id_sppd','$kegiatan','$created_at','$updated_at')"
);
