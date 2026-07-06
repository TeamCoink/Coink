<?php
session_start();
require "conexion.php";

header("Content-Type: application/json");


if(!isset($_SESSION["usuario_id"])){

    echo json_encode([
        "success"=>false
    ]);

    exit();

}

$usuario_id = $_SESSION["usuario_id"];


$sql = "

SELECT *

FROM presupuestos

WHERE usuario_id = ?

";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i",$usuario_id);

$stmt->execute();

$resultado = $stmt->get_result();

if($resultado->num_rows == 0){

    echo json_encode([

        "success"=>false,

        "mensaje"=>"No existe presupuesto."

    ]);

    exit();

}

$presupuesto = $resultado->fetch_assoc();

$presupuesto_id = $presupuesto["id"];


$sqlCategorias = "

SELECT nombre,emoji,monto

FROM presupuesto_categorias

WHERE presupuesto_id = ?

";

$stmtCategorias = $conn->prepare($sqlCategorias);

$stmtCategorias->bind_param("i",$presupuesto_id);

$stmtCategorias->execute();

$resultadoCategorias = $stmtCategorias->get_result();

$categorias = [];

while($fila = $resultadoCategorias->fetch_assoc()){

    $categorias[] = $fila;

}


echo json_encode([

    "success"=>true,

    "presupuesto"=>[

        "ingreso"=>$presupuesto["ingreso"],

        "asignado"=>$presupuesto["asignado"],

        "disponible"=>$presupuesto["disponible"],

        "porcentaje"=>$presupuesto["porcentaje"],

        "categorias"=>$categorias

    ]

]);