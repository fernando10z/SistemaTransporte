<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$data = $_POST;

try {
    // Verificar si el documento ya existe (doble verificación)
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM conductores 
                           WHERE idTipoDocumento = :idTipoDocumento 
                           AND numerodocumento = :numerodocumento");
    $stmt->bindParam(':idTipoDocumento', $data['idTipoDocumento']);
    $stmt->bindParam(':numerodocumento', $data['numerodocumento']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'El número de documento ya está registrado'
        ]);
        exit;
    }
    
    // Iniciar transacción para asegurar que ambas inserciones se completen
    $conn->beginTransaction();
    
    // Insertar nuevo conductor
    $sqlConductor = "INSERT INTO conductores (
        nombre, Apepat, Apemat, idTipoDocumento, numerodocumento, 
        idGenero, idTipoDireccion, direccion, licencia, telefono, Correo, contrasena, tipolicencia, horastrabajo, estado
    ) VALUES (
        :nombre, :apepat, :apemat, :idTipoDocumento, :numerodocumento, 
        :idGenero, :idTipoDireccion, :direccion, :licencia, :telefono, :correo, :contrasena, :tipolicencia, :horastrabajo, 'Activo'
    )";
    
    $stmtConductor = $conn->prepare($sqlConductor);
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
    $stmtConductor->bindParam(':contrasena', $data['contrasena']);
    $stmtConductor->bindParam(':tipolicencia', $data['tipolicencia']);
    $stmtConductor->bindParam(':horastrabajo', $data['horastrabajo']);
    
    if (!$stmtConductor->execute()) {
        $conn->rollBack();
        echo json_encode([
            'success' => false,
            'message' => 'Error al registrar el conductor'
        ]);
        exit;
    }
    
    // Obtener el ID del conductor recién insertado
    $idConductor = $conn->lastInsertId();
    
    // Preparar datos para el usuario
    $nombreCompleto = $data['nombre'];
    $apellidos = $data['apepat'] . ' ' . $data['apemat'];
    $idRol = 3; // Rol de Conductor
    
    // Insertar usuario asociado al conductor
    $sqlUsuario = "INSERT INTO usuarios (
        nombreCompleto, apellidos, idGenero, correo, contrasena, 
        idTipoDireccion, direccion, telefono, idTipoDocumento, 
        numerodocumento, idRol, idConductor, estado
    ) VALUES (
        :nombreCompleto, :apellidos, :idGenero, :correo, :contrasena, 
        :idTipoDireccion, :direccion, :telefono, :idTipoDocumento, 
        :numerodocumento, :idRol, :idConductor, 'Activo'
    )";
    
    $stmtUsuario = $conn->prepare($sqlUsuario);
    $stmtUsuario->bindParam(':nombreCompleto', $nombreCompleto);
    $stmtUsuario->bindParam(':apellidos', $apellidos);
    $stmtUsuario->bindParam(':idGenero', $data['idGenero']);
    $stmtUsuario->bindParam(':correo', $data['correo']);
    $stmtUsuario->bindParam(':contrasena', $data['contrasena']);
    $stmtUsuario->bindParam(':idTipoDireccion', $data['idTipoDireccion']);
    $stmtUsuario->bindParam(':direccion', $data['direccion']);
    $stmtUsuario->bindParam(':telefono', $data['telefono']);
    $stmtUsuario->bindParam(':idTipoDocumento', $data['idTipoDocumento']);
    $stmtUsuario->bindParam(':numerodocumento', $data['numerodocumento']);
    $stmtUsuario->bindParam(':idRol', $idRol);
    $stmtUsuario->bindParam(':idConductor', $idConductor);
    
    if (!$stmtUsuario->execute()) {
        $conn->rollBack();
        echo json_encode([
            'success' => false,
            'message' => 'Error al registrar el usuario asociado al conductor'
        ]);
        exit;
    }
    
    // Confirmar ambas inserciones
    $conn->commit();
    
    echo json_encode(['success' => true]);
    
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode([
        'success' => false,
        'message' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}
?>