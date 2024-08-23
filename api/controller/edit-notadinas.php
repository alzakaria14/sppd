<?php

require '../auth/access.php';
require '../../vendor/autoload.php';
require '../helper/function.php';

// var_dump($_POST);

$id_notadinas = $_POST['id_notadinas'];
$id_user = $_POST['id_user'];
$no_surat = $_POST['no_surat'];
$tujuan = $_POST['tujuan'];
$perihal = $_POST['perihal'];
$maksud_tujuan = $_POST['maksud_tujuan'];
$tanggal_berangkat = $_POST['tanggal_berangkat'];
$tanggal_kembali = $_POST['tanggal_kembali'];
$is_verify = '0';
$updated_at = $datenow;

if (isset($_POST['dasar_surat_uploaded'])) {
    $dasar_surat = $_POST['dasar_surat_uploaded'];
    mysqli_query(
        $connection,
        "UPDATE tb_notadinas SET 
        id_user = '$id_user',
        no_surat = '$no_surat',
        tujuan = '$tujuan',
        perihal = '$perihal',
        dasar_surat = '$dasar_surat',
        maksud_tujuan = '$maksud_tujuan',
        tanggal_berangkat = '$tanggal_berangkat',
        tanggal_kembali = '$tanggal_kembali',
        updated_at = '$updated_at'
        WHERE id_notadinas = '$id_notadinas'"
    );
} else {
    mysqli_query(
        $connection,
        "UPDATE tb_notadinas SET 
        id_user = '$id_user',
        no_surat = '$no_surat',
        tujuan = '$tujuan',
        perihal = '$perihal',
        maksud_tujuan = '$maksud_tujuan',
        tanggal_berangkat = '$tanggal_berangkat',
        tanggal_kembali = '$tanggal_kembali',
        updated_at = '$updated_at'
        WHERE id_notadinas = '$id_notadinas'"
    );
}
