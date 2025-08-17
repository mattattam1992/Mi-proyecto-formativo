<?php
include("../includes/conexion.php");

// Validar campos obligatorios
if (!isset($_POST['nombre'], $_POST['correo'], $_POST['clave'])) {
    die("Faltan datos en el formulario.");
}

$nombre   = $_POST['nombre'];
$correo   = $_POST['correo'];
$clave    = password_hash($_POST['clave'], PASSWORD_DEFAULT);
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;

// Verificar si ya hay usuarios registrados
$verificar = $conn->query("SELECT COUNT(*) as total FROM usuarios");
$datos     = $verificar->fetch_assoc();

$rol = ($datos['total'] == 0) ? 'admin' : 'usuario'; // El primero es admin

// Preparar sentencia SQL
$sql = "INSERT INTO usuarios (nombre, correo, clave, telefono, rol) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre, $correo, $clave, $telefono, $rol);

if ($stmt->execute()) {
    echo "<script>alert('Registro exitoso como $rol');window.location.href='login.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}
?>
