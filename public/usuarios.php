<?php
session_start();
require 'conexion.php';

// Solo el administrador puede acceder
if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: dashboard.php");
    exit;
}

// Agregar usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, password, rol) VALUES (?,?,?)");
    $stmt->execute([$usuario, $password, $rol]);
}

// Eliminar usuario
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM usuarios WHERE id = ?")->execute([$id]);
}

$usuarios = $pdo->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Usuarios</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>👥 Administración de Usuarios</h1>
    <a href="dashboard.php">⬅ Volver</a>
  </header>

  <div class="container">
    <h2>Agregar Nuevo Usuario</h2>
    <form method="POST">
      <input type="text" name="usuario" placeholder="Usuario" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <select name="rol" required>
        <option value="empleado">Empleado</option>
        <option value="admin">Administrador</option>
      </select>
      <button type="submit">Agregar Usuario</button>
    </form>

    <h2>Usuarios Registrados</h2>
    <table>
      <tr><th>ID</th><th>Usuario</th><th>Rol</th><th>Acción</th></tr>
      <?php foreach ($usuarios as $u): ?>
      <tr>
        <td><?= $u['id'] ?></td>
        <td><?= $u['usuario'] ?></td>
        <td><?= $u['rol'] ?></td>
        <td><a href="?delete=<?= $u['id'] ?>" onclick="return confirm('¿Eliminar usuario?')">🗑️</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
