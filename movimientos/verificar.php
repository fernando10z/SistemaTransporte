<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

// Tu conexión ya existe en otro archivo, no es necesario incluirla aquí

try {
    // Consulta para movimientos pendientes
    $sql = "SELECT 
                mp.idMovimiento,
                a.nombre AS nombreAlmacen,
                c.nombreCategoria,
                s.nomArea AS subcategoria,
                p.codigoProducto,
                p.nombreProducto,
                p.stock_minimo,
                p.stock,
                mp.stock_final,
                mp.motivo,
                mp.tipo,
                mp.fecha_movimiento
            FROM movimiento_producto mp
            JOIN producto p ON mp.idProducto = p.idProducto
            JOIN almacen a ON p.idAlmacen = a.idAlmacen
            JOIN categoria_producto c ON p.idCategoria = c.idCategoria
            JOIN subcategoria s ON p.idsubcategoria = s.idsubcategoria
            WHERE mp.motivo IN ('En tránsito', 'Pendiente revisión', 'Traslado')
            ORDER BY mp.fecha_movimiento DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $movimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Agrupar por motivo
    $alertas = [];
    foreach ($movimientos as $mov) {
        $tipoAlerta = '';
        switch ($mov['motivo']) {
            case 'En tránsito':
                $tipoAlerta = 'transito';
                break;
            case 'Pendiente revisión':
                $tipoAlerta = 'revision';
                break;
            case 'Traslado':
                $tipoAlerta = 'traslado';
                break;
        }

        $alertas[$tipoAlerta][] = [
            'idMovimiento' => $mov['idMovimiento'],
            'codigoProducto' => $mov['codigoProducto'],
            'nombreProducto' => $mov['nombreProducto'],
            'almacen' => $mov['nombreAlmacen'],
            'categoria' => $mov['nombreCategoria'],
            'subcategoria' => $mov['subcategoria'],
            'motivo' => $mov['motivo'],
            'tipo' => $mov['tipo'],
            'fecha' => $mov['fecha_movimiento'],
            'stock_final' => $mov['stock_final']
        ];
    }

    echo json_encode(['alertas' => $alertas]);

} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}