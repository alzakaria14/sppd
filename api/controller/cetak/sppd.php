<?php

require '../../config/connection.php';
require 'fpdf/fpdf.php';
require '../../helper/function.php';

$id_sppd = $_GET['id'];

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
        global $id_sppd;
        $data = mysqli_fetch_assoc(
            mysqli_query(
                $connection,
                "SELECT no_surat, tanggal_berangkat, tanggal_kembali, perihal, maksud_tujuan, tujuan, nama, nip, pangkat, jabatan FROM tb_sppd INNER JOIN tb_user USING (id_user) WHERE id_sppd = '$id_sppd'"
            )
        );
        $this->Ln();
        $this->Ln();
        $this->SetFont('Times', '', 12);
        $this->Cell(40, 7, 'Kode No', 0, 0, 'J');
        $this->Cell(2, 7, ':', 0, 1);
        $this->SetFont('Times', '', 12);
        $this->Cell(40, 7, 'Nomor', 0, 0, 'J');
        $this->Cell(2, 7, ':', 0, 0);
        $this->Cell(50, 7, $data['no_surat'], 0, 0);
        $this->SetFont('Times', 'BU', 14);
        $this->Ln();
        $this->Ln();
        $this->Cell(0, 3, "SURAT PERINTAH PERJALANAN DINAS", 0, 1, 'C');
        $this->SetFont('Times', '', 8);
        $this->Ln();
        $this->Ln();
        $this->Cell(90, 10, '1. Pejabat yang memberi perintah', 1, 0, 'L');
        $this->Cell(100, 10, 'KEPALA DINAS KOMUNIKASI DAN INFORMATIKA KAB. HSS', 1, 1, 'L');
        $this->Cell(90, 10, '2. Nama pegawai yang diperintah', 1, 0, 'L');
        $this->Cell(100, 10, $data['nama'], 1, 1, 'L');
        $this->Cell(90, 10, '3. NIP', 1, 0, 'L');
        $this->Cell(100, 10, $data['nip'], 1, 1, 'L');

        $this->Cell(90, 19, '', 1, 0, 'L');
        $this->Cell(100, 19, '', 1, 1, 'L');
        $this->Text(11, 113.5, '4. a. Pangkat dan golongan');
        $this->Text(11, 117.5, '    b. Jabatan');
        $this->Text(11, 121.5, '    c. Tingkat menurut peraturan perjalanan');
        $this->Text(101, 113.5, '4. a. Pangkat dan golongan');
        $this->Text(101, 117.5, '    b. Jabatan');
        $this->Text(101, 121.5, '    c. Tingkat menurut peraturan perjalanan');

        $this->Cell(90, 10, '5. Maksud Perjalanan Dinas', 1, 0, 'L');
        $this->Cell(100, 10, $data['maksud_tujuan'], 1, 1, 'L');

        $this->Cell(90, 10, '6. Alat Angkut yang dipergunakan', 1, 0, 'L');
        $this->Cell(100, 10, 'Mobil Dinas', 1, 1, 'L');

        $this->Cell(90, 13, '', 1, 0, 'L');
        $this->Cell(100, 13, '', 1, 1, 'L');
        $this->Text(11, 152, '7. a. Tempat Berangkat');
        $this->Text(11, 156, '    b. Tempat Tujuan');
        $this->Text(101, 152, 'Kandangan');
        $this->Text(101, 156, $data['tujuan']);

        $this->Cell(90, 18, '', 1, 0, 'L');
        $this->Cell(100, 18, '', 1, 1, 'L');
        $this->Text(11, 165, '8. a. Lamanya Perjalanan Dinas');
        $this->Text(11, 169, '    b. Tanggal Berangkat');
        $this->Text(11, 173, '    c. Tanggal Harus Kembali');
        $this->Text(101, 165,  calculateDateDifference($data['tanggal_berangkat'], $data['tanggal_kembali']) . ' Hari');
        $this->Text(101, 169, idn_date($data['tanggal_berangkat']));
        $this->Text(101, 173, idn_date($data['tanggal_kembali']));

        $this->Cell(90, 10, '9. Pengikut', 1, 0, 'L');
        $this->Cell(100, 10, '', 1, 1, 'L');

        $this->Cell(90, 18, '', 1, 0, 'L');
        $this->Cell(100, 18, 'Dinas Komunikasi dan Informatika Kab. HSS', 1, 1, 'L');
        $this->Text(11, 193, '10. Pembebanan Anggaran');
        $this->Text(11, 197, '    b. Instansi');
        $this->Text(11, 201, '    c. Mata Anggaran');

        $this->Cell(90, 10, '11. Keterangan Lain-lain', 1, 0, 'L');
        $this->Cell(100, 10, '', 1, 1, 'L');
        $this->SetFont('Times', '', 10);
        $this->Ln();
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
