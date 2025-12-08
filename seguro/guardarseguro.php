<?php
require '../conexion/conexion.php';

// Configurar cabeceras para JSON
header('Content-Type: application/json; charset=utf-8');

// Función para enviar respuestas estandarizadas
function jsonResponse($success, $message = '', $data = []) {
    http_response_code($success ? 200 : 400);
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    // Verificar que sea una petición POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        jsonResponse(false, 'Método no permitido');
    }

    // Validar campos requeridos
    $required = [
        'idVehiculo' => 'Vehículo',
        'codigo' => 'Código',
        'nombre_seguro' => 'Nombre del seguro',
        'numero_poliza' => 'Número de póliza',
        'fecha_inicio' => 'Fecha de inicio',
        'fecha_vencimiento' => 'Fecha de vencimiento',
        'estado' => 'Estado'
    ];

    $missing = [];
    foreach ($required as $field => $name) {
        if (empty($_POST[$field])) {
            $missing[] = $name;
        }
    }

    if (!empty($missing)) {
        jsonResponse(false, 'Faltan campos obligatorios: ' . implode(', ', $missing));
    }

    // Validar fechas
    $fechaInicio = DateTime::createFromFormat('Y-m-d', $_POST['fecha_inicio']);
    $fechaVencimiento = DateTime::createFromFormat('Y-m-d', $_POST['fecha_vencimiento']);

    if (!$fechaInicio || !$fechaVencimiento) {
        jsonResponse(false, 'Formato de fecha incorrecto. Use YYYY-MM-DD');
    }

    if ($fechaInicio > $fechaVencimiento) {
        jsonResponse(false, 'La fecha de inicio no puede ser mayor a la de vencimiento');
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO seguros_vehiculo (
            idVehiculo, codigo, nombre_seguro, numero_poliza, 
            fecha_inicio, fecha_vencimiento, observaciones, estado, fecha_registro
        ) VALUES (
            :idVehiculo, :codigo, :nombre_seguro, :numero_poliza, 
            :fecha_inicio, :fecha_vencimiento, :observaciones, :estado, NOW()
        )";

    $stmt = $conn->prepare($sql);

    // Asignar valores con tipo de datos
    $stmt->bindValue(':idVehiculo', $_POST['idVehiculo'], PDO::PARAM_INT);
    $stmt->bindValue(':codigo', $_POST['codigo'], PDO::PARAM_STR);
    $stmt->bindValue(':nombre_seguro', $_POST['nombre_seguro'], PDO::PARAM_STR);
    $stmt->bindValue(':numero_poliza', $_POST['numero_poliza'], PDO::PARAM_STR);
    $stmt->bindValue(':fecha_inicio', $_POST['fecha_inicio'], PDO::PARAM_STR);
    $stmt->bindValue(':fecha_vencimiento', $_POST['fecha_vencimiento'], PDO::PARAM_STR);
    $stmt->bindValue(':observaciones', !empty($_POST['observaciones']) ? $_POST['observaciones'] : null, PDO::PARAM_STR);
    $stmt->bindValue(':estado', $_POST['estado'], PDO::PARAM_STR);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $idInsertado = $conn->lastInsertId();
        jsonResponse(true, 'Seguro registrado exitosamente', ['id' => $idInsertado]);
    } else {
        $error = $stmt->errorInfo();
        jsonResponse(false, 'Error al guardar en la base de datos: ' . $error[2]);
    }
} catch (PDOException $e) {
    jsonResponse(false, 'Error de base de datos: ' . $e->getMessage());
} catch (Exception $e) {
    jsonResponse(false, 'Error general: ' . $e->getMessage());
}
?>