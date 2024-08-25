<?php

use Ramsey\Uuid\Nonstandard\Uuid;

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

$id_pengeluaran = Uuid::uuid1()->toString();
$id_sppd = $_POST['id_sppd'];
$created_at = $datenow;
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
    "INSERT INTO tb_pengeluaran VALUES ('$id_pengeluaran','$id_sppd','$pengeluaran','$created_at','$updated_at')"
);
