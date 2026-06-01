<?php
include 'conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre    = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $monto     = $_POST['monto'];
    $fecha     = $_POST['fecha'];


    $user_id = $_SESSION['user_id']; 

    $sql = "INSERT INTO ahorro (user_id, nombre, categoria, monto, fecha) 
            VALUES ('$user_id', '$nombre', '$categoria', '$monto', '$fecha')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Ahorro agregado con éxito";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
