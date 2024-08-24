<?php

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

// var_dump($_POST);

$id_anggaran = $_POST['id_anggaran'];
$uang_harian = $_POST['uang_harian'];
$transportasi = $_POST['transportasi'];
$penginapan = $_POST['penginapan'];
$updated_at = $datetime;

mysqli_query(
    $connection,
    "UPDATE tb_anggaran SET
    uang_harian = '$uang_harian',
    transportasi = '$transportasi',
    penginapan = '$penginapan'
    WHERE id_anggaran = '$id_anggaran'"
);
