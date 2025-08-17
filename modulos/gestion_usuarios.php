<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include("../includes/conexion.php");
include("../includes/header.php");

$usuarios = $conn->query("SELECT * FROM usuarios");
?>

<main class="container mt-5">
    <h2>Gestión de Usuarios</h2>

    <table class="table table-bordered table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $usuarios->fetch_assoc()): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['nombre'] ?></td>
                    <td><?= $user['correo'] ?></td>
                    <td><?= ucfirst($user['rol']) ?></td>
                    <td>
                        <!-- Evita que el admin se elimine a sí mismo -->
                        <?php if ($_SESSION['usuario_id'] != $user['id']): ?>
                            <form method="POST" action="editar_rol_usuario.php" class="d-inline">
                                <input type="hidden" name="id_usuario" value="<?= $user['id'] ?>">
                                <select name="nuevo_rol" class="form-select form-select-sm d-inline w-auto">
                                    <option value="usuario" <?= $user['rol'] === 'usuario' ? 'selected' : '' ?>>Usuario</option>
                                    <option value="admin" <?= $user['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                            </form>

                            <a href="eliminar_usuario.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro de eliminar este usuario?')">Eliminar</a>
                        <?php else: ?>
                            <span class="text-muted">Acción no disponible</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php include("../includes/footer.php"); ?>
