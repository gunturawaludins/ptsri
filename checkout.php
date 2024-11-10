<?php

namespace Midtrans;

require_once 'Midtrans.php';

Config::$serverKey = 'SB-Mid-server-5q6LCsTxMzj7ClD9yfyFD_qx';
Config::$clientKey = 'SB-Mid-client-GHAqOJodIWM2OPsP';

printExampleWarningMessage();

Config::$isSanitized = Config::$is3ds = true;


function printExampleWarningMessage()
{
	if (strpos(Config::$serverKey, 'your ') != false) {
		echo "<code>";
		echo "<h4>Please set your server key from sandbox</h4>";
		echo "In file: " . __FILE__;
		echo "<br>";
		echo "<br>";
		echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-5q6LCsTxMzj7ClD9yfyFD_qx\';');
		die();
	}
}


session_start();
include 'koneksi.php';
if (!isset($_SESSION["pengguna"])) {
	echo "<script> alert('Anda belum login');</script>";
	echo "<script> location ='login.php';</script>";
}
$idakun = $_SESSION["pengguna"]["id"];
$ambildata = $koneksi->query("SELECT *FROM pengguna WHERE id='$idakun'");
$akun = $ambildata->fetch_assoc();
?>

<?php include 'header.php'; ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>


<div class="container-fluid page-header mb-5 p-0" style="background-image: url(assets_home/img/bg1.jpg);">
	<div class="container-fluid page-header-inner py-5">
		<div class="container text-center">
			<h1 class="display-3 text-white mb-3 animated slideInDown">Checkout</h1>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb justify-content-center text-uppercase">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item text-white active" aria-current="page">Checkout</li>
				</ol>
			</nav>
		</div>
	</div>
</div>

