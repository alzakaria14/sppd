<?php

use Ramsey\Uuid\Nonstandard\Uuid;

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

$id_lpj = $_POST['id_lpj'];
$tanggal = $_POST['tanggal'];
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
    "UPDATE tb_lpj SET tanggal = '$tanggal', bukti = '$bukti', updated_at = '$updated_at' WHERE id_lpj = '$id_lpj'"
);
