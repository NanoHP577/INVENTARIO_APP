<?php
$host = "mysql-juandi.alwaysdata.net";
$dbname = "juandi_inventario";
$user = "juandi"; // Cambia por tu usuario AlwaysData
$pass = "Misifu1234"; // Cambia por tu contraseña AlwaysData

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>
