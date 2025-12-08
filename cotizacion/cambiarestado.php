<?php
require '../conexion/conexion.php';

if (isset($_POST['id'], $_POST['tipo'])) {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];

    $tabla = $tipo === 'cliente' ? 'cotizaciones_clientes' : 'cotizaciones_empresas';
    $columna = $tipo === 'cliente' ? 'idCotizacion' : 'idCotizacionEmpresa';

    $sql = "UPDATE $tabla SET estado = 'Aceptada' WHERE $columna = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Estado actualizado correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo actualizar.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
?>
