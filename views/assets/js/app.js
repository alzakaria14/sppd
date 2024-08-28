// js sppd diskominfo

function cookieValue(nameCookie) {
    var allCookie = document.cookie.split(';');
    for (var i = 0; i < allCookie.length; i++) {
        var cookie = allCookie[i].trim();
        if (cookie.indexOf(nameCookie + '=') === 0) {
            return cookie.substring(nameCookie.length + 1, cookie.length);
        }
    }
    return null;
}

function generateUUID() {
    // Generate random bytes
    const randomBytes = () => {
        return (Math.random() * 0x10000 | 0).toString(16).padStart(4, '0');
    };

    // Generate UUID with the format xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx
    return `${randomBytes()}${randomBytes()}-${randomBytes()}-4${randomBytes().substring(0, 3)}-${(Math.random() * 0x10 | 0x8).toString(16)}${randomBytes().substring(0, 3)}-${randomBytes()}${randomBytes()}${randomBytes()}`;
}

function getDataUser() {
    let id_login = cookieValue('id_login');
    let token = cookieValue('token');
    let url = api('auth/check');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_login: id_login,
            token: token
        },
        dataType: "json",
        success: function (response) {
            // alert(response);
            // console.log(response);
            if (response.status === false) {
                window.location.href = 'pages-login.html';
            } else if (response.status === true) {
                // alert(response);
                // alert(response.nama);
                $('.name').html(response.nama);
                $('.jabatan').html(response.jabatan);

            }
        }
    });
}

$(document).ready(function () {
    $('#header-js').load('header.php');
    $('#main').load('main/dashboard.php');
});

function api(params) {
    var url = '../api/' + params + '.php';
    return url;
}

function nav(params) {
    var url = 'main/' + params + '.php';
    $.ajax({
        type: "POST",
        url: url,
        dataType: "text",
        success: function (response) {
            $('#main').html(response);
        }
    });
}

function login() {
    let username = $('#username').val();
    let password = $('#password').val();
    let url = api('controller/login');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            username: username,
            password: password
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.status === true) {
                window.location.href = 'index.html';
            } else if (response.status === false) {
                $('#notification').html(response.msg);
                setTimeout(() => {
                    $('#notification').html('');
                }, 5000);
            } else {
                $('#notification').html('<span class="text-danger">Unknwon error</span>');
                setTimeout(() => {
                    $('#notification').html('');
                }, 5000);
            }
        }
    });
}

function logout() {
    const cookies = document.cookie.split(";");

    for (let cookie of cookies) {
        const eqPos = cookie.indexOf("=");
        const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
    }

    window.location.reload();
}

function sidebar() {
    let sidebar = $('#sidebar').val();
    if (sidebar == 0) {
        $('body').attr('class', 'toggle-sidebar');
        $('#sidebar').val('1');
    } else {
        $('body').attr('class', '');
        $('#sidebar').val('0');
    }
}

function tambahPegawai() {
    let data = $('#tambahPegawaiForm').serialize();
    let url = api('controller/tambah-pegawai');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('data-pegawai');
            }, 200);
        }
    });
}

function hapusPegawai(id_user) {
    let url = api('controller/hapus-pegawai');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_user: id_user
        },
        success: function (response) {
            setTimeout(() => {
                nav('data-pegawai');
            }, 200);
        }
    });
}

function editPegawai(params) {
    let data = $('#editPegawaiForm' + params).serialize();
    let url = api('controller/edit-pegawai');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('data-pegawai');
            }, 200);
        }
    });
}

function verifikasiPegawai(params) {
    let url = api('/controller/verifikasi-pegawai');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_user: params
        },
        success: function (response) {
            setTimeout(() => {
                nav('data-pegawai');
            }, 200);
        }
    });
}

function verifikasiNotaDinas(params) {
    let url = api('/controller/verifikasi-notadinas');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_notadinas: params
        },
        success: function (response) {
            setTimeout(() => {
                nav('nota-dinas');
            }, 200);
        }
    });
}

