<?php

if (isset($_GET['token'])) {
    if ($_GET['token'] !== 'd58258d9-32e3-46f7-8c33-a71923372f09') {
        echo 'No access';
        exit;
    }
}else{
    echo 'no access';
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SPPD - DISKOMINFO</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="assets/js/jquery/jquery-3.7.1.js"></script>

    <!-- Datatable -->
    <link rel="stylesheet" href="assets/css/datatable.css">
    <script src="assets/js/datatable.js"></script>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="" style="">

    <div id=""><!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center" style="">

            <div class="d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center">
                    <img src="assets/img/logo.png" alt="">
                    <span class="d-none d-lg-block">SPPD</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn" onclick="sidebar()"></i>
            </div><!-- End Logo -->
            <input type="hidden" name="sidebar" value="0">



            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            <span class="d-none d-md-block dropdown-toggle ps-2 name">Muhammad Ikhwan</span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6 class="name">Muhammad Ikhwan</h6>
                                <span class="jabatan">Jabatan</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#" onclick="logout()">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>

                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

        </header><!-- End Header -->

    </div>

    <main class="main">
        <div class="pagetitle">
            <h1>Laporan Pertanggung Jawaban</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Laporan Pertanggung Jawaban</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Data Laporan Pertanggung Jawaban</h5>
                            <div class="text-center">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahLaporan">Tambah LPJ</button>
                            </div>

                            <!-- Table with hoverable rows -->
                            <div class="table-responsive">
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">No SPPD</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Bukti/Nota</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        use Ramsey\Uuid\Nonstandard\Uuid;

                                        require '../api/config/connection.php';
                                        require '../api/helper/function.php';
                                        require '../vendor/autoload.php';
                                        $data_modal = [];
                                        $no = 1;
                                        $query = mysqli_query(
                                            $connection,
                                            "SELECT id_lpj, id_sppd, no_surat, nama, bukti, tanggal FROM tb_lpj INNER JOIN tb_sppd USING (id_sppd) INNER JOIN tb_user USING (id_user) ORDER BY tb_lpj.created_at DESC"
                                        );
                                        while ($data = mysqli_fetch_assoc($query)) {
                                            $data_modal[] = array(
                                                'id_lpj' => $data['id_lpj'],
                                                'id_sppd' => $data['id_sppd'],
                                                'no_surat' => $data['no_surat'],
                                                'tanggal' => $data['tanggal'],
                                                'nama' => $data['nama'],
                                                'bukti' => $bukti = json_decode($data['bukti'])
                                            );
                                            $bukti = json_decode($data['bukti']);
                                        ?>
                                            <tr>
                                                <th scope="row"><?= $no++ ?></th>
                                                <td><?= $data['no_surat'] ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <td>
                                                    <ul class="list-group">
                                                        <?php

                                                        foreach ($bukti as $p) {
                                                        ?>
                                                            <li class="list-group-item"><a target="_blank" href="assets/bukti-lpj/<?= $p->bukti ?>">Lihat Bukti</a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </td>
                                                <td><?= idn_date($data['tanggal']) ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editLaporan<?= $data['id_lpj'] ?>">Edit</button>
                                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusLaporan<?= $data['id_lpj'] ?>">Hapus</button>
                                                    <a target="_blank" href="../api/controller/cetak/lpj.php?id=<?= $data['id_lpj'] ?>" class="btn btn-primary btn-sm">Cetak</a>
                                                    <a target="_blank" href="../api/controller/cetak/verifikasi-lpj.php?id=<?= $data['id_lpj'] ?>" class="btn btn-primary btn-sm">Verifikasi QR</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with hoverable rows -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Hapus -->
        <div class="modal fade" id="hapusLaporan6e016e5a-656c-11ef-b7f6-74563cac53f0" tabindex="-1" aria-labelledby="hapusLaporan6e016e5a-656c-11ef-b7f6-74563cac53f0Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="hapusLaporan6e016e5a-656c-11ef-b7f6-74563cac53f0Label">Konfirmasi Hapus Kegiatan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin menghapus Kegiatan <b>123/asdas/123445</b>?<br>data yang sudah dihapus tidak bisa dikembalikan lagi
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="hapusLaporan('6e016e5a-656c-11ef-b7f6-74563cac53f0')">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editLaporan6e016e5a-656c-11ef-b7f6-74563cac53f0" tabindex="-1" aria-labelledby="editLaporan6e016e5a-656c-11ef-b7f6-74563cac53f0Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editLaporan6e016e5a-656c-11ef-b7f6-74563cac53f0Label">Formulir Edit Kegiatan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="editLaporanForm6e016e5a-656c-11ef-b7f6-74563cac53f0" class="row g-3">
                            <input type="hidden" name="id_lpj" value="6e016e5a-656c-11ef-b7f6-74563cac53f0">
                            <div class="col-12">
                                <label for="id_sppd" class="form-label">No. SPPD</label>
                                <input type="text" class="form-control" name="id_sppd" id="id_sppd" value="123/asdas/123445 | Muhammad Ikhwan" disabled="">
                            </div>
                            <div class="col-12">
                                <label for="tanggal" class="form-label">Tanggal Laporan</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="2024-08-29">
                            </div>
                            <div id="list-bukti" class="row g-3">
                                <div class="row g-3" id="first">
                                    <div class="col-12">
                                        <label for="bukti" class="form-label">Bukti/Nota</label>
                                        <div class="input-group">
                                            <input type="file" name="" id="bukti-f1d86f9a-3f9f-11f0-b42f-00155d1a0868" class="form-control">
                                            <button type="button" class="btn btn-primary" id="btn-unggah-f1d86f9a-3f9f-11f0-b42f-00155d1a0868" onclick="uploadBukti('f1d86f9a-3f9f-11f0-b42f-00155d1a0868')">Unggah</button>
                                            <button type="button" class="btn btn-danger" onclick="hapusBukti('first')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                        <div id="f1d86f9a-3f9f-11f0-b42f-00155d1a0868">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-outline-primary" type="button" onclick="tambahListBukti()">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="editLaporan('6e016e5a-656c-11ef-b7f6-74563cac53f0')" data-bs-dismiss="modal">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal tambah pegawai -->
        <div class="modal fade" id="tambahLaporan" tabindex="-1" aria-labelledby="tambahLaporanLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahLaporanLabel">Formulir Tambah LPJ</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="tambahLaporanForm" class="row g-3">
                            <div class="col-12">
                                <label for="id_sppd" class="form-label">No. SPPD</label>
                                <select name="id_sppd" id="id_sppd" class="form-control">
                                    <option value="" selected="" disabled="">-- Pilih SPPD --</option>
                                    <option value="d7333916-6572-11ef-b787-74563cac53f0">123/asdas/123445 | alzakaria</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="tanggal" class="form-label">Tanggal Laporan</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control">
                            </div>
                            <div id="list-bukti" class="row g-3">
                                <div class="row g-3" id="first">
                                    <div class="col-12">
                                        <label for="bukti" class="form-label">Bukti/Nota</label>
                                        <div class="input-group">
                                            <input type="file" name="" id="bukti-f1d88ff2-3f9f-11f0-b111-00155d1a0868" class="form-control">
                                            <button type="button" class="btn btn-primary" id="btn-unggah-f1d88ff2-3f9f-11f0-b111-00155d1a0868" onclick="uploadBukti('f1d88ff2-3f9f-11f0-b111-00155d1a0868')">Unggah</button>
                                            <button type="button" class="btn btn-danger" onclick="hapusBukti('first')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                        <div id="f1d88ff2-3f9f-11f0-b111-00155d1a0868">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-outline-primary" type="button" onclick="tambahListBukti()">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="tambahLaporan()" data-bs-dismiss="modal">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            © Copyright 2024 <strong><span>SPPD Diskominfo</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            getDataUser();
            $('#datatable').DataTable();
        });
    </script>



    <svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
        <defs id="SvgjsDefs1002"></defs>
        <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
        <path id="SvgjsPath1004" d="M0 0 "></path>
    </svg>
</body>

</html>