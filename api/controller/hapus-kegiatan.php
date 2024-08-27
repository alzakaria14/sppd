<?php

require '../auth/access.php';

$id_kegiatan = $_POST['id_kegiatan'];

mysqli_query(
    $connection,
    "DELETE FROM tb_kegiatan WHERE id_kegiatan = '$id_kegiatan'"
);
