<?php
session_start();

if (isset($_POST['id']) && isset($_POST['cantidad'])) {
    $id = $_POST['id'];
    $cantidad = (int) $_POST['cantidad'];

    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
    }
}

header("Location: carrito.php");
exit;
