-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 06 Nov 2024 pada 09.14
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptsri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `idbarang` int(11) NOT NULL,
  `id_kategori` text NOT NULL,
  `namabarang` text NOT NULL,
  `keyword` text NOT NULL,
  `hargabarang` text NOT NULL,
  `beratbarang` text NOT NULL,
  `stokbarang` text NOT NULL,
  `fotobarang` text NOT NULL,
  `deskripsibarang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`idbarang`, `id_kategori`, `namabarang`, `keyword`, `hargabarang`, `beratbarang`, `stokbarang`, `fotobarang`, `deskripsibarang`) VALUES
(4, '11', 'Root Ginger', 'ginger', '50000', '1', '10', 'Rectangle 12.png', 'Experience the rich aroma and intense flavor of our premium root ginger. Sourced from the finest farms, this ginger is known for its vibrant freshness, adding a zesty kick to your dishes, teas, and remedies. Carefully selected and packed to preserve its natural oils and nutrients, our root ginger is perfect for elevating both culinary and wellness creations. Choose the best for a naturally potent, aromatic spice that brings warmth and vitality to every use.'),
(5, '11', 'Root Cinnamon', 'cinnamon', '13000', '5', '53', 'Cinnamon.png', 'Discover the warm, earthy sweetness of our premium root cinnamon, harvested from select sources to ensure maximum flavor and aroma. This high-quality cinnamon root enhances both sweet and savory dishes with its rich, fragrant spice. Perfect for baking, teas, and traditional remedies, our cinnamon is carefully processed to retain its natural oils and robust flavor profile. '),
(8, '11', 'Cardamom', 'cardamom', '16000', '1', '76', 'Cardamom 5.png', 'Indulge in the exotic, aromatic essence of our premium cardamom, handpicked to deliver its signature sweet and spicy notes. Known for its distinctive flavor and health benefits, this high-quality cardamom is ideal for enhancing teas, desserts, curries, and baked goods.'),
(9, '16', 'Robusta Coffee', 'robusta', '10000', '1', '9', 'Robusta green.png', 'Savor the bold, full-bodied flavor of our premium Robusta coffee, sourced from select farms to ensure rich aroma and strong character. Known for its deep, earthy notes and higher caffeine content, this robust coffee is perfect for those who enjoy a strong, energizing brew.'),
(14, '16', 'Arabica Coffee', 'arabica', '20000', '1', '32', 'Arabica green.png', 'Enjoy the smooth, aromatic richness of our premium Arabica coffee, sourced from the finest high-altitude farms. Renowned for its balanced flavor and delicate acidity, this coffee offers notes of sweetness and subtle hints of fruit or floral undertones, creating a refined and satisfying brew.'),
(28, '17', 'Cacopeat', 'bibitcacopeat', '12000', '1', '33', 'e6b06a31-f664-4345-a9a9-7374dfa1cee0.png', 'Enhance your gardening and soil health with our premium cocopeat, an eco-friendly, sustainable growing medium made from coconut husk fibers. Known for its excellent water retention, aeration, and soil conditioning properties, cocopeat promotes healthier root systems and optimizes nutrient absorption for plants. Ideal for use in potting mixes, hydroponics, and garden beds, our high-quality cocopeat is carefully processed to ensure a low salt content and balanced pH. '),
(29, '25', 'Vanilla', 'vanilla', '10000', '1', '8', 'image_feature.png', 'Experience the luxurious, sweet aroma and rich flavor of our premium vanilla, sourced from the finest growers to ensure exceptional quality. Perfect for baking, desserts, and gourmet dishes, this high-grade vanilla adds depth and warmth to every creation, elevating flavors with its smooth, creamy notes. ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(11, '  Spices'),
(16, '  Coffee'),
(17, '   Coconut Derivatives'),
(25, 'Vanilla');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `idbeli` int(11) NOT NULL,
  `notransaksi` text NOT NULL,
  `id` int(11) NOT NULL,
  `tanggalbeli` date NOT NULL,
  `totalbeli` text NOT NULL DEFAULT '\'\\\'belum bayar\\\'\'',
  `alamatpengiriman` text NOT NULL,
  `totalberat` varchar(255) NOT NULL,
  `kota` text NOT NULL,
  `provinsi` varchar(200) NOT NULL,
  `ekspedisi` varchar(200) NOT NULL,
  `layanan` varchar(200) NOT NULL,
  `ongkir` text NOT NULL,
  `statusbeli` text NOT NULL,
  `catatan` text NOT NULL,
  `waktu` datetime NOT NULL,
  `snapkode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`idbeli`, `notransaksi`, `id`, `tanggalbeli`, `totalbeli`, `alamatpengiriman`, `totalberat`, `kota`, `provinsi`, `ekspedisi`, `layanan`, `ongkir`, `statusbeli`, `catatan`, `waktu`, `snapkode`) VALUES
