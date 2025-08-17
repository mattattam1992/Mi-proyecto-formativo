<?php 
include("../includes/conexion.php"); 
include("../includes/header.php");  

// Obtener productos 
$productos = $conn->query("SELECT * FROM productos"); 
?>

<body class="catalog-page">
<main class="container mt-5">
    <div class="catalog-container">
        <h2 class="catalog-title">Catálogo de Productos</h2>
        
        <div class="products-grid">
            <?php if($productos->num_rows > 0): ?>
                <?php while($producto = $productos->fetch_assoc()): ?>
                    <div class="product-card">
                        <div class="product-image-container">
                            <?php if (!empty($producto['imagen'])): ?>
                                <img src="../<?= $producto['imagen'] ?>" class="product-image" alt="<?= $producto['nombre'] ?>">
                            <?php else: ?>
                                <img src="../assets/img/df.png" class="product-image" alt="Sin imagen">
                            <?php endif; ?>
                            <div class="product-image-overlay"></div>
                          
                        </div>
                        
                        <div class="product-card-body">
                            <h5 class="product-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                            <p class="product-description"><?= htmlspecialchars($producto['descripcion']) ?></p>
                            <div class="product-price">$<?= number_format($producto['precio'], 2) ?></div>
                            
                            <form method="POST" action="carrito_agregar.php" class="add-to-cart-form">
                                <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                                <button type="submit" class="btn-add-cart">
                                    🛒 Agregar al Carrito
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-products">
                    <div class="no-products-icon">📦</div>
                    <h3>No hay productos disponibles</h3>
                    <p>Vuelve más tarde para ver nuestros productos.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>

<?php include("../includes/footer.php"); ?>
