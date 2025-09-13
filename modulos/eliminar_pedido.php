<?php
session_start();
if ($_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include("../includes/conexion.php");

if (isset($_POST['pedido_id'])) {
    $pedido_id = intval($_POST['pedido_id']);
    $conn->query("DELETE FROM detalles_pedido WHERE pedido_id = $pedido_id");
    $conn->query("DELETE FROM pedidos WHERE id = $pedido_id");
}

header("Location: gestion_pedidos.php");
exit;
?>

<?php
include("../includes/conexion.php");

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $sql = "DELETE FROM pedidos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    $response = ['success' => $stmt->execute()];
    echo json_encode($response);
} else {
    echo json_encode(['success' => false]);
}
?>