<?php
session_start();


if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["error" => "No autorizado"]);
    exit();
}


$conexion = new mysqli("localhost", "root", "", "coink");

if ($conexion->connect_error) {
    die(json_encode(["error" => "Error de conexión"]));
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $datos = json_decode(file_get_contents("php://input"), true);
    if (!$datos) {
        $datos = $_POST; 
    }

    $idMeta = isset($datos['id']) ? intval($datos['id']) : 0;

    if ($idMeta > 0) {
        
        $sql = "DELETE FROM metas WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("i", $idMeta);
            if ($stmt->execute()) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["error" => "No se pudo eliminar de la base de datos"]);
            }
            $stmt->close();
        }
    } else {
        echo json_encode(["error" => "ID inválido"]);
    }
    
    $conexion->close();
    exit();
}


function json_parse($str) {
    return json_decode($str, true);
}
?>