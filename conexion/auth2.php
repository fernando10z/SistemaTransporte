<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

$response = [
    'logged_in' => false,
    'is_admin' => false,
];

if (isset($_SESSION['idRol'])) {
    $response['logged_in'] = true;
    $response['is_admin'] = ($_SESSION['idRol'] == 1);
}

echo json_encode($response);
