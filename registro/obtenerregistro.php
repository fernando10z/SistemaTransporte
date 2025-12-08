<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $registroId = (int)$_GET['id'];
    
    try {
        $query = "SELECT 
                    rc.idregistrar,
                    c.nombre,
                    c.Apepat,
                    c.Apemat,
                    td.tipoDocumento,
                    c.numerodocumento,
                    cc.nombre_curso,
                    cc.entidad,
                    d.nota,
                    d.estado,
                    d.observaciones
                  FROM registrarcurso rc
                  JOIN conductores c ON rc.idConductor = c.idConductor
                  JOIN tipodocumento td ON c.idTipoDocumento = td.idTipoDocumento
                  JOIN cursos_conductor cc ON rc.idCurso = cc.idCurso
                  LEFT JOIN desempeno d ON rc.idregistrar = d.idregistrar
                  WHERE rc.idregistrar = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->execute([$registroId]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            echo json_encode($resultado);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Registro no encontrado']);
        }
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error en BD: ' . $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Solicitud inválida']);
}
?>