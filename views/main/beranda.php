<?php


use Ramsey\Uuid\Nonstandard\Uuid;

require '../../api/config/connection.php';
require '../../api/helper/function.php';
require '../../vendor/autoload.php';
?>
<div class="pagetitle">
    <h1>Setting Beranda</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Setting Beranda</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Data Beranda</h5>
                    <div class="text-center">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahSlider">Tambah Slider</button>
                    </div>

                    <!-- Table with hoverable rows -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $data_modal = [];
                                $no = 1;
                                $query = mysqli_query(
                                    $connection,
                                    "SELECT id_slider, judul, gambar, deskripsi FROM tb_slider ORDER BY created_at DESC"
                                );
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $data_modal[] = array(
                                        'id_slider' => $data['id_slider'],
                                        'judul' => $data['judul'],
                                        'gambar' => $data['gambar'],
                                        'deskripsi' => $data['deskripsi']
                                    );
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['judul'] ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusSlider<?= $data['id_slider'] ?>">Hapus</button>
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
<?php



foreach ($data_modal as $data) {
    // var_dump($pengeluaran);
?>

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapusSlider<?= $data['id_slider'] ?>" tabindex="-1" aria-labelledby="hapusSlider<?= $data['id_slider'] ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusSlider<?= $data['id_slider'] ?>Label">Konfirmasi Hapus Kegiatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin menghapus Slider <b><?= $data['judul'] ?></b>?<br>data yang sudah dihapus tidak bisa dikembalikan lagi
                    <div class="text-center">
                        <img src="assets/img/<?= $data['gambar'] ?>" alt="<?= $data['judul'] ?>" class="img-fluid">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="hapusSlider('<?= $data['id_slider'] ?>')">Hapus</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<!-- Modal tambah pegawai -->
<div class="modal fade" id="tambahSlider" tabindex="-1" aria-labelledby="tambahSliderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahSliderLabel">Formulir Tambah Kegiatan Perjalanan Dinas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="tambahSliderForm" class="row g-3">
                    <div class="col-12">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="col-12">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                    </div>
                    <div class="col-12">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input class="form-control" type="file" id="gambar" name="gambar" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan Slider</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
        $('#tambahSliderForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '../api/controller/tambah-slider.php',
                type: 'POST',
                data: formData,
                success: function(data) {
                    console.log(data);
                    if (data == '1') {
                        setTimeout(() => {
                            nav('beranda');
                        }, 200);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    });
</script>