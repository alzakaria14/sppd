<div class="pagetitle">
    <h1>Anggaran Perjalanan Dinas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Anggaran Perjalanan Dinas</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Data Anggaran Perjalanan Dinas</h5>
                    <div class="text-center">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahAnggaran">Tambah Anggaran</button>
                    </div>

                    <!-- Table with hoverable rows -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No SPPD</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Uang Harian</th>
                                    <th scope="col">Biaya Transportasi</th>
                                    <th scope="col">Biaya Penginapan</th>
                                    <th scope="col">Total</th>
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
                                    "SELECT id_anggaran, id_sppd, no_surat, nama, uang_harian, transportasi, penginapan FROM tb_anggaran INNER JOIN tb_sppd USING (id_sppd) INNER JOIN tb_user USING (id_user) ORDER BY tb_anggaran.created_at DESC"
                                );
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $data_modal[] = array(
                                        'id_anggaran' => $data['id_anggaran'],
                                        'id_sppd' => $data['id_sppd'],
                                        'no_surat' => $data['no_surat'],
                                        'nama' => $data['nama'],
                                        'uang_harian' => $data['uang_harian'],
                                        'transportasi' => $data['transportasi'],
                                        'penginapan' => $data['penginapan']
                                    )
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['no_surat'] ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= rupiah($data['uang_harian']) ?></td>
                                        <td><?= rupiah($data['transportasi']) ?></td>
                                        <td><?= rupiah($data['penginapan']) ?></td>
                                        <td><?= rupiah($data['uang_harian'] + $data['transportasi'] + $data['penginapan']) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editAnggaran<?= $data['id_anggaran'] ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusAnggaran<?= $data['id_anggaran'] ?>">Hapus</button>
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
    <div class="modal fade" id="hapusAnggaran<?= $data['id_anggaran'] ?>" tabindex="-1" aria-labelledby="hapusAnggaran<?= $data['id_anggaran'] ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusAnggaran<?= $data['id_anggaran'] ?>Label">Konfirmasi Hapus Anggaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin menghapus Anggaran <b><?= $data['no_surat'] ?></b>?<br>data yang sudah dihapus tidak bisa dikembalikan lagi
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="hapusAnggaran('<?= $data['id_anggaran'] ?>')">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editAnggaran<?= $data['id_anggaran'] ?>" tabindex="-1" aria-labelledby="editAnggaran<?= $data['id_anggaran'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editAnggaran<?= $data['id_anggaran'] ?>Label">Formulir Edit Nota Dinas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editAnggaranForm<?= $data['id_anggaran'] ?>" class="row g-3">
                        <input type="hidden" name="id_anggaran" value="<?= $data['id_anggaran'] ?>">
                        <div class="col-12">
                            <label for="id_sppd" class="form-label">No. SPPD</label>
                            <input type="text" class="form-control" name="id_sppd" id="id_sppd" value="<?= $data['no_surat'] ?> | <?= $data['nama'] ?>" disabled>
                        </div>
                        <div class="col-12">
                            <label for="uang_harian" class="form-label">Uang Harian</label>
                            <input type="number" name="uang_harian" id="uang_harian<?= $data['id_anggaran'] ?>" class="form-control" onkeyup="totalAnggaranEdit('<?= $data['id_anggaran'] ?>')" value="<?= $data['uang_harian'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="transportasi" class="form-label">Biaya Transportasi</label>
                            <input type="number" name="transportasi" id="transportasi<?= $data['id_anggaran'] ?>" class="form-control" onkeyup="totalAnggaranEdit('<?= $data['id_anggaran'] ?>')" value="<?= $data['transportasi'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="penginapan" class="form-label">Biaya Penginapan</label>
                            <input type="number" name="penginapan" id="penginapan<?= $data['id_anggaran'] ?>" class="form-control" onkeyup="totalAnggaranEdit('<?= $data['id_anggaran'] ?>')" value="<?= $data['penginapan'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" name="total" id="total<?= $data['id_anggaran'] ?>" disabled class="form-control" value="<?= $data['uang_harian'] + $data['transportasi'] + $data['penginapan'] ?>">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="editAnggaran('<?= $data['id_anggaran'] ?>')" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<!-- Modal tambah pegawai -->
<div class="modal fade" id="tambahAnggaran" tabindex="-1" aria-labelledby="tambahAnggaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahAnggaranLabel">Formulir Tambah Anggaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="tambahAnggaranForm" class="row g-3">
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
                        <label for="uang_harian" class="form-label">Uang Harian</label>
                        <input type="number" name="uang_harian" id="uang_harian" class="form-control" onkeyup="totalAnggaran()" value="0">
                    </div>
                    <div class="col-12">
                        <label for="transportasi" class="form-label">Biaya Transportasi</label>
                        <input type="number" name="transportasi" id="transportasi" class="form-control" onkeyup="totalAnggaran()" value="0">
                    </div>
                    <div class="col-12">
                        <label for="penginapan" class="form-label">Biaya Penginapan</label>
                        <input type="number" name="penginapan" id="penginapan" class="form-control" onkeyup="totalAnggaran()" value="0">
                    </div>
                    <div class="col-12">
                        <label for="total" class="form-label">Total</label>
                        <input type="number" name="total" id="total" disabled class="form-control" value="0">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="tambahAnggaran()" data-bs-dismiss="modal">Tambah</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>