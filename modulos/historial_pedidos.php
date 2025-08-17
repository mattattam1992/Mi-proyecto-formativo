<?php
session_start(); // importante para obtener datos del usuario logueado

include("../includes/conexion.php");
include("../includes/header.php");

// Verificamos que el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: ../login.php");
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

// Obtener el correo del usuario actual
$sql_usuario = "SELECT correo FROM usuarios WHERE id = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("i", $id_usuario);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();
$usuario = $result_usuario->fetch_assoc();

// Si no encuentra al usuario, se redirige
if (!$usuario) {
    echo "<div class='alert alert-danger'>Usuario no encontrado.</div>";
    include("../includes/footer.php");
    exit();
}

$correo_usuario = $usuario['correo'];

// Obtener pedidos asociados a su correo
$sql_pedidos = "SELECT * FROM pedidos WHERE correo_cliente = ? ORDER BY id DESC"; 
$stmt_pedidos = $conn->prepare($sql_pedidos);
$stmt_pedidos->bind_param("s", $correo_usuario);
$stmt_pedidos->execute();
$pedidos = $stmt_pedidos->get_result();
?>

<main class="container mt-5">
    <h2>Mis Pedidos</h2>

    <?php if ($pedidos->num_rows > 0): ?>
        <?php while ($pedido = $pedidos->fetch_assoc()): ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-info text-white">
                    <strong>Pedido #<?= $pedido['id'] ?></strong> 
                    <?php if (isset($pedido['fecha'])): ?> 
                        | Fecha: <?= $pedido['fecha'] ?>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <p><strong>Dirección:</strong> <?= $pedido['direccion'] ?></p>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $pedido_id = $pedido['id'];
                            $sql_detalles = "SELECT * FROM detalles_pedidos WHERE pedido_id = ?";
                            $stmt_detalles = $conn->prepare($sql_detalles);
                            $stmt_detalles->bind_param("i", $pedido_id);
                            $stmt_detalles->execute();
                            $detalles = $stmt_detalles->get_result();

                            while ($detalle = $detalles->fetch_assoc()):
                            ?>
                                <tr>
                                    <td><?= $detalle['producto_id'] ?></td>
                                    <td>$<?= number_format($detalle['precio'], 2) ?></td>
                                    <td><?= $detalle['cantidad'] ?></td>
                                    <td>$<?= number_format($detalle['subtotal'], 2) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                    <p class="text-end"><strong>Total: $<?= number_format($pedido['total'], 2) ?></strong></p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="alert alert-warning">No has realizado pedidos aún.</div>
    <?php endif; ?>
</main>

<?php include("../includes/footer.php"); ?>
