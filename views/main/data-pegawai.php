<div class="pagetitle">
    <h1>Data Pegawai</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Data Pegawai</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Data Pegawai</h5>
                    <div class="text-center">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahPegawai">Tambah Pegawai</button>
                    </div>

                    <!-- Table with hoverable rows -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Pangkat</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Bidang</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Verifikasi</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                require '../../api/config/connection.php';
                                $data_modal = [];
                                $no = 1;
                                $query = mysqli_query(
                                    $connection,
                                    "SELECT id_user, nama, email, username, nip, pangkat, jabatan, bidang, alamat, is_verify, roles FROM tb_user ORDER BY nama ASC"
                                );
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $data_modal[] = array(
                                        'id_user' => $data['id_user'],
                                        'email' => $data['email'],
                                        'username' => $data['username'],
                                        'nama' => $data['nama'],
                                        'nip' => $data['nip'],
                                        'pangkat' => $data['pangkat'],
                                        'jabatan' => $data['jabatan'],
                                        'bidang' => $data['bidang'],
                                        'alamat' => $data['alamat'],
                                        'is_verify' => $data['is_verify'],
                                        'roles' => $data['roles']
                                    )
                                ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['nip'] ?></td>
                                        <td><?= $data['pangkat'] ?></td>
                                        <td><?= $data['jabatan'] ?></td>
                                        <td><?= $data['bidang'] ?></td>
                                        <td><?= $data['alamat'] ?></td>
                                        <td>
                                            <?php

                                            if ($data['is_verify'] == '0') {
                                                echo 'Unverified';
                                            } else {
                                                echo 'Verified';
                                            }
                                            ?>
                                        </td>
                                        <td><?= $data['roles'] ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editPegawai<?= $data['id_user'] ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusPegawai<?= $data['id_user'] ?>">Hapus</button>
                                            <?php

                                            if ($_COOKIE['roles'] === 'admin' && $data['is_verify'] === '0') {
                                            ?>
                                                <button class="btn btn-sm btn-warning" type="button" onclick="verifikasiPegawai('<?= $data['id_user'] ?>')">Verifikasi</button>
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
    <div class="modal fade" id="hapusPegawai<?= $data['id_user'] ?>" tabindex="-1" aria-labelledby="hapusPegawai<?= $data['id_user'] ?>Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusPegawai<?= $data['id_user'] ?>Label">Konfirmasi Hapus Pegawai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin menghapus pegawai <b><?= $data['nama'] ?></b>?<br>data yang sudah dihapus tidak bisa dikembalikan lagi
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="hapusPegawai('<?= $data['id_user'] ?>')">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editPegawai<?= $data['id_user'] ?>" tabindex="-1" aria-labelledby="editPegawai<?= $data['id_user'] ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPegawai<?= $data['id_user'] ?>Label">Formulir Tambah Data Pegawai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editPegawaiForm<?= $data['id_user'] ?>" class="row g-3">
                        <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control">
                                <button class="btn btn-secondary" type="button"><i class="bi bi-eye-slash"></i></button>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= $data['username'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['nama'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="tel" name="nip" id="nip" class="form-control" value="<?= $data['nip'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="pangkat" class="form-label">Pangkat</label>
                            <select name="pangkat" id="pangkat" class="form-control">
                                <option value="<?= $data['pangkat'] ?>" selected><?= $data['pangkat'] ?></option>
                                <option value="Pengatur Tingkat I / II d">Pengatur Tingkat I / II d</option>
                                <option value="Pengatur Muda Tingkat I / II b">Pengatur Muda Tingkat I / II b</option>
                                <option value="Pengatur Muda / II a">Pengatur Muda / II a</option>
                                <option value="Pengatur / II c">Pengatur / II c</option>
                                <option value="Penata Tingkat I / III d">Penata Tingkat I / III d</option>
                                <option value="Penata Muda Tingkat I / III b">Penata Muda Tingkat I / III b</option>
                                <option value="Penata Muda / III a">Penata Muda / III a</option>
                                <option value="Penata / III c">Penata / III c</option>
                                <option value="Pembina Utama / IV e">Pembina Utama / IV e</option>
                                <option value="Pembina Tingkat I / IV b">Pembina Tingkat I / IV b</option>
                                <option value="Pembina Muda / IV c">Pembina Muda / IV c</option>
                                <option value="Pembina Madya / IV d">Pembina Madya / IV d</option>
                                <option value="Pembina / IV a">Pembina / IV a</option>
                                <option value="Juru Tingkat I / I d">Juru Tingkat I / I d</option>
                                <option value="Juru Muda Tingkat I / I b">Juru Muda Tingkat I / I b</option>
                                <option value="Juru Muda / I a">Juru Muda / I a</option>
                                <option value="Juru / I c">Juru / I c</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="bidang" class="form-label">Bidang</label>
                            <select name="bidang" id="bidang" class="form-control">
                                <option value="<?= $data['bidang'] ?>" selected><?= $data['bidang'] ?></option>
                                <option value="Umum dan Kepegawaian">Umum dan Kepegawaian</option>
                                <option value="Teknologi Informasi dan Komunikasi">Teknologi Informasi dan Komunikasi</option>
                                <option value="Persandian dan Statistik">Persandian dan Statistik</option>
                                <option value="Perencanaan">Perencanaan</option>
                                <option value="Komunikasi dan Informasi Publik">Komunikasi dan Informasi Publik</option>
                                <option value="Keuangan">Keuangan</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="roles" class="form-label">Roles</label>
                            <select name="roles" id="roles" class="form-control">
                                <option value="<?= $data['roles'] ?>"><?= $data['roles'] ?></option>
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?= $data['jabatan'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3"><?= $data['alamat'] ?></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="editPegawai('<?= $data['id_user'] ?>')" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<!-- Modal tambah pegawai -->
<div class="modal fade" id="tambahPegawai" tabindex="-1" aria-labelledby="tambahPegawaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahPegawaiLabel">Formulir Tambah Data Pegawai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="tambahPegawaiForm" class="row g-3">
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control">
                            <button class="btn btn-secondary" type="button"><i class="bi bi-eye-slash"></i></button>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="tel" name="nip" id="nip" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="pangkat" class="form-label">Pangkat</label>
                        <select name="pangkat" id="pangkat" class="form-control">
                            <option value="" selected disabled>--Pilih Pangkat--</option>
                            <option value="Pengatur Tingkat I / II d">Pengatur Tingkat I / II d</option>
                            <option value="Pengatur Muda Tingkat I / II b">Pengatur Muda Tingkat I / II b</option>
                            <option value="Pengatur Muda / II a">Pengatur Muda / II a</option>
                            <option value="Pengatur / II c">Pengatur / II c</option>
                            <option value="Penata Tingkat I / III d">Penata Tingkat I / III d</option>
                            <option value="Penata Muda Tingkat I / III b">Penata Muda Tingkat I / III b</option>
                            <option value="Penata Muda / III a">Penata Muda / III a</option>
                            <option value="Penata / III c">Penata / III c</option>
                            <option value="Pembina Utama / IV e">Pembina Utama / IV e</option>
                            <option value="Pembina Tingkat I / IV b">Pembina Tingkat I / IV b</option>
                            <option value="Pembina Muda / IV c">Pembina Muda / IV c</option>
                            <option value="Pembina Madya / IV d">Pembina Madya / IV d</option>
                            <option value="Pembina / IV a">Pembina / IV a</option>
                            <option value="Juru Tingkat I / I d">Juru Tingkat I / I d</option>
                            <option value="Juru Muda Tingkat I / I b">Juru Muda Tingkat I / I b</option>
                            <option value="Juru Muda / I a">Juru Muda / I a</option>
                            <option value="Juru / I c">Juru / I c</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="bidang" class="form-label">Bidang</label>
                        <select name="bidang" id="bidang" class="form-control">
                            <option value="" selected disabled>--Pilih Bidang--</option>
                            <option value="Umum dan Kepegawaian">Umum dan Kepegawaian</option>
                            <option value="Teknologi Informasi dan Komunikasi">Teknologi Informasi dan Komunikasi</option>
                            <option value="Persandian dan Statistik">Persandian dan Statistik</option>
                            <option value="Perencanaan">Perencanaan</option>
                            <option value="Komunikasi dan Informasi Publik">Komunikasi dan Informasi Publik</option>
                            <option value="Keuangan">Keuangan</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="tambahPegawai()" data-bs-dismiss="modal">Tambah</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>