-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jan 2023 pada 18.12
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_akademikmagang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `id_dospem` int(11) DEFAULT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_telp` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2023-04-05 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL,
  `account_status` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id_akun`, `id_dospem`, `nama`, `username`, `password`, `no_telp`, `email`, `role`, `alamat`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`, `account_status`) VALUES
(1, 0, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', '081269087591', 'admin@gmail.com', 'Admin', 'Fakultas Sains & Teknologi', NULL, NULL, '2023-04-05 00:00:00', NULL, 'Active'),
(13, 11110, 'Ira Gase', 'ira', 'e0a9ab6526071b0dbee156a43cc2400d', '081269087590', 'iragase@saintek.com', 'Dosen Pembimbing', 'Jakarta', NULL, NULL, '2023-04-05 00:00:00', NULL, 'Active'),
(14, 11112, 'Kevin Saragih', 'kevin', 'd2e7a2105d0fb461fe6f2858cc33942f', '081269087591', 'kevinsaragih@saintek.com', 'Dosen Pembimbing', 'Medan', NULL, NULL, '2023-04-05 00:00:00', NULL, 'Active'),
(15, 11113, 'Jake Made', 'jake', '7f6b4c4b8d2070f44e9e79a51f9cd37b', '081269087593', 'jakemade@saintek.com', 'Dosen Pembimbing', 'Bali', NULL, NULL, '2023-04-05 00:00:00', NULL, 'Active'),
(16, NULL, 'Ondosan Sinaga', '5190411406', '66d4f69237b0f3c79c90d0524cce82dd', '081269087592', 'ondosansinaga2@gmail.com', 'Mahasiswa', 'Jetis', NULL, NULL, '2023-04-05 00:00:00', NULL, 'Active'),
(17, NULL, 'Ester Vani', '5190411407', '683c81f323eb9f6d2e8df5b9ca028fa4', '081269087599', 'estervani@gmail.com', 'Mahasiswa', 'Trini', NULL, NULL, '2023-04-05 00:00:00', NULL, 'Active'),
(18, NULL, 'Andi Natanael', '5190411408', '03339dc0dff443f15c254baccde9bece', '081269087598', 'andinatanael@gmail.com', 'Mahasiswa', 'Jombor', NULL, NULL, '2023-04-05 00:00:00', NULL, 'Pending'),
(20, NULL, 'Cici Sinaga', '5190411409', '3d0d80b5b6bc8478b62da19172ea1777', '081269087595', 'cicisinaga@gmail.com', 'Mahasiswa', 'Depok', NULL, NULL, '2023-04-05 00:00:00', NULL, 'Pending'),
(21, 11114, 'Pedro Pascal', 'pedro', 'd3ce9efea6244baa7bf718f12dd0c331', '081269087596', 'pedropascal@gmail.com', 'Dosen Pembimbing', 'Semarang', NULL, NULL, '2023-04-05 00:00:00', NULL, 'Active'),
(23, NULL, 'Igil Sinaga', '5190411400', 'aead013dcce56b099e53bd93984e2a46', '081269087500', 'igilsinaga@gmail.com', 'Mahasiswa', 'Babarsari', NULL, NULL, '2023-04-05 00:00:00', NULL, 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_magang`
--

