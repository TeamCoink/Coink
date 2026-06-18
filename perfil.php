<?php
session_start();

if(!isset($_SESSION['usuario_id'])){
    header("Location: login.php");
    exit();
}

$nombreUsuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';
$usuarioId = $_SESSION['usuario_id']; // Obtenemos el ID único aquí
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil - COINK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/perfil.css">
</head>
<body>

<?php include 'components/navbar.php'; ?>

<div class="perfil-container">
    <div class="card">
        <div class="portada-container" onclick="triggerInput('inputPortada', event)" title="Haz clic para cambiar la portada">
            <img id="portada-img" alt="Foto de portada" style="display: none;">
            <div id="portada-vacia"></div>
            <button class="btn-eliminar-portada" id="btnDeletePortada" onclick="eliminarPortada(event)" title="Eliminar portada">×</button>
        </div>
        <input type="file" id="inputPortada" accept="image/*" style="display: none;" onchange="cambiarPortada(event)">

        <h1 class="app-title">COINK</h1>
        
        <div class="avatar-wrapper">
            <div class="avatar-container" onclick="triggerInput('inputFoto', event)" title="Haz clic para cambiar tu foto">
                <img id="foto" alt="Foto de perfil">
                <div id="iniciales"></div>
                <div class="avatar-overlay">Cambiar</div>
            </div>
            <button class="btn-eliminar-foto" id="btnDeleteFoto" onclick="eliminarFotoPerfil(event)" title="Eliminar foto">×</button>
        </div>
        <input type="file" id="inputFoto" accept="image/*" style="display: none;" onchange="cambiarFotoPersonalizada(event)">

        <h2 class="username-title"><?php echo htmlspecialchars($nombreUsuario); ?></h2>
        
        <p class="user-bio" id="userBio" contenteditable="true" onblur="guardarBiografia()" title="Haz clic para editar tu descripción">Haz clic aquí para agregar una descripción sobre ti...</p>

        <a href="php/logout.php" class="logout-link">
            <button class="btn-cerrar">Cerrar sesión</button>
        </a>

        <div class="social-footer">
            <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" target="_blank"><i class="fa-brands fa-threads"></i></a>
        </div>
    </div>
</div>

<script>
// ID único para diferenciar datos por usuario
const usuarioId = "<?php echo $usuarioId; ?>"; 
const nombreParaInicial = "<?php echo addslashes($nombreUsuario); ?>";

document.addEventListener("DOMContentLoaded", function() {
    actualizarAvatar();
    actualizarPortada();
    cargarBiografia();
});

function triggerInput(idInput, event) {
    if (event.target.tagName !== 'BUTTON') {
        document.getElementById(idInput).click();
    }
}

// Funciones con el ID del usuario concatenado
function cargarBiografia() {
    const bioGuardada = localStorage.getItem("biografia_" + usuarioId);
    const bioElement = document.getElementById("userBio");
    if (bioElement && bioGuardada) bioElement.textContent = bioGuardada;
}

function guardarBiografia() {
    const bioElement = document.getElementById("userBio");
    if (bioElement) {
        localStorage.setItem("biografia_" + usuarioId, bioElement.textContent.trim());
    }
}

function actualizarAvatar() {
    const fotoGuardada = localStorage.getItem("foto_perfil_" + usuarioId);
    const container = document.querySelector(".avatar-container");
    const imgElement = document.getElementById("foto");
    const initialsElement = document.getElementById("iniciales");
    const btnDelete = document.getElementById("btnDeleteFoto");

    if (container && imgElement && initialsElement) {
        if (fotoGuardada) {
            imgElement.src = fotoGuardada;
            container.classList.add("con-foto");
            if(btnDelete) btnDelete.style.display = "flex";
        } else {
            container.classList.remove("con-foto");
            if(btnDelete) btnDelete.style.display = "none";
            initialsElement.textContent = nombreParaInicial.charAt(0).toUpperCase();
        }
    }
}

function cambiarFotoPersonalizada(event) {
    const archivo = event.target.files[0];
    if (!archivo) return;
    const lector = new FileReader();
    lector.onload = function(e) {
        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            canvas.width = 300; canvas.height = 300;
            canvas.getContext('2d').drawImage(img, 0, 0, 300, 300);
            const url = canvas.toDataURL('image/jpeg', 0.8);
            localStorage.setItem("foto_perfil_" + usuarioId, url);
            actualizarAvatar();
        };
        img.src = e.target.result;
    };
    lector.readAsDataURL(archivo);
}

function eliminarFotoPerfil(event) {
    event.stopPropagation();
    if(confirm("¿Eliminar foto?")) {
        localStorage.removeItem("foto_perfil_" + usuarioId);
        actualizarAvatar();
    }
}

function actualizarPortada() {
    const portadaGuardada = localStorage.getItem("portada_" + usuarioId);
    const imgPortada = document.getElementById("portada-img");
    const divVacio = document.getElementById("portada-vacia");
    const btnDelete = document.getElementById("btnDeletePortada");

    if (portadaGuardada) {
        imgPortada.src = portadaGuardada;
        imgPortada.style.display = "block";
        divVacio.style.display = "none";
        if(btnDelete) btnDelete.style.display = "flex";
    } else {
        imgPortada.style.display = "none";
        divVacio.style.display = "block";
        if(btnDelete) btnDelete.style.display = "none";
    }
}

function cambiarPortada(event) {
    const archivo = event.target.files[0];
    if (!archivo) return;
    const lector = new FileReader();
    lector.onload = function(e) {
        const img = new Image();
        img.onload = function() {
            const canvas = document.createElement('canvas');
            canvas.width = 600; canvas.height = 250;
            canvas.getContext('2d').drawImage(img, 0, 0, 600, 250);
            const url = canvas.toDataURL('image/jpeg', 0.8);
            localStorage.setItem("portada_" + usuarioId, url);
            actualizarPortada();
        };
        img.src = e.target.result;
    };
    lector.readAsDataURL(archivo);
}

function eliminarPortada(event) {
    event.stopPropagation();
    if(confirm("¿Eliminar portada?")) {
        localStorage.removeItem("portada_" + usuarioId);
        actualizarPortada();
    }
}
</script>

</body>
</html>