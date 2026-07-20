<?php
session_start();
require 'conexion.php'; 

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode([]);
    exit();
}

$stmt = $conn->prepare("SELECT id, nombre, objetivo, actual FROM metas WHERE usuario_id = ?");
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();
$result = $stmt->get_result();
$metas = $result->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/json');
echo json_encode($metas);
?>