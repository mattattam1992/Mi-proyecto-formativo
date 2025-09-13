<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include("../includes/conexion.php");
include("../includes/header.php");

// Filtro de estado
$estado_filtro = isset($_GET['estado']) ? $_GET['estado'] : '';

// Consulta de pedidos (todos los usuarios)
$sql = "
    SELECT pedidos.id AS pedido_id, pedidos.fecha, pedidos.estado,
           usuarios.nombre, usuarios.correo, pedidos.total,
           GROUP_CONCAT(CONCAT(productos.nombre, ' (', detalles_pedidos.cantidad, ')') SEPARATOR ', ') AS productos
    FROM pedidos
    INNER JOIN usuarios ON pedidos.usuario_id = usuarios.id
    LEFT JOIN detalles_pedidos ON pedidos.id = detalles_pedidos.pedido_id
    LEFT JOIN productos ON detalles_pedidos.producto_id = productos.id
    " . ($estado_filtro ? "WHERE pedidos.estado = '$estado_filtro'" : "") . "
    GROUP BY pedidos.id
    ORDER BY pedidos.fecha DESC
";
$result = $conn->query($sql);

// Agregar antes de la tabla
$total_pedidos = $result->num_rows;
$total_pendientes = 0;
$total_despachados = 0;

while ($row = $result->fetch_assoc()) {
    if ($row['estado'] == 'pendiente') $total_pendientes++;
    if ($row['estado'] == 'despachado') $total_despachados++;
}
$result->data_seek(0); // Reiniciar el puntero
?>

<main class="container mt-5">
    <h2>Historial de Pedidos (Admin)</h2>

    <!-- Filtro por estado -->
    <div class="mb-3">
        <a href="?estado=pendiente" class="btn btn-warning">Pendientes</a>
        <a href="?estado=despachado" class="btn btn-success">Despachados</a>
        <a href="?" class="btn btn-secondary">Todos</a>
    </div>

    <div class="alert alert-info">
        Total pedidos: <?= $total_pedidos ?> | 
        Pendientes: <?= $total_pendientes ?> | 
        Despachados: <?= $total_despachados ?>
    </div>

    <!-- Formulario de búsqueda -->
    <form class="mb-3">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por cliente...">
            <button class="btn btn-primary">Buscar</button>
        </div>
    </form>

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
                    <tr class="<?= $row['estado'] == 'pendiente' ? 'table-warning' : 'table-success' ?>">
                        <td><?= $row['pedido_id'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row['fecha'])) ?></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['correo']) ?></td>
                        <td><?= htmlspecialchars($row['productos']) ?></td>
                        <td><?= $row['estado'] ?></td>
                        <td>
                            <?php if ($row['estado'] === 'pendiente') : ?>
                                <button type="button" 
                                        class="btn btn-success btn-sm despacharBtn" 
                                        data-pedido-id="<?= $row['pedido_id'] ?>" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#despacharModal">
                                    Marcar como Despachado
                                </button>
                            <?php endif; ?>

                            <?php if ($row['estado'] === 'despachado') : ?>
                                <button type="button" 
                                        class="btn btn-danger btn-sm eliminarBtn" 
                                        data-pedido-id="<?= $row['pedido_id'] ?>" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#eliminarModal">
                                    Eliminar
                                </button>
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

    <!-- Modal para despachar pedido -->
    <div class="modal fade" id="despacharModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Despachar Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de marcar este pedido como despachado?</p>
                    <form id="despacharForm">
                        <input type="hidden" id="pedidoId" name="pedidoId">
                        <button type="submit" class="btn btn-success">Confirmar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para eliminar pedido -->
    <div class="modal fade" id="eliminarModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar este pedido?</p>
                    <form id="eliminarForm">
                        <input type="hidden" id="eliminarPedidoId" name="pedidoId">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Despachar pedido
    document.querySelectorAll('.despacharBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('pedidoId').value = this.dataset.pedidoId;
        });
    });

    // Eliminar pedido
    document.querySelectorAll('.eliminarBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('eliminarPedidoId').value = this.dataset.pedidoId;
        });
    });

    // Manejar formulario de despachar
    document.getElementById('despacharForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const pedidoId = document.getElementById('pedidoId').value;
        
        fetch('cambiar_estado.php?id=' + pedidoId + '&estado=despachado')
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
    });

    // Manejar formulario de eliminar
    document.getElementById('eliminarForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const pedidoId = document.getElementById('eliminarPedidoId').value;
        
        fetch('eliminar_pedido.php?id=' + pedidoId)
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
    });
});
</script>

<?php include("../includes/footer.php"); ?>