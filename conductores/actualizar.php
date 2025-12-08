<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$data = $_POST;

try {
    // Iniciar transacción
    $conn->beginTransaction();

    // Verificar si el conductor existe
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM conductores WHERE idConductor = :idConductor");
    $stmt->bindParam(':idConductor', $data['idConductor']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] == 0) {
        throw new Exception('El conductor no existe');
    }
    
    // Actualizar conductor
    $sqlConductor = "UPDATE conductores SET
        nombre = :nombre,
        Apepat = :apepat,
        Apemat = :apemat,
        idTipoDocumento = :idTipoDocumento,
        numerodocumento = :numerodocumento,
        idGenero = :idGenero,
        idTipoDireccion = :idTipoDireccion,
        direccion = :direccion,
        licencia = :licencia,
        telefono = :telefono,
        Correo = :correo,
        horastrabajo = :horastrabajo
    WHERE idConductor = :idConductor";
    
    $stmtConductor = $conn->prepare($sqlConductor);
    $stmtConductor->bindParam(':idConductor', $data['idConductor']);
    $stmtConductor->bindParam(':nombre', $data['nombre']);
    $stmtConductor->bindParam(':apepat', $data['apepat']);
    $stmtConductor->bindParam(':apemat', $data['apemat']);
    $stmtConductor->bindParam(':idTipoDocumento', $data['idTipoDocumento']);
    $stmtConductor->bindParam(':numerodocumento', $data['numerodocumento']);
    $stmtConductor->bindParam(':idGenero', $data['idGenero']);
    $stmtConductor->bindParam(':idTipoDireccion', $data['idTipoDireccion']);
    $stmtConductor->bindParam(':direccion', $data['direccion']);
    $stmtConductor->bindParam(':licencia', $data['licencia']);
    $stmtConductor->bindParam(':telefono', $data['telefono']);
    $stmtConductor->bindParam(':correo', $data['correo']);
    $stmtConductor->bindParam(':horastrabajo', $data['horastrabajo']);
    
    if (!$stmtConductor->execute()) {
        throw new Exception('Error al actualizar el conductor');
    }

    // Preparar datos para actualizar usuario
    $nombreCompleto = $data['nombre'];
    $apellidos = $data['apepat'] . ' ' . $data['apemat'];
    
    // Actualizar usuario asociado
    $sqlUsuario = "UPDATE usuarios SET
        nombreCompleto = :nombreCompleto,
        apellidos = :apellidos,
        idGenero = :idGenero,
        correo = :correo,
        idTipoDireccion = :idTipoDireccion,
        direccion = :direccion,
        telefono = :telefono,
        idTipoDocumento = :idTipoDocumento,
        numerodocumento = :numerodocumento
    WHERE idConductor = :idConductor";
    
    $stmtUsuario = $conn->prepare($sqlUsuario);
    $stmtUsuario->bindParam(':nombreCompleto', $nombreCompleto);
    $stmtUsuario->bindParam(':apellidos', $apellidos);
    $stmtUsuario->bindParam(':idGenero', $data['idGenero']);
    $stmtUsuario->bindParam(':correo', $data['correo']);
    $stmtUsuario->bindParam(':idTipoDireccion', $data['idTipoDireccion']);
    $stmtUsuario->bindParam(':direccion', $data['direccion']);
    $stmtUsuario->bindParam(':telefono', $data['telefono']);
    $stmtUsuario->bindParam(':idTipoDocumento', $data['idTipoDocumento']);
    $stmtUsuario->bindParam(':numerodocumento', $data['numerodocumento']);
    $stmtUsuario->bindParam(':idConductor', $data['idConductor']);
    
    if (!$stmtUsuario->execute()) {
        throw new Exception('Error al actualizar el usuario asociado al conductor');
    }

    // Confirmar ambas actualizaciones
    $conn->commit();
    
    echo json_encode(['success' => true]);
    
} catch (Exception $e) {
    // Revertir cambios en caso de error
    $conn->rollBack();
    
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>