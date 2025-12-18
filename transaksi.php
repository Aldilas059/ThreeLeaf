<?php
// ===== KONFIGURASI KONEKSI DATABASE =====
$host     = 'localhost';
$username = 'root';
$password = '';
$dbname   = 'threeleaf_db';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// ===== AMBIL DATA DARI GET & POST AWAL =====
$menu       = isset($_GET['menu']) ? htmlspecialchars(urldecode($_GET['menu'])) : '';
$harga_asli = isset($_GET['harga']) ? intval($_GET['harga']) : 0;
$jumlah     = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : 1;

// Logika diskon awal (saat pertama kali load / reload)
$diskon_persen = ($jumlah >= 100) ? 20 : 0;
$harga_diskon  = ($diskon_persen > 0) ? $harga_asli * 0.8 : $harga_asli;
$total         = $harga_diskon * $jumlah;

// ===== PROSES SAAT FORM DIKIRIM =====
if ($_POST && isset($_POST['kirim'])) {
    $nama          = htmlspecialchars($_POST['nama']);
    $alamat        = htmlspecialchars($_POST['alamat']);
    $menu_pesan    = htmlspecialchars($_POST['menu']);
    $jumlah_pesan  = intval($_POST['jumlah']);
    $harga_final   = intval($_POST['harga_diskon']);
    $total_pesan   = intval($_POST['total']);
    $diskon_terapk = intval($_POST['diskon']);

    // Simpan ke database
    $stmt = $pdo->prepare("
        INSERT INTO pemesanan (nama, alamat, menu, jumlah, harga_diskon, total, diskon)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $nama,
        $alamat,
        $menu_pesan,
        $jumlah_pesan,
        $harga_final,
        $total_pesan,
        $diskon_terapk
    ]);
    ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Berhasil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main-content">
<section>
    <div class="transaksi-card" style="max-width:700px;margin:auto;text-align:center;">
        <h3 style="color:var(--dark-green);margin-bottom:1.5rem;">✅ Pesanan Berhasil!</h3>

        <div style="background:#fff;padding:2rem;border-radius:15px;text-align:left;">
            <p><strong>Nama:</strong> <?= $nama ?></p>
            <p><strong>Alamat:</strong> <?= nl2br($alamat) ?></p>
            <p><strong>Menu:</strong> <?= $menu_pesan ?></p>
            <p><strong>Jumlah:</strong> <?= $jumlah_pesan ?> pax</p>
            <p>
                <strong>Harga / pax:</strong> Rp <?= number_format($harga_final) ?>
                <?php if ($diskon_terapk > 0): ?>
                    <span style="color:var(--secondary-green);">(Diskon <?= $diskon_terapk ?>%)</span>
                <?php endif; ?>
            </p>
            <hr>
            <p style="font-size:1.4rem;font-weight:bold;color:var(--dark-green);">
                Total: Rp <?= number_format($total_pesan) ?>
            </p>
        </div>

        <a href="index.php?page=home" class="cta-button" style="margin-top:1.5rem;">🏠 Kembali ke Home</a>
        <br><br>
        <a href="index.php?page=laporan" class="cta-button" style="background:var(--secondary-green);color:#fff;">
            📋 Lihat Daftar Pemesanan
        </a>
    </div>
</section>
</div>
</body>
</html>

<?php exit; } ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main-content">
<section class="transaksi-section">
    <h2>Form Pemesanan</h2>

    <form method="POST" class="transaksi-form">
        <div class="transaksi-card">

            <!-- Menu -->
            <div style="text-align:center;margin-bottom:2rem;">
                <label><strong>Menu Terpilih</strong></label><br>
                <div style="margin-top:.5rem;padding:.7rem 2rem;border-radius:20px;background:var(--light-green);font-weight:bold;">
                    <?= $menu ?: 'Silakan pilih menu terlebih dahulu'; ?>
                </div>
            </div>

            <!-- Nama -->
            <label>Nama Lengkap *</label>
            <input type="text" name="nama" class="field-text" required>

            <!-- Alamat -->
            <label style="margin-top:1rem;">Alamat Lengkap *</label>
            <textarea name="alamat" rows="3" class="field-text" required></textarea>

            <!-- Grid Harga -->
            <div class="harga-grid">
                <div>
                    <label>Jumlah Pesanan *</label>
                    <input type="number" id="jumlahPesan" name="jumlah" min="1" value="<?= $jumlah ?>" class="field-text" onchange="hitungDiskon()">
                </div>

                <div>
                    <label>Harga Normal</label>
                    <input type="number" id="hargaNormal" value="<?= $harga_asli ?>" class="field-text" readonly>
                </div>

                <div>
                    <label id="labelHargaDiskon">
                        <?= $diskon_persen ? 'Harga Diskon (20%)' : 'Harga Diskon' ?>
                    </label>
                    <input type="number" id="hargaDiskon" name="harga_diskon" value="<?= $harga_diskon ?>" class="field-text" readonly>
                </div>
            </div>

            <!-- Info Diskon -->
            <div id="infoDiskon" style="<?= $diskon_persen ? '' : 'display:none;' ?>" class="card">
                🎉 <strong>Diskon 20%</strong> untuk pemesanan ≥ 100 pax
            </div>

            <!-- Total -->
            <label>Total Harga</label>
            <input type="number" id="totalHarga" name="total" class="total-harga" value="<?= $total ?>" readonly>

            <input type="hidden" name="menu" value="<?= $menu ?>">
            <input type="hidden" name="diskon" value="<?= $diskon_persen ?>">

            <button type="submit" name="kirim" class="cta-button">
                🚀 Konfirmasi & Kirim Pesanan
            </button>
        </div>
    </form>
</section>
</div>

<script>
function hitungDiskon() {
    const jumlah = parseInt(jumlahPesan.value) || 0;
    const harga  = parseInt(hargaNormal.value) || 0;

    let diskon = 0;
    let hargaAkhir = harga;

    if (jumlah >= 100) {
        diskon = 20;
        hargaAkhir = Math.round(harga * 0.8);
        infoDiskon.style.display = 'block';
        labelHargaDiskon.textContent = 'Harga Diskon (20%)';
    } else {
        infoDiskon.style.display = 'none';
        labelHargaDiskon.textContent = 'Harga Diskon';
    }

    hargaDiskon.value = hargaAkhir;
    totalHarga.value = hargaAkhir * jumlah;
    document.querySelector('input[name="diskon"]').value = diskon;
}
</script>

</body>
</html>
