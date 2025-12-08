<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    $data = [
        'idCliente' => $_POST['idCliente'] ?? 0,
        'nombre' => trim($_POST['nombre'] ?? ''),
        'apellidopat' => trim($_POST['apellidopat'] ?? ''),
        'apellidoMat' => trim($_POST['apellidoMat'] ?? ''),
        'idGenero' => intval($_POST['idGenero'] ?? 0),
        'idTipoDocumento' => intval($_POST['idTipoDocumento'] ?? 0),
        'idTipoDireccion' => intval($_POST['idTipoDireccion'] ?? 0),
        'direccion' => trim($_POST['direccion'] ?? ''),
        'telefono' => preg_replace('/[^0-9]/', '', $_POST['telefono'] ?? ''),
        'correo' => filter_var(trim($_POST['correo'] ?? ''), FILTER_SANITIZE_EMAIL),
        'status' => in_array($_POST['status'] ?? '', ['Activo', 'Inactivo']) ? $_POST['status'] : 'Activo'
    ];

    // Validaciones básicas
    if (empty($data['idCliente'])) throw new Exception('ID de cliente inválido');
    if (empty($data['nombre'])) throw new Exception('El nombre es obligatorio');
    if (strlen($data['telefono']) !== 9) throw new Exception('El teléfono debe tener 9 dígitos');

    // La firma no se modifica, se mantiene la que ya existe en la BD
    $sql = "UPDATE clientes_naturales SET
                nombre = :nombre,
                apellidopat = :apellidopat,
                apellidoMat = :apellidoMat,
                idGenero = :idGenero,
                idTipoDocumento = :idTipoDocumento,
                idTipoDireccion = :idTipoDireccion,
                direccion = :direccion,
                telefono = :telefono,
                correo = :correo,
                status = :status
            WHERE idCliente = :idCliente";
    
    $stmt = $conn->prepare($sql);
    $success = $stmt->execute($data);
    
    if ($success) {
        $response['success'] = true;
        $response['message'] = 'Cliente natural actualizado correctamente';
    } else {
        throw new Exception('Error al actualizar el cliente');
    }
} catch (PDOException $e) {
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>