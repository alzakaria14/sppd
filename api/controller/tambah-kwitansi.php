<?php

use Ramsey\Uuid\Nonstandard\Uuid;

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

$id_kwitansi = Uuid::uuid1()->toString();
$id_sppd = $_POST['id_sppd'];
$jumlah = $_POST['jumlah'];
$perihal = $_POST['perihal'];
$created_at = $datenow;
$updated_at = $datenow;

mysqli_query(
    $connection,
    "INSERT INTO tb_kwitansi VALUES ('$id_kwitansi','$id_sppd','$jumlah','$perihal','$created_at','$updated_at')"
);
