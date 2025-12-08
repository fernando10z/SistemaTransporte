<?php
require_once '../conexion/conexion.php';          // tu archivo de conexión

header('Content-Type: application/json');

if (empty($_POST['id']) || !ctype_digit($_POST['id'])) {
    echo json_encode(['ok' => false, 'msg' => 'ID de registro no válido.']);
    exit;
}

$id = (int) $_POST['id'];

try {
    $conn->beginTransaction();        // 1) inicia transacción

    // 2) borra (o actualiza) desempeños asociados
    $stmt = $conn->prepare(
        "DELETE FROM desempeno WHERE idregistrar = :id"
    );
    $stmt->execute([':id' => $id]);

    // 3) borra el registro principal
    $stmt = $conn->prepare(
        "DELETE FROM registrarcurso WHERE idregistrar = :id"
    );
    $stmt->execute([':id' => $id]);

    $conn->commit();                  // 4) confirma
    echo json_encode(['ok' => true, 'msg' => 'Registro eliminado correctamente.']);

} catch (PDOException $e) {
    $conn->rollBack();
    // mensaje más amigable
    echo json_encode([
        'ok'  => false,
        'msg' => 'No se pudo eliminar: existen datos relacionados o el servidor tuvo un problema.'
    ]);
}
