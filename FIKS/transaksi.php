<section>
    <h2>Form Pemesanan</h2>
    <?php
    $menu       = isset($_GET['menu']) ? htmlspecialchars(urldecode($_GET['menu'])) : '';
    $harga_asli = isset($_GET['harga']) ? intval($_GET['harga']) : 0;
    $jumlah     = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : 1;

    $diskon_persen = ($jumlah >= 100) ? 20 : 0;
    $harga_diskon  = ($diskon_persen > 0) ? $harga_asli * 0.8 : $harga_asli;
    $total         = $harga_diskon * $jumlah;

    if ($_POST && isset($_POST['kirim'])) {
        $nama          = htmlspecialchars($_POST['nama']);
        $alamat        = htmlspecialchars($_POST['alamat']);
        $menu_pesan    = htmlspecialchars($_POST['menu']);
        $jumlah_pesan  = intval($_POST['jumlah']);
        $harga_final   = intval($_POST['harga_diskon']);
        $total_pesan   = intval($_POST['total']);
        $diskon_terapk = intval($_POST['diskon']);
        ?>
        <div style="background:var(--light-green);padding:3rem;border-radius:20px;text-align:center;max-width:700px;margin:0 auto;">
            <h3 style="color:var(--dark-green);margin-bottom:1.5rem;">✅ Pesanan Berhasil!</h3>
            <div style="background:white;padding:2rem;border-radius:15px;margin:1rem 0;box-shadow:0 5px 15px var(--shadow);text-align:left;">
                <p><strong>Nama:</strong> <?= $nama ?></p>
                <p><strong>Alamat:</strong> <?= nl2br($alamat) ?></p>
                <p><strong>Menu:</strong> <?= $menu_pesan ?></p>
                <p><strong>Jumlah:</strong> <?= $jumlah_pesan ?> pax</p>
                <p><strong>Harga per pax:</strong> Rp <?= number_format($harga_final) ?>
                    <?php if ($diskon_terapk > 0): ?>
                        <span style="color:var(--secondary-green);">(Diskon <?= $diskon_terapk ?>%)</span>
                    <?php endif; ?>
                </p>
                <p style="font-size:1.5rem;color:var(--dark-green);font-weight:bold;border-top:2px solid var(--light-green);padding-top:1rem;">
                    Total: Rp <?= number_format($total_pesan) ?>
                </p>
            </div>
            <a href="index.php?page=home" class="cta-button" style="margin-top:1rem;display:inline-block;">🏠 Kembali ke Home</a>
        </div>
        <?php
        exit;
    }
    ?>

    <form method="POST" style="max-width:700px;margin:0 auto;">
        <div style="background:var(--cream);padding:2.5rem 3rem;border-radius:20px;box-shadow:0 10px 30px var(--shadow);">

            <!-- Menu terpilih -->
            <div style="margin-bottom:2rem;text-align:center;">
                <label style="display:block;font-weight:bold;margin-bottom:0.5rem;">Menu Terpilih</label>
                <div style="display:inline-block;padding:0.8rem 2.5rem;border-radius:20px;background:var(--light-green);color:var(--dark-green);font-weight:bold;font-size:1.1rem;">
                    <?= $menu ?: 'Pilih menu dari halaman Menu'; ?>
                </div>
            </div>

            <!-- Nama & Alamat -->
            <div style="margin-bottom:1.5rem;">
                <label style="display:block;font-weight:bold;margin-bottom:0.5rem;">Nama Lengkap *</label>
                <input type="text" name="nama" required class="field-text">
            </div>

            <div style="margin-bottom:2rem;">
                <label style="display:block;font-weight:bold;margin-bottom:0.5rem;">Alamat Lengkap *</label>
                <textarea name="alamat" required class="field-text" rows="3"></textarea>
            </div>

            <!-- Baris jumlah & harga -->
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;margin-bottom:1.5rem;">
                <div>
                    <label style="display:block;font-weight:bold;margin-bottom:0.3rem;font-size:0.95rem;">Jumlah Pesanan *</label>
                    <input type="number" name="jumlah" id="jumlahPesan" min="1" max="1000"
                           value="<?= $jumlah ?>" required class="field-text" onchange="hitungDiskon()">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;margin-bottom:0.3rem;font-size:0.95rem;">Harga Normal</label>
                    <input type="number" id="hargaNormal" value="<?= $harga_asli ?>" readonly class="field-text">
                </div>
                <div>
                    <label id="labelHargaDiskon" style="display:block;font-weight:bold;margin-bottom:0.3rem;font-size:0.95rem;">
                        <?= $diskon_persen > 0 ? 'Harga Diskon (20%)' : 'Harga Diskon' ?>
                    </label>
                    <input type="number" id="hargaDiskon" name="harga_diskon" value="<?= $harga_diskon ?>" readonly
                           class="field-text" style="background:<?= $diskon_persen > 0 ? 'var(--secondary-green);color:#fff;' : '#fff;' ?>">
                </div>
            </div>

            <!-- Info diskon -->
            <div id="infoDiskon"
                 style="background:var(--light-green);padding:0.8rem 1rem;border-radius:10px;margin-bottom:2rem;text-align:center;<?= $diskon_persen > 0 ? '' : 'display:none;' ?>">
                <strong style="color:var(--dark-green);font-size:1.05rem;">🎉 DISKON 20% AKTIF!</strong><br>
                <span style="color:var(--secondary-green);font-size:0.95rem;">Pemesanan 100+ pax = Rp <?= number_format($harga_asli * 0.8) ?>/pax</span>
            </div>

            <!-- Total -->
            <div style="margin-bottom:2rem;">
                <label style="display:block;font-weight:bold;margin-bottom:0.5rem;">Total Harga</label>
                <input type="number" name="total" id="totalHarga" value="<?= $total ?>" readonly
                       style="width:100%;font-size:1.6rem;padding:1.1rem;border:4px solid var(--secondary-green);border-radius:18px;background:var(--light-green);font-weight:bold;color:var(--dark-green);box-sizing:border-box;">
                <input type="hidden" name="menu"   value="<?= $menu ?>">
                <input type="hidden" name="diskon" value="<?= $diskon_persen ?>">
            </div>

            <button type="submit" name="kirim" class="cta-button" style="width:100%;font-size:1.05rem;padding:1rem;">
                🚀 Konfirmasi & Kirim Pesanan
            </button>
        </div>
    </form>

    <script>
        function hitungDiskon() {
            const jumlah = parseInt(document.getElementById('jumlahPesan').value) || 0;
            const hargaNormal = parseInt(document.getElementById('hargaNormal').value) || 0;

            let hargaDiskon = hargaNormal;
            let diskonPersen = 0;

            if (jumlah >= 100) {
                hargaDiskon = Math.round(hargaNormal * 0.8);
                diskonPersen = 20;
                document.getElementById('infoDiskon').style.display = 'block';
                document.getElementById('labelHargaDiskon').textContent = 'Harga Diskon (20%)';
                document.getElementById('hargaDiskon').style.background = 'var(--secondary-green)';
                document.getElementById('hargaDiskon').style.color = '#fff';
            } else {
                document.getElementById('infoDiskon').style.display = 'none';
                document.getElementById('labelHargaDiskon').textContent = 'Harga Diskon';
                document.getElementById('hargaDiskon').style.background = '#fff';
                document.getElementById('hargaDiskon').style.color = '#333';
            }

            document.getElementById('hargaDiskon').value = hargaDiskon;
            document.getElementById('totalHarga').value = hargaDiskon * jumlah;
        }
    </script>
</section>
