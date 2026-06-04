<?php
session_start();
require 'conexion.php';

// Filtramos por ID de meta Y por usuario logueado para mayor seguridad
$stmt = $conn->prepare("SELECT * FROM metas WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $_GET['id'], $_SESSION['usuario_id']);
$stmt->execute();
echo json_encode($stmt->get_result()->fetch_assoc());
?>