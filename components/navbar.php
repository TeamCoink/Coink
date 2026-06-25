<?php

if (session_status() === PHP_SESSION_NONE) {

    session_start();

}

?>



<header>

    <nav class="navbar">



        <div class="logo">

            <a href="index.php">

                <img src="img/123repetido.png" alt="Coink Logo" class="logo-img" >

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
<<<<<<< HEAD

                    Logout

=======
                    Cerrar Sesion
>>>>>>> f94a2c30a9ba5fae00eeb6420f19885d7dd441e6
                </a>



            <?php else: ?>



                <!-- Usuario NO logueado -->
<<<<<<< HEAD

                <a href="./register.html" class="signup-btn">

                    Sign Up

                </a>



                <a href="login.php" class="login-btn">

                    Login

=======
                <a href="./login.php" class="signup-btn">
                     Iniciar sesion
                </a>

                <a href="register.html" class="login-btn">
                    Registarte
>>>>>>> f94a2c30a9ba5fae00eeb6420f19885d7dd441e6
                </a>



            <?php endif; ?>



            <div class="dropdown">



                <button class="more-btn" id="moreBtn">
<<<<<<< HEAD

                    More

=======
                    Más
>>>>>>> f94a2c30a9ba5fae00eeb6420f19885d7dd441e6
                    <i class="fa-solid fa-chevron-down"></i>

                </button>



                <div class="dropdown-menu" id="dropdownMenu">



                    <a href="dashboard.php">

                        <i class="fa-regular fa-newspaper"></i>

                        Dashboard

                    </a>

<<<<<<< HEAD


                   


=======
                    <a href="planes.php">
                        <i class="fa-solid fa-money-bill"></i>
                        Planes
                    </a>

                    
>>>>>>> f94a2c30a9ba5fae00eeb6420f19885d7dd441e6

                </div>

            </div>



        </div>



    </nav>

</header>