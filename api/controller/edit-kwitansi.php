<?php

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

// var_dump($_POST);

$id_kwitansi = $_POST['id_kwitansi'];
$jumlah = $_POST['jumlah'];
$perihal = $_POST['perihal'];
$updated_at = $datenow;

mysqli_query(
    $connection,
    "UPDATE tb_kwitansi SET
    jumlah = '$jumlah',
    perihal = '$perihal',
    updated_at = '$updated_at'
    WHERE id_kwitansi = '$id_kwitansi'"
);
