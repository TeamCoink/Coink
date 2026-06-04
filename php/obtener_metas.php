<?php
// obtener_metas.php
session_start();
require 'conexion.php'; // Asegúrate de que este sea el nombre correcto de tu archivo

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode([]); // Si no hay sesión, devolvemos lista vacía
    exit();
}

$usuarioId = $_SESSION['usuario_id'];

// Consultamos solo las metas del usuario que inició sesión
$stmt = $pdo->prepare("SELECT id, nombre, objetivo, actual FROM metas WHERE usuario_id = ?");
$stmt->execute([$usuarioId]);
$metas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Enviamos los datos en formato JSON para que JavaScript los entienda
header('Content-Type: application/json');
echo json_encode($metas);
?>