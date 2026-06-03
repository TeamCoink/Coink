<?php
session_start();
include("conexion.php");

// verificar si hay sesión iniciada
if (!isset($_SESSION['usuario_id'])) {
    die("Usuario no autenticado");
}

$usuario_id = $_SESSION['usuario_id'];

// obtener datos del formulario
$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];
$monto = $_POST['monto'];
$fecha = $_POST['fecha'];

// consulta SQL
$sql = "INSERT INTO ahorros 
(usuario_id, nombre, categoria, monto, fecha) 
VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "issds",
    $usuario_id,
    $nombre,
    $categoria,
    $monto,
    $fecha
);

if ($stmt->execute()) {
    header("Location: ../dashboard.php");
    exit();
} else {
    echo "Error al guardar ahorro";
}

$stmt->close();
$conn->close();
?>