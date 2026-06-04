<?php
session_start();

// 1. Verificar si el usuario inició sesión
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["error" => "No autorizado"]);
    exit();
}

// 2. Conectarse a la base de datos
$conexion = new mysqli("localhost", "root", "", "coink");

if ($conexion->connect_error) {
    die(json_encode(["error" => "Error de conexión"]));
}

// 3. Procesar la petición de eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leer los datos JSON enviados por JavaScript
    $datos = json_decode(file_get_contents("php://input"), true);
    if (!$datos) {
        $datos = $_POST; // Por si acaso se envía como formulario tradicional
    }

    $idMeta = isset($datos['id']) ? intval($datos['id']) : 0;

    if ($idMeta > 0) {
        // Eliminar la meta que coincida con el ID
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

// Función auxiliar por si file_get_contents no parsea directo
function json_parse($str) {
    return json_decode($str, true);
}
?>