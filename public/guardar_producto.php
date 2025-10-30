<?php
session_start();
require 'conexion.php';

$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$cantidad = $_POST['cantidad'];
$bodega = $_POST['bodega'];

$nombreArchivo = null;
if(isset($_FILES['imagen']) && $_FILES['imagen']['error']==0){
    $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $nombreArchivo = uniqid().".".$ext;
    if(!is_dir("uploads")) mkdir("uploads");
    move_uploaded_file($_FILES['imagen']['tmp_name'], "uploads/".$nombreArchivo);
}

$stmt = $pdo->prepare("INSERT INTO productos(nombre,marca,cantidad,bodega,imagen) VALUES(?,?,?,?,?)");
$stmt->execute([$nombre,$marca,$cantidad,$bodega,$nombreArchivo]);

$hist = $pdo->prepare("INSERT INTO historial(producto,usuario,accion,cantidad,bodega,marca) VALUES(?,?,?,?,?,?)");
$hist->execute([$nombre,$_SESSION['usuario'],'Ingreso',$cantidad,$bodega,$marca]);

header("Location: productos.php");
?>
