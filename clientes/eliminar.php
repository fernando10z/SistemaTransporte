<?php
include '../conexion/conexion.php';

header('Content-Type: application/json');

$id = $_POST['id'] ?? null;
$tipo = $_POST['tipo'] ?? null;
$response = ['success' => false, 'message' => ''];

try {
    if (!$id || !$tipo) {
        throw new Exception('Datos incompletos');
    }

    // 1. Primero obtener información de la firma si existe
    $firma = null;
    if ($tipo === 'Natural') {
        $sqlSelect = "SELECT firmas FROM clientes_naturales WHERE idCliente = ?";
        $sqlDelete = "DELETE FROM clientes_naturales WHERE idCliente = ?";
    } elseif ($tipo === 'Empresa') {
        $sqlSelect = "SELECT firmas FROM clientes_empresas WHERE idEmpresa = ?";
        $sqlDelete = "DELETE FROM clientes_empresas WHERE idEmpresa = ?";
    } else {
        throw new Exception('Tipo de cliente no válido');
    }

    // Obtener el nombre del archivo de firma
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->execute([$id]);
    $result = $stmtSelect->fetch(PDO::FETCH_ASSOC);
    
    if ($result && !empty($result['firmas'])) {
        $firma = $result['firmas'];
    }

    // 2. Eliminar el registro de la base de datos
    $stmtDelete = $conn->prepare($sqlDelete);
    $deleteSuccess = $stmtDelete->execute([$id]);

    if (!$deleteSuccess) {
        throw new Exception('Error al eliminar el registro de la base de datos');
    }

    // 3. Si se eliminó el registro, eliminar el archivo de firma si existe
    if ($firma) {
        $uploadDir = '../uploads/firmas/';
        $filePath = $uploadDir . $firma;
        
        if (file_exists($filePath) && is_writable($filePath)) {
            if (!unlink($filePath)) {
                $response['message'] = 'Cliente eliminado pero no se pudo eliminar el archivo de firma';
            }
        }
    }

    $response['success'] = true;
    $response['message'] = 'Cliente eliminado correctamente';

} catch (PDOException $e) {
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
exit; // Asegurar que no se envía nada más después del JSON
?>