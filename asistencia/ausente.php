<?php
include("../conexion/conexion.php"); // conexión PDO desde tu archivo

function registrarAusentesAutomatico($conn) {
    date_default_timezone_set('America/Lima'); // zona horaria de Perú

    $horaActual = date('H:i');
    $horaSolo = date('H'); // Solo hora (00 a 23)
    $fechaHoy = date('Y-m-d');

    // Ejecutar solo entre 12:00-12:59 o 18:00-18:59
    if (($horaSolo == '12') || ($horaSolo == '18')) {

        // Obtener todos los conductores (activos e inactivos)
        $stmtConductores = $conn->prepare("SELECT idConductor FROM conductores");
        $stmtConductores->execute();
        $conductores = $stmtConductores->fetchAll(PDO::FETCH_ASSOC);

        $contadorInsertados = 0;
        foreach ($conductores as $conductor) {
            $idConductor = $conductor['idConductor'];

            // Verificar si YA tiene un registro de asistencia hoy
            $stmtAsistencia = $conn->prepare("
                SELECT COUNT(*) as total 
                FROM asistencia_conductores 
                WHERE idConductor = :idConductor 
                  AND dia = :dia
                  AND estado IN ('Ingreso', 'Justificado', 'Ausente')
            ");
            $stmtAsistencia->execute([
                ':idConductor' => $idConductor,
                ':dia' => $fechaHoy
            ]);
            $asistencia = $stmtAsistencia->fetch(PDO::FETCH_ASSOC);

            if ($asistencia['total'] == 0) {
                // Insertar registro Ausente
                $stmtInsert = $conn->prepare("INSERT INTO asistencia_conductores 
                    (idConductor, dia, hora_entrada, hora_salida, horas_conducidas, motivojustificacion, fotojusticicacion, observaciones, estado)
                    VALUES 
                    (:idConductor, :dia, '00:00:00', '00:00:00', 0, 'No asistió', 'N/A', 'Registro automático por ausencia', 'Ausente')");
                
                $stmtInsert->execute([
                    ':idConductor' => $idConductor,
                    ':dia' => $fechaHoy
                ]);
                $contadorInsertados++;
            }
        }

        echo "✅ Proceso finalizado: Se insertaron $contadorInsertados ausentes automáticos para $fechaHoy.\n";
    } else {
        echo "⛔ Este script solo puede ejecutarse entre las 12:00-12:59 o 18:00-18:59. Hora actual: $horaActual\n";
    }
}

// Ejecutar la función
registrarAusentesAutomatico($conn);
?>
