<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validar datos requeridos
        $required = ['idMantenimiento', 'idVehiculo', 'tipo_mantenimiento', 'fecha_mantenimiento', 'fecha_proxima_mantenimiento', 'estado'];
        foreach($required as $field) {
            if(empty($_POST[$field])) {
                throw new Exception("El campo $field es requerido");
            }
        }
        
        // Preparar datos
        $data = [
            'idMantenimiento' => $_POST['idMantenimiento'],
            'idVehiculo' => $_POST['idVehiculo'],
            'tipo_mantenimiento' => $_POST['tipo_mantenimiento'],
            'descripcion' => $_POST['descripcion'] ?? null,
            'fecha_mantenimiento' => $_POST['fecha_mantenimiento'],
            'fecha_proxima_mantenimiento' => $_POST['fecha_proxima_mantenimiento'],
            'kilometraje' => $_POST['kilometraje'] ?? null,
            'costo' => $_POST['costo'] ?? null,
            'taller' => $_POST['taller'] ?? null,
            'observaciones' => $_POST['observaciones'] ?? null,
            'estado' => $_POST['estado']
        ];
        
        // Actualizar en la base de datos
        $sql = "UPDATE mantenimiento_vehiculo SET
                  idVehiculo = :idVehiculo,
                  tipo_mantenimiento = :tipo_mantenimiento,
                  descripcion = :descripcion,
                  fecha_mantenimiento = :fecha_mantenimiento,
                  fecha_proxima_mantenimiento = :fecha_proxima_mantenimiento,
                  kilometraje = :kilometraje,
                  costo = :costo,
                  taller = :taller,
                  observaciones = :observaciones,
                  estado = :estado
                WHERE idMantenimiento = :idMantenimiento";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
        
        echo json_encode([
            'success' => true,
            'message' => 'Mantenimiento actualizado correctamente'
        ]);
    } catch(Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
}
?>