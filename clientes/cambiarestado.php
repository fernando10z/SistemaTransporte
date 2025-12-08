<?php
include '../conexion/conexion.php';

$id = $_POST['id'];
$tipo = $_POST['tipo'];

try {
    // Cambiar estado según tipo de cliente
    if ($tipo === 'Natural') {
        $sql = "UPDATE clientes_naturales SET status = IF(status = 'Activo', 'Inactivo', 'Activo') WHERE idCliente = :id";
    } elseif ($tipo === 'Empresa') {
        $sql = "UPDATE clientes_empresas SET status = IF(status = 'Activo', 'Inactivo', 'Activo') WHERE idEmpresa = :id";
    } else {
        echo json_encode(['success' => false, 'message' => 'Tipo de cliente no válido']);
        exit;
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al cambiar estado']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
