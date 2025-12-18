<?php
$pdo = new PDO("mysql:host=localhost;dbname=threeleaf_db", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM pemesanan WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) die("Data tidak ditemukan");

if ($_POST) {
    $stmt = $pdo->prepare("
        UPDATE pemesanan SET 
        nama=?, alamat=?, jumlah=?, harga_diskon=?, total=?, diskon=?
        WHERE id=?
    ");
    $stmt->execute([
        $_POST['nama'],
        $_POST['alamat'],
        $_POST['jumlah'],
        $_POST['harga_diskon'],
        $_POST['total'],
        $_POST['diskon'],
        $id
    ]);

    header("Location: index.php?page=laporan");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pesanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main-content">
<section>
    <h2>Edit Pesanan</h2>

    <form method="post" class="transaksi-form" oninput="hitungTotal()">
        <div class="transaksi-card">

            <label>Nama</label>
            <input class="field-text" name="nama" value="<?= $data['nama'] ?>" required>

            <label style="margin-top:1rem;">Alamat</label>
            <textarea class="field-text" name="alamat"><?= $data['alamat'] ?></textarea>

            <div class="harga-grid">
                <div>
                    <label>Jumlah (pax)</label>
                    <input class="field-text" id="jumlah" name="jumlah" value="<?= $data['jumlah'] ?>">
                </div>
                <div>
                    <label>Harga / pax</label>
                    <input class="field-text" id="harga" name="harga_diskon" value="<?= $data['harga_diskon'] ?>" readonly>
                </div>
                <div>
                    <label>Diskon</label>
                    <input class="field-text" id="diskon" name="diskon" value="<?= $data['diskon'] ?>" readonly>
                </div>
            </div>

            <label>Total Harga</label>
            <input class="total-harga" id="total" name="total" value="<?= $data['total'] ?>" readonly>

            <button class="cta-button">💾 Simpan Perubahan</button>
            <a href="index.php?page=laporan" class="back-btn">⬅ Kembali</a>

        </div>
    </form>
</section>
</div>

<script>
function hitungTotal() {
    let jumlah = document.getElementById('jumlah').value;
    let harga = 25000;
    let diskon = 0;

    if (jumlah >= 100) {
        harga = 20000;
        diskon = 20;
    }

    document.getElementById('harga').value = harga;
    document.getElementById('diskon').value = diskon;
    document.getElementById('total').value = jumlah * harga;
}
</script>

</body>
</html>
