<?php

require '../auth/access.php';

$id_sppd = $_POST['id_sppd'];

mysqli_query(
    $connection,
    "UPDATE tb_sppd SET is_verify = '1' WHERE id_sppd = '$id_sppd'"
);
