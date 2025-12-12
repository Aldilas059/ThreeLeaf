<?php
include 'config.php';
$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'");
$buku = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Beli Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h2>TOKO BUKU</h2>
    <a href="index.php">Home</a>
    <a href="buku.php">Data Buku</a>
</div>

<div class="content">
    <h1>Beli Buku</h1>

    <div class="box">
        <img src="images/<?php echo $buku['gambar']; ?>" width="150"><br><br>
        <strong><?php echo $buku['judul']; ?></strong><br>
        Rp <?php echo number_format($buku['harga']); ?>
    </div>

    <form action="proses_beli.php" method="post" class="box">
        <input type="hidden" name="id_buku" value="<?php echo $buku['id']; ?>">

        <label>Nama Pembeli</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Jumlah</label><br>
        <input type="number" name="jumlah" required><br><br>

        <button type="submit">Proses Pembelian</button>
    </form>

</div>

</body>
</html>
