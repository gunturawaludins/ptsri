<?php
include 'koneksi.php';
$id = $_GET['id'];
$status = $_GET['status'];
$koneksi->query("UPDATE pembelian SET statusbeli='$status' WHERE notransaksi='$id'") or die(mysqli_error($koneksi));
header("location: http://localhost/ptsri/riwayat.php");
