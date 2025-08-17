<?php 
session_start(); 
if ($_SESSION['rol'] !== 'admin') {     
    header("Location: login.php");     
    exit; 
} 
include("../includes/header.php"); 
?>

<body class="admin-page">
<main class="container mt-5">
    <div class="admin-panel">
        <h2>Panel de Administración</h2>
        <div class="admin-welcome">
            <p class="mb-0">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?> (Administrador)</p>
        </div>

        <div class="admin-grid">
            <div class="admin-card">
                <div class="card-body text-center">
                    <div class="admin-icon">
                        📦
                    </div>
                    <h5 class="card-title">Gestión de Productos</h5>
                    <p class="card-text">Agrega, edita o elimina productos de la tienda.</p>
                    <a href="gestion_productos.php" class="btn-admin">Ir a Gestión de Productos</a>
                </div>
            </div>
            
            <div class="admin-card">
                <div class="card-body text-center">
                    <div class="admin-icon">
                        👥
                    </div>
                    <h5 class="card-title">Gestión de Usuarios</h5>
                    <p class="card-text">Consulta los usuarios registrados en la plataforma.</p>
                    <a href="gestion_usuarios.php" class="btn-admin">Ir a Gestión de Usuarios</a>
                </div>
            </div>
            
            <div class="admin-card">
                <div class="card-body text-center">
                    <div class="admin-icon">
                        📋
                    </div>
                    <h5 class="card-title">Gestión de Pedidos</h5>
                    <p class="card-text">Consulta todos los pedidos realizados por los clientes.</p>
                    <a href="gestion_pedidos.php" class="btn-admin">Ir a Gestión de Pedidos</a>
                </div>
            </div>
        </div>
    </div>
</main>
</body>

<?php include("../includes/footer.php"); ?>