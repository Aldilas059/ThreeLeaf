<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThreeLeaf Catering - <?php echo ucfirst($page); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <main class="main-content">
        <?php
        switch ($page) {
            case 'home':        include 'home.php'; break;
            case 'rekomendasi': include 'rekomendasi.php'; break;
            case 'menu':        include 'menu.php'; break;
            case 'search':      include 'search.php'; break;
            case 'discount':    include 'discount.php'; break;
            case 'testimoni':   include 'testimoni.php'; break;
            case 'tentang':     include 'tentang.php'; break;
            case 'galeri':      include 'galeri.php'; break;
            case 'transaksi':   include 'transaksi.php'; break;
            case 'laporan':     include 'laporan.php'; break;
            default:            include 'home.php';
        }
        ?>
        <?php include 'footer.php'; ?>
    </main>
</body>
</html>
