<?php
include '../conexion/conexion.php';

// Limpiamos cualquier output previo
ob_clean();

// Forzamos el tipo de contenido a JSON
header('Content-Type: application/json');

// Verificamos que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

try {
    // Validamos los datos recibidos
    $required_fields = ['nombre_empresa'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(['error' => 'El campo ' . $field . ' es obligatorio']);
            exit;
        }
    }

    $nombre_empresa = $_POST['nombre_empresa'];
    $ruc = $_POST['ruc'] ?? null;
    $direccion = $_POST['direccion'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $correo = $_POST['correo'] ?? null;
    $firma = null;
    $logo = null;

    // Directorio donde se guardarán los archivos
    $upload_dir = '../configuracion/empresa/';
    
    // Crear directorio si no existe
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Manejo de la firma
    if (isset($_FILES['firmas']) && $_FILES['firmas']['error'] === UPLOAD_ERR_OK) {
        $extension = pathinfo($_FILES['firmas']['name'], PATHINFO_EXTENSION);
        $firma_nombre = 'firma_' . uniqid() . '.' . $extension;
        $destino = $upload_dir . $firma_nombre;
        
        // Validar tipo de archivo
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['firmas']['type'], $allowed_types)) {
            echo json_encode(['error' => 'Tipo de archivo no permitido para la firma']);
            exit;
        }
        
        // Validar tamaño (2MB máximo)
        if ($_FILES['firmas']['size'] > 2097152) {
            echo json_encode(['error' => 'El archivo de firma excede el tamaño máximo de 2MB']);
            exit;
        }
        
        if (move_uploaded_file($_FILES['firmas']['tmp_name'], $destino)) {
            $firma = $firma_nombre;
        }
    }

    // Manejo del logo
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $logo_nombre = 'logo_' . uniqid() . '.' . $extension;
        $destino = $upload_dir . $logo_nombre;
        
        // Validar tipo de archivo
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['logo']['type'], $allowed_types)) {
            echo json_encode(['error' => 'Tipo de archivo no permitido para el logo']);
            exit;
        }
        
        // Validar tamaño (2MB máximo)
        if ($_FILES['logo']['size'] > 2097152) {
            echo json_encode(['error' => 'El archivo de logo excede el tamaño máximo de 2MB']);
            exit;
        }
        
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $destino)) {
            $logo = $logo_nombre;
        }
    }

    // Inserción en la base de datos
    $sql = "INSERT INTO configuracion_empresa (
            nombre_empresa,
            ruc,
            direccion,
            telefono,
            correo,
            firmas,
            logo,
            fecha_registro
        ) VALUES (
            :nombre_empresa,
            :ruc,
            :direccion,
            :telefono,
            :correo,
            :firmas,
            :logo,
            CURRENT_TIMESTAMP
        )";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre_empresa', $nombre_empresa);
    $stmt->bindParam(':ruc', $ruc);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':firmas', $firma);
    $stmt->bindParam(':logo', $logo);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Configuración registrada correctamente']);
    } else {
        echo json_encode(['error' => 'Error al ejecutar la consulta SQL']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de base de datos: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error general: ' . $e->getMessage()]);
}
?>