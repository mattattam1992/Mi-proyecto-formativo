<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include("../includes/conexion.php");

if (isset($_POST['pedido_id'])) {
    $pedido_id = intval($_POST['pedido_id']);
    $conn->query("DELETE FROM detalles_pedido WHERE pedido_id = $pedido_id");
    $conn->query("DELETE FROM pedidos WHERE id = $pedido_id");
}

header("Location: gestion_pedidos.php");
exit;
?>