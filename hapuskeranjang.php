<?php
session_start();
$idbarang = $_GET["id"];
unset($_SESSION["keranjang"][$idbarang]);
include 'koneksi.php';

echo "<script> alert('Produk Terhapus');</script>";
echo "<script> location ='keranjang.php';</script>";
