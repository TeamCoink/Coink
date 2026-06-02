<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <nav class="navbar">

        <!-- Logo -->
        <div class="logo">
            🐷 <span>Coink</span>
        </div>

        <!-- Links -->
        <ul class="nav-links">

            <li>
                <a href="learn.html">
                    <i class="fa-solid fa-graduation-cap"></i>
                    Aprender
                </a>
            </li>

            <li>
                <a href="contacto.html">
                    <i class="fa-regular fa-message"></i>
                    Contactanos
                </a>
            </li>

            <li>
                <a href="about-us.html">
                    <i class="fa-solid fa-users"></i>
                    Sobre Nosotros
                </a>
            </li>

        </ul>

        <div class="nav-buttons">

            <?php if(isset($_SESSION['usuario_id'])): ?>

                <!-- Usuario logueado -->
                <a href="perfil.php" class="signup-btn">
                    👤 <?php echo $_SESSION['nombre']; ?>
                </a>

                <a href="php/logout.php" class="login-btn">
                    Logout
                </a>

            <?php else: ?>

                <!-- Usuario NO logueado -->
                <a href="./register.html" class="signup-btn">
                    Sign Up
                </a>

                <a href="login.html" class="login-btn">
                    Login
                </a>

            <?php endif; ?>

            <div class="dropdown">

                <button class="more-btn" id="moreBtn">
                    More
                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <div class="dropdown-menu" id="dropdownMenu">

                    <a href="dashboard.html">
                        <i class="fa-regular fa-newspaper"></i>
                        Dashboard
                    </a>

                    <a href="#">
                        <i class="fa-regular fa-circle-question"></i>
                        Preguntas Frecuentes
                    </a>

                    <a href="#">
                        <i class="fa-solid fa-bullhorn"></i>
                        Novedades
                    </a>

                    <a href="#">
                        <i class="fa-regular fa-envelope"></i>
                        Newsletter
                    </a>

                    <a href="#">
                        <i class="fa-solid fa-gear"></i>
                        Configuración
                    </a>

                </div>
            </div>

        </div>

    </nav>
</header>