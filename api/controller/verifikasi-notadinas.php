<?php

require '../auth/access.php';

$id_notadinas = $_POST['id_notadinas'];

mysqli_query(
    $connection,
    "UPDATE tb_notadinas SET is_verify = '1' WHERE id_notadinas = '$id_notadinas'"
);
