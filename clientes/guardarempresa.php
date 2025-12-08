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
        'razonSocial' => trim($_POST['razonSocial'] ?? ''),
        'ruc' => trim($_POST['ruc'] ?? ''),
        'idTipoRuc' => intval($_POST['idTipoRuc'] ?? 0),
        'idTipoDireccion' => intval($_POST['idTipoDireccion'] ?? 0),
        'direccion' => trim($_POST['direccion'] ?? ''),
        'telefono' => trim($_POST['telefono'] ?? ''),
        'correo' => filter_var(trim($_POST['correo'] ?? ''), FILTER_SANITIZE_EMAIL),
        'status' => in_array($_POST['status'] ?? '', ['Activo', 'Inactivo']) ? $_POST['status'] : 'Activo'
    ];

    // Validaciones
    if (empty($data['razonSocial'])) throw new Exception('La razón social es obligatoria');
    if (empty($data['ruc'])) throw new Exception('El RUC es obligatorio');
    if (strlen($data['ruc']) != 11) throw new Exception('El RUC debe tener 11 dígitos');
    if (empty($data['idTipoRuc'])) throw new Exception('El tipo de RUC es obligatorio');

    // Verificar si el RUC ya existe
    $stmt = $conn->prepare("SELECT idEmpresa FROM clientes_empresas WHERE ruc = :ruc AND idEmpresa != :id");
    $stmt->execute([
        ':ruc' => $data['ruc'],
        ':id' => $_POST['idCliente'] ?? 0
    ]);
    if ($stmt->fetch()) throw new Exception('El RUC ya está registrado');

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
    $sql = "INSERT INTO clientes_empresas (
        razonSocial, ruc, idTipoRuc, idTipoDireccion, 
        direccion, telefono, correo, firmas, status
    ) VALUES (
        :razonSocial, :ruc, :idTipoRuc, :idTipoDireccion, 
        :direccion, :telefono, :correo, :firmas, :status
    )";
    
    $data['firmas'] = $firmaPath;
    
    $stmt = $conn->prepare($sql);
    if ($stmt->execute($data)) {
        $response['success'] = true;
        $response['message'] = 'Empresa registrada correctamente';
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