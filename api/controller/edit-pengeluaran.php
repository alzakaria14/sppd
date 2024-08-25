<?php


require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

$id_pengeluaran = $_POST['id_pengeluaran'];
$updated_at = $datenow;
$pengeluaran = [];

for ($i = 0; $i < count($_POST['jumlah']); $i++) {
    $pengeluaran[] = array(
        'keterangan' => $_POST['keterangan'][$i],
        'jumlah' => $_POST['jumlah'][$i]
    );
}

$pengeluaran = json_encode($pengeluaran);

mysqli_query(
    $connection,
    "UPDATE tb_pengeluaran SET pengeluaran = '$pengeluaran' WHERE id_pengeluaran = '$id_pengeluaran'"
);

