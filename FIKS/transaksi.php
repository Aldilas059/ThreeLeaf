<section>
    <h2>Form Pemesanan</h2>
    <?php
    $menu = isset($_GET['menu']) ? htmlspecialchars(urldecode($_GET['menu'])) : '';
    $harga = isset($_GET['harga']) ? intval($_GET['harga']) : 0;
    $jumlah = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : 1;
    $total = $harga * $jumlah;
    
    if ($_POST && isset($_POST['kirim'])) {
        $nama = htmlspecialchars($_POST['nama']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $menu_pesan = htmlspecialchars($_POST['menu']);
        $jumlah_pesan = intval($_POST['jumlah']);
        $total_pesan = intval($_POST['total']);
        
        // Simulasi simpan ke database
        echo "
        <div style='background:var(--light-green);padding:2rem;border-radius:15px;text-align:center;'>
            <h3 style='color:var(--dark-green);margin-bottom:1rem;'>✅ Pesanan Berhasil!</h3>
            <p><strong>Nama:</strong> $nama</p>
            <p><strong>Alamat:</strong> $alamat</p>
            <p><strong>Menu:</strong> $menu_pesan</p>
            <p><strong>Jumlah:</strong> $jumlah_pesan pax</p>
            <p><strong>Total:</strong> Rp " . number_format($total_pesan) . "</p>
            <a href='index.php?page=home' class='cta-button' style='margin-top:1rem;'>🏠 Kembali ke Home</a>
        </div>";
        exit;
    }
    ?>
    
    <form method="POST" style="max-width:600px;margin:0 auto;">
        <div style="background:var(--cream);padding:2rem;border-radius:15px;margin-bottom:2rem;">
            <div style="display:grid;grid-template-columns:1fr 2fr;gap:1rem;margin-bottom:1rem;">
                <label style="font-weight:bold;">Menu Terpilih:</label>
                <div style="font-size:1.2rem;color:var(--dark-green);padding:0.5rem;background:var(--light-green);border-radius:10px;">
                    <?php echo $menu ?: 'Pilih menu dari halaman Menu'; ?>
                </div>
            </div>
            
            <div style="margin-bottom:1.5rem;">
                <label style="display:block;font-weight:bold;margin-bottom:0.5rem;">Nama Lengkap *</label>
                <input type="text" name="nama" required class="search-input" style="width:100%;border-radius:10px;">
            </div>
            
            <div style="margin-bottom:1.5rem;">
                <label style="display:block;font-weight:bold;margin-bottom:0.5rem;">Alamat Lengkap *</label>
                <textarea name="alamat" required rows="3" class="search-input" style="width:100%;border-radius:10px;"></textarea>
            </div>
            
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.5rem;">
                <div>
                    <label style="display:block;font-weight:bold;margin-bottom:0.5rem;">Jumlah Pesanan (pax) *</label>
                    <input type="number" name="jumlah" min="1" max="1000" value="<?php echo $jumlah; ?>" required 
                           onchange="hitungTotal()" class="search-input" style="width:100%;border-radius:10px;">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;margin-bottom:0.5rem;">Harga per pax</label>
                    <input type="number" name="harga" value="<?php echo $harga; ?>" readonly 
                           class="search-input" style="width:100%;border-radius:10px;background:var(--light-green);">
                </div>
            </div>
            
            <div style="margin-bottom:2rem;">
                <label style="display:block;font-weight:bold;margin-bottom:0.5rem;">Total Harga</label>
                <input type="number" name="total" id="totalHarga" value="<?php echo $total; ?>" readonly 
                       style="width:100%;font-size:1.5rem;padding:1.5rem;border:3px solid var(--secondary-green);border-radius:15px;background:var(--light-green);font-weight:bold;">
            </div>
            
            <button type="submit" name="kirim" class="cta-button" style="width:100%;font-size:1.2rem;padding:1.2rem;">🚀 Kirim Pesanan</button>
        </div>
    </form>
    
    <script>
    function hitungTotal() {
        const jumlah = document.querySelector('input[name="jumlah"]').value;
        const harga = document.querySelector('input[name="harga"]').value;
        const total = jumlah * harga;
        document.getElementById('totalHarga').value = total;
    }
    </script>
</section>
