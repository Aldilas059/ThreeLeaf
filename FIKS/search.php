<section>
    <h2>Cari Menu Favorit</h2>
    <div class="search-container">
        <form method="get" action="index.php">
            <input type="hidden" name="page" value="search">
            <input type="text" name="q" class="search-input" placeholder="Cari nasi box, prasmanan, wedding..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
            <button type="submit" class="search-btn">🔍 Cari</button>
        </form>
    </div>
    <?php if (!empty($_GET['q'])): ?>
        <p style="text-align:center;margin-top:1rem;color:#666;">Hasil pencarian untuk: <strong><?php echo htmlspecialchars($_GET['q']); ?></strong><br>(Nanti bisa dihubungkan ke database MySQL)</p>
    <?php endif; ?>
</section>
