<?php

function password($params)
{
    global $salt;
    return hash('sha256', $salt . $params . $salt);
}

function idn_date($tanggal)
{
    $namaHari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    $namaBulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

    $tanggalObjek = new DateTime($tanggal);

    $hari = $namaHari[$tanggalObjek->format('w')];
    $bulan = $namaBulan[$tanggalObjek->format('n') - 1];
    $tanggal = $tanggalObjek->format('j');
    $tahun = $tanggalObjek->format('Y');

    return "$hari, $tanggal $bulan $tahun";
}

function rupiah($number)
{
    $result = "Rp " . number_format($number, 0, ',', '.');
    return $result;
}

function terbilang($angka)
{
    $satuan = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
    $belasan = array('', 'Sepuluh', 'Sebelas', 'Dua Belas', 'Tiga Belas', 'Empat Belas', 'Lima Belas', 'Enam Belas', 'Tujuh Belas', 'Delapan Belas', 'Sembilan Belas');
    $puluhan = array('', 'Sepuluh', 'Dua Puluh', 'Tiga Puluh', 'Empat Puluh', 'Lima Puluh', 'Enam Puluh', 'Tujuh Puluh', 'Delapan Puluh', 'Sembilan Puluh');
    $ribuan = array('', 'Ribu', 'Juta', 'Miliar', 'Triliun');

    if ($angka == 0) return 'Nol';

    $terbilang = '';
    $idx = 0;

    while ($angka > 0) {
        $bagian = $angka % 1000;
        if ($bagian > 0) {
            $strBagian = '';
            $ratusan = floor($bagian / 100);
            $sisa = $bagian % 100;

            if ($ratusan > 0) {
                $strBagian .= $satuan[$ratusan] . ' Ratus ';
            }

            if ($sisa < 20) {
                $strBagian .= ($sisa < 10 ? $satuan[$sisa] : $belasan[$sisa - 10]);
            } else {
                $puluh = floor($sisa / 10);
                $unit = $sisa % 10;
                $strBagian .= $puluhan[$puluh] . ($unit > 0 ? ' ' . $satuan[$unit] : '');
            }

            $terbilang = $strBagian . ($ribuan[$idx] ? ' ' . $ribuan[$idx] : '') . ' ' . $terbilang;
        }

        $angka = floor($angka / 1000);
        $idx++;
    }

    return trim($terbilang);
}
