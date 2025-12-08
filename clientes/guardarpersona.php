<?php
require_once '../conexion/conexion.php';

// Limpiar buffer y configurar headers
while (ob_get_level()) ob_end_clean();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/json; charset=utf-8");

$response = ['success' => false, 'message' => ''];

try {
    $data = [
        'nombre' => trim($_POST['nombre'] ?? ''),
        'apellidopat' => trim($_POST['apellidopat'] ?? ''),
        'apellidoMat' => trim($_POST['apellidoMat'] ?? ''),
        'idGenero' => intval($_POST['idGenero'] ?? 0),
        'idTipoDocumento' => intval($_POST['idTipoDocumento'] ?? 0),
        'numerodocumento' => trim($_POST['numerodocumento'] ?? ''),
        'idTipoDireccion' => intval($_POST['idTipoDireccion'] ?? 0),
        'direccion' => trim($_POST['direccion'] ?? ''),
        'telefono' => trim($_POST['telefono'] ?? ''),
        'correo' => filter_var(trim($_POST['correo'] ?? ''), FILTER_SANITIZE_EMAIL),
        'status' => in_array($_POST['status'] ?? '', ['Activo', 'Inactivo']) ? $_POST['status'] : 'Activo'
    ];

    // Validaciones
    if (empty($data['nombre'])) throw new Exception('El nombre es obligatorio');
    if (empty($data['idTipoDocumento'])) throw new Exception('El tipo de documento es obligatorio');
    if (empty($data['numerodocumento'])) throw new Exception('El número de documento es obligatorio');

    // Validar longitud del documento según tipo
    if ($data['idTipoDocumento'] == 1 && strlen($data['numerodocumento']) != 8) {
        throw new Exception('El DNI debe tener 8 dígitos');
    } elseif (($data['idTipoDocumento'] == 2 || $data['idTipoDocumento'] == 3) && strlen($data['numerodocumento']) != 12) {
        throw new Exception('El documento debe tener 12 dígitos');
    }

    // Verificar si el documento ya existe
    $stmt = $conn->prepare("SELECT idCliente FROM clientes_naturales WHERE idTipoDocumento = :tipo AND numerodocumento = :doc AND idCliente != :id");
    $stmt->execute([
        ':tipo' => $data['idTipoDocumento'], 
        ':doc' => $data['numerodocumento'],
        ':id' => $_POST['idCliente'] ?? 0
    ]);
    if ($stmt->fetch()) throw new Exception('El número de documento ya está registrado');

    // Procesar la imagen de firma
    $firmaPath = '';
    if (!empty($_FILES['firmas']['name'])) {
        $uploadDir = '../uploads/firmas/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileExt = pathinfo($_FILES['firmas']['name'], PATHINFO_EXTENSION);
        $fileName = 'firma_' . time() . '_' . uniqid() . '.' . $fileExt;
        $targetFile = $uploadDir . $fileName;

        // Validar tipo de archivo
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['firmas']['type'], $allowedTypes)) {
            throw new Exception('Solo se permiten imágenes JPG, PNG o GIF');
        }

        // Validar tamaño (2MB máximo)
        if ($_FILES['firmas']['size'] > 2 * 1024 * 1024) {
            throw new Exception('El tamaño máximo permitido es 2MB');
        }

        // Mover el archivo
        if (move_uploaded_file($_FILES['firmas']['tmp_name'], $targetFile)) {
            $firmaPath = $fileName;
        } else {
            throw new Exception('Error al subir el archivo de firma');
        }
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO clientes_naturales (
        nombre, apellidopat, apellidoMat, idGenero, idTipoDocumento, 
        numerodocumento, idTipoDireccion, direccion, telefono, correo, 
        firmas, status
    ) VALUES (
        :nombre, :apellidopat, :apellidoMat, :idGenero, :idTipoDocumento, 
        :numerodocumento, :idTipoDireccion, :direccion, :telefono, :correo, 
        :firmas, :status
    )";
    
    $data['firmas'] = $firmaPath;
    
    $stmt = $conn->prepare($sql);
    if ($stmt->execute($data)) {
        $response['success'] = true;
        $response['message'] = 'Cliente natural registrado correctamente';
        $response['id'] = $conn->lastInsertId();
    } else {
        // Eliminar la imagen si hubo error en la base de datos
        if (!empty($firmaPath)) {
            @unlink($uploadDir . $firmaPath);
        }
        throw new Exception('Error al guardar en la base de datos');
    }

} catch (PDOException $e) {
    $response['message'] = 'Error en la base de datos: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
exit();
?>