(5, 'TP20241031065820', 22, '2024-10-31', '10000', 'asd', '1', 'Jakarta Barat', 'DKI Jakarta', 'JNE', 'REG 19,000 2-3', '19000', 'settlement', '', '2024-10-31 18:58:20', 'd3b32476-9a7a-4d0e-ab9d-aa11293cdaf1'),
(6, 'TP20241101091830', 25, '2024-11-01', '30000', 'jl sudirman', '3', 'Jakarta Barat', 'DKI Jakarta', 'JNE', 'REG 19,000 2-3', '19000', 'Barang Di Kemas', '-', '2024-11-01 09:18:30', 'a2d28558-18cc-407e-9dfe-531fa481f57f'),
(7, 'TP20241106114130', 22, '2024-11-06', '12000', 'Jl Pasundan', '1', 'Palembang', 'Sumatera Selatan', 'JNE', 'CTC 10,000 1-2', '10000', '', '', '2024-11-06 11:41:30', 'f67cc004-0654-4dc0-b4c1-7bd6b4fd2003'),
(8, 'TP20241106031342', 22, '2024-11-06', '20000', 'Jl Pasundan', '1', 'Palembang', 'Sumatera Selatan', 'JNE', 'CTC 10,000 1-2', '10000', '', '', '2024-11-06 15:13:42', '80b02c2f-8733-4f4f-b3bc-51cbb4a79921');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelianproduk`
--

CREATE TABLE `pembelianproduk` (
  `idbeli_produk` int(11) NOT NULL,
  `idbeli` text NOT NULL,
  `idproduk` text NOT NULL,
  `nama` text NOT NULL,
  `harga` text NOT NULL,
  `berat` text NOT NULL,
  `subberat` text NOT NULL,
  `subharga` text NOT NULL,
  `jumlah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelianproduk`
--

INSERT INTO `pembelianproduk` (`idbeli_produk`, `idbeli`, `idproduk`, `nama`, `harga`, `berat`, `subberat`, `subharga`, `jumlah`) VALUES
(5, '5', '', 'Vanilla', '10000', '1', '1', '10000', '1'),
(6, '6', '', 'Vanilla', '10000', '1', '3', '30000', '3'),
(7, '7', '', 'Cacopeat', '12000', '1', '1', '12000', '1'),
(8, '8', '', 'Arabica Coffee', '20000', '1', '1', '20000', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `fotoprofil` varchar(255) NOT NULL,
  `level` text NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL,
  `status_daftar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `telepon`, `alamat`, `fotoprofil`, `level`, `otp`, `otp_expiry`, `status_daftar`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin', '0812345678', 'Palembang', 'Untitled.png', 'Admin', NULL, NULL, ''),
(20, 'Asyfa', 'asyfaariliani@gmail.com', 'Asyfa', '082318296475', 'Riau', 'Untitled.png', 'Pelanggan', NULL, NULL, ''),
(21, 'wanti', 'wantiapriliani5@gmail.com', 'wanti', '082318296475', 'Riau', 'Untitled.png', 'Pelanggan', NULL, NULL, ''),
(22, 'Sugeng', 'sugeng@gmail.com', 'sugeng', '089482198912', 'Jl. Palembang', 'Untitled.png', 'Pelanggan', NULL, NULL, ''),
(23, 'Intan', 'intan@gmail.com', 'intan', '089418295812', 'Jl. Palembang', 'Untitled.png', 'Pelanggan', NULL, NULL, ''),
(25, 'joni', 'joni@gmail.com', 'joni', '087123', 'asd', 'Untitled.png', 'Pelanggan', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `promosi`
--

CREATE TABLE `promosi` (
  `idpromosi` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `tipe` text NOT NULL,
  `gambar` text DEFAULT NULL,
  `status` text NOT NULL,
  `waktu` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `promosi`
--

INSERT INTO `promosi` (`idpromosi`, `judul`, `pesan`, `tipe`, `gambar`, `status`, `waktu`) VALUES
(1, 'Diskon Akhir Tahun', '<p>Nikmati diskon hingga 50% untuk semua produk!</p>\r\n', 'Promo', '202411051.png', '', '2024-11-05 16:01:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`idbeli`);

--
-- Indeks untuk tabel `pembelianproduk`
--
ALTER TABLE `pembelianproduk`
  ADD PRIMARY KEY (`idbeli_produk`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `promosi`
--
ALTER TABLE `promosi`
  ADD PRIMARY KEY (`idpromosi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `idbeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pembelianproduk`
--
ALTER TABLE `pembelianproduk`
  MODIFY `idbeli_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `promosi`
--
ALTER TABLE `promosi`
  MODIFY `idpromosi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
