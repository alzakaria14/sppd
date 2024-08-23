<?php

require '../config/connection.php';

if (empty($_COOKIE['id_login'])) {
    $response = array(
        'status' => false,
        'msg' => 'Login first'
    );
    // echo json_encode($response);
    exit;
}

$id_login = $_COOKIE['id_login'];
$token = $_COOKIE['token'];

// echo "SELECT id_user, acces_at FROM tb_login WHERE id_login = '$id_login' AND token = '$token'";


$check = mysqli_fetch_assoc(
    mysqli_query(
        $connection,
        "SELECT id_user, acces_at FROM tb_login WHERE id_login = '$id_login' AND token = '$token'"
    )
);

if ($check !== null) {
    $id_user = $check['id_user'];
    $user = mysqli_fetch_assoc(
        mysqli_query(
            $connection,
            "SELECT username, nama, jabatan FROM tb_user WHERE id_user = '$id_user'"
        )
    );
    mysqli_query(
        $connection,
        "UPDATE tb_login SET acces_at = '$datenow' WHERE id_login = '$id_login'"
    );
    $response = array(
        'status' => true,
        'username' => $user['username'],
        'nama' => $user['nama'],
        'jabatan' => $user['jabatan'],
        'last_login' => $check['acces_at']
    );
} else {
    $response = array(
        'status' => false,
        'msg' => 'Login first'
    );
    exit;
}

// echo json_encode($response);
