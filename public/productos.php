<?php
session_start();
require 'conexion.php';
if(!isset($_SESSION['usuario'])) header("Location: login.php");

$productos = $pdo->query("SELECT * FROM productos")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Productos</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <h1>🛒 Gestión de Productos</h1>
  <a href="dashboard.php">⬅ Volver</a>
</header>

<div class="container">
  <h2>Agregar Producto</h2>
  <form action="guardar_producto.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="nombre" placeholder="Nombre del producto" required>
    <input type="text" name="marca" placeholder="Marca" required>
    <input type="number" name="cantidad" placeholder="Cantidad" required>
    <input type="text" name="bodega" placeholder="Bodega" required>
    <input type="file" name="imagen">
    <button type="submit">Guardar</button>
  </form>

  <h2>Inventario Actual</h2>
  <table>
    <tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Cantidad</th><th>Bodega</th><th>Imagen</th><th>Acciones</th></tr>
    <?php foreach($productos as $p): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nombre'] ?></td>
        <td><?= $p['marca'] ?></td>
        <td><?= $p['cantidad'] ?></td>
        <td><?= $p['bodega'] ?></td>
        <td><?php if($p['imagen']): ?><img src="uploads/<?= $p['imagen'] ?>" height="50"><?php endif; ?></td>
        <td>
          <a href="editar_producto.php?id=<?= $p['id'] ?>">✏️</a>
          <a href="eliminar_producto.php?id=<?= $p['id'] ?>" onclick="return confirm('¿Eliminar producto?')">🗑️</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>
