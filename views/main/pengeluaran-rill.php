<div class="pagetitle">
    <h1>Pengeluaran Rill</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Pengeluaran Rill</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Data Pengeluaran Rill</h5>
                    <div class="text-center">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahPengeluaran">Tambah Pengeluaran</button>
                    </div>

                    <!-- Table with hoverable rows -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No SPPD</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total</th>
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
                                    "SELECT id_pengeluaran, id_sppd, no_surat, nama, pengeluaran FROM tb_pengeluaran INNER JOIN tb_sppd USING (id_sppd) INNER JOIN tb_user USING (id_user) ORDER BY tb_pengeluaran.created_at DESC"
                                );
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $data_modal[] = array(
                                        'id_pengeluaran' => $data['id_pengeluaran'],
                                        'id_sppd' => $data['id_sppd'],
                                        'no_surat' => $data['no_surat'],
                                        'nama' => $data['nama'],
                                        'pengeluaran' => $pengeluaran = json_decode($data['pengeluaran'])
                                    );
                                    $pengeluaran = json_decode($data['pengeluaran']);
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['no_surat'] ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td>
                                            <ul class="list-group">
                                                <?php

                                                foreach ($pengeluaran as $p) {
                                                ?>
                                                    <li class="list-group-item"><?= $p->keterangan; ?></li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                <?php

                                                foreach ($pengeluaran as $p) {
                                                ?>
                                                    <li class="list-group-item"><?= rupiah($p->jumlah); ?></li>
                                                <?php } ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <?php

                                            $total[] = 0;
                                            foreach ($pengeluaran as $p) {
                                                $total[] = $p->jumlah;
                                            }
                                            echo rupiah(array_sum($total));
                                            $total = null;
                                            ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editPengeluaran<?= $data['id_pengeluaran'] ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusPengeluaran<?= $data['id_pengeluaran'] ?>">Hapus</button>
                                            <a target="_blank" href="../api/controller/cetak/pengeluaran.php?id=<?= $data['id_pengeluaran'] ?>" class="btn btn-primary btn-sm">Cetak</a>
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
    <div class="modal fade" id="hapusPengeluaran<?= $data['id_pengeluaran'] ?>" tabindex="-1" aria-labelledby="hapusPengeluaran<?= $data['id_pengeluaran'] ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusPengeluaran<?= $data['id_pengeluaran'] ?>Label">Konfirmasi Hapus Kwitansi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin menghapus Pengeluaran Rill <b><?= $data['no_surat'] ?></b>?<br>data yang sudah dihapus tidak bisa dikembalikan lagi
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="hapusPengeluaran('<?= $data['id_pengeluaran'] ?>')">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editPengeluaran<?= $data['id_pengeluaran'] ?>" tabindex="-1" aria-labelledby="editPengeluaran<?= $data['id_pengeluaran'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPengeluaran<?= $data['id_pengeluaran'] ?>Label">Formulir Edit Pengeluaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editPengeluaranForm<?= $data['id_pengeluaran'] ?>" class="row g-3">
                        <input type="hidden" name="id_pengeluaran" value="<?= $data['id_pengeluaran'] ?>">
                        <div class="col-12">
                            <label for="id_sppd" class="form-label">No. SPPD</label>
                            <input type="text" class="form-control" name="id_sppd" id="id_sppd" value="<?= $data['no_surat'] ?> | <?= $data['nama'] ?>" disabled>
                        </div>
                        <div id="list-pengeluaran-<?= $data['id_pengeluaran'] ?>" class="row g-3">
                            <?php

                            $id_list_edit_pengeluaran = Uuid::uuid1()->toString();

                            foreach ($data['pengeluaran'] as $p) {
                                // var_dump($p);
                            ?>
                                <div class="row g-3" id="<?= $id_list_edit_pengeluaran ?>">
                                    <div class="col-6">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" name="keterangan[]" id="keterangan" class="form-control" value="<?= $p->keterangan ?>">
                                    </div>
                                    <div class="col-6">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <div class="input-group">
                                            <input type="text" name="jumlah[]" id="jumlah" class="form-control" value="<?= $p->jumlah ?>">
                                            <button type="button" class="btn btn-danger" onclick="hapusListPengeluaran('<?= $id_list_edit_pengeluaran ?>')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-outline-primary" type="button" onclick="tambahListPengeluaranEdit('<?= $data['id_pengeluaran'] ?>')">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="editPengeluaran('<?= $data['id_pengeluaran'] ?>')" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<!-- Modal tambah pegawai -->
<div class="modal fade" id="tambahPengeluaran" tabindex="-1" aria-labelledby="tambahPengeluaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahPengeluaranLabel">Formulir Tambah Kwitansi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="tambahPengeluaranForm" class="row g-3">
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
                    <div id="list-pengeluaran" class="row g-3">
                        <div class="row g-3" id="first">
                            <div class="col-6">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" name="keterangan[]" id="keterangan" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <div class="input-group">
                                    <input type="text" name="jumlah[]" id="jumlah" class="form-control">
                                    <button type="button" class="btn btn-danger" onclick="hapusListPengeluaran('first')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-outline-primary" type="button" onclick="tambahListPengeluaran()">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="tambahPengeluaran()" data-bs-dismiss="modal">Tambah</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>