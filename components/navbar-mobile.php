<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="mobile-header">
  <link rel="stylesheet" href="style/navbar-mobile.css">   

    <!-- Botón hamburguesa -->
    <button class="menu-toggle" id="menuToggle">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Logo -->
    <a href="index.php" class="mobile-logo">
        <img src="img/123repetido.png" alt="Coink">
    </a>

</header>


<!-- Fondo oscuro -->

<div class="mobile-overlay" id="mobileOverlay"></div>


<!-- Panel -->

<aside class="mobile-sidebar" id="mobileSidebar">

    <div class="sidebar-top">

    <?php if(isset($_SESSION['usuario_id'])): ?>

        <div class="mobile-avatar-wrapper">

            <img
                id="mobile-avatar-img"
                class="mobile-avatar-img"
                src=""
                style="display:none;">

            <div
                id="mobile-avatar-initials"
                class="mobile-avatar-initials">

                <?php echo strtoupper(substr($_SESSION['nombre'],0,1)); ?>

            </div>

        </div>

        <h3>

            Hola,
            <?php echo htmlspecialchars($_SESSION['nombre']); ?>

        </h3>

        <p>Bienvenido de nuevo</p>

            <?php else: ?>

                <h3>Bienvenido 🐷</h3>

                <p>Inicia sesión para comenzar</p>

            <?php endif; ?>

        </div>
        </div>


    <nav class="sidebar-links">

        <a href="index.php">
            <i class="fa-solid fa-house"></i>
            Inicio
        </a>

        <a href="metodos.php">
            <i class="fa-solid fa-graduation-cap"></i>
            Aprender
        </a>

        <a href="contacto.php">
            <i class="fa-regular fa-message"></i>
            Contactanos
        </a>

        <a href="about-us.php">
            <i class="fa-solid fa-users"></i>
            Sobre Nosotros
        </a>

        <a href="dashboard.php">
            <i class="fa-solid fa-chart-line"></i>
            Dashboard
        </a>

        <a href="planes.php">
            <i class="fa-solid fa-crown"></i>
            Planes
        </a>

        <?php if(isset($_SESSION['usuario_id'])): ?>

            <a href="perfil.php">
                <i class="fa-solid fa-user"></i>
                Perfil
            </a>

        <?php endif; ?>

    </nav>


    <div class="sidebar-bottom">

        <?php if(isset($_SESSION['usuario_id'])): ?>

            <a href="php/logout.php" class="logout-mobile">

                <i class="fa-solid fa-right-from-bracket"></i>

                Cerrar sesión

            </a>

        <?php else: ?>

            <a href="login.php" class="login-mobile">

                Iniciar sesión

            </a>

        <?php endif; ?>

    </div>

</aside>

<script>
(function(){

const usuarioId = "<?php echo $_SESSION['usuario_id'] ?? ''; ?>";

const fotoGuardada =
localStorage.getItem("foto_perfil_personalizada_" + usuarioId);

const img = document.getElementById("mobile-avatar-img");
const inicial = document.getElementById("mobile-avatar-initials");

if(fotoGuardada && img){

    img.src = fotoGuardada;

    img.style.display = "block";

    img.style.width = "100%";

    img.style.height = "100%";

    img.style.objectFit = "cover";

    inicial.style.display = "none";
}

})();
</script>