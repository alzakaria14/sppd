<?php

require '../auth/access.php';

$id_anggaran = $_POST['id_anggaran'];

mysqli_query(
    $connection,
    "DELETE FROM tb_anggaran WHERE id_anggaran = '$id_anggaran'"
);
