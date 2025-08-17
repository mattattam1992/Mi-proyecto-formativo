<!-- Encabezo principal -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Technological Innovation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: 
#d9d5cc;">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">Technological Innovation</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="catalogo.php">Productos</a></li>
        <li class="nav-item"><a class="nav-link" href="carrito.php">Carrito</a></li>
        <?php if (isset($_SESSION['rol'])): ?>
            <?php if ($_SESSION['rol'] === 'admin'): ?>
                <li class="nav-item"><a class="nav-link" href="panel_admin.php">Panel Admin</a></li>
            <?php elseif ($_SESSION['rol'] === 'usuario'): ?>
                <li class="nav-item"><a class="nav-link" href="panel_usuario.php">Mi Panel</a></li>
            <?php endif; ?>
            <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Cerrar sesión</a></li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="registro.php">Registro</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

