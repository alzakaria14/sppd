<?php

use Ramsey\Uuid\Nonstandard\Uuid;

require '../config/connection.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

$username = mysqli_real_escape_string($connection, $_POST['username']);
$password = password($_POST['password']);

$check = mysqli_fetch_assoc(
    mysqli_query(
        $connection,
        "SELECT id_user, roles FROM tb_user WHERE username = '$username' AND password = '$password'"
    )
);

if ($check !== null) {
    $id_user = $check['id_user'];
    $id_login = Uuid::uuid1()->toString();
    $token = password(Uuid::uuid1()->toString());
    $login_at = $datenow;
    $acces_at = $datenow;
    mysqli_query(
        $connection,
        "INSERT INTO tb_login VALUES ('$id_login','$id_user','$token','$login_at','$acces_at')"
    );
    setcookie('id_login', $id_login, time() + (86400 * 360), '/');
    setcookie('token', $token, time() + (86400 * 360), '/');
    setcookie('roles', $check['roles'], time() + (86400 * 360), '/');
    $response = array(
        'status' => true,
        'msg' => 'Login succes'
    );
} else {
    $response = array(
        'status' => false,
        'msg' => '<span class="text-danger">Username atau password salah</span>'
    );
}

echo json_encode($response);
