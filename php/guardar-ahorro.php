
<?php
session_start();
require 'conexion.php';
header("Content-Type: application/json");


error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION['usuario_id'])) {

        echo json_encode([
            "success" => false,
            "mensaje" => "Sesión expirada."
        ]);

        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $usuarioId = $_SESSION['usuario_id'];

        $nombre = trim($_POST['nombre']);
        $categoria = trim($_POST['categoria']);
        $monto = floatval($_POST['monto']);
        $fecha = $_POST['fecha'];

        if (empty($nombre) || empty($categoria) || $monto <= 0 || empty($fecha)) {

            echo json_encode([
                "success" => false,
                "mensaje" => "Faltan datos del formulario."
            ]);

            exit();
        }

        $sql = "INSERT INTO ahorros 
                (usuario_id, nombre, categoria, monto, fecha)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        
        if(!$stmt){

            echo json_encode([
                "success"=>false,
                "mensaje"=>$conn->error
            ]);

            exit();
        }

        $stmt->bind_param(
            "issds",
            $usuarioId,
            $nombre,
            $categoria,
            $monto,
            $fecha
        ); 

    if($stmt->execute()){

        echo json_encode([

            "success"=>true,

            "mensaje"=>"Ahorro guardado correctamente."

        ]);

    }else{

        echo json_encode([

            "success"=>false,

            "mensaje"=>$stmt->error

        ]);

    }

} 
?>

