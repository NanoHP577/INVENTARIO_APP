<?php
$host = "localhost";
$dbname = "inventario_db";
$user = "root"; // Cambia por tu usuario AlwaysData
$pass = ""; // Cambia por tu contraseña AlwaysData

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>
