<?php 
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<nav class="sidebar">
    <div class="logo">Three<span>Leaf</span> Catering</div>
    <ul class="nav-menu">
        <li><a href="index.php?page=home"        class="<?php echo ($page=='home')?'active':''; ?>">🏠 Home</a></li>
        <li><a href="index.php?page=rekomendasi" class="<?php echo ($page=='rekomendasi')?'active':''; ?>">⭐ Rekomendasi</a></li>
        <li><a href="index.php?page=menu"        class="<?php echo ($page=='menu')?'active':''; ?>">🍽️ Menu</a></li>
        <li><a href="index.php?page=search"      class="<?php echo ($page=='search')?'active':''; ?>">🔍 Search</a></li>
        <li><a href="index.php?page=discount"    class="<?php echo ($page=='discount')?'active':''; ?>">💸 Discount</a></li>
        <li><a href="index.php?page=testimoni"   class="<?php echo ($page=='testimoni')?'active':''; ?>">💬 Testimoni</a></li>
        <li><a href="index.php?page=tentang"     class="<?php echo ($page=='tentang')?'active':''; ?>">ℹ️ Tentang Kami</a></li>
        <li><a href="index.php?page=galeri"      class="<?php echo ($page=='galeri')?'active':''; ?>">🖼️ Galeri</a></li>
        <li><a href="index.php?page=laporan"     class="<?php echo ($page=='laporan')?'active':''; ?>">📊 Laporan</a></li>
    </ul>
</nav>
