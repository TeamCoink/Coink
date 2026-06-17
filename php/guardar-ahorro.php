```php
<?php
session_start();
require 'conexion.php';

// Mostrar errores (temporalmente)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuarioId = $_SESSION['usuario_id'];

    $nombre = trim($_POST['nombre']);
    $categoria = trim($_POST['categoria']);
    $monto = floatval($_POST['monto']);
    $fecha = $_POST['fecha'];

    // Validar datos
    if (empty($nombre) || empty($categoria) || $monto <= 0 || empty($fecha)) {
        die("Faltan datos del formulario");
    }

    $sql = "INSERT INTO ahorros 
            (usuario_id, nombre, categoria, monto, fecha)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error prepare: " . $conn->error);
    }

    $stmt->bind_param(
        "issds",
        $usuarioId,
        $nombre,
        $categoria,
        $monto,
        $fecha
    );

if ($stmt->execute()) {

    header("Location: ../dashboard.php?guardado=1");
    exit();

} else {
    die("Error execute: " . $stmt->error);
}



    $stmt->close();
    $conn->close();
}
?>

