<?php
session_start();
include("../includes/header.php");

if (empty($_SESSION['carrito'])) {
    echo "<script>alert('Tu carrito está vacío'); window.location.href='catalogo.php';</script>";
    exit;
}
?>

<main class="container mt-5">
    <h2>Finalizar Compra</h2>

    <form action="procesar_checkout.php" method="POST">
        <div class="mb-3">
            <label>Nombre Completo</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Correo Electrónico</label>
            <input type="email" name="correo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Dirección de Envío</label>
            <textarea name="direccion" class="form-control" required></textarea>
        </div>

        <h4 class="mt-4">Resumen del Pedido</h4>
        <ul class="list-group mb-3">
            <?php 
            $total = 0;
            foreach ($_SESSION['carrito'] as $producto): 
                $subtotal = $producto['precio'] * $producto['cantidad'];
                $total += $subtotal;
            ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $producto['nombre'] ?> (x<?= $producto['cantidad'] ?>)
                    <span>$<?= number_format($subtotal, 2) ?></span>
                </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Total:</strong>
                <strong>$<?= number_format($total, 2) ?></strong>
            </li>
        </ul>

        <input type="hidden" name="total" value="<?= $total ?>">
        <button type="submit" class="btn btn-success">Confirmar Pedido</button>
    </form>
</main>

<?php include("../includes/footer.php"); ?>
