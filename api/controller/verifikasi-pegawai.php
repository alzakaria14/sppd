<?php

require '../auth/access.php';

$id_user = $_POST['id_user'];

mysqli_query(
    $connection,
    "UPDATE tb_user SET is_verify = '1' WHERE id_user = '$id_user'"
);
