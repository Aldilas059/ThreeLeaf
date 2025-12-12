<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_buku");

if (!$koneksi) {
    die("Koneksi gagal!");
}
?>
