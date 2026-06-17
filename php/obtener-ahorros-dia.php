<?php

session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    exit();
}

$usuarioId = $_SESSION['usuario_id'];

$fecha = $_GET['fecha'] ?? '';

$sql = "
SELECT nombre, categoria, monto
FROM ahorros
WHERE usuario_id = ?
AND DATE(fecha) = ?
ORDER BY id DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $usuarioId, $fecha);
$stmt->execute();

$result = $stmt->get_result();

$ahorros = [];

while($fila = $result->fetch_assoc()){
    $ahorros[] = $fila;
}

echo json_encode($ahorros);