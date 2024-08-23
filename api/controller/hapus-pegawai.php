<?php

require '../auth/access.php';

$id_user = $_POST['id_user'];

mysqli_query(
    $connection,
    "DELETE FROM tb_user WHERE id_user = '$id_user'"
);
