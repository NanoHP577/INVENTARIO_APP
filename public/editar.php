<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit;
}
require_once __DIR__ . '/../src/db.php';

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}
$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM articulos WHERE id = ?");
$stmt->execute([$id]);
$art = $stmt->fetch();
if (!$art) {
    header('Location: dashboard.php');
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar artículo</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header><h1>Editar artículo</h1></header>
<main class="container">
  <section class="card">
    <form action="actualizar.php" method="post" class="form">
      <input type="hidden" name="id" value="<?= $art['id'] ?>">
      <input name="nombre" value="<?= htmlspecialchars($art['nombre']) ?>" required>
      <input name="unidades" type="number" min="0" value="<?= $art['unidades'] ?>" required>
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
      <button type="submit">Guardar</button>
      <a href="dashboard.php" class="btn-cancel">Cancelar</a>
    </form>
  </section>
</main>
</body>
</html>
