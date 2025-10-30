<?php
session_start();
require 'conexion.php';

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->execute([$usuario]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['rol'] = $user['rol'];
    header("Location: dashboard.php");
} else {
    header("Location: login.php?error=1");
}
?>
