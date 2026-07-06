<?php
session_start();
require "conexion.php";

header("Content-Type: application/json");


if(!isset($_SESSION["usuario_id"])){

    echo json_encode([
        "success" => false,
        "mensaje" => "Usuario no autenticado."
    ]);

    exit();

}

$usuario_id = $_SESSION["usuario_id"];



$datos = json_decode(file_get_contents("php://input"), true);

$ingreso = $datos["ingreso"];
$asignado = $datos["asignado"];
$disponible = $datos["disponible"];
$porcentaje = $datos["porcentaje"];
$categorias = $datos["categorias"];


$sqlBuscar = "SELECT id
              FROM presupuestos
              WHERE usuario_id = ?";

$stmtBuscar = $conn->prepare($sqlBuscar);
$stmtBuscar->bind_param("i",$usuario_id);
$stmtBuscar->execute();

$resultado = $stmtBuscar->get_result();


if($resultado->num_rows > 0){

    // Ya existe

    $fila = $resultado->fetch_assoc();

    $presupuesto_id = $fila["id"];

    $sqlActualizar = "

        UPDATE presupuestos

        SET

            ingreso = ?,
            asignado = ?,
            disponible = ?,
            porcentaje = ?

        WHERE id = ?

    ";

    $stmtActualizar = $conn->prepare($sqlActualizar);

    $stmtActualizar->bind_param(

        "ddddi",

        $ingreso,
        $asignado,
        $disponible,
        $porcentaje,
        $presupuesto_id

    );

    $stmtActualizar->execute();

}else{



    $sqlInsertar = "

        INSERT INTO presupuestos

        (usuario_id, ingreso, asignado, disponible, porcentaje)

        VALUES (?,?,?,?,?)

    ";

    $stmtInsertar = $conn->prepare($sqlInsertar);

    $stmtInsertar->bind_param(

        "idddd",

        $usuario_id,
        $ingreso,
        $asignado,
        $disponible,
        $porcentaje

    );

    $stmtInsertar->execute();

    $presupuesto_id = $conn->insert_id;

}



$sqlEliminar = "

    DELETE FROM presupuesto_categorias

    WHERE presupuesto_id = ?

";

$stmtEliminar = $conn->prepare($sqlEliminar);

$stmtEliminar->bind_param("i",$presupuesto_id);

$stmtEliminar->execute();


$sqlCategoria = "

    INSERT INTO presupuesto_categorias

    (presupuesto_id,nombre,emoji,monto)

    VALUES (?,?,?,?)

";

$stmtCategoria = $conn->prepare($sqlCategoria);

foreach($categorias as $categoria){

    $nombre = $categoria["nombre"];
    $emoji = $categoria["emoji"];
    $monto = $categoria["monto"];

    $stmtCategoria->bind_param(

        "issd",

        $presupuesto_id,
        $nombre,
        $emoji,
        $monto

    );

    $stmtCategoria->execute();

}

echo json_encode([

    "success" => true,

    "presupuesto_id" => $presupuesto_id,

    "mensaje" => "Presupuesto guardado correctamente."

]);

?>