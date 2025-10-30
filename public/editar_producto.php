<?php
session_start();
require 'conexion.php';
if(!isset($_GET['id'])) header("Location: productos.php");
$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD']=='POST'){
  $nombre = $_POST['nombre'];
  $marca = $_POST['marca'];
  $cantidad = $_POST['cantidad'];
  $bodega = $_POST['bodega'];

  $stmt = $pdo->prepare("UPDATE productos SET nombre=?,marca=?,cantidad=?,bodega=? WHERE id=?");
  $stmt->execute([$nombre,$marca,$cantidad,$bodega,$id]);
  header("Location: productos.php");
}

$producto = $pdo->query("SELECT * FROM productos WHERE id=$id")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Producto</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Editar Producto</h2>
  <form method="POST">
    <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required>
    <input type="text" name="marca" value="<?= $producto['marca'] ?>" required>
    <input type="number" name="cantidad" value="<?= $producto['cantidad'] ?>" required>
    <input type="text" name="bodega" value="<?= $producto['bodega'] ?>" required>
    <button type="submit">Guardar Cambios</button>
  </form>
  <a class="btn-cancelar" href="productos.php">Cancelar</a>
</div>
</body>
</html>
