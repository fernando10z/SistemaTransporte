<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    $data = [
        'idEmpresa' => $_POST['idCliente'] ?? 0,
        'razonSocial' => trim($_POST['razonSocial'] ?? ''),
        'idTipoRuc' => intval($_POST['idTipoRuc'] ?? 0),
        'idTipoDireccion' => intval($_POST['idTipoDireccion'] ?? 0),
        'direccion' => trim($_POST['direccion'] ?? ''),
        'telefono' => preg_replace('/[^0-9]/', '', $_POST['telefono'] ?? ''),
        'correo' => filter_var(trim($_POST['correo'] ?? ''), FILTER_SANITIZE_EMAIL),
        'status' => in_array($_POST['status'] ?? '', ['Activo', 'Inactivo']) ? $_POST['status'] : 'Activo'
    ];

    // Validaciones básicas
    if (empty($data['idEmpresa'])) throw new Exception('ID de empresa inválido');
    if (empty($data['razonSocial'])) throw new Exception('La razón social es obligatoria');
    if (strlen($data['telefono']) !== 9) throw new Exception('El teléfono debe tener 9 dígitos');

    // La firma no se modifica, se mantiene la que ya existe en la BD
    $sql = "UPDATE clientes_empresas SET
                razonSocial = :razonSocial,
                idTipoRuc = :idTipoRuc,
                idTipoDireccion = :idTipoDireccion,
                direccion = :direccion,
                telefono = :telefono,
                correo = :correo,
                status = :status
            WHERE idEmpresa = :idEmpresa";
    
    $stmt = $conn->prepare($sql);
    $success = $stmt->execute($data);
    
    if ($success) {
        $response['success'] = true;
        $response['message'] = 'Empresa actualizada correctamente';
    } else {
        throw new Exception('Error al actualizar la empresa');
    }
} catch (PDOException $e) {
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>