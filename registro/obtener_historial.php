<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

if (isset($_GET['idConductor'])) {
    $idConductor = $_GET['idConductor'];
    
    try {
        // Obtener información básica del conductor
        $sqlConductor = "SELECT 
                            c.idConductor,
                            c.nombre,
                            c.Apepat,
                            c.Apemat,
                            c.numerodocumento,
                            c.tipolicencia,
                            c.licencia,
                            c.estado,
                            td.tipoDocumento
                         FROM conductores c
                         JOIN tipodocumento td ON c.idTipoDocumento = td.idTipoDocumento
                         WHERE c.idConductor = :idConductor";
        
        $stmtConductor = $conn->prepare($sqlConductor);
        $stmtConductor->bindParam(':idConductor', $idConductor);
        $stmtConductor->execute();
        $conductor = $stmtConductor->fetch(PDO::FETCH_ASSOC);
        
        if (!$conductor) {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'Conductor no encontrado']);
            exit;
        }
        
        // Obtener todos sus cursos con desempeño
        $sqlCursos = "SELECT 
                         rc.idregistrar,
                         rc.estado as estado_registro,
                         rc.fechaInicio,
                         rc.fechaFinal,
                         c.nombre_curso,
                         c.entidad,
                         d.idDesempeno,
                         d.nota,
                         d.estado as estado_desempeno,
                         DATE_FORMAT(d.fecha_registro, '%Y-%m-%d %H:%i:%s') as fecha_registro
                      FROM registrarcurso rc
                      INNER JOIN cursos_conductor c ON rc.idCurso = c.idCurso
                      LEFT JOIN desempeno d ON rc.idregistrar = d.idregistrar
                      WHERE rc.idConductor = :idConductor
                      ORDER BY rc.fechaInicio DESC";
        
        $stmtCursos = $conn->prepare($sqlCursos);
        $stmtCursos->bindParam(':idConductor', $idConductor);
        $stmtCursos->execute();
        $cursos = $stmtCursos->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'conductor' => $conductor,
            'data' => $cursos
        ]);
        
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => 'Error en la base de datos',
            'details' => $e->getMessage()
        ]);
    }
} else {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'ID de conductor no proporcionado'
    ]);
}
?>