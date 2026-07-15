<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos</title>

   
    <link rel="stylesheet" href="style/contacto.css">
    <link rel="stylesheet" href="style/index.css">

    
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<div class="container">

   
    <div class="botones-superiores">
    <button class="boton-regresar" onclick="history.back()">
        <i class="fa-solid fa-angles-left"></i>
    </button>
    </div>

    
    <div class="left">

        <img src="img/123repetido.png" class="logo">

        <h1>
            ¡Estamos aquí para
            <span>ayudarte!</span>
        </h1>

        <p class="descripcion">
            ¿Tienes dudas, sugerencias o necesitas soporte?
            Escríbenos y nuestro equipo te responderá pronto.
        </p>

        <div class="info">

            <div class="icon green">
                <i class="fa-regular fa-envelope"></i>
            </div>

            <div>
                <h3>Correo electrónico</h3>
                <p>proyecto@coink.com</p>
            </div>

        </div>

        <div class="info">

            <div class="icon yellow">
                <i class="fa-solid fa-phone"></i>
            </div>

            <div>
                <h3>Teléfono</h3>
                <p>+503 7019-2828</p>
            </div>

        </div>

        <div class="info">

            <div class="icon pink">
                <i class="fa-regular fa-comments"></i>
            </div>

            <div>
                <h3>Chat en vivo</h3>
                <p>Disponible en la app y web</p>
            </div>

        </div>

        <img src="" class="pig">

    </div>

    <!-- DERECHA -->

    <div class="right">

        <div class="formulario">

            <div class="titulo">

                <div class="circle">
                    <i class="fa-regular fa-comment"></i>
                </div>

                <div>
                    <h2>Contáctanos</h2>

                    <p>
                        Completa el formulario y te responderemos lo antes posible.
                    </p>
                </div>

            </div>

            <form id="contactForm">

                <label>Correo electrónico</label>

                <div class="input-box">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" required>
                </div>

                <div class="double">

                    <div class="mini">

                        <label>Nombre</label>

                        <div class="input-box">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" required>
                        </div>

                    </div>

                    <div class="mini">

                        <label>Asunto</label>

                        <div class="input-box">
                            <input type="text" required>
                        </div>

                    </div>

                </div>

                <label>Mensaje</label>

                <textarea required></textarea>

                <button type="submit" class="btn">
                    <i class="fa-regular fa-paper-plane"></i>
                    Enviar mensaje
                </button>

            </form>

            <div class="social">

                <p>O escríbenos por</p>

                <div class="social-icons">

                    <i class="fa-brands fa-whatsapp"></i>
                    <i class="fa-brands fa-facebook-messenger"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-regular fa-envelope"></i>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="contacto.js"></script>
<script src="javaScript/homepage.js"></script>

</body>
</html>