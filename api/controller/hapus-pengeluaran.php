<?php

require '../auth/access.php';

$id_pengeluaran = $_POST['id_pengeluaran'];

mysqli_query(
    $connection,
    "DELETE FROM tb_pengeluaran WHERE id_pengeluaran = '$id_pengeluaran'"
);
