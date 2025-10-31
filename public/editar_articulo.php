<?php
// editar_articulo.php
session_start();
require 'conexion.php';
if(!isset($_SESSION['cedula'])) { header('Location: login.php'); exit; }
if(!isset($_GET['id'])) { header('Location: articulos.php'); exit; }

$id = intval($_GET['id']);
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $unidades = intval($_POST['unidades'] ?? 0);
    $tipo = $_POST['tipo'] ?? 'PC';
    $bodega = $_POST['bodega'] ?? 'Norte';
    $modificado_por = $_SESSION['nombre'];

    $stmt = $pdo->prepare("UPDATE articulos SET nombre=?, unidades=?, tipo=?, bodega=?, modificado_por=?, modificado_en=NOW() WHERE id=?");
    $stmt->execute([$nombre,$unidades,$tipo,$bodega,$modificado_por,$id]);
    header('Location: articulos.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM articulos WHERE id = ?");
$stmt->execute([$id]);
$art = $stmt->fetch();
if(!$art) { header('Location: articulos.php'); exit; }
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Artículo</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="header"><h1>Editar Artículo</h1><div><a href="articulos.php">Volver</a></div></div>
  <div class="container">
    <form method="post">
      <input type="text" name="nombre" value="<?= htmlspecialchars($art['nombre']) ?>" required>
      <input type="number" name="unidades" value="<?= $art['unidades'] ?>" required>
      <select name="tipo" required>
        <option value="PC" <?= $art['tipo']==='PC'?'selected':'' ?>>PC</option>
        <option value="Teclado" <?= $art['tipo']==='Teclado'?'selected':'' ?>>Teclado</option>
        <option value="Disco Duro" <?= $art['tipo']==='Disco Duro'?'selected':'' ?>>Disco Duro</option>
        <option value="Mouse" <?= $art['tipo']==='Mouse'?'selected':'' ?>>Mouse</option>
      </select>
      <select name="bodega" required>
        <option value="Norte" <?= $art['bodega']==='Norte'?'selected':'' ?>>Norte</option>
        <option value="Sur" <?= $art['bodega']==='Sur'?'selected':'' ?>>Sur</option>
        <option value="Oriente" <?= $art['bodega']==='Oriente'?'selected':'' ?>>Oriente</option>
        <option value="Occidente" <?= $art['bodega']==='Occidente'?'selected':'' ?>>Occidente</option>
      </select>
      <button type="submit">Guardar Cambios</button>
    </form>
  </div>
</body>
</html>
