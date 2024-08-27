<?php

use Ramsey\Uuid\Nonstandard\Uuid;

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

$id_lpj = Uuid::uuid1()->toString();
$id_sppd = $_POST['id_sppd'];
$tanggal = $_POST['tanggal'];
$created_at = $datenow;
$updated_at = $datenow;
$bukti = [];

for ($i = 0; $i < count($_POST['bukti']); $i++) {
    $bukti[] = array(
        'bukti' => $_POST['bukti'][$i]
    );
}

$bukti = json_encode($bukti);

mysqli_query(
    $connection,
    "INSERT INTO tb_lpj VALUES ('$id_lpj','$id_sppd','$tanggal','$bukti','$created_at','$updated_at')"
);

mysqli_query(
    $connection,
    "UPDATE tb_sppd SET is_done = '1' WHERE id_sppd = '$id_sppd'"
);