CREATE TABLE `daftar_magang` (
  `id_daftarmagang` int(11) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nama_mahasiswa` varchar(30) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `mitra_perusahaan` varchar(30) NOT NULL,
  `posisi` varchar(30) NOT NULL,
  `sertifikat_terima` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pending Admin',
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `id_dospem` int(11) DEFAULT NULL,
  `id_akun` int(11) DEFAULT NULL,
  `nama_dospem` varchar(30) NOT NULL,
  `username_dospem` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_magang`
--

INSERT INTO `daftar_magang` (`id_daftarmagang`, `nim`, `nama_mahasiswa`, `id_jurusan`, `mitra_perusahaan`, `posisi`, `sertifikat_terima`, `status`, `tanggal_masuk`, `tanggal_keluar`, `id_dospem`, `id_akun`, `nama_dospem`, `username_dospem`) VALUES
(6, '5190411406', 'Ondosan Sinaga', 1, 'PT. Travelxism', 'Junior Researcher', 'http://localhost/akademikmagang/uploads/files/DITERIMA.pdf', 'Selesai', '2020-07-02', '2021-02-02', 11112, 16, 'Kevin Saragih', 'kevin'),
(7, '5190411407', 'Ester Vani', 2, 'PT. Gojek Indonesia', 'Junior Data Analyst', 'http://localhost/akademikmagang/uploads/files/DITERIMA.pdf', 'Disetujui', '2022-07-04', '2023-02-04', NULL, 17, 'Ira Gase', 'ira'),
(8, '5190411406', 'Ondosan Sinaga', 1, 'PT. Shopee Indonesia', 'UX Research', 'http://localhost/akademikmagang/uploads/files/DITERIMA.pdf', 'Pending Admin', '2023-01-01', '2023-01-28', NULL, 16, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dospem`
--

CREATE TABLE `dospem` (
  `id_dospem` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telp` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `account_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dospem`
--

INSERT INTO `dospem` (`id_dospem`, `nama`, `username`, `password`, `no_telp`, `email`, `role`, `alamat`, `account_status`) VALUES
(11110, 'Ira Gase', 'ira', 'e0a9ab6526071b0dbee156a43cc2400d', '081269087590', 'iragase@saintek.com', 'Dosen Pembimbing', 'Jakarta', 'Active'),
(11112, 'Kevin Saragih', 'kevin', 'd2e7a2105d0fb461fe6f2858cc33942f', '081269087591', 'kevinsaragih@saintek.com', 'Dosen Pembimbing', 'Medan', 'Active'),
(11113, 'Jake Made', 'jake', '7f6b4c4b8d2070f44e9e79a51f9cd37b', '081269087593', 'jakemade@saintek.com', 'Dosen Pembimbing', 'Bali', 'Active'),
(11114, 'Pedro Pascal', 'pedro', 'd3ce9efea6244baa7bf718f12dd0c331', '081269087596', 'pedropascal@gmail.com', 'Dosen Pembimbing', 'Semarang', 'Active');

--
-- Trigger `dospem`
--
DELIMITER $$
CREATE TRIGGER `dospemAccount` AFTER INSERT ON `dospem` FOR EACH ROW BEGIN
	INSERT INTO akun SET
    id_dospem = new.id_dospem,
    nama = new.nama,
    username = new.username,
    password = new.password,
    no_telp = new.no_telp,
    email = new.email,
    role = new.role,
    alamat = new.alamat,
    account_status = new.account_status;
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'Informatika'),
(2, 'Sistem Informasi'),
(3, 'Teknik Elektro'),
(4, 'Informatika Medis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_akhir`
--

CREATE TABLE `laporan_akhir` (
  `id_laporanakhir` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_dospem` int(11) NOT NULL,
  `username_dospem` varchar(30) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nama_mahasiswa` varchar(30) NOT NULL,
  `nama_dospem` varchar(30) NOT NULL,
  `file_laporan` varchar(255) NOT NULL,
  `catatan_dospem` text NOT NULL,
  `Status` varchar(30) NOT NULL DEFAULT 'Belum Selesai'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan_akhir`
--

INSERT INTO `laporan_akhir` (`id_laporanakhir`, `id_akun`, `id_dospem`, `username_dospem`, `nim`, `nama_mahasiswa`, `nama_dospem`, `file_laporan`, `catatan_dospem`, `Status`) VALUES
(1, 16, 11112, 'kevin', '5190411406', 'Ondosan Sinaga', 'Kevin Saragih', 'http://localhost/akademikmagang/uploads/files/LAPORAN AKHIR.pdf', 'Sangat bagus !', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `id_dospem` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nama_mahasiswa` varchar(30) NOT NULL,
  `nama_dospem` varchar(30) NOT NULL,
  `username_dosen` varchar(30) NOT NULL,
  `review_mahasiswa` text NOT NULL,
  `review_dosen` text NOT NULL,
  `file_review` varchar(255) NOT NULL,
  `tanggal_review` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `review`
--

INSERT INTO `review` (`id_review`, `id_dospem`, `id_akun`, `nim`, `nama_mahasiswa`, `nama_dospem`, `username_dosen`, `review_mahasiswa`, `review_dosen`, `file_review`, `tanggal_review`) VALUES
(1, 11112, 16, '5190411406', 'Ondosan Sinaga', 'Kevin Saragih', 'kevin', 'Saya dengan Mbak Vina mengumpulkan data ke salah satu wisata di Jogjakarta dan di akhir hari kami mulai menyusun data.', 'Sangat bagus, terus lanjutkan !', 'http://localhost/akademikmagang/uploads/files/t8ozxhl3c7q5kpg.pdf', '2020-10-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id_sertifikat` int(11) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nama_mahasiswa` varchar(30) NOT NULL,
  `file_sertifikat` varchar(255) NOT NULL,
  `id_daftarmagang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertifikat`, `nim`, `nama_mahasiswa`, `file_sertifikat`, `id_daftarmagang`) VALUES
(1, '5190411406', 'Ondosan Sinaga', 'http://localhost/akademikmagang/uploads/files/SERTIFIKAT.pdf', 6);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE,
  ADD KEY `id_dospem` (`id_dospem`);

--
-- Indeks untuk tabel `daftar_magang`
--
ALTER TABLE `daftar_magang`
  ADD PRIMARY KEY (`id_daftarmagang`),
  ADD KEY `id_jurusan` (`id_jurusan`),
  ADD KEY `id_dospem` (`id_dospem`),
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `id_akun_2` (`id_akun`) USING BTREE,
  ADD KEY `id_dospem_2` (`id_dospem`) USING BTREE;

--
-- Indeks untuk tabel `dospem`
--
ALTER TABLE `dospem`
  ADD UNIQUE KEY `id_dospem` (`id_dospem`) USING BTREE,
  ADD KEY `id_dospem_2` (`id_dospem`) USING BTREE;

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  ADD PRIMARY KEY (`id_laporanakhir`),
  ADD UNIQUE KEY `id_dospem` (`id_dospem`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indeks untuk tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_dospem` (`id_dospem`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indeks untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD KEY `id_daftarmagang` (`id_daftarmagang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `daftar_magang`
--
ALTER TABLE `daftar_magang`
  MODIFY `id_daftarmagang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  MODIFY `id_laporanakhir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_magang`
--
ALTER TABLE `daftar_magang`
  ADD CONSTRAINT `daftar_magang_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_magang_ibfk_2` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`),
  ADD CONSTRAINT `daftar_magang_ibfk_3` FOREIGN KEY (`id_dospem`) REFERENCES `dospem` (`id_dospem`);

--
-- Ketidakleluasaan untuk tabel `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  ADD CONSTRAINT `laporan_akhir_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`);

--
-- Ketidakleluasaan untuk tabel `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_dospem`) REFERENCES `dospem` (`id_dospem`);

--
-- Ketidakleluasaan untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD CONSTRAINT `sertifikat_ibfk_1` FOREIGN KEY (`id_daftarmagang`) REFERENCES `daftar_magang` (`id_daftarmagang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
