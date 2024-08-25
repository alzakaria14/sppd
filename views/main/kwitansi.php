<div class="pagetitle">
    <h1>Kwitansi Pejalanan Dinas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Kwitansi Pejalanan Dinas</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Data Kwitansi</h5>
                    <div class="text-center">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahKwitansi">Tambah Kwitansi</button>
                    </div>

                    <!-- Table with hoverable rows -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No SPPD</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nominal Pembayaran</th>
                                    <th scope="col">Perihal Pembayaran</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                require '../../api/config/connection.php';
                                require '../../api/helper/function.php';
                                $data_modal = [];
                                $no = 1;
                                $query = mysqli_query(
                                    $connection,
                                    "SELECT id_kwitansi, id_sppd, no_surat, nama, jumlah, tb_kwitansi.perihal FROM tb_kwitansi INNER JOIN tb_sppd USING (id_sppd) INNER JOIN tb_user USING (id_user) ORDER BY tb_kwitansi.created_at DESC"
                                );
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $data_modal[] = array(
                                        'id_kwitansi' => $data['id_kwitansi'],
                                        'id_sppd' => $data['id_sppd'],
                                        'no_surat' => $data['no_surat'],
                                        'nama' => $data['nama'],
                                        'jumlah' => $data['jumlah'],
                                        'perihal' => $data['perihal']
                                    )
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['no_surat'] ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= rupiah($data['jumlah']) ?></td>
                                        <td><?= $data['perihal'] ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editKwitansi<?= $data['id_kwitansi'] ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusKwitansi<?= $data['id_kwitansi'] ?>">Hapus</button>
                                            <button type="button" class="btn btn-primary btn-sm">Cetak</button>
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
    // var_dump($data);
?>

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapusKwitansi<?= $data['id_kwitansi'] ?>" tabindex="-1" aria-labelledby="hapusKwitansi<?= $data['id_kwitansi'] ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusKwitansi<?= $data['id_kwitansi'] ?>Label">Konfirmasi Hapus Kwitansi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin menghapus Kwitansi <b><?= $data['no_surat'] ?></b>?<br>data yang sudah dihapus tidak bisa dikembalikan lagi
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="hapusKwitansi('<?= $data['id_kwitansi'] ?>')">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editKwitansi<?= $data['id_kwitansi'] ?>" tabindex="-1" aria-labelledby="editKwitansi<?= $data['id_kwitansi'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editKwitansi<?= $data['id_kwitansi'] ?>Label">Formulir Edit Nota Dinas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editKwitansiForm<?= $data['id_kwitansi'] ?>" class="row g-3">
                        <input type="hidden" name="id_kwitansi" value="<?= $data['id_kwitansi'] ?>">
                        <div class="col-12">
                            <label for="id_sppd" class="form-label">No. SPPD</label>
                            <input type="text" class="form-control" name="id_sppd" id="id_sppd" value="<?= $data['no_surat'] ?> | <?= $data['nama'] ?>" disabled>
                        </div>
                        <div class="col-12">
                            <label for="jumlah" class="form-label">Jumlah Dana</label>
                            <input type="number" name="jumlah" id="jumlah<?= $data['id_kwitansi'] ?>" class="form-control" onkeyup="terbilangShowEdit('<?= $data['id_kwitansi'] ?>')" value="<?= $data['jumlah'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="perihal" class="form-label">Perihal</label>
                            <input type="text" name="perihal" id="perihal" class="form-control" value="<?= $data['perihal'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="terbilang" class="form-label">Terbilang</label>
                            <input type="text" name="terbilang" id="terbilang<?= $data['id_kwitansi'] ?>" class="form-control" disabled value="<?= terbilang($data['jumlah']) ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="editKwitansi('<?= $data['id_kwitansi'] ?>')" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<!-- Modal tambah pegawai -->
<div class="modal fade" id="tambahKwitansi" tabindex="-1" aria-labelledby="tambahKwitansiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahKwitansiLabel">Formulir Tambah Kwitansi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="tambahKwitansiForm" class="row g-3">
                    <div class="col-12">
                        <label for="id_sppd" class="form-label">No. SPPD</label>
                        <select name="id_sppd" id="id_sppd" class="form-control">
                            <option value="" selected disabled>-- Pilih SPPD --</option>
                            <?php

                            $query = mysqli_query(
                                $connection,
                                "SELECT id_sppd, no_surat, nama FROM tb_sppd INNER JOIN tb_user USING (id_user) WHERE tb_sppd.is_verify = '1' AND is_done = '0' ORDER BY tb_sppd.created_at DESC"
                            );
                            while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <option value="<?= $data['id_sppd'] ?>"><?= $data['no_surat'] ?> | <?= $data['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="jumlah" class="form-label">Jumlah Dana</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" onkeyup="terbilangShow()">
                    </div>
                    <div class="col-12">
                        <label for="perihal" class="form-label">Perihal</label>
                        <input type="text" name="perihal" id="perihal" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="terbilang" class="form-label">Terbilang</label>
                        <input type="text" name="terbilang" id="terbilang" class="form-control" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="tambahKwitansi()" data-bs-dismiss="modal">Tambah</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>