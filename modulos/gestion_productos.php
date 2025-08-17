<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include("../includes/conexion.php");
include("../includes/header.php");

// Obtener productos
$productos = $conn->query("SELECT * FROM productos");
?>

<main class="container mt-5">
    <h2>Gestión de Productos</h2>

    <!-- Formulario para agregar producto -->
    <form action="producto_insertar.php" method="POST" enctype="multipart/form-data" class="mb-5">
        <div class="row">
            <div class="col-md-4">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label>Precio:</label>
                <input type="number" name="precio" step="0.01" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label>Categoría:</label>
                <input type="text" name="categoria" class="form-control">
            </div>
        </div>
        <div class="mt-3">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>
        <div class="mt-3">
            <label>Imagen:</label>
            <input type="file" name="imagen" class="form-control">
        </div>
        <div class="mt-3">
            <label>Stock:</label>
            <input type="number" name="stock" class="form-control" min="0" value="0">
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </div>
    </form>

    <!-- Lista de productos -->
    <h4>Lista de productos</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $productos->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nombre'] ?></td>
                    <td>$<?= $row['precio'] ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td>
                        <a href="producto_editar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="producto_eliminar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php include("../includes/footer.php"); ?>

