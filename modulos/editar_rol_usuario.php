<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include("../includes/conexion.php");

if (isset($_POST['id_usuario']) && isset($_POST['nuevo_rol'])) {
    $id = $_POST['id_usuario'];
    $nuevo_rol = $_POST['nuevo_rol'];

    // Protege al admin de modificar su propio rol
    if ($_SESSION['id'] != $id) {
        $sql = "UPDATE usuarios SET rol = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $nuevo_rol, $id);
        $stmt->execute();
    }
}

header("Location: gestion_usuarios.php");
