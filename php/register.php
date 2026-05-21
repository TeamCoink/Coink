<?php 
    include("conexion.php"); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $nombre = $_POST['nombre']; 
        $correo = $_POST['correo'];

        // HASH DE CONTRASEÑA 
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
        $sql = "INSERT INTO usuarios (nombre, correo, password, rol) VALUES (?, 
    ?, ?, 'usuario')"; 

        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("sss", $nombre, $correo, $password); 

        if ($stmt->execute()) { 
           header("Location: ../index.php"); 
        } else { 
            echo "Error al registrar"; 
    } 
} 
?> 
