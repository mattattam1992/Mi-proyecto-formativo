<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include("../includes/conexion.php");
include("../includes/header.php");

// Consulta de pedidos (todos los usuarios)
$sql = "
    SELECT pedidos.id AS pedido_id, pedidos.fecha, pedidos.estado,
           usuarios.nombre, usuarios.correo,
           GROUP_CONCAT(CONCAT(productos.nombre, ' (', detalles_pedidos.cantidad, ')') SEPARATOR ', ') AS productos
    FROM pedidos
    INNER JOIN usuarios ON pedidos.usuario_id = usuarios.id
    INNER JOIN detalles_pedidos ON pedidos.id = detalles_pedidos.pedido_id
    INNER JOIN productos ON detalles_pedidos.producto_id = productos.id
    GROUP BY pedidos.id, pedidos.fecha, pedidos.estado, usuarios.nombre, usuarios.correo
    ORDER BY pedidos.fecha DESC
";
$result = $conn->query($sql);
?>

<main class="container mt-5">
    <h2>Historial de Pedidos (Admin)</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Email</th>
                <th>Productos</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['pedido_id'] ?></td>
                        <td><?= $row['fecha'] ?></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['correo']) ?></td>
                        <td><?= htmlspecialchars($row['productos']) ?></td>
                        <td><?= $row['estado'] ?></td>
                        <td>
                            <?php if ($row['estado'] === 'pendiente') : ?>
                                <a href="cambiar_estado.php?id=<?= $row['pedido_id'] ?>&estado=despachado" class="btn btn-success btn-sm">Marcar como Despachado</a>
                            <?php endif; ?>

                            <?php if ($row['estado'] === 'despachado') : ?>
                                <a href="eliminar_pedido.php?id=<?= $row['pedido_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este pedido?')">Eliminar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No hay pedidos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include("../includes/footer.php"); ?>

