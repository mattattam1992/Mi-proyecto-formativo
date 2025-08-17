<?php
include("../includes/conexion.php");

$conn = isset($conn) ? $conn : (isset($conexion) ? $conexion : null);

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = floatval($_POST['precio']);
$stock = intval($_POST['stock']);

// Procesar imagen
$imagen = "";
if (!empty($_FILES['imagen']['name'])) {
    $ruta = "../assets/img/";
    $nombreArchivo = time() . "_" . basename($_FILES["imagen"]["name"]);
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta . $nombreArchivo);
    $imagen = "assets/img/" . $nombreArchivo;
}

$sql = "INSERT INTO productos (nombre, descripcion, precio, imagen, stock) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $imagen, $stock);
$stmt->execute();

header("Location: gestion_productos.php");
exit;
