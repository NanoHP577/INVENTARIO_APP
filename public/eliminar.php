<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit;
}
require_once __DIR__ . '/../src/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM articulos WHERE id = ?");
        $stmt->execute([$id]);
    }
}
header('Location: dashboard.php');
exit;
