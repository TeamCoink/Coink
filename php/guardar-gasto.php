<?php

session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {

    header("Location: ../login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $usuarioId =
        $_SESSION['usuario_id'];

    $nombre =
        $_POST['nombre'];

    $categoria =
        $_POST['categoria'];

    $monto =
        $_POST['monto'];

    $fecha =
        $_POST['fecha'];

    $sql = "
    INSERT INTO gastos
    (usuario_id, nombre, categoria, monto, fecha)

    VALUES (?, ?, ?, ?, ?)
    ";

    $stmt =
        $conn->prepare($sql);

    $stmt->bind_param(
        "issds",
        $usuarioId,
        $nombre,
        $categoria,
        $monto,
        $fecha
    );

    if($stmt->execute()){

       header("Location: ../dashboard.php?guardado=gasto");

        exit();
    }
}
?>