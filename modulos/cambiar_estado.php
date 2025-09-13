<?php
<?php
include("../includes/conexion.php");

if(isset($_GET['id']) && isset($_GET['estado'])) {
    $id = intval($_GET['id']);
    $estado = $_GET['estado'];
    
    $sql = "UPDATE pedidos SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $estado, $id);
    
    $response = ['success' => $stmt->execute()];
    echo json_encode($response);
} else {
    echo json_encode(['success' => false]);
}