<?php

require '../auth/access.php';

$id_lpj = $_POST['id_lpj'];

$id_sppd = mysqli_fetch_assoc(
    mysqli_query(
        $connection,
        "SELECT id_sppd FROM tb_lpj WHERE id_lpj = '$id_lpj'"
    )
)['id_sppd'];

mysqli_query(
    $connection,
    "UPDATE tb_sppd SET is_done = '0' WHERE id_sppd = '$id_sppd'"
);

mysqli_query(
    $connection,
    "DELETE FROM tb_lpj WHERE id_lpj = '$id_lpj'"
);
