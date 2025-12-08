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
    $required = ['nombre_empresa', 'idTipoRuc', 'numero_ruc', 'idTipoDireccion'];
    foreach ($required as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            throw new Exception("El campo $field es requerido");
        }
    }

    // Sanitizar inputs
    $nombre_empresa = trim($_POST['nombre_empresa']);
    $idTipoRuc = intval($_POST['idTipoRuc']);
    $numero_ruc = trim($_POST['numero_ruc']);
    $idTipoDireccion = intval($_POST['idTipoDireccion']);
    $idProveedor = isset($_POST['idProveedor']) ? intval($_POST['idProveedor']) : null;

    // Validar RUC (11 dígitos)
    if (!preg_match('/^\d{11}$/', $numero_ruc)) {
        throw new Exception("El RUC debe tener exactamente 11 dígitos");
    }

    // Verificar si el RUC ya existe (excepto para el proveedor actual que se está editando)
    $sqlVerificar = "SELECT idProveedor FROM proveedores 
                    WHERE idTipoRuc = :idTipoRuc 
                    AND numero_ruc = :numero_ruc";
    
    if ($idProveedor) {
        $sqlVerificar .= " AND idProveedor != :idProveedor";
    }

    $stmtVerificar = $conn->prepare($sqlVerificar);
    $stmtVerificar->bindParam(':idTipoRuc', $idTipoRuc, PDO::PARAM_INT);
    $stmtVerificar->bindParam(':numero_ruc', $numero_ruc, PDO::PARAM_STR);
    
    if ($idProveedor) {
        $stmtVerificar->bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
    }

    $stmtVerificar->execute();

    if ($stmtVerificar->rowCount() > 0) {
        throw new Exception("Ya existe un proveedor con este tipo y número de RUC");
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

    // Procesar archivo de firma (solo para nuevo registro)
    $firma = null;
    if (empty($idProveedor)) {
        if (!empty($_FILES['firma']['name'])) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'];
            $fileExt = strtolower(pathinfo($_FILES['firma']['name'], PATHINFO_EXTENSION));
            
            if (!in_array($fileExt, $allowed)) {
                throw new Exception("Tipo de archivo no permitido. Formatos aceptados: " . implode(', ', $allowed));
            }
            
            $uploadDir = 'uploads/firmas/';
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0755, true)) {
                    throw new Exception("No se pudo crear el directorio para las firmas");
                }
            }
            
            $fileName = uniqid('firma_', true) . '.' . $fileExt;
            $uploadPath = $uploadDir . $fileName;
            
            if (!move_uploaded_file($_FILES['firma']['tmp_name'], $uploadPath)) {
                throw new Exception("Error al subir el archivo de firma");
            }
            
            $firma = $uploadPath;
        }
    }

    // Preparar datos para la base de datos
    $data = [
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

    // Determinar si es inserción o actualización
    if (empty($idProveedor)) {
        // Insertar nuevo proveedor
        $data[':firma'] = $firma;
        $sql = "INSERT INTO proveedores (nombre_empresa, idTipoRuc, numero_ruc, contacto_nombre, 
                contacto_telefono, contacto_correo, firma, idTipoDireccion, direccion, idGenero, estado)
                VALUES (:nombre_empresa, :idTipoRuc, :numero_ruc, :contacto_nombre, 
                :contacto_telefono, :contacto_correo, :firma, :idTipoDireccion, :direccion, :idGenero, :estado)";
    } else {
        // Actualizar proveedor existente
        $data[':idProveedor'] = $idProveedor;
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
    }

    $stmt = $conn->prepare($sql);
    if ($stmt->execute($data)) {
        $response = [
            'status' => 'success',
            'message' => empty($idProveedor) ? 'Proveedor registrado exitosamente' : 'Proveedor actualizado exitosamente',
            'id' => empty($idProveedor) ? $conn->lastInsertId() : $idProveedor
        ];
    } else {
        throw new Exception("Error al guardar en la base de datos: " . implode(" ", $stmt->errorInfo()));
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