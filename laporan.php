<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'threeleaf_db';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->query("SELECT * FROM pemesanan ORDER BY tanggal DESC");
$pemesanan = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <h2>Daftar Pemesanan</h2>

    <div class="daftar-container">
        <?php if (empty($pemesanan)): ?>
            <div class="no-data">📭 Belum ada pemesanan</div>
        <?php else: ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Harga/pax</th>
                        <th>Diskon</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th style="width:80px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pemesanan as $i => $p): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td class="nama-cell"><?= htmlspecialchars($p['nama']) ?></td>
                        <td><?= htmlspecialchars($p['menu']) ?></td>
                        <td><?= $p['jumlah'] ?> pax</td>
                        <td>Rp <?= number_format($p['harga_diskon']) ?></td>
                        <td><?= $p['diskon'] ?>%</td>
                        <td class="total-cell">Rp <?= number_format($p['total']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($p['tanggal'])) ?></td>
                        <td style="text-align:center;">
                            <a href="edit_pesanan.php?id=<?= $p['id'] ?>" title="Edit">✏️</a>
                            &nbsp;
                            <a href="hapus_pesanan.php?id=<?= $p['id'] ?>"
                               onclick="return confirm('Yakin hapus pesanan ini?')"
                               title="Hapus">🗑️</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</section>
