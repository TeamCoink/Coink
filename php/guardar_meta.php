<?php
// guardar_meta.php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'No autorizado']);
    exit();
}

// Recibimos los datos del formulario
$input = json_decode(file_get_contents('php://input'), true);
$usuario_id = $_SESSION['usuario_id'];
$nombre = $input['nombre'];
$objetivo = $input['objetivo'];

// Preparamos la consulta
$sql = "INSERT INTO metas (usuario_id, nombre, objetivo) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$usuario_id, $nombre, $objetivo])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Error al guardar']);
}
?>