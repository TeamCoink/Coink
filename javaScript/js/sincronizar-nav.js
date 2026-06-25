document.addEventListener("DOMContentLoaded", function() {
    // Intentamos buscar el usuarioId en el localStorage, si no, intentamos sacarlo de un input o variable global
    // Si tu navbar está en todas las páginas, lo mejor es usar un identificador fijo o el nombre de usuario
    const usuarioId = "<?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : ''; ?>";
    
    if (!usuarioId) return; // Si no hay usuario, no hacemos nada

    const navImg = document.getElementById('nav-avatar-img');
    const navInitials = document.getElementById('nav-avatar-initials');
    const fotoGuardada = localStorage.getItem("foto_perfil_" + usuarioId);

    if (fotoGuardada && navImg && navInitials) {
        navImg.src = fotoGuardada;
        navImg.style.display = 'block';
        navInitials.style.display = 'none';
    }
});