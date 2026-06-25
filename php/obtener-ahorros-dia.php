<?php

session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    exit();
}

$usuarioId = $_SESSION['usuario_id'];
$fecha = $_GET['fecha'] ?? '';

$movimientos = [];

/* AHORROS */

$sqlAhorros = "
SELECT nombre, categoria, monto
FROM ahorros
WHERE usuario_id = ?
AND DATE(fecha) = ?
";

$stmtAhorros = $conn->prepare($sqlAhorros);
$stmtAhorros->bind_param("is", $usuarioId, $fecha);
$stmtAhorros->execute();

$resultAhorros = $stmtAhorros->get_result();

while($fila = $resultAhorros->fetch_assoc()){

    $fila['tipo'] = 'ahorro';

    $movimientos[] = $fila;
}


/* GASTOS */

$sqlGastos = "
SELECT nombre, categoria, monto
FROM gastos
WHERE usuario_id = ?
AND DATE(fecha) = ?
";

$stmtGastos = $conn->prepare($sqlGastos);
$stmtGastos->bind_param("is", $usuarioId, $fecha);
$stmtGastos->execute();

$resultGastos = $stmtGastos->get_result();

while($fila = $resultGastos->fetch_assoc()){

    $fila['tipo'] = 'gasto';

    $movimientos[] = $fila;
}

echo json_encode($movimientos);