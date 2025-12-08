<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Error desconocido'];

try {
    // Validar método de solicitud
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método no permitido", 405);
    }

    // Validar datos requeridos
    $required = ['idProveedor', 'nombre_empresa', 'idTipoRuc', 'numero_ruc', 'idTipoDireccion'];
    foreach ($required as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            throw new Exception("El campo $field es requerido");
        }
    }

    // Sanitizar inputs
    $idProveedor = intval($_POST['idProveedor']);
    $nombre_empresa = trim($_POST['nombre_empresa']);
    $idTipoRuc = intval($_POST['idTipoRuc']);
    $numero_ruc = trim($_POST['numero_ruc']);
    $idTipoDireccion = intval($_POST['idTipoDireccion']);

    // Validar RUC (11 dígitos)
    if (!preg_match('/^\d{11}$/', $numero_ruc)) {
        throw new Exception("El RUC debe tener exactamente 11 dígitos");
    }

    // Validar teléfono (9 dígitos si está presente)
    $contacto_telefono = isset($_POST['contacto_telefono']) ? trim($_POST['contacto_telefono']) : '';
    if (!empty($contacto_telefono) && !preg_match('/^\d{9}$/', $contacto_telefono)) {
        throw new Exception("El teléfono debe tener exactamente 9 dígitos");
    }

    // Validar email si está presente
    $contacto_correo = isset($_POST['contacto_correo']) ? trim($_POST['contacto_correo']) : '';
    if (!empty($contacto_correo) && !filter_var($contacto_correo, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Ingrese un correo electrónico válido");
    }

    // Preparar datos para la base de datos (sin incluir firma)
    $data = [
        ':idProveedor' => $idProveedor,
        ':nombre_empresa' => $nombre_empresa,
        ':idTipoRuc' => $idTipoRuc,
        ':numero_ruc' => $numero_ruc,
        ':contacto_nombre' => isset($_POST['contacto_nombre']) ? trim($_POST['contacto_nombre']) : null,
        ':contacto_telefono' => !empty($contacto_telefono) ? $contacto_telefono : null,
        ':contacto_correo' => !empty($contacto_correo) ? $contacto_correo : null,
        ':idTipoDireccion' => $idTipoDireccion,
        ':direccion' => isset($_POST['direccion']) ? trim($_POST['direccion']) : null,
        ':idGenero' => isset($_POST['idGenero']) ? intval($_POST['idGenero']) : null,
        ':estado' => isset($_POST['estado']) ? trim($_POST['estado']) : 'Activo'
    ];

    // Query de actualización (sin incluir firma)
    $sql = "UPDATE proveedores SET 
            nombre_empresa = :nombre_empresa,
            idTipoRuc = :idTipoRuc,
            numero_ruc = :numero_ruc,
            contacto_nombre = :contacto_nombre,
            contacto_telefono = :contacto_telefono,
            contacto_correo = :contacto_correo,
            idTipoDireccion = :idTipoDireccion,
            direccion = :direccion,
            idGenero = :idGenero,
            estado = :estado
            WHERE idProveedor = :idProveedor";

    $stmt = $conn->prepare($sql);
    if ($stmt->execute($data)) {
        $response = [
            'status' => 'success',
            'message' => 'Proveedor actualizado exitosamente',
            'id' => $idProveedor
        ];
    } else {
        throw new Exception("Error al actualizar en la base de datos: " . implode(" ", $stmt->errorInfo()));
    }
} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'message' => $e->getMessage(),
        'code' => $e->getCode()
    ];
} finally {
    if (isset($conn)) {
        $conn = null;
    }
    exit(json_encode($response));
}
?>