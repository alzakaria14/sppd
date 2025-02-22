<?php

use Ramsey\Uuid\Nonstandard\Uuid;

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$gambar = $_FILES['gambar'];

$gambar_name = $gambar['name'];
$gambar_tmp = $gambar['tmp_name'];
$created_at = date('Y-m-d H:i:s');

//simpan gambar
$gambar_ext = explode('.', $gambar_name);
$gambar_ext = strtolower(end($gambar_ext));
$gambar_save = Uuid::uuid4()->toString() . '.' . $gambar_ext;

move_uploaded_file($gambar_tmp, '../../views/assets/img/' . $gambar_save);

mysqli_query(
    $connection,
    "INSERT INTO tb_slider (id_slider, judul, deskripsi, gambar, created_at) VALUES ('$gambar_save', '$judul', '$deskripsi', '$gambar_save','$created_at')"
);

echo 1;
