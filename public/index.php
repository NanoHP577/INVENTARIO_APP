<?php
session_start();
// Si ya está autenticado, redirigir al dashboard
if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin') {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';
    // Requisito: usuario 'admin' y contraseña '1234'
    if ($user === 'admin' && $pass === '1234') {
        $_SESSION['user'] = 'admin';
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Credenciales inválidas.';
    }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Login - Inventario</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="login-card">
    <h1>Ingreso - Inventario</h1>
    <?php if($error): ?>
      <div class="alert"><?=htmlspecialchars($error)?></div>
    <?php endif; ?>
    <form method="post">
      <label>Usuario</label>
      <input name="user" required placeholder="usuario">
      <label>Contraseña</label>
      <input type="password" name="pass" required placeholder="contraseña">
      <button type="submit">Entrar</button>
    </form>
    <p class="note">Usuario: <strong>admin</strong> — Contraseña: <strong>1234</strong></p>
  </div>
</body>
</html>
