<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Coink</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/login.css">
</head>

<body>

<main class="contenedorLogin">

    <section class="card">

        <div class="logoArea">
            <img src="img/WhatsApp Image 2026-05-04 at 21.11.10.jpeg" alt="">
        </div>

        <h1>¡Bienvenido de <span class="verde">vuelta!</span></h1>
        <p class="sub">Inicia sesión para continuar ahorrando</p>

        <?php if(isset($_GET['error'])): ?>
    <?php if($_GET['error'] == 'email'): ?>
        <div class="alerta">❌ Correo incorrecto</div>
    <?php endif; ?>

    <?php if($_GET['error'] == 'password'): ?>
        <div class="alerta">❌ Contraseña incorrecta</div>
    <?php endif; ?>
<?php endif; ?>

        <form method="POST" action="php/login.php">

            <label>Correo electrónico</label>
            <div class="input">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" name="correo">
            </div>

            <label>Contraseña</label>
            <div class="input">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password">
            </div>

            <div class="options">
                <label><input type="checkbox"> Recordarme</label>
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>

            <button class="btn" type="submit" >INICIAR SESIÓN</button>
            
          

            <script>
             function iniciarSesion() {
             localStorage.setItem("sesion", "activa");
             window.location.href = "index.php";
                            }
            </script>
            
            <script>
                function iniciarSesion() {
                localStorage.setItem("sesion", "activa");
                localStorage.setItem("usuario", "Cesar");
                localStorage.setItem("correo", "cesar@gmail.com");
             localStorage.setItem("foto", "https://via.placeholder.com/150");

                window.location.href = "index.html";
             }
            </script>



            <p class="divider">O continua con</p>

            <div class="social">
                <button>
                   <i class="fa-brands fa-google"></i> Google
                </button>
                <button>
                    <i class="fa-brands fa-apple"></i> Apple
                </button>
            </div>

            
            <div class="register">
             <span>¿No tienes cuenta?</span>
                 <a href="register.html" class="btn-register">
                    Regístrate aquí >
                 </a>
            </div>
        </form>

    </section>

    <section class="info">

        <h2>
            ¡Dale un futuro <br>
            <span class="rosa">mejor</span> a tus 
            <span class="verde">metas!</span>
        </h2>

        <p>
            Organiza tus finanzas, ahorra más <br>
            y cumple tus sueños
        </p>

        <img src="img/cerditohome.png" class="pig">

    </section>

</main>

</body>
</html>