<?php
require_once '../conexion/conexion.php';

header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Error desconocido'];

try {
    // Validar que se reciba el ID del proveedor
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new Exception("ID de proveedor no válido");
    }

    $idProveedor = intval($_GET['id']);

    // Consulta para obtener los datos del proveedor (excluyendo firma)
    $sql = "SELECT p.idProveedor, p.nombre_empresa, p.idTipoRuc, p.numero_ruc, 
                   p.contacto_nombre, p.contacto_telefono, p.contacto_correo,
                   p.idTipoDireccion, p.direccion, p.idGenero, p.estado,
                   tr.descripcion AS tipo_ruc_desc, 
                   td.tipoDireccion AS tipo_direccion_desc,
                   g.genero AS genero_desc
            FROM proveedores p
            LEFT JOIN tipo_ruc tr ON p.idTipoRuc = tr.idTipoRuc
            LEFT JOIN tipodireccion td ON p.idTipoDireccion = td.idTipoDireccion
            LEFT JOIN genero g ON p.idGenero = g.idGenero
            WHERE p.idProveedor = :idProveedor";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $proveedor = $stmt->fetch(PDO::FETCH_ASSOC);
        $response = [
            'status' => 'success',
            'data' => $proveedor
        ];
    } else {
        throw new Exception("Proveedor no encontrado");
    }
} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'message' => $e->getMessage()
    ];
} finally {
    if (isset($conn)) {
        $conn = null;
    }
    exit(json_encode($response));
}
?>