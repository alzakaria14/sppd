<?php

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

// var_dump($_POST);

$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$email = $_POST['email'];
$nip = $_POST['nip'];
$pangkat = $_POST['pangkat'];
$jabatan = $_POST['jabatan'];
$bidang = $_POST['bidang'];
$alamat = $_POST['alamat'];
$roles = $_POST['roles'];
$updated_at = $datenow;

if ($_POST['password'] == '') {
    $query = "UPDATE tb_user SET id_user = '$id_user', nama = '$nama', username = '$username', email = '$email', nip = '$nip', pangkat = '$pangkat', jabatan = '$jabatan', bidang = '$bidang', alamat = '$alamat', roles = '$roles', updated_at = '$updated_at' WHERE id_user = '$id_user'";
} else {
    $password = password($_POST['password']);
    $query = "UPDATE tb_user SET id_user = '$id_user', nama = '$nama', username = '$username', email = '$email', nip = '$nip', pangkat = '$pangkat', jabatan = '$jabatan', bidang = '$bidang', alamat = '$alamat', roles = '$roles', updated_at = '$updated_at' WHERE id_user = '$id_user'";
}

mysqli_query(
    $connection,
    $query
);
