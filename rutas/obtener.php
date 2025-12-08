<?php
include '../conexion/conexion.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['idRuta']) || empty($_GET['idRuta'])) {
        throw new Exception("El ID de la ruta es requerido");
    }

    $idRuta = $_GET['idRuta'];

    // Consulta modificada con JOIN para obtener el nombreZona
    $sql = "SELECT r.*, z.nombreZona 
            FROM rutas r
            LEFT JOIN zonas_cobertura z ON r.idZona = z.idZona
            WHERE r.idRuta = :idRuta";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idRuta', $idRuta);
    $stmt->execute();
    
    $ruta = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($ruta) {
        // Corregir posible typo en el nombre de la columna (nombreZona vs nombreZona)
        if (isset($ruta['nombreZona'])) {
            $ruta['nombreZona'] = $ruta['nombreZona'];
        } else {
            $ruta['nombreZona'] = "Zona no especificada";
        }
        
        echo json_encode([
            'success' => true,
            'data' => $ruta
        ]);
    } else {
        throw new Exception("No se encontró la ruta con el ID proporcionado");
    }
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error de base de datos: ' . $e->getMessage()
    ]);
} catch(Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>