<?php
session_start();

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/perfil.css">
</head>

<body>

<?php include 'components/navbar.php'; ?>

<div class="perfil-container">

    <div class="card">

        <img
        src="img/default-user.png"
        class="foto-perfil"
        width="120">

        <h2>
            <?php echo $_SESSION['nombre']; ?>
        </h2>

        <p>
            Rol:
            <?php echo $_SESSION['rol']; ?>
        </p>

        <a href="php/logout.php">
            <button>
                Cerrar sesión
            </button>
        </a>

    </div>

</div>

</body>
</html>