<?php
// validar_login.php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$cedula = trim($_POST['cedula'] ?? '');
$password = trim($_POST['password'] ?? '');

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE cedula = ?");
$stmt->execute([$cedula]);
$user = $stmt->fetch();

if ($user && $password === $user['password']) {
    // Guardar en sesión
    $_SESSION['cedula'] = $user['cedula'];
    $_SESSION['nombre'] = $user['nombre'];
    header('Location: dashboard.php');
    exit;
} else {
    header('Location: login.php?error=1');
    exit;
}
