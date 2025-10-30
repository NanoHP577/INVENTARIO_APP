<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel Principal</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <h1>📦 Inventario Empresarial</h1>
  <p>Bienvenido, <strong><?= $_SESSION['usuario'] ?></strong> (<?= $_SESSION['rol'] ?>)</p>
  <nav>
    <a href="productos.php">🛒 Productos</a>
    <?php if($_SESSION['rol']=='admin'): ?>
      <a href="usuarios.php">👥 Usuarios</a>
      <a href="historial.php">📜 Historial</a>
    <?php endif; ?>
    <a href="logout.php">🚪 Cerrar sesión</a>
  </nav>
</header>

<div class="container">
  <h2>Bienvenido al sistema de inventario</h2>
  <p>Desde este panel puedes gestionar productos, usuarios y revisar el historial de movimientos.</p>
</div>
</body>
</html>

