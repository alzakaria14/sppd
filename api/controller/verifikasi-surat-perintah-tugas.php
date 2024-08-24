<?php

require '../auth/access.php';

$id_spt = $_POST['id_spt'];

mysqli_query(
    $connection,
    "UPDATE tb_spt SET is_verify = '1' WHERE id_spt = '$id_spt'"
);
