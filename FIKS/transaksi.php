<section>
    <h2>Form Pemesanan</h2>
    <?php
    $menu = isset($_GET['menu']) ? htmlspecialchars(urldecode($_GET['menu'])) : '';
    $harga_asli = isset($_GET['harga']) ? intval($_GET['harga']) : 0;
    $jumlah = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : 1;
    
    // LOGIKA DISKON 20% jika 100+ pax
    $harga_diskon = ($jumlah >= 100) ? $harga_asli * 0.8 : $harga_asli; // 20% off
    $diskon_persen = ($jumlah >= 100) ? 20 : 0;
    $total = $harga_diskon * $jumlah;
    
    if ($_POST && isset($_POST['kirim'])) {
        $nama = htmlspecialchars($_POST['nama']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $menu_pesan = htmlspecialchars($_POST['menu']);
        $jumlah_pesan = intval($_POST['jumlah']);
        $harga_final = intval($_POST['harga_diskon']);
        $total_pesan = intval($_POST['total']);
        $diskon_terapkan = intval($_POST['diskon']);
        
        echo "
        <div style='background:var(--light-green);padding:3rem;border-radius:20px;text-align:center;max-width:600px;margin:0 auto;'>
            <h3 style='color:var(--dark-green);margin-bottom:1.5rem;'>✅ Pesanan Berhasil!</h3>
            <div style='background:white;padding:2rem;border-radius:15px;margin:1rem 0;box-shadow:0 5px 15px var(--shadow);'>
                <p><strong>Nama:</strong> $nama</p>
                <p><strong>Alamat:</strong> $alamat</p>
                <p><strong>Menu:</strong> $menu_pesan</p>
                <p><strong>Jumlah:</strong> $jumlah_pesan pax</p>
                <p><strong>Harga per pax:</strong> Rp " . number_format($harga_final) . " <span style='color:var(--secondary-green);font-size:1.2rem;'>(Diskon {$diskon_terapkan}%)</span></p>
                <p style='font-size:1.5rem;color:var(--dark-green);font-weight:bold;border-top:2px solid var(--light-green);padding-top:1rem;'>Total: Rp " . number_format($total_pesan) . "</p>
            </div>
            <a href='index.php?page=home' class='cta-button' style='margin-top:1rem;display:inline-block;'>🏠 Kembali ke Home</a>
        </div>";
        exit;
    }
    ?>
    
    <form method="POST" style="max-width:600px;margin:0 auto;">
        <div style="background:var(--cream);padding:2.5rem;border-radius:20px;box-shadow:0 10px 30px var(--shadow);">
            <div style="display:grid;grid-template-columns:1fr 2fr;gap:1rem;margin-bottom:2rem;">
                <label style="font-weight:bold;align-self:center;">Menu Terpilih:</label>
                <div style="font-size:1.3rem;color:var(--dark-green);padding:1rem;background:var(--light-green);border-radius:15px;font-weight:bold;">
                    <?php echo $menu ?: 'Pilih menu dari halaman Menu'; ?>
                </div>
            </div>
            
            <div style="margin-bottom:1.5rem;">
                <label style="display:block;font-weight:bold;margin-bottom:0.5rem;font-size:1.1rem;">Nama Lengkap *</label>
                <input type="text" name="nama" required class="search-input">
            </div>
            
            <div style="margin-bottom:1.5rem;">
                <label style="display:block;font-weight:bold;margin-bottom:0.5rem;font-size:1.1rem;">Alamat Lengkap *</label>
                <input type="text" name="alamat" required class="search-input">
            </div>
            
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;margin-bottom:1.5rem;">
                <div>
                    <label style="display:block;font-weight:bold;margin-bottom:0.5rem;font-size:0.95rem;">Jumlah Pesanan *</label>
                    <input type="number" name="jumlah" id="jumlahPesan" min="1" max="1000" value="<?php echo $jumlah; ?>" required 
                        onchange="hitungDiskon()" class="search-input">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;margin-bottom:0.5rem;font-size:0.95rem;">Harga Normal</label>
                    <input type="number" id="hargaNormal" value="<?php echo $harga_asli; ?>" readonly 
                        class="search-input" style="background:var(--cream);">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;margin-bottom:0.5rem;font-size:0.95rem;" id="labelHargaDiskon">Harga Diskon</label>
                    <input type="number" id="hargaDiskon" name="harga_diskon" value="<?php echo $harga_diskon; ?>" readonly 
                        class="search-input" style="background:<?php echo $diskon_persen > 0 ? 'var(--secondary-green)' : 'var(--cream)'; ?>;color:white;">
                </div>
            </div>
            
            <div id="infoDiskon" style="background:<?php echo $diskon_persen > 0 ? 'var(--light-green)' : 'var(--cream)'; ?>;padding:1rem;border-radius:10px;margin-bottom:2rem;text-align:center;display:<?php echo $diskon_persen > 0 ? 'block' : 'none'; ?>;">
                <strong style="color:var(--dark-green);font-size:1.2rem;">🎉 DISKON 20% AKTIF!</strong><br>
                <span style="color:var(--secondary-green);">Pemesanan 100+ pax = Rp <?php echo number_format($harga_asli * 0.8); ?>/pax</span>
            </div>
            
            <div style="margin-bottom:2rem;">
                <label style="display:block;font-weight:bold;margin-bottom:0.5rem;font-size:1.2rem;">Total Harga</label>
                <input type="number" name="total" id="totalHarga" value="<?php echo $total; ?>" readonly 
                    style="width:100%;font-size:2rem;padding:1.5rem;border:4px solid var(--secondary-green);border-radius:20px;background:var(--light-green);font-weight:bold;color:var(--dark-green);">
                <input type="hidden" name="menu" value="<?php echo $menu; ?>">
                <input type="hidden" name="diskon" value="<?php echo $diskon_persen; ?>">
            </div>
            
            <button type="submit" name="kirim" class="cta-button" style="width:100%;font-size:1.3rem;padding:1.5rem;">🚀 Konfirmasi & Kirim Pesanan</button>
        </div>
    </form>
    
    <script>
    function hitungDiskon() {
        const jumlah = parseInt(document.getElementById('jumlahPesan').value) || 0;
        const hargaNormal = parseInt(document.getElementById('hargaNormal').value) || 0;
        
        let hargaDiskon = hargaNormal;
        let diskonPersen = 0;
        
        // Diskon 20% jika 100+ pax
        if (jumlah >= 100) {
            hargaDiskon = Math.round(hargaNormal * 0.8);
            diskonPersen = 20;
            document.getElementById('infoDiskon').style.display = 'block';
            document.getElementById('labelHargaDiskon').textContent = 'Harga Diskon (20%)';
            document.getElementById('hargaDiskon').style.background = 'var(--secondary-green)';
            document.getElementById('hargaDiskon').style.color = 'white';
        } else {
            document.getElementById('infoDiskon').style.display = 'none';
            document.getElementById('labelHargaDiskon').textContent = 'Harga Normal';
            document.getElementById('hargaDiskon').style.background = 'var(--cream)';
            document.getElementById('hargaDiskon').style.color = '#333';
        }
        
        document.getElementById('hargaDiskon').value = hargaDiskon;
        document.getElementById('totalHarga').value = hargaDiskon * jumlah;
    }
    </script>
</section>
