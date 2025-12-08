<?php
require_once '../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];

try {
    $idUsuario = $_POST['idUsuario'];
    $nombreCompleto = $_POST['nombreCompleto'];
    $apellidos = $_POST['apellidos'];
    $idGenero = $_POST['idGenero'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $idTipoDireccion = $_POST['idTipoDireccion'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $idTipoDocumento = $_POST['idTipoDocumento'];
    $numerodocumento = $_POST['numerodocumento'];
    $idRol = $_POST['idRol'];
    $estado = $_POST['estado'];

    // Actualizar usuario existente
    if (!empty($contrasena)) {
        $sql = "UPDATE usuarios SET 
                nombreCompleto = ?, 
                apellidos = ?, 
                idGenero = ?, 
                correo = ?, 
                contrasena = ?,
                idTipoDireccion = ?, 
                direccion = ?, 
                telefono = ?, 
                idTipoDocumento = ?, 
                numerodocumento = ?, 
                idRol = ?, 
                estado = ? 
                WHERE idUsuario = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $nombreCompleto, $apellidos, $idGenero, $correo, $contrasena, 
            $idTipoDireccion, $direccion, $telefono, $idTipoDocumento, 
            $numerodocumento, $idRol, $estado, $idUsuario
        ]);
    } else {
        $sql = "UPDATE usuarios SET 
                nombreCompleto = ?, 
                apellidos = ?, 
                idGenero = ?, 
                correo = ?, 
                idTipoDireccion = ?, 
                direccion = ?, 
                telefono = ?, 
                idTipoDocumento = ?, 
                numerodocumento = ?, 
                idRol = ?, 
                estado = ? 
                WHERE idUsuario = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $nombreCompleto, $apellidos, $idGenero, $correo, 
            $idTipoDireccion, $direccion, $telefono, $idTipoDocumento, 
            $numerodocumento, $idRol, $estado, $idUsuario
        ]);
    }
    
    $response['success'] = true;
    $response['message'] = 'Usuario actualizado correctamente';
} catch(PDOException $e) {
    $response['message'] = 'Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>