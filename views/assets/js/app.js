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
    $('#header-js').load('header.html');
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