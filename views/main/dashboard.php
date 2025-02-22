<?php

require '../../api/config/connection.php';
?>
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <h5>Selamat Datang</h5>
        <h2 class="name"></h2>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php

                $query = mysqli_query(
                    $connection,
                    "SELECT * FROM tb_slider ORDER BY created_at DESC"
                );
                $no = 1;
                while ($data = mysqli_fetch_assoc($query)) {
                ?>
                    <div class="carousel-item <?= $no == 1 ? 'active' : '' ?>">
                        <img src="assets/img/<?= $data['gambar'] ?>" class="d-block w-100 carousel-img" alt="...">
                        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                            <h5 class="display-4"><?= $data['judul'] ?></h5>
                            <p class="lead"><?= $data['deskripsi'] ?></p>
                        </div>
                    </div>
                <?php

                    $no++;
                } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <hr>
    <div class="row">
        <!-- Left side columns -->
        <div class="col-12">
            <div class="row">

                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Surat Perintah Tugas</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>
                                        <?= mysqli_num_rows(
                                            mysqli_query(
                                                $connection,
                                                "SELECT id_spt FROM tb_spt"
                                            )
                                        ) ?>
                                    </h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Surat Perjalanan Dinas</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>
                                        <?= mysqli_num_rows(
                                            mysqli_query(
                                                $connection,
                                                "SELECT id_sppd FROM tb_sppd"
                                            )
                                        ) ?>
                                    </h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Nota Dinas</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>
                                        <?= mysqli_num_rows(
                                            mysqli_query(
                                                $connection,
                                                "SELECT id_notadinas FROM tb_notadinas"
                                            )
                                        ) ?>
                                    </h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Pegawai</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>
                                        <?= mysqli_num_rows(
                                            mysqli_query(
                                                $connection,
                                                "SELECT id_user FROM tb_user"
                                            )
                                        ) ?>
                                    </h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php

                if ($_COOKIE['roles'] === 'admin') {
                ?>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Anggaran</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cash"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?= mysqli_num_rows(
                                                mysqli_query(
                                                    $connection,
                                                    "SELECT id_anggaran FROM tb_anggaran"
                                                )
                                            ) ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Kwintansi</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cash"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?= mysqli_num_rows(
                                                mysqli_query(
                                                    $connection,
                                                    "SELECT id_kwitansi FROM tb_kwitansi"
                                                )
                                            ) ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Pengeluaran Rill</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cash"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?= mysqli_num_rows(
                                                mysqli_query(
                                                    $connection,
                                                    "SELECT id_pengeluaran FROM tb_pengeluaran"
                                                )
                                            ) ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">Kegiatan</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-check"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            <?= mysqli_num_rows(
                                                mysqli_query(
                                                    $connection,
                                                    "SELECT id_kegiatan FROM tb_kegiatan"
                                                )
                                            ) ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div><!-- End Left side columns -->
    </div>
</section>