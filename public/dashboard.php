<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit;
}
require_once __DIR__ . '/../src/db.php';

// Obtener todos los articulos
$stmt = $pdo->query("SELECT * FROM articulos ORDER BY creado DESC");
$articulos = $stmt->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Dashboard - Inventario</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
  <h1>Inventario - Panel Admin</h1>
  <div class="right">
    <a href="logout.php" class="btn">Cerrar sesión</a>
  </div>
</header>

<main class="container">
  <section class="card">
    <h2>Agregar artículo</h2>
    <form action="guardar.php" method="post" class="form">
      <input name="nombre" placeholder="Nombre" required>
      <input name="unidades" type="number" min="0" value="0" required>
      <select name="tipo" required>
        <option value="">Selecciona tipo</option>
        <option value="PC">PC</option>
        <option value="Teclado">Teclado</option>
        <option value="Disco Duro">Disco Duro</option>
        <option value="Mouse">Mouse</option>
      </select>
      <select name="bodega" required>
        <option value="">Selecciona bodega</option>
        <option value="Norte">Norte</option>
        <option value="Sur">Sur</option>
        <option value="Oriente">Oriente</option>
        <option value="Occidente">Occidente</option>
      </select>
      <button type="submit">Agregar</button>
    </form>
  </section>

  <section class="card">
    <h2>Lista de artículos</h2>
    <table>
      <thead>
        <tr><th>ID</th><th>Nombre</th><th>Unidades</th><th>Tipo</th><th>Bodega</th><th>Fecha</th><th>Acciones</th></tr>
      </thead>
      <tbody>
      <?php if(empty($articulos)): ?>
        <tr><td colspan="7">No hay artículos</td></tr>
      <?php else: foreach($articulos as $a): ?>
        <tr>
          <td><?= $a['id'] ?></td>
          <td><?= htmlspecialchars($a['nombre']) ?></td>
          <td><?= $a['unidades'] ?></td>
          <td><?= $a['tipo'] ?></td>
          <td><?= $a['bodega'] ?></td>
          <td><?= $a['creado'] ?></td>
          <td>
            <a href="editar.php?id=<?= $a['id'] ?>">Editar</a> |
            <a href="eliminar.php?id=<?= $a['id'] ?>" onclick="return confirm('Eliminar artículo?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </section>
</main>
</body>
</html>
