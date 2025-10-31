<?php
// conexion.php
$DB_HOST = ' mysql-juandi.alwaysdata.net';
$DB_NAME = 'juandi_inventario';
$DB_USER = 'juandi';
$DB_PASS = 'Misifu1234';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    // En producción no mostrar el detalle
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
