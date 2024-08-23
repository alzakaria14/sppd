<?php

use Ramsey\Uuid\Nonstandard\Uuid;

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

// var_dump($_POST);

$id_user = Uuid::uuid1()->toString();
$nama = $_POST['nama'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password($_POST['password']);
$nip = $_POST['nip'];
$pangkat = $_POST['pangkat'];
$jabatan = $_POST['jabatan'];
$bidang = $_POST['bidang'];
$alamat = $_POST['alamat'];
$roles = 'user';
$is_verify = 0;
$created_at = $datenow;
$updated_at = $datenow;

mysqli_query(
    $connection,
    "INSERT INTO tb_user VALUES ('$id_user','$nama','$username','$email','$password','$nip','$pangkat','$jabatan','$bidang','$alamat','$roles','$is_verify','$created_at','$updated_at')"
);

$response = array(
    'status' => true,
    'msg' => 'success'
);

echo json_encode($response);
