<?php
session_start();
require 'conexion.php';
if(!isset($_GET['id'])) header("Location: productos.php");
$id = $_GET['id'];

$pdo->prepare("DELETE FROM productos WHERE id=?")->execute([$id]);
header("Location: productos.php");
?>
