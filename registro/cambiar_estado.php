<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idDesempeno = $_POST['idDesempeno'] ?? null;
    $estadoDesempeno = $_POST['estadoDesempeno'] ?? null;
    $idregistrar = $_POST['idregistrar'] ?? null;
    $estadoRegistro = $_POST['estadoRegistro'] ?? null;
    
    try {
        // Validar datos
        if (!$idDesempeno || !$estadoDesempeno || !$idregistrar || !$estadoRegistro) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos']);
            exit;
        }
        
        // Validar estados permitidos
        $estadosDesempenoPermitidos = ['Pendiente', 'Acabado', 'No Culmino'];
        $estadosRegistroPermitidos = ['Activado', 'Terminado', 'No terminado'];
        
        if (!in_array($estadoDesempeno, $estadosDesempenoPermitidos) || !in_array($estadoRegistro, $estadosRegistroPermitidos)) {
            http_response_code(400);
            echo json_encode(['error' => 'Estado no válido']);
            exit;
        }
        
        // Iniciar transacción
        $conn->beginTransaction();
        
        // 1. Actualizar estado en desempeño
        $stmtDesempeno = $conn->prepare("UPDATE desempeno SET estado = :estado WHERE idDesempeno = :id");
        $stmtDesempeno->bindParam(':estado', $estadoDesempeno);
        $stmtDesempeno->bindParam(':id', $idDesempeno);
        $stmtDesempeno->execute();
        
        // 2. Actualizar estado en registrarcurso
        $stmtRegistro = $conn->prepare("UPDATE registrarcurso SET estado = :estado WHERE idregistrar = :id");
        $stmtRegistro->bindParam(':estado', $estadoRegistro);
        $stmtRegistro->bindParam(':id', $idregistrar);
        $stmtRegistro->execute();
        
        // Confirmar transacción
        $conn->commit();
        
        echo json_encode([
            'success' => true,
            'message' => 'Estados actualizados correctamente',
            'data' => [
                'estado_desempeno' => $estadoDesempeno,
                'estado_registro' => $estadoRegistro
            ]
        ]);
        
    } catch(PDOException $e) {
        // Revertir transacción en caso de error
        $conn->rollBack();
        http_response_code(500);
        echo json_encode([
            'error' => 'Error al actualizar los estados',
            'details' => $e->getMessage()
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
?>