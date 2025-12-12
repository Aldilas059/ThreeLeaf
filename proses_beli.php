<?php
include 'config.php';

$nama = $_POST['nama'];
$id_buku = $_POST['id_buku'];
$jumlah = $_POST['jumlah'];

$buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id_buku'");
$data = mysqli_fetch_array($buku);

$total = $data['harga'] * $jumlah;

mysqli_query($koneksi, "INSERT INTO transaksi VALUES(
    '', '$nama', '$id_buku', '$jumlah', '$total', NOW()
)");

header("location:transaksi.php");
?>
