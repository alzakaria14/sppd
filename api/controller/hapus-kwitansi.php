<?php

require '../auth/access.php';

$id_kwitansi = $_POST['id_kwitansi'];

mysqli_query(
    $connection,
    "DELETE FROM tb_kwitansi WHERE id_kwitansi = '$id_kwitansi'"
);
