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

                                require '../../api/config/connection.php';
                                require '../../api/helper/function.php';
                                require '../../vendor/autoload.php';
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
    <div class="modal fade" id="hapusLaporan<?= $data['id_lpj'] ?>" tabindex="-1" aria-labelledby="hapusLaporan<?= $data['id_lpj'] ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusLaporan<?= $data['id_lpj'] ?>Label">Konfirmasi Hapus Kegiatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin menghapus Kegiatan <b><?= $data['no_surat'] ?></b>?<br>data yang sudah dihapus tidak bisa dikembalikan lagi
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="hapusLaporan('<?= $data['id_lpj'] ?>')">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <?php

    $uuid_nota = Uuid::uuid1()->toString();
    ?>
    <div class="modal fade" id="editLaporan<?= $data['id_lpj'] ?>" tabindex="-1" aria-labelledby="editLaporan<?= $data['id_lpj'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editLaporan<?= $data['id_lpj'] ?>Label">Formulir Edit Kegiatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editLaporanForm<?= $data['id_lpj'] ?>" class="row g-3">
                        <input type="hidden" name="id_lpj" value="<?= $data['id_lpj'] ?>">
                        <div class="col-12">
                            <label for="id_sppd" class="form-label">No. SPPD</label>
                            <input type="text" class="form-control" name="id_sppd" id="id_sppd" value="<?= $data['no_surat'] ?> | <?= $data['nama'] ?>" disabled>
                        </div>
                        <div class="col-12">
                            <label for="tanggal" class="form-label">Tanggal Laporan</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $data['tanggal'] ?>">
                        </div>
                        <div id="list-bukti" class="row g-3">
                            <div class="row g-3" id="first">
                                <div class="col-12">
                                    <label for="bukti" class="form-label">Bukti/Nota</label>
                                    <div class="input-group">
                                        <input type="file" name="" id="bukti-<?= $uuid_nota ?>" class="form-control">
                                        <button type="button" class="btn btn-primary" id="btn-unggah-<?= $uuid_nota ?>" onclick="uploadBukti('<?= $uuid_nota ?>')">Unggah</button>
                                        <button type="button" class="btn btn-danger" onclick="hapusBukti('first')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <div id="<?= $uuid_nota ?>">
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
                    <button type="button" class="btn btn-primary" onclick="editLaporan('<?= $data['id_lpj'] ?>')" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<!-- Modal tambah pegawai -->
<div class="modal fade" id="tambahLaporan" tabindex="-1" aria-labelledby="tambahLaporanLabel" aria-hidden="true">
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
                            <option value="" selected disabled>-- Pilih SPPD --</option>
                            <?php

                            $uuid_nota = Uuid::uuid1()->toString();
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
                        <label for="tanggal" class="form-label">Tanggal Laporan</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>
                    <div id="list-bukti" class="row g-3">
                        <div class="row g-3" id="first">
                            <div class="col-12">
                                <label for="bukti" class="form-label">Bukti/Nota</label>
                                <div class="input-group">
                                    <input type="file" name="" id="bukti-<?= $uuid_nota ?>" class="form-control">
                                    <button type="button" class="btn btn-primary" id="btn-unggah-<?= $uuid_nota ?>" onclick="uploadBukti('<?= $uuid_nota ?>')">Unggah</button>
                                    <button type="button" class="btn btn-danger" onclick="hapusBukti('first')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <div id="<?= $uuid_nota ?>">
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
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>