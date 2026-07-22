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
    <link rel="shortcut icon" href="img/favicon_io/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
</head>
<body>

   <a href="index.php" class="boton-regresar">
    <i class="fa-solid fa-arrow-left-long"></i>
   </a>


<div class="perfil-container">
    <div class="card">
        <div class="portada-container" onclick="triggerInput('inputPortada', event)">
            <img id="portada-img" alt="Portada" style="display: none;">
            <div id="portada-vacia"></div>
            <button class="btn-eliminar-portada" id="btnDeletePortada" onclick="eliminarPortada(event)">×</button>
        </div>
        <input type="file" id="inputPortada" accept="image/*" style="display: none;" onchange="iniciarRecorte(event, 'portada')">
        
        <div class="avatar-wrapper">
            <div class="avatar-container" onclick="triggerInput('inputFoto', event)">
                <img id="foto" alt="Foto de perfil">
                <div id="iniciales"></div>
                <div class="avatar-overlay">Cambiar</div>
            </div>
            <button class="btn-eliminar-foto" id="btnDeleteFoto" onclick="eliminarFotoPerfil(event)">×</button>
        </div>
        <input type="file" id="inputFoto" accept="image/*" style="display: none;" onchange="iniciarRecorte(event, 'avatar')">
        
        <h2 class="username-title"><?php echo htmlspecialchars($nombreUsuario); ?></h2>
        <p class="user-bio" id="userBio">Haz clic aquí para agregar una descripción...</p>
                   
        <div class="user-details">
    
    <span id="userJoinDate"><i class="fa-solid fa-calendar-days"></i> Se unió en Julio 2026</span>
</div>

<div class="tags-container" id="tagsContainer"></div>
                    

            
        
        <div class="actions-container">
            <a href="php/logout.php" style="text-decoration:none;"><button class="btn-cerrar">Cerrar sesión</button></a>
           <button onclick="abrirModal()" class="btn-editar">Editar Perfil</button>
        </div>

        
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
const KEY_TAGS = "tags_" + usuarioId;

let cropper = null; 
let tipoActual = ''; 

document.addEventListener("DOMContentLoaded", function() {
    actualizarAvatar();
    actualizarPortada();
    cargarBiografia();

    // En lugar de poner "Julio 2026" manualmente, usamos esto:
const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
const fechaActual = new Date();
const fechaTexto = meses[fechaActual.getMonth()] + " " + fechaActual.getFullYear();

document.getElementById('userJoinDate').innerHTML = `<i class="fa-solid fa-calendar-days"></i> Se unió en ${fechaTexto}`;
    
   
    const nombreGuardado = localStorage.getItem("nombre_usuario_" + usuarioId);
    if (nombreGuardado) document.querySelector('.username-title').textContent = nombreGuardado;

   
    const locGuardada = localStorage.getItem("ubicacion_" + usuarioId);
    if (locGuardada) document.getElementById('userLocation').innerHTML = `<i class="fa-solid fa-location-dot"></i> ${locGuardada}`;

   
    const tagsGuardadas = localStorage.getItem(KEY_TAGS);
    if (tagsGuardadas) {
        const container = document.getElementById('tagsContainer');
        container.innerHTML = '';
        tagsGuardadas.split(',').forEach(tag => {
            if (tag.trim() !== "") {
                const span = document.createElement('span');
                span.className = 'tag';
                span.textContent = '#' + tag.trim();
                container.appendChild(span);
            }
        });
    }
});

function triggerInput(idInput, event) {
    if (event.target.tagName !== 'BUTTON') {
        const input = document.getElementById(idInput);
        input.value = ''; 
        input.click();
    }
}

function iniciarRecorte(event, tipo) {
    const file = event.target.files[0];
    if (!file) return;
    
    tipoActual = tipo;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = document.getElementById('imgRecorte');
        img.src = e.target.result;
        
       
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        
        document.getElementById('modalRecorte').style.display = 'block';
        
     
        cropper = new Cropper(img, {
            aspectRatio: tipo === 'avatar' ? 1 : 2.5,
            viewMode: 1,
            ready: function() {
                
                cropper.setData({ width: 500, height: 200 }); 
            }
        });
    };
    reader.readAsDataURL(file);
}

function guardarRecorte() {
    if (!cropper) return;
    const dataUrl = cropper.getCroppedCanvas().toDataURL('image/jpeg');
    if (tipoActual === 'avatar') {
        localStorage.setItem(KEY_FOTO, dataUrl);
        actualizarAvatar();
    } else {
        localStorage.setItem(KEY_PORTADA, dataUrl);
        actualizarPortada();
    }
    cerrarRecorte();
}

function cerrarRecorte() {
    document.getElementById('modalRecorte').style.display = 'none';
    if (cropper) { cropper.destroy(); cropper = null; }
}

