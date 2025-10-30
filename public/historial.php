<?php
session_start();
require 'conexion.php';
if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') header("Location: dashboard.php");

$historial = $pdo->query("SELECT * FROM historial ORDER BY fecha DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Historial de Movimientos</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <h1>📜 Historial</h1>
  <a href="dashboard.php">⬅ Volver</a>
</header>
<div class="container">
  <table>
    <tr><th>ID</th><th>Producto</th><th>Usuario</th><th>Acción</th><th>Cantidad</th><th>Bodega</th><th>Marca</th><th>Fecha</th></tr>
    <?php foreach($historial as $h): ?>
    <tr>
      <td><?= $h['id'] ?></td>
      <td><?= $h['producto'] ?></td>
      <td><?= $h['usuario'] ?></td>
      <td><?= $h['accion'] ?></td>
      <td><?= $h['cantidad'] ?></td>
      <td><?= $h['bodega'] ?></td>
      <td><?= $h['marca'] ?></td>
      <td><?= $h['fecha'] ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>
