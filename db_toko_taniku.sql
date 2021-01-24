-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Des 2020 pada 01.23
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko_taniku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `kode_transaksi` varchar(30) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `nama_distributor` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephon` varchar(50) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `status_bayar` varchar(20) NOT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_detail_transaksi`
--

INSERT INTO `tb_detail_transaksi` (`kode_transaksi`, `id_user`, `id_distributor`, `nama_distributor`, `email`, `telephon`, `alamat`, `tanggal_transaksi`, `jumlah_transaksi`, `status_bayar`, `tanggal_post`, `tanggal_update`) VALUES
('13122020GSLQ5UYE', 1, 1, 'Retno Anjarwati', 'anjarwati259@gmail.com', '081554988354', 'jalan karimata 4', '2020-12-13 00:00:00', 26000, 'Sudah Bayar', '2020-12-13 06:04:47', '2020-12-28 14:56:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_distributor`
--

CREATE TABLE `tb_distributor` (
  `id_distributor` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_distributor` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(54) NOT NULL,
  `telephon` varchar(50) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `status_distributor` varchar(20) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_distributor`
--

INSERT INTO `tb_distributor` (`id_distributor`, `id_user`, `nama_distributor`, `email`, `password`, `telephon`, `alamat`, `status_distributor`, `tanggal_daftar`, `tanggal_update`) VALUES
(1, 0, 'Retno Anjarwati', 'anjarwati259@gmail.com', '391400d2a492145244a77bb140851f85b7160538', '081554988354', 'jalan karimata 4', 'Pending', '2020-12-10 13:49:45', '2020-12-10 12:49:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar`
--

CREATE TABLE `tb_gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `judul_gambar` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `slug_kategori` varchar(255) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `slug_kategori`, `nama_kategori`, `tanggal_update`) VALUES
(1, 'sayur', 'Sayur', '2020-12-10 08:39:48'),
(2, 'buah', 'Buah', '2020-12-17 07:35:46'),
(3, 'bumbu-dapur', 'Bumbu Dapur', '2020-12-17 07:36:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_konfigurasi`
--

CREATE TABLE `tb_konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `namaweb` varchar(255) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `metatext` text NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `rekening_pembayaran` varchar(255) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_konfigurasi`
--

INSERT INTO `tb_konfigurasi` (`id_konfigurasi`, `namaweb`, `tagline`, `email`, `website`, `keywords`, `metatext`, `telephone`, `alamat`, `facebook`, `instagram`, `deskripsi`, `logo`, `icon`, `rekening_pembayaran`, `tanggal_update`) VALUES
(1, 'Toko Pertanian Semboro', 'Distribusi Jeruk', 'jeruk@gmail.com', 'tokojerukpaksur.com', 'jeruk, toko jeruk, pak sur', 'ok', '081554988354', 'darungan-sidomulyo', 'https://facebook.com/tokojerukpaksur', 'https://instagram.com/tokojerukpaksur', 'distribusi jeruk kerennn', 'Logo.png', 'Logo1.png', '0221866622', '2020-12-03 12:04:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `id_rekening` int(11) NOT NULL,
  `rekening_pembayaran` varchar(255) NOT NULL,
  `rekening_distributor` varchar(255) NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `nama_bank` varchar(10) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `kode_transaksi`, `id_rekening`, `rekening_pembayaran`, `rekening_distributor`, `tanggal_bayar`, `nama_bank`, `jumlah_bayar`, `bukti_bayar`, `tanggal_update`) VALUES
(2, '13122020GSLQ5UYE', 2, '12333', 'hadi', '2020-12-13 00:00:00', 'BANK BRI', 26000, '6701_png_860.png', '2020-12-13 14:20:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petani`
--

CREATE TABLE `tb_petani` (
  `id_petani` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_petani` varchar(50) NOT NULL,
  `telephon` varchar(50) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product`
--

CREATE TABLE `tb_product` (
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_tengkulak` int(11) DEFAULT NULL,
  `kode_product` varchar(20) NOT NULL,
  `nama_product` varchar(255) NOT NULL,
  `slug_product` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `status_product` varchar(20) NOT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_product`
--

INSERT INTO `tb_product` (`id_product`, `id_user`, `id_kategori`, `id_tengkulak`, `kode_product`, `nama_product`, `slug_product`, `keterangan`, `harga`, `stok`, `gambar`, `status_product`, `tanggal_post`, `tanggal_update`) VALUES
(1, 1, 1, NULL, 'bwm-01', 'Bawang Merah', 'bawang-merah-bwm-01', '<p>ada</p>\r\n', 12000, 5, 'bawang1.jpg', 'Publish', '2020-12-10 09:46:17', '2020-12-10 08:46:17'),
(2, 10, 1, NULL, 'b1', 'bawang Putih', 'bawang-putih-b1', '<p>ada</p>\r\n', 14000, 5, 'bawang3.jpg', 'Publish', '2020-12-10 09:49:07', '2020-12-10 08:49:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rekening`
--

CREATE TABLE `tb_rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `nomor_rekening` varchar(20) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_post` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_rekening`
--

INSERT INTO `tb_rekening` (`id_rekening`, `nama_bank`, `nomor_rekening`, `nama_pemilik`, `gambar`, `tanggal_post`) VALUES
(2, 'Bank BRI', '9873837838', 'Retno Anjarwati', '', '2020-12-05 22:31:12'),
(3, 'Bank BNI', '26276537367', 'Retno', '', '2020-12-05 22:31:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tengkulak`
--

CREATE TABLE `tb_tengkulak` (
  `id_tengkulak` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_tengkulak` varchar(50) NOT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `telephon` varchar(50) DEFAULT NULL,
  `status_tengkulak` varchar(20) NOT NULL,
  `tanggal_daftar` datetime DEFAULT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tengkulak`
--

INSERT INTO `tb_tengkulak` (`id_tengkulak`, `id_user`, `nama_tengkulak`, `alamat`, `telephon`, `status_tengkulak`, `tanggal_daftar`, `tanggal_update`) VALUES
(1, 10, 'agil', 'semboro', '081554988354', 'Pending', '2020-12-07 13:06:02', '2020-12-07 16:08:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `taggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_distributor`, `id_product`, `id_user`, `kode_transaksi`, `harga`, `jumlah`, `total_harga`, `tanggal_transaksi`, `taggal_update`) VALUES
(1, 1, 2, 0, '13122020GSLQ5UYE', 14000, 1, 14000, '2020-12-13 00:00:00', '2020-12-13 05:04:48'),
(2, 1, 1, 0, '13122020GSLQ5UYE', 12000, 1, 12000, '2020-12-13 00:00:00', '2020-12-13 05:04:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `akses_level` varchar(20) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `email`, `username`, `password`, `akses_level`, `tanggal_update`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Admin', '2020-12-03 12:46:30'),
(2, 'Tengkulak', 'tengkulak@gmail.com', 'tengkulak', 'e0e040515f41eb4df6a6cc463834e6548abd18cf', 'Tengkulak', '2020-12-07 09:50:36'),
(10, 'agil', 'agil@gmail.com', 'agil1234', '900849c7d0258a8bb420f4e7742bd6dc8ed3258d', 'Tengkulak', '2020-12-07 12:06:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- Indeks untuk tabel `tb_distributor`
--
ALTER TABLE `tb_distributor`
  ADD PRIMARY KEY (`id_distributor`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `tb_gambar`
--
ALTER TABLE `tb_gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_konfigurasi`
--
ALTER TABLE `tb_konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `tb_petani`
--
ALTER TABLE `tb_petani`
  ADD PRIMARY KEY (`id_petani`);

--
-- Indeks untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `kode_product` (`kode_product`);

--
-- Indeks untuk tabel `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD PRIMARY KEY (`id_rekening`),
  ADD UNIQUE KEY `nomor_rekening` (`nomor_rekening`);

--
-- Indeks untuk tabel `tb_tengkulak`
--
ALTER TABLE `tb_tengkulak`
  ADD PRIMARY KEY (`id_tengkulak`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_distributor`
--
ALTER TABLE `tb_distributor`
  MODIFY `id_distributor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_gambar`
--
ALTER TABLE `tb_gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_konfigurasi`
--
ALTER TABLE `tb_konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_petani`
--
ALTER TABLE `tb_petani`
  MODIFY `id_petani` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_rekening`
--
ALTER TABLE `tb_rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_tengkulak`
--
ALTER TABLE `tb_tengkulak`
  MODIFY `id_tengkulak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
