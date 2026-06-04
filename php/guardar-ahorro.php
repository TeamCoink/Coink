<?php
session_start();

// 1. Verificar si el usuario inició sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.html");
    exit();
}

// 2. Conectarse a la base de datos (Ajusta 'coink' si tu base de datos se llama diferente)
$conexion = new mysqli("localhost", "root", "", "coink");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 3. Procesar los datos que mandó el formulario tradicional
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recibir el ID de la meta y el monto a sumar
    $idMeta = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $montoAbono = isset($_POST['monto']) ? floatval($_POST['monto']) : 0;

    // Si los datos son válidos, hacemos la magia matemática en la base de datos
    if ($idMeta > 0 && $montoAbono > 0) {
        
        // Buscamos tu tabla de metas (asumiendo que se llama 'metas' como en tus otros archivos)
        // Esta consulta le SUMA directamente el abono al valor actual que ya tenía guardado
        $sql = "UPDATE metas SET actual = actual + ? WHERE id = ?";
        
        $stmt = $conexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("di", $montoAbono, $idMeta);
            $stmt->execute();
            $stmt->close();
        }
    }
    
    $conexion->close();

    // 4. ¡LA REDIRECCIÓN MÁGICA! Regresamos al usuario al detalle de su meta automáticamente
    header("Location: ../detalle-meta.php");
    exit();
}
?>