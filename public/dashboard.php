<?php
// dashboard.php
session_start();
if(!isset($_SESSION['cedula'])) {
    header('Location: login.php');
    exit;
}
$cedula = $_SESSION['cedula'];
$nombre = $_SESSION['nombre'];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Dashboard - Inventario</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="header">
    <h1>Panel de Control</h1>
    <div>
      <span class="small">Usuario: <?= htmlspecialchars($nombre) ?> (<?= htmlspecialchars($cedula) ?>)</span>
      <a href="logout.php">Cerrar sesión</a>
    </div>
  </div>

  <div class="container">
    <h2>Bienvenido al sistema, <?= htmlspecialchars($nombre) ?></h2>

    <?php if($cedula === '1111'): ?>
      <!-- Mostrar dos botones al admin con cedula 1111 -->
      <div style="display:flex;gap:12px;margin-top:18px">
        <a href="usuarios.php"><button>Gestión de Usuarios</button></a>
        <a href="articulos.php"><button>Gestión de Artículos</button></a>
      </div>
    <?php else: ?>
      <!-- A los demás usuarios solo abrir gestión de artículos -->
      <div style="margin-top:18px">
        <a href="articulos.php"><button>Ir a Gestión de Artículos</button></a>
      </div>
    <?php endif; ?>

  </div>
</body>
</html>