<div class="container-xxl py-5">
	<div class="container">
		<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
			<h6 class="text-primary text-uppercase">Checkout</h6>
			<h1 class="mb-5">Checkout</h1>
		</div>
		<div class="row g-4">
			<div class="table-responsive">
				<table class="table">
					<thead class="bg-white">
						<tr>
							<th>No</th>
							<th>Produk</th>
							<th>Foto Produk</th>
							<th>Harga</th>
							<th>Jumlah Beli</th>
							<th>Total Harga</th>
						</tr>
					</thead>
					<tbody>
						<?php $nomor = 1; ?>
						<?php $totalberat = 0; ?>
						<?php $totalbelanja = 0; ?>
						<?php foreach ($_SESSION["keranjang"] as $idbarang => $jumlah) : ?>
							<?php
							$ambil = $koneksi->query("SELECT * FROM barang 
					WHERE idbarang='$idbarang'");
							$pecah = $ambil->fetch_assoc();
							$totalharga = $pecah["hargabarang"] * $jumlah;
							$subberat = $pecah["beratbarang"] * $jumlah;
							$totalberat += $subberat;

							?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $pecah['namabarang']; ?></td>
								<td class="image-prod">
									<img src="foto/<?php echo $pecah["fotobarang"]; ?>" style="width: 150px;border-radius:10px">
								</td>
								<td>Rp <?php echo number_format($pecah['hargabarang']); ?></td>
								<td><?php echo $jumlah; ?></td>
								<td>Rp <?php echo number_format($totalharga); ?></td>
							</tr>
							<?php $nomor++; ?>
							<?php $totalbelanja += $totalharga; ?>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="d-none d-sm-block mb-5 pb-4">
	</div>
	<div class="row">
		<div class="col-lg-12">
			<form class="form-contact contact_form" method="post">
				<div class="row">
					<div class="col-12">
						<h2 class="contact-title">Check out Detail</h2>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="mb-3 text-white">Nama</label>
							<input type="text" readonly value="<?php echo $_SESSION["pengguna"]['nama'] ?>" class="form-control valid mb-3" required>
							</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="mb-3 text-white">No. Telepon</label>
							<input type="text" readonly value="<?php echo $_SESSION["pengguna"]['telepon'] ?>" class="form-control valid mb-3" required>
							</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label class="mb-3 text-white">Alamat</label>
							<input type="hidden" name="totalberatnya" value="<?php echo $totalberat ?>">
										<textarea class="form-control valid mb-3" rows="5" name="alamatpengiriman" placeholder="Masukkan Alamat" required></textarea>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label class="mb-3 text-white">Provinsi</label>
							<select class="form-control" name="nama_provinsi">

										</select>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label class="mb-3 text-white">Kota</label>
							<select class="form-control" name="nama_distrik">

										</select>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label class="mb-3 text-white">Ekspedisi</label>
							<select class="form-control" name="nama_ekspedisi">

</select>
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label class="mb-3 text-white">Layanan</label>
							<select class="form-control" name="nama_paket">

										</select>
						</div>
					</div>
					<input type="hidden" id="dua" name="dua" value="<?php echo $totalbelanja ?>">
					<div class="col-12">
						<div class="form-group">
							<label class="mb-3 text-white">Total Belanja</label>
							<input class="form-control mb-3" type="number" readonly required value="<?= $totalbelanja ?>">
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label class="mb-3 text-white">Ongkos Kirim</label>
							<input class="form-control mb-3" name="ongkir" type="number" readonly required id="res">
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label class="mb-3 text-white">Grand Total</label>
							<input class="form-control mb-3" id="grandtotal" name="grandtotal" required readonly type="number">
						</div>
					</div>
					<input type="hidden" name="totalbelanja" id="totalbelanja" value="<?= $totalbelanja ?>">
					<input type="hidden" name="total_berat" value="1">
					<input type="hidden" name="provinsi">
					<input type="hidden" name="distrik">
					<input type="hidden" name="tipe">
					<input type="hidden" name="kodepos">
					<input type="hidden" name="ekspedisi">
					<input type="hidden" name="paket">
					<input type="hidden" name="ongkir">
					<input type="hidden" name="estimasi">
				</div>
				<div class="form-group mt-3">
					<button type="submit" name="checkout" class="btn btn-primary">Selesaikan Transaksi</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
if (isset($_POST["checkout"])) {
	$notransaksi = 'TP' . date("Ymdhis");
	$id = $_SESSION["pengguna"]["id"];
	$tanggalbeli = date("Y-m-d");
	$waktu = date("Y-m-d H:i:s");
	$alamatpengiriman = $_POST["alamatpengiriman"];
	$totalbeli = $totalbelanja;
	$totalberatnya = $_POST["totalberatnya"];
	$ongkir = $_POST["ongkir"];
	$provinsi = $_POST["nama_provinsi"];
	$kota = $_POST["nama_distrik"];
	$ekspedisi = strtoupper($_POST["nama_ekspedisi"]);
	$layanan = $_POST["nama_paket"];
	$koneksi->query(
		"INSERT INTO pembelian(notransaksi,
				id, tanggalbeli, totalbeli, alamatpengiriman, totalberat, ongkir, statusbeli, waktu,kota, provinsi, ekspedisi, layanan)
				VALUES('$notransaksi','$id', '$tanggalbeli', '$totalbeli', '$alamatpengiriman','$totalberat','$ongkir', '', '$waktu','$kota','$provinsi','$ekspedisi','$layanan')"
	);
	$idbeli_barusan = $koneksi->insert_id;
	$item_details = array();
	foreach ($_SESSION['keranjang'] as $idbarang => $jumlah) {
		$ambil = $koneksi->query("SELECT*FROM barang WHERE idbarang='$idbarang'");
		$perbarang = $ambil->fetch_assoc();
		$nama = $perbarang['namabarang'];
		$harga = $perbarang['hargabarang'];
		$berat = $perbarang['beratbarang'];

		$subberat = $perbarang['beratbarang'] * $jumlah;
		$subharga = $perbarang['hargabarang'] * $jumlah;
		$koneksi->query("INSERT INTO pembelianproduk (idbeli, idproduk, nama, harga, berat, subberat, subharga, jumlah)
					VALUES ('$idbeli_barusan','$idproduk', '$nama','$harga','$berat', '$subberat', '$subharga','$jumlah')");

		$koneksi->query("UPDATE barang SET stokbarang=stokbarang -$jumlah
					WHERE idbarang='$idbarang'");

		$item_details[] = array('id' => $idbarang, 'price' => $harga, 'quantity' => $jumlah, 'name' => $nama);
	}

	$transaction_details = array(
		'order_id' => $notransaksi,
		'gross_amount' => $totalbeli,
	);
	// Optional

	$billing_address = array(
		'first_name'    => $akun['nama'],
		'last_name'     => "",
		'address'       => $alamatpengiriman,
		'city'          => $kota,
		'postal_code'   => "30118",
		'phone'         => $akun['telepon'],
		'country_code'  => 'IDN'
	);

	// Optional
	$shipping_address = array(
		'first_name'    => $akun['nama'],
		'last_name'     => "",
		'address'       => $alamatpengiriman,
		'city'          => $kota,
		'postal_code'   => "30118",
		'phone'         => $akun['telepon'],
		'country_code'  => 'IDN'
	);
	// Optional
	$customer_details = array(
		'first_name'    => $akun['nama'],
		'last_name'     => "",
		'email'         => $akun['email'],
		'phone'         => $akun['telepon'],
		'billing_address'  => $billing_address,
		'shipping_address' => $shipping_address
	);
	// Fill transaction details
	$transaction = array(
		'transaction_details' => $transaction_details,
		'customer_details' => $customer_details,
		'item_details' => $item_details,
	);

	$snap_token = '';
	try {
		$snap_token = Snap::getSnapToken($transaction);
	} catch (\Exception $e) {
	}

	$koneksi->query("UPDATE pembelian SET snapkode='$snap_token' WHERE idbeli='$idbeli_barusan'") or die(mysqli_error($koneksi));

	// unset($_SESSION["keranjang"]);
	echo "<script> alert('Pembelian Sukses');</script>";
	echo "<script> location ='riwayat.php';</script>";
}
?>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
<script>
	$(document).ready(function() {
		$.ajax({
			type: 'post',
			url: 'dataprovinsi.php',
			success: function(hasil_provinsi) {
				$("select[name=nama_provinsi]").html(hasil_provinsi);
			}
		});

		$("select[name=nama_provinsi]").on("change", function() {
			var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
			$.ajax({
				type: 'post',
				url: 'datadistrik.php',
				data: 'id_provinsi=' + id_provinsi_terpilih,
				success: function(hasil_distrik) {
					$("select[name=nama_distrik]").html(hasil_distrik);
				}
			});
		});
		$.ajax({
			type: 'post',
			url: 'dataekspedisi.php',
			success: function(hasil_ekspedisi) {
				$("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
			}
		});

		$("select[name=nama_ekspedisi]").on("change", function() {
			//dapetin data ongkir

			//dapetin ekspedisi terpilih
			var ekpedisi_terpilih = $("select[name=nama_ekspedisi]").val();
			//dapetin id_distrik yg dipilih pengguna
			var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
			//dapetin total berat dari inputan
			var total_berat = $("input[name=total_berat]").val();
			$.ajax({
				type: 'post',
				url: 'datapaket.php',
				data: 'ekspedisi=' + ekpedisi_terpilih + '&distrik=' + distrik_terpilih + '&berat=' + total_berat,
				success: function(hasil_paket) {
					console.log(hasil_paket);
					$("select[name=nama_paket]").html(hasil_paket);

					//taro ekspedisi terpilih di inputan ekspedisi
					$("input[name=ekspedisi]").val(ekpedisi_terpilih);
				}
			})
		});
		$("select[name=nama_distrik]").on("change", function() {
			var prov = $("option:selected", this).attr("nama_provinsi");
			var dist = $("option:selected", this).attr("nama_distrik");
			var tipe = $("option:selected", this).attr("tipe_distrik");
			var kodepos = $("option:selected", this).attr("kodepos");

			$("input[name=provinsi]").val(prov);
			$("input[name=distrik]").val(dist);
			$("input[name=tipe]").val(tipe);
			$("input[name=kodepos]").val(kodepos);
		});
		$("select[name=nama_paket]").on("change", function() {
			var paket = $("option:selected", this).attr("paket");
			var ongkir = $("option:selected", this).attr("ongkir");
			var etd = $("option:selected", this).attr("etd");

			$("input[name=paket]").val(paket);
			$("input[name=ongkir]").val(ongkir);
			$("input[name=estimasi]").val(etd);
			var num2 = document.getElementById("totalbelanja").value;
			result = parseInt(ongkir) + parseInt(num2);
			document.getElementById("grandtotal").value = result;
		})
	});
</script>
<?php
include 'footer.php';
?>