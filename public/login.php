<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login - Inventario</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
  <h2>🔐 Acceso al Inventario</h2>
  <form action="validar_login.php" method="POST">
    <label>Usuario</label>
    <input type="text" name="usuario" required>
    <label>Contraseña</label>
    <input type="password" name="password" required>
    <button type="submit">Ingresar</button>
  </form>
  <?php if(isset($_GET['error'])) echo "<p class='error'>⚠️ Usuario o contraseña incorrectos</p>"; ?>
</div>
</body>
</html>
