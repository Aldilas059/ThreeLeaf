<?php
$pdo = new PDO("mysql:host=localhost;dbname=threeleaf_db", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("DELETE FROM pemesanan WHERE id=?");
$stmt->execute([$id]);

header("Location: index.php?page=laporan");
exit;