function unggahDasarSurat() {
    let spinner = '<div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </div>';
    $('#btn-unggah').html(spinner);
    let data = new FormData();
    data.append('dasar_surat', $('#dasar_surat')[0].files[0]);
    let url = api('controller/upload-dasar-surat');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (response) {
            // console.log(response);
            if (response.status === true) {
                $('#list-dasar-surat').html('<input type="hidden" name="dasar_surat_uploaded" value="' + response.filename + '"> <ul> <li>' + response.originalFilename + '</li> </ul>');
                $('#btn-unggah').html('Unggah');
            } else if (response.status === false) {
                $('#list-dasar-surat').html('<span class="text-danger">Hanya file jpg, png, dan pdf yang diizinkan</span>');
                $('#btn-unggah').html('Unggah');
                setTimeout(() => {
                    $('#list-dasar-surat').html('');
                }, 5000);
            }
        },
        error: function (xhr, status, error) {
            console.error('Terjadi kesalahan: ' + error);
        }
    });
}


function tambahNotaDinas() {
    let data = $('#tambahNotaDinasForm').serialize();
    let url = api('controller/tambah-nota-dinas');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('nota-dinas');
            }, 200);
        }
    });
}

function hapusNotaDinas(params) {
    let url = api('controller/hapus-nota-dinas');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_notadinas: params
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('nota-dinas');
            }, 200);
        }
    });
}

function editNotaDinas(params) {
    let data = $('#editNotaDinasForm' + params).serialize();
    let url = api('controller/edit-notadinas');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('nota-dinas');
            }, 200);
        }
    });
}

function tambahSuratPerjalananDinas() {
    let data = $('#tambahSuratPerjalananDinasForm').serialize();
    let url = api('controller/tambah-surat-perjalanan-dinas');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('surat-perjalanan-dinas');
            }, 200);
        }
    });
}

function verifikasiSuratPerjalananDinas(params) {
    let url = api('/controller/verifikasi-surat-perjalanan-dinas');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_sppd: params
        },
        success: function (response) {
            setTimeout(() => {
                nav('surat-perjalanan-dinas');
            }, 200);
        }
    });
}

function hapusSuratPerjalananDinas(params) {
    let url = api('controller/hapus-surat-perjalanan-dinas');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_sppd: params
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('surat-perjalanan-dinas');
            }, 200);
        }
    });
}

function editSuratPerjalananDinas(params) {
    let data = $('#editSuratPerjalananDinasForm' + params).serialize();
    let url = api('controller/edit-surat-perjalanan-dinas');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('surat-perjalanan-dinas');
            }, 200);
        }
    });
}

function tambahSuratPerintahTugas() {
    let data = $('#tambahSuratPerintahTugasForm').serialize();
    let url = api('controller/tambah-surat-perintah-tugas');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('surat-perintah-tugas');
            }, 200);
        }
    });
}

function verifikasiSuratPerintahTugas(params) {
    let url = api('/controller/verifikasi-surat-perintah-tugas');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_spt: params
        },
        success: function (response) {
            setTimeout(() => {
                nav('surat-perintah-tugas');
            }, 200);
        }
    });
}

function hapusSuratPerintahTugas(params) {
    let url = api('controller/hapus-surat-perintah-tugas');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_spt: params
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('surat-perintah-tugas');
            }, 200);
        }
    });
}

function editSuratPerintahTugas(params) {
    let data = $('#editSuratPerintahTugasForm' + params).serialize();
    let url = api('controller/edit-surat-perintah-tugas');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('surat-perintah-tugas');
            }, 200);
        }
    });
}

function totalAnggaran() {
    let uang_harian = parseFloat($('#uang_harian').val());
    let transportasi = parseFloat($('#transportasi').val());
    let penginapan = parseFloat($('#penginapan').val());
    let total = uang_harian + transportasi + penginapan;
    $('#total').val(total);
}

function totalAnggaranEdit(params) {
    let uang_harian = parseFloat($('#uang_harian' + params).val());
    let transportasi = parseFloat($('#transportasi' + params).val());
    let penginapan = parseFloat($('#penginapan' + params).val());
    let total = uang_harian + transportasi + penginapan;
    $('#total' + params).val(total);
}

