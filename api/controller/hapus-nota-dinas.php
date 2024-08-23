<?php

require '../auth/access.php';

$id_notadinas = $_POST['id_notadinas'];

mysqli_query(
    $connection,
    "DELETE FROM tb_notadinas WHERE id_notadinas = '$id_notadinas'"
);
