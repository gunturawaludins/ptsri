<?php
session_start();
include 'koneksi.php';
?>
<?php include 'header.php'; ?>
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(assets_home/img/bg1.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Keranjang</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center text-uppercase">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item text-white active" aria-current="page">Keranjang</li>
				</ol>
			</nav>
		</div>
	</div>
</div>

<div class="container-xxl py-5">
	<div class="container">
		<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
			<h6 class="text-primary text-uppercase">Keranjang</h6>
			<h1 class="mb-5">Keranjang</h1>
		</div>
		<div class="row g-4">
			<div class="table-responsive">
				<table class="table">
					<thead class="bg-white">
						<tr>
							<th>No</th>
							<th>Foto Produk</th>
							<th>Produk</th>
							<th>Jumlah Beli</th>
							<th>Harga</th>
							<th>Total Harga</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $nomor = 1; ?>
						<?php if (!empty($_SESSION["keranjang"])) { ?>
							<?php foreach ($_SESSION["keranjang"] as $idbarang => $jumlah) : ?>
								<?php
								$ambil = $koneksi->query("SELECT * FROM barang 
								WHERE idbarang='$idbarang'");
								$pecah = $ambil->fetch_assoc();
								$totalharga = $pecah["hargabarang"] * $jumlah;
								?>
								<tr class="text-tengah">
									<td><?php echo $nomor; ?></td>
									<td class="image-prod">
										<img src="foto/<?php echo $pecah["fotobarang"]; ?>" style="width: 150px;border-radius:10px">
									</td>
									<td><?php echo $pecah['namabarang']; ?></td>
									<td><?php echo $jumlah; ?></td>
									<td>Rp <?php echo number_format($pecah['hargabarang']); ?></td>
									<td>Rp <?php echo number_format($totalharga); ?></td>
									<td>
										<a href="hapuskeranjang.php?id=<?php echo $idbarang ?>" class="btn btn-primary">Hapus</a>
									</td>
								</tr>
								<?php $nomor++; ?>
						<?php endforeach;
						} ?>
					</tbody>
				</table>
				<br>
				<a href="checkout.php" class="btn btn-success">Checkout</a>
			</div>
		</div>
	</div>
</div>

<?php
include 'footer.php';
?>