function tambahAnggaran() {
    let data = $('#tambahAnggaranForm').serialize();
    let url = api('controller/tambah-anggaran');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "text",
        success: function (response) {
            setTimeout(() => {
                nav('anggaran');
            }, 200);
        }
    });
}

function hapusAnggaran(params) {
    let url = api('controller/hapus-anggaran');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_anggaran: params
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('anggaran');
            }, 200);
        }
    });
}

function editAnggaran(params) {
    let data = $('#editAnggaranForm' + params).serialize();
    let url = api('controller/edit-anggaran');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('anggaran');
            }, 200);
        }
    });
}

function terbilangShow() {
    let angka = parseInt($('#jumlah').val());
    const satuan = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan"];
    const belasan = ["", "Sepuluh", "Sebelas", "Dua Belas", "Tiga Belas", "Empat Belas", "Lima Belas", "Enam Belas", "Tujuh Belas", "Delapan Belas", "Sembilan Belas"];
    const puluhan = ["", "Sepuluh", "Dua Puluh", "Tiga Puluh", "Empat Puluh", "Lima Puluh", "Enam Puluh", "Tujuh Puluh", "Delapan Puluh", "Sembilan Puluh"];
    const ribuan = ["", "Ribu", "Juta", "Miliar", "Triliun"];

    if (angka === 0) return "Nol";

    let terbilang = "";
    let idx = 0;

    while (angka > 0) {
        let bagian = angka % 1000;
        if (bagian > 0) {
            let strBagian = "";
            let ratusan = Math.floor(bagian / 100);
            let sisa = bagian % 100;

            if (ratusan > 0) {
                strBagian += satuan[ratusan] + " Ratus ";
            }

            if (sisa < 20) {
                strBagian += (sisa < 10 ? satuan[sisa] : belasan[sisa - 10]);
            } else {
                let puluh = Math.floor(sisa / 10);
                let unit = sisa % 10;
                strBagian += puluhan[puluh] + (unit > 0 ? " " + satuan[unit] : "");
            }

            terbilang = strBagian + (ribuan[idx] ? " " + ribuan[idx] : "") + " " + terbilang;
        }

        angka = Math.floor(angka / 1000);
        idx++;
    }

    $('#terbilang').val(terbilang.trim());
}

function terbilangShowEdit(params) {
    let angka = parseInt($('#jumlah' + params).val());
    const satuan = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan"];
    const belasan = ["", "Sepuluh", "Sebelas", "Dua Belas", "Tiga Belas", "Empat Belas", "Lima Belas", "Enam Belas", "Tujuh Belas", "Delapan Belas", "Sembilan Belas"];
    const puluhan = ["", "Sepuluh", "Dua Puluh", "Tiga Puluh", "Empat Puluh", "Lima Puluh", "Enam Puluh", "Tujuh Puluh", "Delapan Puluh", "Sembilan Puluh"];
    const ribuan = ["", "Ribu", "Juta", "Miliar", "Triliun"];

    if (angka === 0) return "Nol";

    let terbilang = "";
    let idx = 0;

    while (angka > 0) {
        let bagian = angka % 1000;
        if (bagian > 0) {
            let strBagian = "";
            let ratusan = Math.floor(bagian / 100);
            let sisa = bagian % 100;

            if (ratusan > 0) {
                strBagian += satuan[ratusan] + " Ratus ";
            }

            if (sisa < 20) {
                strBagian += (sisa < 10 ? satuan[sisa] : belasan[sisa - 10]);
            } else {
                let puluh = Math.floor(sisa / 10);
                let unit = sisa % 10;
                strBagian += puluhan[puluh] + (unit > 0 ? " " + satuan[unit] : "");
            }

            terbilang = strBagian + (ribuan[idx] ? " " + ribuan[idx] : "") + " " + terbilang;
        }

        angka = Math.floor(angka / 1000);
        idx++;
    }

    $('#terbilang' + params).val(terbilang.trim());
}

