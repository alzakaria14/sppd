<?php

require '../../config/connection.php';
require 'fpdf/fpdf.php';
require '../../helper/function.php';

$id_notadinas = $_GET['id'];

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
        global $id_notadinas;
        $data = mysqli_fetch_assoc(
            mysqli_query(
                $connection,
                "SELECT no_surat, tanggal_berangkat, tanggal_kembali, perihal, maksud_tujuan, tujuan, nama, nip, pangkat, jabatan FROM tb_notadinas INNER JOIN tb_user USING (id_user) WHERE id_notadinas = '$id_notadinas'"
            )
        );
        $this->SetFont('Times', 'BU', 14);
        $this->Ln();
        $this->Ln();
        $this->Cell(0, 3, "NOTA PERMINTAAN PERJALANAN DINAS", 0, 1, 'C');
        $this->SetFont('Times', '', 12);
        $this->Ln();
        $this->Ln();
        $this->Cell(40, 8, 'Kepada Yth.', 0, 0, 'L');
        $this->Cell(10, 8, ':', 0, 0, 'C');
        $this->Cell(130, 8, 'Kepala Dinas Komunikasi dan Informatika', 0, 1, 'L');
        $this->Cell(40, 8, 'Dari', 0, 0, 'L');
        $this->Cell(10, 8, ':', 0, 0, 'C');
        $this->Cell(130, 8, 'Kepala Bidang Komunikasi dan Informasi Publik', 0, 1, 'L');
        $this->Cell(40, 8, 'Tanggal', 0, 0, 'L');
        $this->Cell(10, 8, ':', 0, 0, 'C');
        $this->Cell(130, 8, idn_date($data['tanggal_berangkat']), 0, 1, 'L');
        $this->Cell(40, 8, 'Nomor Surat', 0, 0, 'L');
        $this->Cell(10, 8, ':', 0, 0, 'C');
        $this->Cell(130, 8, $data['no_surat'], 0, 1, 'L');
        $this->Cell(40, 8, 'Perihal', 0, 0, 'L');
        $this->Cell(10, 8, ':', 0, 0, 'C');
        $this->Cell(130, 8, $data['perihal'], 0, 1, 'L');
        $this->Cell(10, 4, '', 0, 1);
        //Garis
        $this->Line(10, 100, 200, 100);
        $this->Line(10, 100.5, 200, 100.5);
        //space
        $this->Cell(10, 4, '', 0, 1);
        $this->SetFont('Times', 'B', 12);
        $this->Cell(40, 6, 'A. Maksud dan Tujuan:', 0, 1, 'L');
        $this->SetFont('Times', '', 12);
        $this->MultiCell(190, 6, $data['maksud_tujuan'], 0, 'J');
        $this->Ln();
        $this->SetFont('Times', 'B', 12);
        $this->Cell(40, 6, 'B. Untuk Menugaskan Melakukan Perjalanan Dinas', 0, 1, 'L');
        $this->SetFont('Times', 'B', 12);
        $this->Cell(10, 8, 'No.', 1, 0, 'C');
        $this->Cell(45, 8, 'NAMA', 1, 0, 'C');
        $this->Cell(45, 8, 'NIP', 1, 0, 'C');
        $this->Cell(45, 8, 'PANGKAT/GOL', 1, 0, 'C');
        $this->Cell(45, 8, 'JABATAN', 1, 1, 'C');

        $this->SetFont('Times', '', 10);
        $this->Cell(10, 8, '1', 1, 0, 'C');
        $this->Cell(45, 8, $data['nama'], 1, 0, 'J');
        $this->Cell(45, 8, $data['nip'], 1, 0, 'J');
        $this->Cell(45, 8, $data['pangkat'], 1, 0, 'J');
        $this->Cell(45, 8, $data['jabatan'], 1, 0, 'J');

        $this->Ln();
        $this->Ln();
        $this->SetFont('Times', 'B', 12);
        $this->Cell(40, 6, 'C. Lokasi:', 0, 1, 'L');
        $this->SetFont('Times', '', 12);
        $this->Cell(190, 6, ' -Tempat Berangkat: Kandangan', 0, 1, 'L');
        $this->Cell(190, 6, ' -Tempat Tujuan: ' . $data['tujuan'], 0, 1, 'L');


        $this->Ln();
        $this->Ln();
        $this->SetFont('Times', 'B', 12);
        $this->Cell(60, 6, 'D. Lama Keberangkatan            :', 0, 0, 'L');
        $this->SetFont('Times', '', 12);
        $this->Cell(120, 6, '3 hari', 0, 1, 'L');
        $this->Cell(60, 6, '', 0, 0, 'L');
        $this->Cell(40, 6, 'Tanggal Berangkat', 0, 0, 'L');
        $this->Cell(5, 6, ':', 0, 0, 'C');
        $this->Cell(85, 6, idn_date($data['tanggal_berangkat']), 0, 1, 'L');
        $this->Cell(60, 6, '', 0, 0, 'L');
        $this->Cell(40, 6, 'Tanggal Kembali', 0, 0, 'L');
        $this->Cell(5, 6, ':', 0, 0, 'C');
        $this->Cell(85, 6, idn_date($data['tanggal_kembali']), 0, 1, 'L');
        $this->Ln();
        $this->Cell(190, 6, 'Demikian disampaikan dengan hormat, mohon arahan dan persetujuan Ibu.', 0, 1, 'L');
        $this->Ln();
        $this->Cell(100, 0, '', 0, 0);
        $this->Cell(100, 5, 'Kepala Dinas', 0, 1, 'C');
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
