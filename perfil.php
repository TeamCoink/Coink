<?php
session_start();

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.html");
    exit();
}

// Tomamos el nombre del usuario directamente desde la sesión de PHP de forma segura
$nombreUsuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil - COINK</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/perfil.css">
</head>
<body>

<?php include 'components/navbar.php'; ?>

<div class="perfil-container">
    <div class="card">
        <h1 class="app-title">COINK</h1>
        
        <div class="avatar-container" onclick="document.getElementById('inputFoto').click();" title="Haz clic para cambiar tu foto">
            <img id="foto" alt="Foto de perfil">
            <div id="iniciales"></div>
            <div class="avatar-overlay">Cambiar foto</div>
        </div>

        <input type="file" id="inputFoto" accept="image/*" style="display: none;" onchange="cambiarFotoPersonalizada(event)">

        <h2>
            <?php echo $_SESSION['nombre']; ?>
        </h2>

        <p class="user-role">
            Rol: <?php echo $_SESSION['rol']; ?>
        </p>

        <a href="php/logout.php">
            <button class="btn-cerrar">
                Cerrar sesión
            </button>
        </a>
    </div>
</div>

<script>
// Guardamos el nombre de usuario de PHP de forma segura
const nombreParaInicial = "<?php echo addslashes($nombreUsuario); ?>";

// Se ejecuta automáticamente al cargar la página
document.addEventListener("DOMContentLoaded", function() {
    actualizarAvatar();
});

// FUNCIÓN ÚNICA: Controla si muestra la foto o las iniciales usando la clase "con-foto"
function actualizarAvatar() {
    const fotoGuardada = localStorage.getItem("foto_perfil_personalizada");
    const container = document.querySelector(".avatar-container");
    const imgElement = document.getElementById("foto");
    const initialsElement = document.getElementById("iniciales");

    if (container && imgElement && initialsElement) {
        if (fotoGuardada && fotoGuardada !== "null" && fotoGuardada !== "") {
            // Si hay una foto guardada, se asigna y se activa la clase CSS
            imgElement.src = fotoGuardada;
            container.classList.add("con-foto");
        } else {
            // Si no hay foto, se remueve la clase y se calcula la inicial en mayúscula
            container.classList.remove("con-foto");
            
            const primeraLetra = nombreParaInicial.trim().charAt(0).toUpperCase();
            initialsElement.textContent = primeraLetra || "U";
        }
    }
}

// FUNCIÓN DE CARGA: Comprime la foto a 300x300 para que quepa en la memoria del navegador
function cambiarFotoPersonalizada(event) {
    const archivo = event.target.files[0];
    if (!archivo) return;

    const lector = new FileReader();
    lector.onload = function(e) {
        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            
            // Tamaño óptimo para el círculo de tu tarjeta
            canvas.width = 300;
            canvas.height = 300;
            
            // Dibujamos la imagen optimizada
            ctx.drawImage(img, 0, 0, 300, 300);
            
            // Convertimos a un formato liviano
            const urlImagenOptimizada = canvas.toDataURL('image/jpeg', 0.7);
            
            // Guardamos en el almacenamiento local
            localStorage.setItem("foto_perfil_personalizada", urlImagenOptimizada);
            
            // Refrescamos los cambios visuales al instante
            actualizarAvatar();
        };
        img.src = e.target.result;
    };
    lector.readAsDataURL(archivo);
}
</script>

</body>
</html>