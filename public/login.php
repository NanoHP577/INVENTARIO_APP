<?php
// login.php
session_start();
if(isset($_SESSION['cedula'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Ingreso - Inventario</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="header"><h1>Inventario - Ingreso</h1></div>
  <div class="container">
    <h2>Iniciar sesión</h2>
    <form action="validar_login.php" method="post">
      <label>Cédula</label>
      <input type="text" name="cedula" required placeholder="Ingrese su cédula">
      <label>Contraseña</label>
      <input type="password" name="password" required placeholder="Contraseña">
      <button type="submit">Entrar</button>
    </form>
    <?php if(isset($_GET['error'])): ?>
      <div class="alert">Cédula o contraseña incorrecta.</div>
    <?php endif; ?>
    <p class="note">Usuario administrador: cedula <strong>1111</strong> - contraseña <strong>1234</strong></p>
  </div>
</body>
</html>
