<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include("../includes/conexion.php");

if (isset($_GET['id']) && $_GET['id'] != $_SESSION['id']) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM usuarios WHERE id = $id");
}

header("Location: gestion_usuarios.php");
