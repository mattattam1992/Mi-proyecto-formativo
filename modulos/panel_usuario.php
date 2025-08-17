<?php 
session_start(); 
if ($_SESSION['rol'] !== 'usuario') {     
    header("Location: login.php");     
    exit; 
} 
include("../includes/header.php"); 
?>

<body class="user-page">
<main class="container mt-5">
    <div class="user-panel">
        <h2 class="user-welcome-title">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
        <p class="user-subtitle">Explora productos, haz pedidos y revisa tu historial de compras.</p>
        
        <div class="user-card-container">
            <div class="user-main-card">
                <div class="card-body text-center">
                    <div class="user-main-icon">
                        🛒
                    </div>
                    <h5 class="card-title">Mis Pedidos</h5>
                    <p class="card-text">Consulta el historial completo de tus compras y el estado de tus pedidos actuales.</p>
                    <a href="historial_pedidos.php" class="btn-user">Ver Mi Historial</a>
                </div>
            </div>
        </div>
        
        <div class="user-motivation">
            <p class="mb-0">💫 "Cada compra es una nueva experiencia esperándote" 💫</p>
        </div>
    </div>
</main>
</body>

<?php include("../includes/footer.php"); ?>
