<?php

namespace Midtrans;

require_once 'Midtrans.php';

// Midtrans configuration
Config::$serverKey = 'SB-Mid-server-5q6LCsTxMzj7ClD9yfyFD_qx';
Config::$clientKey = 'SB-Mid-client-GHAqOJodIWM2OPsP';
Config::$isSanitized = Config::$is3ds = true;

session_start();
include 'koneksi.php';

if (!isset($_SESSION["pengguna"])) {
    echo "<script> alert('Anda belum login');</script>";
    echo "<script> location ='login.php';</script>";
}

include 'header.php';

$id = $_SESSION["pengguna"]['id'];
?>

<!-- CSS untuk rata tengah teks dalam tabel -->
<style>
    .centered-text {
        text-align: center;
    }
</style>

<div class="container-fluid page-header mb-5 p-0" style="background-image: url(assets_home/img/bg1.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Riwayat</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Riwayat</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">Riwayat Pembelian</h6>
            <h1 class="mb-5">Riwayat Pembelian</h1>
        </div>
        <div class="row g-4">
            <div class="table-responsive">
                <table class="table text-white">
                    <thead class="bg-white text-dark">
                        <tr class="centered-text">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Daftar</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Opsi</th>
                            <th>Nota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $nomor = 1;
                        $ambil = $koneksi->query("SELECT *, pembelian.idbeli as idbelireal FROM pembelian WHERE pembelian.id='$id' ORDER BY pembelian.tanggalbeli DESC, pembelian.idbeli DESC");
                        while ($pecah = $ambil->fetch_assoc()) {
                            if ($pecah['statusbeli'] != '') {
                                $notransaksi = $pecah['notransaksi'];
                                $status = \Midtrans\Transaction::status($notransaksi);
                                $transaction = $status->transaction_status;
                                if ($pecah['statusbeli'] == 'pending') {
                                    $koneksi->query("UPDATE pembelian SET statusbeli='$transaction' WHERE idbeli='$pecah[idbelireal]'") or die(mysqli_error($koneksi));
                                }
                            }
                        ?>
                            <tr class="centered-text">
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo tanggal($pecah['tanggalbeli']) . '<br>Jam ' . date('H:i', strtotime($pecah['waktu'])); ?></td>
                                <td>
                                    <ul style="padding: 0;list-style-type: none;">
                                        <?php
                                        $ambildetail = $koneksi->query("SELECT * FROM pembelianproduk WHERE idbeli='$pecah[idbelireal]'");
                                        while ($detail = $ambildetail->fetch_assoc()) {
                                            echo '<li><b>- ' . $detail['nama'] . '</b></li>';
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td>Rp. <?php echo number_format($pecah["totalbeli"]); ?></td>
                                <td>
                                    <b>
                                        <?php
                                        if ($pecah['statusbeli'] != '') {
                                            if ($transaction == 'settlement') {
                                                echo "<label class='text-success'>Lunas</label><br>";
                                                if ($pecah['statusbeli'] == 'Barang Telah Sampai ke Pemesan') {
                                                    echo '<a data-toggle="modal" data-target="#selesai' . $nomor . '" class="tombolkecil text-putih">Konfirmasi Selesai</a>';
                                                } else {
                                                    if ($pecah['statusbeli'] != 'settlement') {
                                                        echo $pecah['statusbeli'];
                                                    }
                                                }
                                            } else if ($transaction == 'pending') {
                                                echo "<label class='text-warning'>Pending, Mohon Selesaikan Pembayaran</label>";
                                            } else if ($transaction == 'deny') {
                                                echo "<label class='text-danger'>Di Tolak</label>";
                                            } else if ($transaction == 'expire') {
                                                echo "<label class='text-danger'>Gagal, Pembayaran anda telah melewati batas pembayaran</label>";
                                            } else if ($transaction == 'cancel') {
                                                echo "<label class='text-danger'>Gagal</label>";
                                            } else {
                                                echo "<label class='text-danger'>Gagal</label>";
                                            }
                                        } else {
                                            echo 'Belum Dibayar';
                                        }
                                        ?>
                                    </b>
                                </td>
                                <td>
                                    <button onclick="bayar('<?php echo $pecah['snapkode']; ?>')" class="btn btn-info">Bayar</button>
                                </td>
                                <td>
                                    <a class="btn btn-primary" target="_blank" href="notacetak.php?id=<?php echo $pecah['idbeli']; ?>">Nota</a>
                                </td>
                            </tr>
                        <?php $nomor++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$no = 1;
$ambil = $koneksi->query("SELECT *, pembelian.idbeli as idbelireal FROM pembelian WHERE pembelian.id='$id' ORDER BY pembelian.tanggalbeli DESC, pembelian.idbeli DESC");
while ($pecah = $ambil->fetch_assoc()) { ?>
    <div class="modal fade" id="selesai<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pesanan Selesai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <h5>Apakah anda yakin ingin mengkonfirmasi pesanan telah selesai ?</h5>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-contol" value="<?= $pecah['idbelireal'] ?>" name="idbeli">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="selesai" value="selesai" class="btn btn-primary">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    $no++;
}

if (isset($_POST["selesai"])) {
    $koneksi->query("UPDATE pembelian SET statusbeli='Selesai' WHERE idbeli='$_POST[idbeli]'");
    echo "<script>alert('Pesanan berhasil di konfirmasi selesai')</script>";
    echo "<script>location='riwayat.php';</script>";
}
?>

<div style="padding-top:600px"></div>
<?php include 'footer.php'; ?>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
<script type="text/javascript">
    function bayar(id) {
        snap.pay(id);
    };
</script>
