<?php
session_start();
if(!isset($_SESSION['usuario_id'])){ header("Location: login.php"); exit(); }
$nombreUsuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';
$usuarioId = $_SESSION['usuario_id']; 
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


<div class="perfil-container">
    <div class="card">
      
        <div class="portada-container" onclick="triggerInput('inputPortada', event)">
            <img id="portada-img" alt="Portada" style="display: none;">
            <div id="portada-vacia"></div>
            <button class="btn-eliminar-portada" id="btnDeletePortada" onclick="eliminarPortada(event)">×</button>
        </div>
        <input type="file" id="inputPortada" accept="image/*" style="display: none;" onchange="cambiarPortada(event)">
        
        
        
      
        <div class="avatar-wrapper">
            <div class="avatar-container" onclick="triggerInput('inputFoto', event)">
                <img id="foto" alt="Foto de perfil">
                <div id="iniciales"></div>
                <div class="avatar-overlay">Cambiar</div>
            </div>
            <button class="btn-eliminar-foto" id="btnDeleteFoto" onclick="eliminarFotoPerfil(event)">×</button>
        </div>
        <input type="file" id="inputFoto" accept="image/*" style="display: none;" onchange="cambiarFotoPersonalizada(event)">
        
        <h2 class="username-title"><?php echo htmlspecialchars($nombreUsuario); ?></h2>
        
       
        <p class="user-bio" id="userBio" contenteditable="true" onblur="guardarBiografia()">Haz clic aquí para agregar una descripción...</p>
        
        
        <a href="php/logout.php" class="logout-link"><button class="btn-cerrar">Cerrar sesión</button></a>

        <div class="social-footer">
            <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" target="_blank"><i class="fa-brands fa-threads"></i></a>
        </div>
    </div>
</div>

<script>
const usuarioId = "<?php echo $usuarioId; ?>";
const KEY_FOTO = "foto_perfil_personalizada_" + usuarioId;
const KEY_PORTADA = "portada_" + usuarioId;
const KEY_BIO = "biografia_" + usuarioId;

document.addEventListener("DOMContentLoaded", function() {
    actualizarAvatar();
    actualizarPortada();
    cargarBiografia();
});

function triggerInput(idInput, event) {
    if (event.target.tagName !== 'BUTTON') document.getElementById(idInput).click();
}


function cargarBiografia() {
    const bioGuardada = localStorage.getItem(KEY_BIO);
    const bioElement = document.getElementById("userBio");
    if (bioElement && bioGuardada) bioElement.textContent = bioGuardada;
}
function guardarBiografia() {
    localStorage.setItem(KEY_BIO, document.getElementById("userBio").textContent.trim());
}


function actualizarAvatar() {
    const fotoGuardada = localStorage.getItem(KEY_FOTO);
    const imgElement = document.getElementById("foto");
    const container = document.querySelector(".avatar-container");
    const initialsElement = document.getElementById("iniciales");
    
    if (fotoGuardada) {
        imgElement.src = fotoGuardada;
        imgElement.style.display = "block";
        container.classList.add("con-foto");
        initialsElement.style.display = "none";
    } else {
        imgElement.style.display = "none";
        container.classList.remove("con-foto");
        initialsElement.style.display = "flex";
        initialsElement.textContent = "<?php echo strtoupper(substr($nombreUsuario, 0, 1)); ?>";
    }
}
function cambiarFotoPersonalizada(event) {
    const reader = new FileReader();
    reader.onload = function(e) {
        localStorage.setItem(KEY_FOTO, e.target.result);
        window.dispatchEvent(new Event('fotoActualizada'));
        actualizarAvatar();
    };
    reader.readAsDataURL(event.target.files[0]);
}
function eliminarFotoPerfil(event) {
    event.stopPropagation();
    localStorage.removeItem(KEY_FOTO);
    window.dispatchEvent(new Event('fotoActualizada'));
    actualizarAvatar();
}


function actualizarPortada() {
    const portadaGuardada = localStorage.getItem(KEY_PORTADA);
    const imgPortada = document.getElementById("portada-img");
    const divVacio = document.getElementById("portada-vacia");
    if (portadaGuardada) {
        imgPortada.src = portadaGuardada;
        imgPortada.style.display = "block";
        divVacio.style.display = "none";
    } else {
        imgPortada.style.display = "none";
        divVacio.style.display = "block";
    }
}
function cambiarPortada(event) {
    const reader = new FileReader();
    reader.onload = function(e) {
        localStorage.setItem(KEY_PORTADA, e.target.result);
        actualizarPortada();
    };
    reader.readAsDataURL(event.target.files[0]);
}
function eliminarPortada(event) {
    event.stopPropagation();
    localStorage.removeItem(KEY_PORTADA);
    actualizarPortada();
}
</script>
</body>
</html>