<?php
// articulos.php
session_start();
require 'conexion.php';
if(!isset($_SESSION['cedula'])) { header('Location: login.php'); exit; }

$cedula_actual = $_SESSION['cedula'];
$nombre_actual = $_SESSION['nombre'];

// Agregar artículo - POST
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $nombre = trim($_POST['nombre'] ?? '');
    $unidades = intval($_POST['unidades'] ?? 0);
    $tipo = $_POST['tipo'] ?? 'PC';
    $bodega = $_POST['bodega'] ?? 'Norte';
    if($nombre !== '') {
        $stmt = $pdo->prepare("INSERT INTO articulos (nombre,unidades,tipo,bodega,creado_por) VALUES (?,?,?,?,?)");
        $stmt->execute([$nombre,$unidades,$tipo,$bodega,$nombre_actual]);
        header('Location: articulos.php');
        exit;
    }
}

// Eliminar
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $pdo->prepare("DELETE FROM articulos WHERE id = ?")->execute([$id]);
    header('Location: articulos.php');
    exit;
}

$articulos = $pdo->query("SELECT * FROM articulos ORDER BY creado_en DESC")->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Artículos - Inventario</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="header"><h1>Gestión de Artículos</h1><div><a href="dashboard.php">Volver</a> | <a href="logout.php">Salir</a></div></div>
  <div class="container">
    <h2>Agregar Artículo</h2>
    <form method="post">
      <input type="text" name="nombre" placeholder="Nombre del artículo" required>
      <input type="number" name="unidades" placeholder="Unidades" value="1" required>
      <select name="tipo" required>
        <option value="PC">PC</option>
        <option value="Teclado">Teclado</option>
        <option value="Disco Duro">Disco Duro</option>
        <option value="Mouse">Mouse</option>
      </select>
      <select name="bodega" required>
        <option value="Norte">Norte</option>
        <option value="Sur">Sur</option>
        <option value="Oriente">Oriente</option>
        <option value="Occidente">Occidente</option>
      </select>
      <button type="submit" name="agregar">Agregar Artículo</button>
    </form>

    <h2>Listado de Artículos</h2>
    <table class="table">
      <tr><th>ID</th><th>Nombre</th><th>Unidades</th><th>Tipo</th><th>Bodega</th><th>Creado por</th><th>Creado en</th><th>Acciones</th></tr>
      <?php foreach($articulos as $a): ?>
        <tr>
          <td><?= $a['id'] ?></td>
          <td><?= htmlspecialchars($a['nombre']) ?></td>
          <td><?= $a['unidades'] ?></td>
          <td><?= $a['tipo'] ?></td>
          <td><?= $a['bodega'] ?></td>
          <td><?= htmlspecialchars($a['creado_por'] ?? '') ?></td>
          <td><?= $a['creado_en'] ?></td>
          <td>
            <a class="link" href="editar_articulo.php?id=<?= $a['id'] ?>">Editar</a> |
            <a class="link" href="articulos.php?delete=<?= $a['id'] ?>" onclick="return confirm('Eliminar artículo?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
