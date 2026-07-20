<?php
session_start();
require 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);
if (isset($data['nombre']) && isset($data['objetivo'])) {
    $stmt = $conn->prepare("INSERT INTO metas (usuario_id, nombre, objetivo, actual) VALUES (?, ?, ?, 0)");
    $stmt->bind_param("isd", $_SESSION['usuario_id'], $data['nombre'], $data['objetivo']);
    $stmt->execute();
    echo json_encode(["success" => true]);
}
?>