function tambahKwitansi() {
    let data = $('#tambahKwitansiForm').serialize();
    let url = api('controller/tambah-kwitansi');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "text",
        success: function (response) {
            setTimeout(() => {
                nav('kwitansi');
            }, 200);
        }
    });
}

function hapusKwitansi(params) {
    let url = api('controller/hapus-kwitansi');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_kwitansi: params
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('kwitansi');
            }, 200);
        }
    });
}

function editKwitansi(params) {
    let data = $('#editKwitansiForm' + params).serialize();
    let url = api('controller/edit-kwitansi');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('kwitansi');
            }, 200);
        }
    });
}

function tambahListPengeluaran() {
    let uuid = generateUUID();
    let list = '<div class="row g-3" id="' + uuid + '"> <div class="col-6"> <label for="keterangan" class="form-label">Keterangan</label> <input type="text" name="keterangan[]" id="keterangan" class="form-control"> </div> <div class="col-6"> <label for="jumlah" class="form-label">Jumlah</label> <div class="input-group"> <input type="text" name="jumlah[]" id="jumlah" class="form-control"> <button type="button" class="btn btn-danger" onclick="hapusListPengeluaran(' + "'" + '' + uuid + "'" + ')"> <i class="bi bi-trash"></i> </button> </div> </div> </div>';
    $('#list-pengeluaran').append(list);
}

function tambahListPengeluaranEdit(params) {
    let uuid = generateUUID();
    let list = '<div class="row g-3" id="' + uuid + '"> <div class="col-6"> <label for="keterangan" class="form-label">Keterangan</label> <input type="text" name="keterangan[]" id="keterangan" class="form-control"> </div> <div class="col-6"> <label for="jumlah" class="form-label">Jumlah</label> <div class="input-group"> <input type="text" name="jumlah[]" id="jumlah" class="form-control"> <button type="button" class="btn btn-danger" onclick="hapusListPengeluaran(' + "'" + '' + uuid + "'" + ')"> <i class="bi bi-trash"></i> </button> </div> </div> </div>';
    $('#list-pengeluaran-' + params).append(list);
}

function hapusListPengeluaran(params) {
    $('#' + params).remove();
}

function tambahPengeluaran() {
    let data = $('#tambahPengeluaranForm').serialize();
    let url = api('controller/tambah-pengeluaran');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('pengeluaran-rill');
            }, 200);
        }
    });
}

function hapusPengeluaran(params) {
    let url = api('controller/hapus-pengeluaran');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_pengeluaran: params
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('pengeluaran-rill');
            }, 200);
        }
    });
}

function editPengeluaran(params) {
    let data = $('#editPengeluaranForm' + params).serialize();
    let url = api('controller/edit-pengeluaran');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            // console.log(response);
            setTimeout(() => {
                nav('pengeluaran-rill');
            }, 200);
        }
    });
}

function tambahListKegiatan() {
    let uuid = generateUUID();
    let list = '<div class="row g-3" id="' + uuid + '"> <div class="col-12"> <label for="kegiatan" class="form-label">Kegiatan</label> <div class="input-group"> <input type="text" name="kegiatan[]" id="kegiatan" class="form-control"> <button type="button" class="btn btn-danger" onclick="hapusListKegiatan(' + "'" + '' + uuid + "'" + ')"> <i class="bi bi-trash"></i> </button> </div> </div> <div class="col-6"> <label for="tanggal" class="form-label">Tanggal</label> <input type="date" name="tanggal[]" id="tanggal" class="form-control"> </div> <div class="col-6"> <label for="tempat" class="form-label">Tempat</label> <input type="text" name="tempat[]" id="tempat" class="form-control"> </div><hr> </div> ';
    $('#list-kegiatan').append(list);
}

function hapusListKegiatan(params) {
    $('#' + params).remove();
}

function tambahKegiatan() {
    let data = $('#tambahKegiatanForm').serialize();
    let url = api('controller/tambah-kegiatan');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('kegiatan');
            }, 200);
        }
    });
}

