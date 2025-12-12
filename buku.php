<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
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
    <h1>Data Buku</h1>

    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM buku");
    while ($data = mysqli_fetch_array($query)) {
    ?>
        <div class="card">
            <img src="images/<?php echo $data['gambar']; ?>">
            <h3><?php echo $data['judul']; ?></h3>
            <p>Penulis: <?php echo $data['penulis']; ?></p>
            <p>Harga: Rp <?php echo number_format($data['harga']); ?></p>

            <a class="btn" href="beli.php?id=<?php echo $data['id']; ?>">Beli</a>
        </div>
    <?php } ?>
</div>

</body>
</html>
