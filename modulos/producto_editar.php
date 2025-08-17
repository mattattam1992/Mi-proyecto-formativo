<?php
session_start();
include("../includes/conexion.php");

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "UPDATE productos SET nombre=?, precio=?, stock=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdii", $nombre, $precio, $stock, $id);
    $stmt->execute();

    header("Location: gestion_productos.php");
    exit;
}

// Obtener datos
$producto = $conn->query("SELECT * FROM productos WHERE id = $id")->fetch_assoc();
include("../includes/header.php");
?>

<main class="container mt-5">
    <h2>Editar Producto</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= $producto['nombre'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" value="<?= $producto['precio'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="<?= $producto['stock'] ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="gestion_productos.php" class="btn btn-secondary">Volver</a>
    </form>
</main>

<?php include("../includes/footer.php"); ?>