function actualizarAvatar() {
    const foto = localStorage.getItem(KEY_FOTO);
    const img = document.getElementById("foto");
    const init = document.getElementById("iniciales");
    if (foto) { img.src = foto; img.style.display = "block"; init.style.display = "none"; }
    else { img.style.display = "none"; init.style.display = "flex"; init.textContent = "<?php echo strtoupper(substr($nombreUsuario, 0, 1)); ?>"; }
}

function actualizarPortada() {
    const port = localStorage.getItem(KEY_PORTADA);
    const img = document.getElementById("portada-img");
    const div = document.getElementById("portada-vacia");
    if (port) { img.src = port; img.style.display = "block"; div.style.display = "none"; }
    else { img.style.display = "none"; div.style.display = "block"; }
}

function eliminarFotoPerfil(e) { e.stopPropagation(); localStorage.removeItem(KEY_FOTO); actualizarAvatar(); }
function eliminarPortada(e) { e.stopPropagation(); localStorage.removeItem(KEY_PORTADA); actualizarPortada(); }
function guardarBiografia() { localStorage.setItem(KEY_BIO, document.getElementById("userBio").textContent.trim()); }
function cargarBiografia() { const bio = localStorage.getItem(KEY_BIO); if(bio) document.getElementById("userBio").textContent = bio; }

function guardarTodo() {
    try {
        const nameInput = document.getElementById('editName');
        if (nameInput && nameInput.value.trim() !== "") {
            localStorage.setItem("nombre_usuario_" + usuarioId, nameInput.value);
            document.querySelector('.username-title').textContent = nameInput.value;
        }

        const bioInput = document.getElementById('editBio');
        if (bioInput) {
            const nuevaBio = bioInput.value.trim();
            if (nuevaBio !== "") {
                localStorage.setItem(KEY_BIO, nuevaBio);
                document.getElementById("userBio").textContent = nuevaBio;
            } else {
                localStorage.removeItem(KEY_BIO);
                document.getElementById("userBio").textContent = "Haz clic aquí para agregar una descripción...";
            }
        }

        const tagsInput = document.getElementById('editTags');
        const container = document.getElementById('tagsContainer');
        if (container) {
            container.innerHTML = '';
            if (tagsInput && tagsInput.value.trim() !== "") {
                localStorage.setItem(KEY_TAGS, tagsInput.value);
                tagsInput.value.split(',').forEach(tag => {
                    if (tag.trim() !== "") {
                        const span = document.createElement('span');
                        span.className = 'tag';
                        span.textContent = '#' + tag.trim();
                        container.appendChild(span);
                    }
                });
            } else { 
                localStorage.removeItem(KEY_TAGS); 
            }
        }
        document.getElementById('modalEditar').style.display = 'none';
    } catch (e) { 
        console.error(e); 
    }
}

function abrirModal() {
    document.getElementById('editName').value = document.querySelector('.username-title').textContent;
    
    const bioActual = document.getElementById('userBio').textContent;
    if (bioActual.includes('Haz clic aquí')) {
        document.getElementById('editBio').value = '';
    } else {
        document.getElementById('editBio').value = bioActual;
    }
    
    const tagsGuardadas = localStorage.getItem(KEY_TAGS);
    if (tagsGuardadas) {
        document.getElementById('editTags').value = tagsGuardadas;
    } else {
        document.getElementById('editTags').value = '';
    }

    document.getElementById('modalEditar').style.display = 'block';
}



</script>

<div id="modalEditar" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000;">
  <div style="background:white; margin:15% auto; padding:20px; width:300px; border-radius:20px; text-align:center;">
    
    <h3>Editar Perfil</h3>
    <input type="text" id="editName" placeholder="Tu nombre">
    <textarea id="editBio" placeholder="Tu bio"></textarea>
    
<textarea id="editTags" placeholder="Tus intereses (separados por coma, ej: Diseño, Dev, COINK)"></textarea>
<div class="modal-buttons">
    <button onclick="guardarTodo()" class="btn-guardar">Guardar</button>
    <button onclick="document.getElementById('modalEditar').style.display='none'" class="btn-cancelar">Cancelar</button>
</div>
  </div>
</div>

<div id="modalRecorte" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:2000;">
    <div style="background:white; margin:5% auto; padding:20px; width:80%; max-width:500px; border-radius:20px; text-align:center;">
        <h3>Ajustar imagen</h3>
        <div style="max-height: 300px; overflow: hidden;"><img id="imgRecorte" style="max-width: 100%;"></div>
        <br>
        <button onclick="guardarRecorte()">Aplicar</button>
        <button onclick="cerrarRecorte()">Cancelar</button>
    </div>
</div>

</body>
</html>