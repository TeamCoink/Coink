<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <nav class="navbar">

        <div class="logo">
            <a href="index.php">
                <img src="img/mini-logo.png" alt="Coink Logo" class="logo-img">
            </a>
        </div>
        <!-- Links -->
        <ul class="nav-links">

            <li>
                <a href="metodos.php">
                    <i class="fa-solid fa-graduation-cap"></i>
                    Aprender
                </a>
            </li>

            <li>
                <a href="contacto.php">
                    <i class="fa-regular fa-message"></i>
                    Contactanos
                </a>
            </li>

            <li>
                <a href="about-us.php">
                    <i class="fa-solid fa-users"></i>
                    Sobre Nosotros
                </a>
            </li>

        </ul>

        <div class="nav-buttons">

            <?php if(isset($_SESSION['usuario_id'])): ?>

                <!-- Usuario logueado -->
                <a href="perfil.php" class="signup-btn">
                     <?php echo $_SESSION['nombre']; ?>
                </a>

                <a href="php/logout.php" class="login-btn">
                    Logout
                </a>

            <?php else: ?>

                <!-- Usuario NO logueado -->
                <a href="./register.html" class="signup-btn">
                    Sign Up
                </a>

                <a href="login.php" class="login-btn">
                    Login
                </a>

            <?php endif; ?>

            <div class="dropdown">

                <button class="more-btn" id="moreBtn">
                    More
                    <i class="fa-solid fa-chevron-down"></i>
                </button>

                <div class="dropdown-menu" id="dropdownMenu">

                    <a href="dashboard.php">
                        <i class="fa-regular fa-newspaper"></i>
                        Dashboard
                    </a>

                    

                </div>
            </div>

        </div>

    </nav>
</header>