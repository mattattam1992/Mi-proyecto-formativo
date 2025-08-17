<?php 
session_start(); 
include("../includes/header.php"); 
?>

<body class="cart-page">
<main class="container mt-5">
    <div class="cart-container">
        <h2 class="cart-title">Carrito de Compras</h2>
        
        <?php if (!empty($_SESSION['carrito'])): ?>
            <div class="table-responsive">
                <table class="table cart-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['carrito'] as $id => $producto):
                            $subtotal = $producto['precio'] * $producto['cantidad'];
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td>
                                    <span class="product-name"><?= htmlspecialchars($producto['nombre']) ?></span>
                                </td>
                                <td>
                                    <span class="product-price">$<?= number_format($producto['precio'], 2) ?></span>
                                </td>
                                <td>
                                    <form action="actualizar_carrito.php" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <select name="cantidad" onchange="this.form.submit()" class="quantity-selector">
                                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                                <option value="<?= $i ?>" <?= $i == $producto['cantidad'] ? 'selected' : '' ?>>
                                                    <?= $i ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <span class="subtotal">$<?= number_format($subtotal, 2) ?></span>
                                </td>
                                <td>
                                    <a href="carrito_eliminar.php?id=<?= $id ?>" class="btn-remove" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                        🗑️ Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <tr class="total-row">
                            <td colspan="3" class="text-end">
                                <strong>Total General:</strong>
                            </td>
                            <td>
                                <span class="total-amount">$<?= number_format($total, 2) ?></span>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="cart-actions">
                <a href="catalogo.php" class="btn-continue">
                    🔙 Continuar Comprando
                </a>
                <a href="checkout.php" class="btn-checkout">
                    💳 Proceder al Pago
                </a>
            </div>
            
        <?php else: ?>
            <div class="empty-cart">
                <div class="empty-cart-icon">🛒</div>
                <h3>Tu carrito está vacío</h3>
                <p>¡Agrega algunos productos increíbles para comenzar tu compra!</p>
                <a href="catalogo.php" class="btn-checkout">
                    🛍️ Ir al Catálogo
                </a>
            </div>
        <?php endif; ?>
    </div>
</main>
</body>

<?php include("../includes/footer.php"); ?>
