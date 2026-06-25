<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="img/123repetido.png" alt="Coink Logo" class="logo-img">
            </a>
        </div>

        <ul class="nav-links">
            <li><a href="metodos.php"><i class="fa-solid fa-graduation-cap"></i> Aprender</a></li>
            <li><a href="contacto.php"><i class="fa-regular fa-message"></i> Contactanos</a></li>
            <li><a href="about-us.php"><i class="fa-solid fa-users"></i> Sobre Nosotros</a></li>
        </ul>

        <div class="nav-buttons">
            <?php if(isset($_SESSION['usuario_id'])): ?>
                <a href="perfil.php" class="navbar-profile-link">
                    <div class="navbar-avatar-wrapper">
                        <img src="" alt="Avatar" id="nav-avatar-img" class="navbar-avatar-img" style="display: none;">
                        <div id="nav-avatar-initials" class="navbar-avatar-initials">
                            <?php echo strtoupper(substr($_SESSION['nombre'], 0, 1)); ?>
                        </div>
                    </div>
                    <div class="navbar-user-info">
                        <span class="navbar-username"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                        <span class="navbar-user-role">Mi Perfil</span>
                    </div>
                </a>

                <a href="php/logout.php" class="login-btn">Logout</a>
            <?php else: ?>
                <a href="./register.html" class="signup-btn">Sign Up</a>
                <a href="login.php" class="login-btn">Login</a>
            <?php endif; ?>

            <div class="dropdown">
                <button class="more-btn" id="moreBtn">
                    Más <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="dashboard.php"><i class="fa-regular fa-newspaper"></i> Dashboard</a>
                    <a href="planes.php"><i class="fa-solid fa-money-bill"></i> Planes</a>
                </div>
            </div>
        </div>
    </nav>

    <script>
    (function() {
        function actualizarAvatarAlInstante() {
            const usuarioId = "<?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : ''; ?>";
            const fotoGuardada = localStorage.getItem("foto_perfil_personalizada_" + usuarioId);
            
            const navImg = document.getElementById('nav-avatar-img');
            const navInitials = document.getElementById('nav-avatar-initials');

            if (fotoGuardada && navImg) {
                navImg.src = fotoGuardada;
                navImg.style.setProperty('display', 'block', 'important');
                navImg.style.setProperty('width', '35px', 'important');
                navImg.style.setProperty('height', '35px', 'important');
                navImg.style.setProperty('border-radius', '50%', 'important');
                navImg.style.setProperty('object-fit', 'cover', 'important');
                navImg.style.setProperty('position', 'absolute', 'important');
                navImg.style.setProperty('z-index', '999', 'important');
                
                if (navInitials) navInitials.style.setProperty('display', 'none', 'important');
            } else if (navInitials) {
                if (navImg) navImg.style.setProperty('display', 'none', 'important');
                navInitials.style.setProperty('display', 'flex', 'important');
            }
        }

        window.addEventListener('load', actualizarAvatarAlInstante);
        window.addEventListener('storage', function(e) {
            if (e.key === "foto_perfil_personalizada_<?php echo isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : ''; ?>") {
                actualizarAvatarAlInstante();
            }
        });
        window.addEventListener('fotoActualizada', actualizarAvatarAlInstante);
    })();
    </script>
</header>