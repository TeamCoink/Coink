<?php
// Ajusta la ruta según dónde esté tu archivo conexion.php
include 'conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asegúrate que los "name" en tu formulario coincidan con estos
    $nombre    = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $monto     = $_POST['monto'];   // debe coincidir con name="monto"
    $fecha     = $_POST['fecha'];

    $sql = "INSERT INTO ahorro (nombre, categoria, monto, fecha) 
            VALUES ('$nombre', '$categoria', '$monto', '$fecha')";

    if ($conexion->query($sql) === TRUE) {
        echo "✅ Ahorro agregado con éxito";
        // header("Location: dashboard.php"); // si quieres redirigir
    } else {
        echo "Error: " . $conexion->error;
    }
}

$conexion->close();
?>
