<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

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
                    <span class="d-none d-md-block dropdown-toggle ps-2 name"></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6 class="name"></h6>
                        <span class="jabatan"></span>
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

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" onclick="nav('dashboard')">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" onclick="nav('nota-dinas')">
                <i class="bi bi-envelope"></i>
                <span>Nota Dinas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" onclick="nav('surat-perjalanan-dinas')">
                <i class="bi bi-envelope"></i>
                <span>Surat Perjalanan Dinas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" onclick="nav('surat-perintah-tugas')">
                <i class="bi bi-envelope"></i>
                <span>Surat Perintah Tugas</span>
            </a>
        </li>

        <?php

        if ($_COOKIE['roles'] === 'admin') {
        ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" onclick="nav('anggaran')">
                    <i class="bi bi-cash"></i>
                    <span>Anggaran</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" onclick="nav('kwitansi')">
                    <i class="bi bi-cash"></i>
                    <span>Kwitansi</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" onclick="nav('pengeluaran-rill')">
                    <i class="bi bi-cash"></i>
                    <span>Pengeluaran Rill</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" onclick="nav('kegiatan')">
                    <i class="bi bi-airplane"></i>
                    <span>Kegiatan Perjalanan Dinas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" onclick="nav('lpj')">
                    <i class="bi bi-clipboard-data"></i>
                    <span>Laporan Pertanggung Jawaban</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" onclick="nav('data-pegawai')">
                    <i class="bi bi-people-fill"></i>
                    <span>Data Pegawai</span>
                </a>
            </li>
        <?php } ?>



        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-printer"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#" onclick="nav('rekap')">
                        <i class="bi bi-circle"></i><span>Cetak Rekap Perjalanan Dinas</span>
                    </a>
                </li>
                <li>
                    <a href="../api/controller/cetak/pegawai.php" target="_blank">
                        <i class="bi bi-circle"></i><span>Cetak Data Pegawai</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

    </ul>

</aside><!-- End Sidebar-->