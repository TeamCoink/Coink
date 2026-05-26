g<?php 
    $host = "localhost"; 
    $user = "root"; 
    $password = ""; 
    $dbname = "coink"; 
    $conn = new mysqli($host, $user, $password, "coink");

    if ($conn->connect_error) { 
    die("Error de conexión: " . $conn->connect_error); 
    } 

    $conn->set_charset("utf8mb4"); 
?>