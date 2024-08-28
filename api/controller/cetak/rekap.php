<?php

require '../../config/connection.php';
require 'fpdf/fpdf.php';
require '../../helper/function.php';

$start_date = $_GET['1'];
$end_date = $_GET['2'];

// echo "SELECT no_surat, tanggal_berangkat, tanggal_kembali, perihal, maksud_tujuan, tujuan, nama, nip, pangkat, jabatan FROM tb_sppd INNER JOIN tb_user USING (id_user) WHERE is_done = '1' WHERE tanggal_berangkat BETWEEN '$start_date' AND '$end_date'";

class PDF extends FPDF
{
    function Header()
    {
        global $user;
        $this->SetY(10);
        $this->Image('../../../views/assets/img/logo.png', 10, 8, 30, 30, '', '');

        // judul
        $this->SetFont('Times', '', 16);
        $this->SetTextColor(1, 57, 116);
        $this->Cell(0, 7, "PEMERINTAH KABUPATEN HULU SUNGAI SELATAN", 0, 1, 'R');
        $this->SetFont('Times', '', 18);
        $this->Cell(0, 7, "DINAS KOMUNIKASI DAN INFORMATIKA", 0, 1, 'R');
        $this->SetFont('Times', '', 12);
        $this->SetTextColor(0, 0, 0);
        $this->Ln();
        $this->Cell(0, 1, "Jalan Aluh Idut No. 66 A Telp/Fax. (0517) 21230 KANDANGAN - 71212", 0, 1, 'R');
        $this->Cell(10, 4, '', 0, 1);
        //Garis
        $this->Line(10, 40, 200, 40);
        $this->Line(10, 40.5, 200, 40.5);
        //space
        $this->Cell(10, 4, '', 0, 1);
    }
    //Page Content
    function Content()
    {
        // max 190
        global $connection;
        global $start_date;
        global $end_date;
        $query = mysqli_query(
            $connection,
            "SELECT no_surat, tanggal_berangkat, tanggal_kembali, perihal, maksud_tujuan, tujuan, nama, nip, pangkat, jabatan FROM tb_sppd INNER JOIN tb_user USING (id_user) WHERE is_done = '1' AND tanggal_berangkat BETWEEN '$start_date' AND '$end_date'"
        );
        $this->SetFont('Times', 'BU', 14);
        $this->Ln();
        $this->Ln();
        $this->Cell(0, 8, "REKAP SURAT PERJLANAN DINAS", 0, 1, 'C');
        $this->SetFont('Times', 'I', 10);
        $this->Cell(0, 3, idn_date($start_date) . ' - ' . idn_date($end_date), 0, 1, 'C');
        $this->SetFont('Times', '', 12);
        $this->Ln();
        $this->Ln();
        $no = 1;
        while ($data = mysqli_fetch_assoc($query)) {
            $this->Cell(190, 0, '', 1, 1);
            $this->Cell(190, 4, '', 0, 1);
            $this->Cell(8, 6, $no++ . '.', 0, 0, 'L');
            $this->Cell(40, 6, 'No. SPPD', 0, 0, 'L');
            $this->Cell(10, 6, ':', 0, 0, 'C');
            $this->Cell(130, 6, $data['no_surat'], 0, 1, 'L');
            $this->Cell(8, 6, '', 0, 0, 'L');
            $this->Cell(40, 6, 'Nama', 0, 0, 'L');
            $this->Cell(10, 6, ':', 0, 0, 'C');
            $this->Cell(130, 6, $data['nama'], 0, 1, 'L');
            $this->Cell(8, 6, '', 0, 0, 'L');
            $this->Cell(40, 6, 'Tempat Tujuan', 0, 0, 'L');
            $this->Cell(10, 6, ':', 0, 0, 'C');
            $this->Cell(130, 6, $data['tujuan'], 0, 1, 'L');
            $this->Cell(8, 6, '', 0, 0, 'L');
            $this->Cell(40, 6, 'Maksud Tujuan', 0, 0, 'L');
            $this->Cell(10, 6, ':', 0, 0, 'C');
            $this->MultiCell(130, 6, $data['maksud_tujuan'], 0, 'J');
            $this->Cell(8, 6, '', 0, 0, 'L');
            $this->Cell(40, 6, 'Tanggal', 0, 0, 'L');
            $this->Cell(10, 6, ':', 0, 0, 'C');
            $this->Cell(130, 6, idn_date($data['tanggal_berangkat']) . ' - ' . idn_date($data['tanggal_kembali']), 0, 1, 'L');
            $this->Cell(190, 4, '', 0, 1);
            $this->Cell(190, 0, '', 1, 1);
        }
        $this->Cell(190, 4, '', 0, 1);
        $this->Ln();
        $this->SetFont('Times', '', 12);
        $this->Cell(100, 0, '', 0, 0);
        $this->Cell(100, 5, 'Kepala Dinas,', 0, 1, 'C');
        $this->Cell(100, 0, '', 0, 0);
        $this->Cell(100, 5, idn_date(date('Y-m-d')), 0, 1, 'C');
        $this->Cell(120, 7, '', 0, 1);
        $this->Cell(120, 7, '', 0, 1);
        $this->Cell(120, 7, '', 0, 1);
        $this->Cell(100, 0, '', 0, 0);
        $this->SetFont('Times', 'B', 12);
        $this->Cell(100, 5, 'Hj. Rahmawaty, ST, MT', 0, 1, 'C');
        $this->SetFont('Times', '', 12);
        $this->Cell(129, 5, '', 0, 0);
        $this->Cell(120, 5, 'Pembina Utama Muda', 0, 1);
        $this->Cell(125, 5, '', 0, 0);
        $this->Cell(0, 5, 'NIP. 197107261997032005', 0, 1);
    }

    //Page footer
    function Footer()
    {
        $this->SetFont('Times', '', 16);
        //atur posisi 1.5 cm dari bawah
        // $this->SetY(-15);
        // $this->Image('../../views/assets/img/logo-footer.png', 10, null, 32.1, 11.6, '', '');
        // $this->SetY(-25);
        // $this->SetX(-40);
        // $this->Image('../../views/assets/img/logo-footer-qr.png', null, null, 32.1, 21.8, '', '');
        //buat garis horizontal
        //Arial italic 9
        $this->SetFont('Times', 'I', 9);
        //nomor halaman
        $this->SetY(-12);
        $this->SetX(0);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo() . ' dari {nb}', 0, 0, 'C');
    }
}
//logo


// Memberikan space kebawah agar tidak terlalu rapat
$pdf = new PDF('p', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content();
$pdf->Output();
