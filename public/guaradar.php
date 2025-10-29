<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit;
}
require_once __DIR__ . '/../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $unidades = intval($_POST['unidades'] ?? 0);
    $tipo = $_POST['tipo'] ?? '';
    $bodega = $_POST['bodega'] ?? '';

    if ($nombre === '' || $unidades < 0 || $tipo === '' || $bodega === '') {
        header('Location: dashboard.php');
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO articulos (nombre, unidades, tipo, bodega) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $unidades, $tipo, $bodega]);
}

header('Location: dashboard.php');
exit;
