<?php
include('../conexion/conexion.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Validar datos recibidos
        $requiredFields = ['idConductor', 'fecha_registro', 'motivojustificacion'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("El campo $field es requerido");
            }
        }

        // Validar archivo de imagen
        if (!isset($_FILES['fotojustificacion']) || $_FILES['fotojustificacion']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Debe subir una imagen de justificación válida");
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $fileType = $_FILES['fotojustificacion']['type'];
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Solo se permiten archivos JPG, JPEG o PNG");
        }

        if ($_FILES['fotojustificacion']['size'] > 2097152) { // 2MB
            throw new Exception("El archivo no debe exceder los 2MB");
        }

        // Obtener datos del conductor
        $stmt = $conn->prepare("SELECT 
                                CONCAT(c.nombre, ' ', c.Apepat, ' ', c.Apemat) as nombrecompleto,
                                CONCAT(td.tipoDocumento, ' ', c.numerodocumento) as documento
                            FROM conductores c
                            JOIN tipodocumento td ON c.idTipoDocumento = td.idTipoDocumento
                            WHERE c.idConductor = ?");
        $stmt->execute([$_POST['idConductor']]);
        $conductor = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$conductor) {
            throw new Exception("Conductor no encontrado");
        }

        // Guardar la imagen en el servidor
        $uploadDir = '../uploads/justificaciones/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileExt = pathinfo($_FILES['fotojustificacion']['name'], PATHINFO_EXTENSION);
        $fileName = 'justificacion_' . time() . '_' . $_POST['idConductor'] . '.' . $fileExt;
        $filePath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['fotojustificacion']['tmp_name'], $filePath)) {
            throw new Exception("Error al guardar la imagen en el servidor");
        }

        // Obtener el día de la semana en español
        $dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        $fecha = new DateTime($_POST['fecha_registro']);
        $nombreDia = $dias[$fecha->format('w')];

        // Insertar o actualizar en la tabla asistencia_conductores
        // Primero verificamos si ya existe un registro para esa fecha y conductor
        $stmt = $conn->prepare("SELECT idAsistencia FROM asistencia_conductores 
                               WHERE idConductor = ? AND DATE(fecha_registro) = ?");
        $stmt->execute([$_POST['idConductor'], $_POST['fecha_registro']]);
        $existeRegistro = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existeRegistro) {
            // Actualizar registro existente
            $stmt = $conn->prepare("UPDATE asistencia_conductores SET 
                                    motivojustificacion = ?,
                                    fotojusticicacion = ?,
                                    estado = 'Justificado',
                                    dia = ?,
                                    fecha_registro = ?,
                                    hora_entrada = '00:00:00',
                                    hora_salida = '00:00:00',
                                    horas_conducidas = 0,
                                    observaciones = 'Justificado por ausencia'
                                WHERE idAsistencia = ?");
            
            $stmt->execute([
                $_POST['motivojustificacion'],
                $fileName,
                $nombreDia,
                $_POST['fecha_registro'],
                $existeRegistro['idAsistencia']
            ]);
        } else {
            // Insertar nuevo registro
            $stmt = $conn->prepare("INSERT INTO asistencia_conductores (
                idConductor,
                dia,
                hora_entrada,
                hora_salida,
                horas_conducidas,
                motivojustificacion,
                fotojusticicacion,
                observaciones,
                estado,
                fecha_registro
            ) VALUES (
                :idConductor,
                :dia,
                '00:00:00',
                '00:00:00',
                0,
                :motivojustificacion,
                :fotojustificacion,
                'Justificado por ausencia',
                'Justificado',
                :fecha_registro
            )");
            
            $stmt->execute([
                ':idConductor' => $_POST['idConductor'],
                ':dia' => $nombreDia,
                ':motivojustificacion' => $_POST['motivojustificacion'],
                ':fotojustificacion' => $fileName,
                ':fecha_registro' => $_POST['fecha_registro']
            ]);
        }

        echo json_encode([
            'success' => true,
            'message' => 'Justificación registrada correctamente'
        ]);

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Método no permitido'
    ]);
}
?>