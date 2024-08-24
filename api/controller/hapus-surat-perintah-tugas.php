<?php

require '../auth/access.php';

$id_spt = $_POST['id_spt'];

mysqli_query(
    $connection,
    "DELETE FROM tb_spt WHERE id_spt = '$id_spt'"
);
