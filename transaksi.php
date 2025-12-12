<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h2>TOKO BUKU</h2>
    <a href="index.php">Home</a>
    <a href="buku.php">Data Buku</a>
    <a href="transaksi.php">Transaksi</a>
</div>

<div class="content">
    <h1>Data Transaksi</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Buku</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>

        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "
            SELECT transaksi.*, buku.judul 
            FROM transaksi 
            JOIN buku ON transaksi.id_buku = buku.id
        ");
        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['judul']; ?></td>
            <td><?= $data['jumlah']; ?></td>
            <td>Rp <?= number_format($data['total']); ?></td>
            <td><?= $data['tanggal']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
