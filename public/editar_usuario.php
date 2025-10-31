<?php
// editar_usuario.php
session_start();
require 'conexion.php';
if(!isset($_SESSION['cedula']) || $_SESSION['cedula'] !== '1111') { header('Location: login.php'); exit; }

if(!isset($_GET['id'])) { header('Location: usuarios.php'); exit; }
$id = intval($_GET['id']);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if($nombre !== '') {
        if($password !== '') {
            $pdo->prepare("UPDATE usuarios SET nombre=?, password=? WHERE id=?")->execute([$nombre,$password,$id]);
        } else {
            $pdo->prepare("UPDATE usuarios SET nombre=? WHERE id=?")->execute([$nombre,$id]);
        }
    }
    header('Location: usuarios.php');
    exit;
}

$user = $pdo->prepare("SELECT id,cedula,nombre FROM usuarios WHERE id = ?");
$user->execute([$id]);
$u = $user->fetch();
if(!$u) { header('Location: usuarios.php'); exit; }
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Usuario</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="header"><h1>Editar Usuario</h1><div><a href="usuarios.php">Volver</a></div></div>
  <div class="container">
    <form method="post">
      <label>Cédula</label>
      <input type="text" value="<?= htmlspecialchars($u['cedula']) ?>" disabled>
      <label>Nombre</label>
      <input type="text" name="nombre" value="<?= htmlspecialchars($u['nombre']) ?>" required>
      <label>Nueva contraseña (dejar vacío para no cambiar)</label>
      <input type="text" name="password" placeholder="Contraseña (texto plano)">
      <button type="submit">Guardar</button>
    </form>
  </div>
</body>
</html>
