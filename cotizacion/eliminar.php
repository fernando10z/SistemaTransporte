<?php
require '../conexion/conexion.php';

if (isset($_POST['id'], $_POST['tipo'])) {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];

    $tabla = $tipo === 'cliente' ? 'cotizaciones_clientes' : 'cotizaciones_empresas';
    $columna = $tipo === 'cliente' ? 'idCotizacion' : 'idCotizacionEmpresa';

    $sql = "DELETE FROM $tabla WHERE $columna = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Cotización eliminada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo eliminar.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
?>
