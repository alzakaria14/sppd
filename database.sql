CREATE TABLE tb_user (
    id_user CHAR(36) PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password CHAR(64) NOT NULL,
    NIP CHAR(18) NOT NULL,
    pangkat VARCHAR(255) NOT NULL,
    jabatan VARCHAR(255) NOT NULL,
    bidang VARCHAR(255) NOT NULL,
    alamat TEXT NOT NULL,
    roles ENUM('user','admin') NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);


CREATE TABLE tb_notadinas (
    id_notadinas CHAR(36) PRIMARY KEY,
    id_user CHAR(36) NOT NULL,
    no_surat VARCHAR(255) NOT NULL,
    tujuan VARCHAR(255) NOT NULL,
    perihal TEXT NOT NULL,
    dasar_surat VARCHAR(255) NOT NULL,
    maksud_tujuan TEXT NOT NULL,
    tanggal_berangkat DATE,
    tanggal_kembali DATE,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE tb_sppd (
    id_sppd CHAR(36) PRIMARY KEY,
    id_user CHAR(36) NOT NULL,
    no_surat VARCHAR(255) NOT NULL,
    tujuan VARCHAR(255) NOT NULL,
    perihal TEXT NOT NULL,
    dasar_surat VARCHAR(255) NOT NULL,
    maksud_tujuan TEXT NOT NULL,
    tanggal_berangkat DATE,
    tanggal_kembali DATE,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE tb_spt (
    id_spt CHAR(36) PRIMARY KEY,
    id_user CHAR(36) NOT NULL,
    no_surat VARCHAR(255) NOT NULL,
    tujuan VARCHAR(255) NOT NULL,
    perihal TEXT NOT NULL,
    dasar_surat VARCHAR(255) NOT NULL,
    maksud_tujuan TEXT NOT NULL,
    tanggal_berangkat DATE,
    tanggal_kembali DATE,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE tb_anggaran (
    id_anggaran CHAR(36) PRIMARY KEY,
    id_sppd CHAR(36) NOT NULL,
    uang_harian FLOAT NOT NULL,
    transportasi FLOAT NOT NULL,
    penginapan FLOAT NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE tb_kwitansi (
    id_kwitansi CHAR(36) PRIMARY KEY,
    id_sppd CHAR(36) NOT NULL,
    jumlah FLOAT NOT NULL,
    perihal VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE tb_pengeluaran (
    id_pengeluaran CHAR(36) PRIMARY KEY,
    id_sppd CHAR(36) NOT NULL,
    pengeluaran JSON,
    created_at DATETIME,
    updated_at DATETIME 
);

CREATE TABLE tb_kegiatan (
    id_kegiatan CHAR(36) PRIMARY KEY,
    id_sppd CHAR(36) NOT NULL,
    kegiatan JSON,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE tb_lpj (
    id_lpj CHAR(36) PRIMARY KEY,
    id_sppd CHAR(36) NOT NULL,
    tanggal DATE,
    bukti JSON,
    created_at DATETIME,
    updated_at DATETIME
);

