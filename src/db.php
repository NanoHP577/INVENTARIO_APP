<?php
// src/db.php
// Ajusta las constantes según tu entorno (LOCAL o AlwaysData)
define('DB_HOST', 'mysql-juandi.alwaysdata.net');
define('DB_NAME', 'juandi_inventario');
define('DB_USER', 'juandi');
define('DB_PASS', 'Misifu1234'); // XAMPP: '' ; AlwaysData: cambiar por credenciales del panel

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // En producción no mostrar detalle
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