function hapusKegiatan(params) {
    let url = api('controller/hapus-kegiatan');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_kegiatan: params
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('kegiatan');
            }, 200);
        }
    });
}

function tambahListKegiatanEdit(params) {
    let uuid = generateUUID();
    let list = '<div class="row g-3" id="' + uuid + '"> <div class="col-12"> <label for="kegiatan" class="form-label">Kegiatan</label> <div class="input-group"> <input type="text" name="kegiatan[]" id="kegiatan" class="form-control"> <button type="button" class="btn btn-danger" onclick="hapusListKegiatan(' + "'" + '' + uuid + "'" + ')"> <i class="bi bi-trash"></i> </button> </div> </div> <div class="col-6"> <label for="tanggal" class="form-label">Tanggal</label> <input type="date" name="tanggal[]" id="tanggal" class="form-control"> </div> <div class="col-6"> <label for="tempat" class="form-label">Tempat</label> <input type="text" name="tempat[]" id="tempat" class="form-control"> </div><hr> </div> ';
    $('#list-kegiatan-' + params).append(list);
}

function editKegiatan(params) {
    let data = $('#editKegiatanForm' + params).serialize();
    let url = api('controller/edit-kegiatan');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            // console.log(response);
            setTimeout(() => {
                nav('kegiatan');
            }, 200);
        }
    });
}

function uploadBukti(params) {
    let spinner = '<div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </div>';
    $('#btn-unggah').html(spinner);
    let data = new FormData();
    data.append('bukti', $('#bukti-' + params)[0].files[0]);
    let url = api('controller/upload-bukti');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (response) {
            // console.log(response);
            if (response.status === true) {
                $('#' + params).html('<input type="hidden" name="bukti[]"  value="' + response.filename + '"> <ul> <li>' + response.originalFilename + '</li> </ul>')
                $('#btn-unggah').html('Unggah');
            } else if (response.status === false) {
                $('#list-bukti').html('<span class="text-danger">Hanya file jpg, png, dan pdf yang diizinkan</span>');
                $('#btn-unggah').html('Unggah');
                setTimeout(() => {
                    $('#list-bukti').html('');
                }, 5000);
            }
        },
        error: function (xhr, status, error) {
            console.error('Terjadi kesalahan: ' + error);
        }
    });
}

function tambahListBukti() {
    let uuid = generateUUID();
    let uuidContent = generateUUID();
    let list = '<div class="row g-3" id="' + uuid + '"> <div class="col-12"> <label for="bukti" class="form-label">Bukti/Nota</label> <div class="input-group"> <input type="file" name="" id="bukti-' + uuidContent + '" class="form-control"> <button type="button" class="btn btn-primary" id="btn-unggah-' + uuidContent + '" onclick="uploadBukti(' + "'" + '' + uuidContent + "'" + ')">Unggah</button> <button type="button" class="btn btn-danger" onclick="hapusBukti(' + "'" + '' + uuid + "'" + ')"> <i class="bi bi-trash"></i> </button> </div> <div id="' + uuidContent + '"> </div> </div></div>';
    $('#list-bukti').append(list);
}

function hapusBukti(params) {
    $('#' + params).remove();
}

function tambahLaporan() {
    let data = $('#tambahLaporanForm').serialize();
    let url = api('controller/tambah-laporan');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('lpj');
            }, 200);
        }
    });
}

function hapusLaporan(params) {
    let url = api('controller/hapus-laporan');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_lpj: params
        },
        dataType: "text",
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('lpj');
            }, 200);
        }
    });
}

function editLaporan(params) {
    let data = $('#editLaporanForm' + params).serialize();
    let url = api('controller/edit-laporan');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                nav('lpj');
            }, 200);
        }
    });
}

function cetakRekap() {
    let startDate = $('#start-date').val();
    let endDate = $('#end-date').val();
    let url = '../api/controller/cetak/rekap.php?1=' + startDate + '&2=' + endDate;
    window.open(url, '_blank');
}