<?php
// usuarios.php
session_start();
require 'conexion.php';
if(!isset($_SESSION['cedula'])) { header('Location: login.php'); exit; }
// Solo admin (cedula 1111) puede acceder a esta página
if($_SESSION['cedula'] !== '1111') { header('Location: dashboard.php'); exit; }

// Manejo de POST para agregar usuario
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = trim($_POST['cedula'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if($cedula !== '' && $nombre !== '' && $password !== '') {
        $stmt = $pdo->prepare("INSERT INTO usuarios (cedula,nombre,password) VALUES (?,?,?)");
        try {
            $stmt->execute([$cedula,$nombre,$password]);
        } catch (PDOException $e) {
            $error = "No se pudo agregar: " . $e->getMessage();
        }
    }
    header("Location: usuarios.php");
    exit;
}

// Eliminar usuario (GET delete)
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $pdo->prepare("DELETE FROM usuarios WHERE id = ?")->execute([$id]);
    header("Location: usuarios.php");
    exit;
}

$users = $pdo->query("SELECT id,cedula,nombre FROM usuarios ORDER BY nombre")->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Usuarios - Inventario</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="header"><h1>Gestión de Usuarios</h1><div><a href="dashboard.php">Volver</a> | <a href="logout.php">Salir</a></div></div>
  <div class="container">
    <h2>Agregar Usuario</h2>
    <form method="post">
      <input type="text" name="cedula" placeholder="Cédula" required>
      <input type="text" name="nombre" placeholder="Nombre completo" required>
      <input type="text" name="password" placeholder="Contraseña (texto plano)" required>
      <button type="submit">Agregar</button>
    </form>

    <h2>Usuarios Registrados</h2>
    <table class="table">
      <tr><th>ID</th><th>Cédula</th><th>Nombre</th><th>Acción</th></tr>
      <?php foreach($users as $u): ?>
        <tr>
          <td><?= $u['id'] ?></td>
          <td><?= htmlspecialchars($u['cedula']) ?></td>
          <td><?= htmlspecialchars($u['nombre']) ?></td>
          <td>
            <a class="link" href="editar_usuario.php?id=<?= $u['id'] ?>">Editar</a> |
            <?php if($u['cedula'] !== '1111'): ?>
              <a class="link" href="usuarios.php?delete=<?= $u['id'] ?>" onclick="return confirm('Eliminar usuario?')">Eliminar</a>
            <?php else: ?>
              <span class="small">(admin)</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
