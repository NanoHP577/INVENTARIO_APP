<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit;
}
require_once __DIR__ . '/../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nombre = trim($_POST['nombre'] ?? '');
    $unidades = intval($_POST['unidades'] ?? 0);
    $tipo = $_POST['tipo'] ?? '';
    $bodega = $_POST['bodega'] ?? '';

    if ($id <= 0 || $nombre === '' || $tipo === '' || $bodega === '') {
        header('Location: dashboard.php');
        exit;
    }

    $stmt = $pdo->prepare("UPDATE articulos SET nombre=?, unidades=?, tipo=?, bodega=? WHERE id=?");
    $stmt->execute([$nombre, $unidades, $tipo, $bodega, $id]);
}

header('Location: dashboard.php');
exit;
