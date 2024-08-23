<?php

function password($params)
{
    global $salt;
    return hash('sha256', $salt . $params . $salt);
}

function idn_date($tanggal) {
    $namaHari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    $namaBulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    
    $tanggalObjek = new DateTime($tanggal);
    
    $hari = $namaHari[$tanggalObjek->format('w')];
    $bulan = $namaBulan[$tanggalObjek->format('n') - 1];
    $tanggal = $tanggalObjek->format('j');
    $tahun = $tanggalObjek->format('Y');
    
    return "$hari, $tanggal $bulan $tahun";
}
