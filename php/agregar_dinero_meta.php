<?php

session_start();
require 'conexion.php';

$idMeta = $_POST['id'];
$monto = $_POST['monto'];

$sql = "
UPDATE metas
SET actual = actual + ?
WHERE id = ?
AND usuario_id = ?
";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "dii",
    $monto,
    $idMeta,
    $_SESSION['usuario_id']
);

$stmt->execute();

header(
    "Location: ../detalle-meta.php"
);

exit();