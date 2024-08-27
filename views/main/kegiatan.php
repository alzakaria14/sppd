<div class="pagetitle">
    <h1>Kegiatan Perjalanan Dinas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Kegiatan Perjalanan Dinas</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Data Kegiatan Perjalanan Dinas</h5>
                    <div class="text-center">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahKegiatan">Tambah Kegiatan</button>
                    </div>

                    <!-- Table with hoverable rows -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No SPPD</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Tempat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                use Ramsey\Uuid\Nonstandard\Uuid;

                                require '../../api/config/connection.php';
                                require '../../api/helper/function.php';
                                require '../../vendor/autoload.php';
                                $data_modal = [];
                                $no = 1;
                                $query = mysqli_query(
                                    $connection,
                                    "SELECT id_kegiatan, id_sppd, no_surat, nama, kegiatan FROM tb_kegiatan INNER JOIN tb_sppd USING (id_sppd) INNER JOIN tb_user USING (id_user) ORDER BY tb_kegiatan.created_at DESC"
                                );
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $data_modal[] = array(
                                        'id_kegiatan' => $data['id_kegiatan'],
                                        'id_sppd' => $data['id_sppd'],
                                        'no_surat' => $data['no_surat'],
                                        'nama' => $data['nama'],
                                        'kegiatan' => $kegiatan = json_decode($data['kegiatan'])
                                    );
                                    $kegiatan = json_decode($data['kegiatan']);
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['no_surat'] ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td>
                                            <ul class="list-group">
                                                <?php

                                                foreach ($kegiatan as $p) {
                                                ?>
                                                    <li class="list-group-item"><?= $p->kegiatan ?></li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                <?php

                                                foreach ($kegiatan as $p) {
                                                ?>
                                                    <li class="list-group-item"><?= idn_date($p->tanggal) ?></li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                <?php

                                                foreach ($kegiatan as $p) {
                                                ?>
                                                    <li class="list-group-item"><?= $p->tempat ?></li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editKegiatan<?= $data['id_kegiatan'] ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusKegiatan<?= $data['id_kegiatan'] ?>">Hapus</button>
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
    // var_dump($pengeluaran);
?>

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapusKegiatan<?= $data['id_kegiatan'] ?>" tabindex="-1" aria-labelledby="hapusKegiatan<?= $data['id_kegiatan'] ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusKegiatan<?= $data['id_kegiatan'] ?>Label">Konfirmasi Hapus Kegiatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin menghapus Kegiatan <b><?= $data['no_surat'] ?></b>?<br>data yang sudah dihapus tidak bisa dikembalikan lagi
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="hapusKegiatan('<?= $data['id_kegiatan'] ?>')">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editKegiatan<?= $data['id_kegiatan'] ?>" tabindex="-1" aria-labelledby="editKegiatan<?= $data['id_kegiatan'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editKegiatan<?= $data['id_kegiatan'] ?>Label">Formulir Edit Kegiatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editKegiatanForm<?= $data['id_kegiatan'] ?>" class="row g-3">
                        <input type="hidden" name="id_kegiatan" value="<?= $data['id_kegiatan'] ?>">
                        <div class="col-12">
                            <label for="id_sppd" class="form-label">No. SPPD</label>
                            <input type="text" class="form-control" name="id_sppd" id="id_sppd" value="<?= $data['no_surat'] ?> | <?= $data['nama'] ?>" disabled>
                        </div>
                        <div id="list-kegiatan-<?= $data['id_kegiatan'] ?>" class="row g-3">
                            <?php

                            $id_list_edit_kegiatan = Uuid::uuid1()->toString();

                            foreach ($data['kegiatan'] as $p) {
                                // var_dump($p);
                            ?>
                                <div class="row g-3" id="<?= $id_list_edit_kegiatan ?>">
                                    <div class="col-12">
                                        <label for="kegiatan" class="form-label">Kegiatan</label>
                                        <div class="input-group">
                                            <input type="text" name="kegiatan[]" id="kegiatan" class="form-control" value="<?= $p->kegiatan ?>">
                                            <button type="button" class="btn btn-danger" onclick="hapusListKegiatan('<?= $id_list_edit_kegiatan ?>')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" name="tanggal[]" id="tanggal" class="form-control" value="<?= $p->tanggal ?>">
                                    </div>
                                    <div class="col-6">
                                        <label for="tempat" class="form-label">Tempat</label>
                                        <input type="text" name="tempat[]" id="tempat" class="form-control" value="<?= $p->tempat ?>">
                                    </div>
                                    <hr>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-outline-primary" type="button" onclick="tambahListKegiatanEdit('<?= $data['id_kegiatan'] ?>')">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="editKegiatan('<?= $data['id_kegiatan'] ?>')" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<!-- Modal tambah pegawai -->
<div class="modal fade" id="tambahKegiatan" tabindex="-1" aria-labelledby="tambahKegiatanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahKegiatanLabel">Formulir Tambah Kegiatan Perjalanan Dinas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="tambahKegiatanForm" class="row g-3">
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
                    <div id="list-kegiatan" class="row g-3">
                        <div class="row g-3" id="first">
                            <div class="col-12">
                                <label for="kegiatan" class="form-label">Kegiatan</label>
                                <div class="input-group">
                                    <input type="text" name="kegiatan[]" id="kegiatan" class="form-control">
                                    <button type="button" class="btn btn-danger" onclick="hapusListKegiatan('first')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal[]" id="tanggal" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="tempat" class="form-label">Tempat</label>
                                <input type="text" name="tempat[]" id="tempat" class="form-control">
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-outline-primary" type="button" onclick="tambahListKegiatan()">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="tambahKegiatan()" data-bs-dismiss="modal">Tambah</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>