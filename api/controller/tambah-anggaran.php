<?php

use Ramsey\Uuid\Nonstandard\Uuid;

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

$id_anggaran = Uuid::uuid1()->toString();
$id_sppd = $_POST['id_sppd'];
$uang_harian = $_POST['uang_harian'];
$transportasi = $_POST['transportasi'];
$penginapan = $_POST['penginapan'];
$created_at = $datenow;
$updated_at = $datenow;

mysqli_query(
    $connection,
    "INSERT INTO tb_anggaran VALUES ('$id_anggaran','$id_sppd','$uang_harian','$transportasi','$penginapan','$created_at','$updated_at')"
);
