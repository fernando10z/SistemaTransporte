<?php
include('../conexion/conexion.php');

// Asegurar que no haya salida antes de las cabeceras
if (ob_get_length()) ob_clean();

header('Content-Type: application/json; charset=utf-8');

try {
    // Verificar que sea una solicitud POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Método no permitido", 405);
    }

    // Obtener el contenido POST como JSON
    $input = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        $input = $_POST; // Fallback a POST normal
    }

    // Validar campos requeridos
    $required = ['idConductor', 'motivo', 'tipo_sancion', 'supervisor'];
    foreach ($required as $field) {
        if (empty($input[$field])) {
            throw new Exception("El campo $field es requerido", 400);
        }
    }

    // Procesar datos
    $data = [
        'idConductor' => (int)$input['idConductor'],
        'motivo' => trim($input['motivo']),
        'tipo_sancion' => $input['tipo_sancion'],
        'monto_multa' => ($input['tipo_sancion'] === 'Multa') ? (float)$input['monto_multa'] : 0,
        'fecha_inicio_sancion' => !empty($input['fecha_inicio_sancion']) ? $input['fecha_inicio_sancion'] : null,
        'fecha_fin_sancion' => !empty($input['fecha_fin_sancion']) ? $input['fecha_fin_sancion'] : null,
        'observaciones' => !empty($input['observaciones']) ? trim($input['observaciones']) : null,
        'supervisor' => trim($input['supervisor']),
        'estado' => !empty($input['estado']) ? $input['estado'] : 'Pendiente'
    ];

    // Validar monto si es multa
    if ($data['tipo_sancion'] === 'Multa' && $data['monto_multa'] <= 0) {
        throw new Exception("El monto de la multa debe ser mayor a 0", 400);
    }

    // Iniciar transacción
    $conn->beginTransaction();

    try {
        // Obtener próximo ID
        $stmt = $conn->query("SELECT IFNULL(MAX(idSancion), 0) + 1 FROM sanciones_conductores");
        $idSancion = (int)$stmt->fetchColumn();

        // Insertar registro
        $sql = "INSERT INTO sanciones_conductores (
                idSancion, idConductor, motivo, tipo_sancion, monto_multa,
                fecha_inicio_sancion, fecha_fin_sancion, observaciones, supervisor, estado
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $idSancion,
            $data['idConductor'],
            $data['motivo'],
            $data['tipo_sancion'],
            $data['monto_multa'],
            $data['fecha_inicio_sancion'],
            $data['fecha_fin_sancion'],
            $data['observaciones'],
            $data['supervisor'],
            $data['estado']
        ]);

        $conn->commit();

        // Respuesta exitosa en formato que espera el frontend
        $response = [
            'status' => 'success',
            'message' => 'Sanción registrada correctamente',
            'idSancion' => $idSancion
        ];

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    } catch (PDOException $e) {
        $conn->rollBack();
        throw new Exception("Error de base de datos: " . $e->getMessage(), 500);
    }

} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}

// Asegurar que no se envíe nada más después
exit;
?>