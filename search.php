<?php
// ====== DATA MENU UNTUK PENCARIAN ======
$menus = [
    [
        'nama'  => 'Nasi Box Premium',
        'desc'  => 'Ayam goreng, sambal, lalapan, es teh',
        'harga' => 25000,
        'img'   => 'https://i.pinimg.com/736x/91/0b/6d/910b6db47aaebe8d850482302e8f684b.jpg',
    ],
    [
        'nama'  => 'Paket Prasmanan',
        'desc'  => '10 jenis lauk pauk lengkap',
        'harga' => 40000,
        'img'   => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRki9j7GYsw2HEj_qdvvMTlKzjTi5U_r5eb40zdNVA8vmH16ULnnNYmu-rxPkwL5b9KwCs&usqp=CAU',
    ],
    [
        'nama'  => 'Kari Ayam Special',
        'desc'  => 'Kari kental dengan rempah premium',
        'harga' => 35000,
        'img'   => 'https://cnc-magazine.oramiland.com/parenting/images/bumbu_ayam_kari_pedas.width-800.format-webp.webp',
    ],
    [
        'nama'  => 'Ayam Bakar Madu',
        'desc'  => 'Balutan madu asli + sambal matah',
        'harga' => 38000,
        'img'   => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRz42jEhp0Kzq6nXXvhgoEoL0VE9tkWxDHtix7gkkeEYvlPMapKa3KRbrAVL-sNAV00Js&usqp=CAU',
    ],
];

// Ambil keyword pencarian
$query   = isset($_GET['q']) ? trim($_GET['q']) : '';
$results = [];

if ($query !== '') {
    foreach ($menus as $m) {
        // Cek kecocokan di nama atau deskripsi (tidak case sensitive)
        if (stripos($m['nama'], $query) !== false || stripos($m['desc'], $query) !== false) {
            $results[] = $m;
        }
    }
}
?>

<section>
    <h2>Cari Menu Favorit</h2>

    <div class="search-container">
        <form method="get" action="index.php">
            <input type="hidden" name="page" value="search">

            <div class="search-wrapper">
                <input 
                    type="text" 
                    name="q" 
                    class="search-input" 
                    placeholder="Cari nasi box, prasmanan, wedding..."
                    value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>"
                >
                <button type="submit" class="search-btn">🔍 Cari</button>
            </div>
        </form>
    </div>

    <?php if ($query !== ''): ?>
        <p style="text-align:center;margin-top:1rem;color:#666;">
            Hasil pencarian untuk: 
            <strong><?php echo htmlspecialchars($query); ?></strong>
        </p>

        <?php if (empty($results)): ?>
            <p style="text-align:center;margin-top:1rem;color:#999;">
                Menu tidak ditemukan. Coba kata kunci lain.
            </p>
        <?php else: ?>
            <div class="grid" style="margin-top:2rem;">
                <?php foreach ($results as $m): ?>
                    <div class="card">
                        <img 
                            src="<?php echo $m['img']; ?>"
                            alt="<?php echo htmlspecialchars($m['nama']); ?>"
                            style="width:100%;height:200px;object-fit:cover;border-radius:10px;margin-bottom:1rem;"
                        >
                        <h3><?php echo htmlspecialchars($m['nama']); ?></h3>
                        <p><?php echo htmlspecialchars($m['desc']); ?></p>
                        <div style="font-size:1.5rem;color:var(--secondary-green);font-weight:bold;margin:1rem 0;">
                            Rp <?php echo number_format($m['harga']); ?>
                        </div>
                        <a href="index.php?page=transaksi&menu=<?php echo urlencode($m['nama']); ?>&harga=<?php echo $m['harga']; ?>" 
                        class="cta-button" 
                        style="width:100%;text-align:center;">
                            🛒 Beli Sekarang
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</section>
