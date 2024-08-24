<?php

require '../auth/access.php';

$id_sppd = $_POST['id_sppd'];

mysqli_query(
    $connection,
    "DELETE FROM tb_sppd WHERE id_sppd = '$id_sppd'"
);
