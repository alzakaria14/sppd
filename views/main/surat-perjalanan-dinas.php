<div class="pagetitle">
    <h1>Surat Perintah Perjalanan Dinas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Surat Perintah Perjalanan Dinas</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Data Surat Perintah Perjalanan Dinas</h5>
                    <div class="text-center">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahSuratPerjalananDinas">Ajukan SPPD</button>
                    </div>

                    <!-- Table with hoverable rows -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No Surat</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Perihal</th>
                                    <th scope="col">Dasar</th>
                                    <th scope="col">Maksud Tujuan</th>
                                    <th scope="col">Tempat Tujuan</th>
                                    <th scope="col">Tanggal Berangkat</th>
                                    <th scope="col">Tanggal Kembali</th>
                                    <th scope="col">Status</th>
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
                                    "SELECT id_sppd, id_user, nama, nip, no_surat, tujuan, perihal, dasar_surat, maksud_tujuan, tanggal_berangkat, tanggal_kembali, tb_sppd.is_verify FROM tb_sppd INNER JOIN tb_user USING (id_user) ORDER BY tb_sppd.created_at DESC"
                                );
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $data_modal[] = array(
                                        'id_sppd' => $data['id_sppd'],
                                        'id_user' => $data['id_user'],
                                        'nama' => $data['nama'],
                                        'nip' => $data['nip'],
                                        'no_surat' => $data['no_surat'],
                                        'tujuan' => $data['tujuan'],
                                        'perihal' => $data['perihal'],
                                        'dasar_surat' => $data['dasar_surat'],
                                        'maksud_tujuan' => $data['maksud_tujuan'],
                                        'tanggal_berangkat' => $data['tanggal_berangkat'],
                                        'tanggal_kembali' => $data['tanggal_kembali'],
                                        'is_verify' => $data['is_verify']
                                    )
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['no_surat'] ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['perihal'] ?></td>
                                        <td>
                                            <?php

                                            if ($data['dasar_surat'] === '0') {
                                                echo 'Kosong';
                                            } else {
                                                echo '<a target="_blank" href="assets/dasar-surat/' . $data['dasar_surat'] . '">Lihat</a>';
                                            }
                                            ?>
                                        </td>
                                        <td><?= $data['maksud_tujuan'] ?></td>
                                        <td><?= $data['tujuan'] ?></td>
                                        <td><?= idn_date($data['tanggal_berangkat']) ?></td>
                                        <td><?= idn_date($data['tanggal_kembali']) ?></td>
                                        <td>
                                            <?php

                                            if ($data['is_verify'] == '0') {
                                                echo 'Unverified';
                                            } else {
                                                echo 'Verified';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php

                                            if ($_COOKIE['roles'] === 'admin') {
                                            ?>
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editSuratPerjalananDinas<?= $data['id_sppd'] ?>">Edit</button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusSuratPerjalananDinas<?= $data['id_sppd'] ?>">Hapus</button>
                                            <?php } ?>
                                            <?php

                                            if ($_COOKIE['roles'] === 'admin' && $data['is_verify'] === '0') {
                                            ?>
                                                <button class="btn btn-sm btn-warning" type="button" onclick="verifikasiSuratPerjalananDinas('<?= $data['id_sppd'] ?>')">Verifikasi</button>
                                            <?php } else if ($data['is_verify'] === '1') { ?>
                                                <a target="_blank" href="../api/controller/cetak/sppd.php?id=<?= $data['id_sppd'] ?>" class="btn btn-primary btn-sm">Cetak</a>
                                            <?php } ?>
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
    <div class="modal fade" id="hapusSuratPerjalananDinas<?= $data['id_sppd'] ?>" tabindex="-1" aria-labelledby="hapusSuratPerjalananDinas<?= $data['id_sppd'] ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusSuratPerjalananDinas<?= $data['id_sppd'] ?>Label">Konfirmasi Hapus Nota Dinas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin menghapus Nota Dinas <b><?= $data['no_surat'] ?></b>?<br>data yang sudah dihapus tidak bisa dikembalikan lagi
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="hapusSuratPerjalananDinas('<?= $data['id_sppd'] ?>')">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editSuratPerjalananDinas<?= $data['id_sppd'] ?>" tabindex="-1" aria-labelledby="editSuratPerjalananDinas<?= $data['id_sppd'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editSuratPerjalananDinas<?= $data['id_sppd'] ?>Label">Formulir Edit SPPD</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editSuratPerjalananDinasForm<?= $data['id_sppd'] ?>" class="row g-3">
                        <input type="hidden" name="id_sppd" value="<?= $data['id_sppd'] ?>">
                        <div class="col-12">
                            <label for="no_surat" class="form-label">No Surat</label>
                            <input type="no_surat" class="form-control" id="no_surat" name="no_surat" value="<?= $data['no_surat'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="id_user" class="form-label">Pegawai</label>
                            <select name="id_user" id="id_user" class="form-control">
                                <option value="<?= $data['id_user'] ?>" selected><?= $data['nama'] ?> | <?= $data['nip'] ?></option>
                                <?php

                                $query = mysqli_query(
                                    $connection,
                                    "SELECT id_user, nama, nip FROM tb_user WHERE is_verify = '1' ORDER BY nama ASC"
                                );
                                while ($data_select = mysqli_fetch_assoc($query)) {
                                ?>
                                    <option value="<?= $data_select['id_user'] ?>"><?= $data_select['nama'] ?> | <?= $data_select['nip'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="tujuan" class="form-label">Tempat Tujuan</label>
                            <input type="text" name="tujuan" id="tujuan" class="form-control" value="<?= $data['tujuan'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="perihal" class="form-label">Perihal</label>
                            <input type="text" name="perihal" id="perihal" class="form-control" value="<?= $data['perihal'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="maksud_tujuan" class="form-label">Maksud Tujuan</label>
                            <textarea name="maksud_tujuan" id="maksud_tujuan" class="form-control" rows="3"><?= $data['maksud_tujuan'] ?></textarea>
                        </div>
                        <div class="col-12">
                            <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
                            <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="form-control" value="<?= $data['tanggal_berangkat'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" value="<?= $data['tanggal_kembali'] ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="editSuratPerjalananDinas('<?= $data['id_sppd'] ?>')" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<!-- Modal tambah pegawai -->
<div class="modal fade" id="tambahSuratPerjalananDinas" tabindex="-1" aria-labelledby="tambahSuratPerjalananDinasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahSuratPerjalananDinasLabel">Formulir Tambah SPPD</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="tambahSuratPerjalananDinasForm" class="row g-3">
                    <div class="col-12">
                        <label for="no_surat" class="form-label">No Surat</label>
                        <input type="no_surat" class="form-control" id="no_surat" name="no_surat">
                    </div>
                    <div class="col-12">
                        <label for="id_user" class="form-label">Pegawai</label>
                        <select name="id_user" id="id_user" class="form-control">
                            <option value="" selected disabled>-- Nama | NIP --</option>
                            <?php

                            $query = mysqli_query(
                                $connection,
                                "SELECT id_user, nama, nip FROM tb_user WHERE is_verify = '1' ORDER BY nama ASC"
                            );
                            while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <option value="<?= $data['id_user'] ?>"><?= $data['nama'] ?> | <?= $data['nip'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="tujuan" class="form-label">Tempat Tujuan</label>
                        <input type="text" name="tujuan" id="tujuan" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="perihal" class="form-label">Perihal</label>
                        <input type="text" name="perihal" id="perihal" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="dasar_surat" class="form-label">Dasar Surat (Opsional)</label>
                        <div class="input-group">
                            <input type="file" name="dasar_surat" id="dasar_surat" class="form-control">
                            <button class="btn btn-primary" type="button" id="btn-unggah" onclick="unggahDasarSurat()">Unggah</button>
                        </div>
                        <div id="list-dasar-surat">
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="maksud_tujuan" class="form-label">Maksud Tujuan</label>
                        <textarea name="maksud_tujuan" id="maksud_tujuan" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
                        <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="tambahSuratPerjalananDinas()" data-bs-dismiss="modal">Tambah</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>