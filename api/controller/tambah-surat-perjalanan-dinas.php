<?php

use Ramsey\Uuid\Nonstandard\Uuid;

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

$id_sppd = Uuid::uuid1()->toString();
$id_user = $_POST['id_user'];
$no_surat = $_POST['no_surat'];
$tujuan = $_POST['tujuan'];
$perihal = $_POST['perihal'];
$maksud_tujuan = $_POST['maksud_tujuan'];
$tanggal_berangkat = $_POST['tanggal_berangkat'];
$tanggal_kembali = $_POST['tanggal_kembali'];
$is_verify = '0';
$created_at = $datenow;
$updated_at = $datenow;

if (isset($_POST['dasar_surat_uploaded'])) {
    $dasar_surat = $_POST['dasar_surat_uploaded'];
    mysqli_query(
        $connection,
        "INSERT INTO tb_sppd VALUES ('$id_sppd','$id_user','$no_surat','$tujuan','$perihal','$dasar_surat','$maksud_tujuan','$tanggal_berangkat','$tanggal_kembali','$is_verify','0','$created_at','$updated_at')"
    );
} else {
    mysqli_query(
        $connection,
        "INSERT INTO tb_sppd VALUES ('$id_sppd','$id_user','$no_surat','$tujuan','$perihal','0','$maksud_tujuan','$tanggal_berangkat','$tanggal_kembali','$is_verify','0','$created_at','$updated_at')"
    );
}
