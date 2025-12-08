<?php
require_once '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProveedor = $_POST['id'];

    try {
        // Obtener la firma antes de eliminar
        $stmt = $conn->prepare("SELECT firma FROM proveedores WHERE idProveedor = :id");
        $stmt->bindParam(':id', $idProveedor);
        $stmt->execute();
        $proveedor = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($proveedor) {
            // Eliminar archivo de firma si existe
            if (!empty($proveedor['firma']) && file_exists($proveedor['firma'])) {
                unlink($proveedor['firma']);
            }

            // Eliminar proveedor de la BD
            $delete = $conn->prepare("DELETE FROM proveedores WHERE idProveedor = :id");
            $delete->bindParam(':id', $idProveedor);
            $delete->execute();

            echo json_encode([
                'status' => 'success',
                'message' => 'Proveedor eliminado correctamente.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Proveedor no encontrado.'
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error al eliminar: ' . $e->getMessage()
        ]);
    }
}
?>
