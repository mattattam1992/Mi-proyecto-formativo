<?php
session_start();
$usuario_id = $_SESSION['usuario_id']; // tomado del login
include("../includes/conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['carrito'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $total = $_POST['total'];

    // Insertar en pedidos
    $sql = "INSERT INTO pedidos (usuario_id, correo_cliente, direccion, total) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issd", $usuario_id, $correo, $direccion, $total);
    $stmt->execute();

    $pedido_id = $stmt->insert_id;

    // Insertar cada producto en detalles_pedido
    $detalle_sql = "INSERT INTO detalles_pedidos (pedido_id, producto_id, precio, cantidad, subtotal) VALUES (?, ?, ?, ?, ?)";
    $detalle_stmt = $conn->prepare($detalle_sql);

    foreach ($_SESSION['carrito'] as $producto_id => $producto) {
    $cantidad = $producto['cantidad'];
    $precio = $producto['precio'];

    $sql_detalle = "INSERT INTO detalles_pedidos (pedido_id, producto_id, cantidad, precio) 
                    VALUES (?, ?, ?, ?)";
    $stmt_detalle = $conn->prepare($sql_detalle);
    $stmt_detalle->bind_param("iiid", $pedido_id, $producto_id, $cantidad, $precio);
    $stmt_detalle->execute();
}


    // Vaciar carrito
    unset($_SESSION['carrito']);

    echo "<script>alert('¡Gracias por tu compra! Tu pedido ha sido registrado.'); window.location.href='catalogo.php';</script>";
} else {
    echo "<script>alert('Error al procesar el pedido.'); window.location.href='checkout.php';</script>";
}
