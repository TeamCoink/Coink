
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Coink</title>
    <link rel="shortcut icon" href="img/favicon_io/favicon-32x32.png" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>
<body>

<?php include 'components/navbar.php'; ?>
<?php include 'components/navbar-mobile.php'; ?>

 <section class="hero">
    <div class="hero-content">
        <h1 class="motto">
            Aprende a <br> manejar tu dinero <br> y cumple
            <div class="pink">tus sueños.</div>  
        </h1>

        <p>
            Educación financiera sencilla y práctica para que tomes
            mejores decisiones cada día.
        </p>

        <div class="hero-buttons">
            <a href="metodos.php" class="btn-primary">Aprender</a>
            <a href="login.php" class="btn-secondary">Unirme</a>
        </div>
    </div>

    <div class="hero-image">
        <img src="img/pigH.png" alt="Cerdito Coink" width="1000px">
    </div>
</section> 

<section id="features">
    <div class="feature">
        <img src="img/feature1.png" alt="" width="140px">
        <h3>Aprender</h3>
        <p>Conceptos claros y metodos efectivos</p>
    </div>

    <div class="feature">
        <img src="img/feature2.png" alt="" width="140px">
        <h3>Planifica</h3>
        <p>Organiza tus metas y finanzas propias</p>
    </div>

    <div class="feature">
        <img src="img/feature3.png" alt="" width="140px">
        <h3>Ahorra</h3>
        <p>Pequeños hábitos, grandes cambios</p>
    </div>

    <div class="feature">
        <img src="img/feature4.png" alt="" width="140px">
        <h3>Invierte</h3>
        <p>Haz crecer tu dinero de manera rapidas</p>
    </div>

</section>

<section class="about-coink">

    <div id="book-img">
        <img src="img/libroverde.png" alt="icono" width="550px">
    </div>

    <div class="texto">
        <h1>¿Qué es 
            <span class="c">C</span><span class="o">o</span><span class="i">i</span><span class="n">n</span><span class="k">k</span>
        ?</h1><br>
        <p>Somos una plataforma de educación financiera que busca ayudarte a comprender el dinero, aprender a administrar tus ingresos y que puedas usar Coink como una  herramienta para mejorar tu vida, ofreciendote herramientas que te ayudaran a que veas como tu dinero crece de manera inteligente. </p>

        <div id="knowmore"><button class="button3"><a href="about-us.php">Conoce más →</a></button></div>

    </div>

</section>

<section id="beneficios">
    
    <h1>Beneficios</h1>
    <div class="linea1"></div>

    <div class="cards-home">
        <img src="img/agenda.jpg" alt="" width="270" height="187"><br>
        <p>Coink te brinda distintos métodos de ahorro que se ajustan a tus necesidades</p>
    </div>

    <div class="cards-home">
        <img src="img/planta.jpg" alt="" width="270"><br>
        <p>Crea tus propias metas y compartelas con tus amigos y familia</p>
    </div>

    <div class="cards-home">
        <img src="img/chart.jpg" alt="" width="270" height="189"><br>
        <p>Conoce el progreso diario y mensual de como llevas tus ahorros</p>
    </div>
    
</section>

<section class="cta">

    <div class="cta-image">
        <img src="img/macetita.png" alt="Planta creciendo" width="520px">
    </div>

    <div class="cta-content">

        <h1>
            Únete hoy a <br>
            Coink <span>e invierte</span> <br>
            en ti mismo <br>
            mañana.
        </h1>

        <p>
            Empieza a construir ahora la vida financiera
            que siempre has querido.
        </p>

        <a href="register.html" class="cta-btn">
            ¡Comienza ya!
        </a>

    </div>

</section>

<section id="recursos">
    <h1>¡De <span class="c">C</span><span class="o">o</span><span class="i">i</span><span class="n">n</span><span class="k">k</span> para ti!</h1>

    <div class="cards-container">

         <div class="cards3">
            <img src="img/mujer.jpg" alt="" width="350">
            <div class="cards-texto">
             <h3>¿Ahorrar o Invertir?  <br> Diferencias y como empezar</h3><br>
             <p>Conoce las diferencias entre ahorrar e invertir y cual te conviene más</p> <br>
             <p ><a href="diferencias.php" class="more-bttn">Ver más</a></p>
        </div>
      
    </div>

    <div class="cards4">
        <img src="img/hombtr.jpg" alt="" width="310">
        <div class="cards-texto">
            <h3>Como crear un fondo <br> de emergencia paso a paso</h3><br>
            <p>Tener un fondo de emergencia <br> puede marcar la diferencia en <br> tu vida diaria</p> <br>
            <p ><a href="fondo.php" class="more-bttn">Ver más</a></p>
        </div>
        
    </div>

    <div class="cards3">
        <img src="img/hombre2.jpeg" alt="" width="350">
        <div class="cards-texto">
            <h3>10 hábitos financieros que cambiaran tu vida</h3><br>
            <p>Descubre los 10 hábitos de los que nadie habla para mejorar tus finanzas</p> <br>
            <p ><a href="habitos.php" class="more-bttn">Ver más</a></p>
        </div>
       
    </div>
    </div>
   

</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const sesion = localStorage.getItem("sesion");

    if (sesion === "activa") {
        const loginBtn = document.querySelector("#login a");

        if (loginBtn) {
            loginBtn.textContent = "Sesión iniciada ";
            loginBtn.href = "#";
        }
    }
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const sesion = localStorage.getItem("sesion");
    const loginBtn = document.getElementById("login");
    const perfilLink = document.getElementById("perfilLink");

    if (sesion === "activa") {
        if (loginBtn) loginBtn.style.display = "none";
        if (perfilLink) perfilLink.style.display = "block";

       
        const nombre = localStorage.getItem("usuario") || "odaduu";
        const foto = localStorage.getItem("foto");

        const imgElement = document.getElementById("foto");
        const initialsElement = document.getElementById("iniciales");

      
        if (imgElement && initialsElement) {
            if (foto && foto !== "null" && foto !== "") {
                imgElement.src = foto;
                imgElement.style.display = "block";
                initialsElement.style.display = "none";
            } else {
                imgElement.style.display = "none";
                initialsElement.style.display = "flex";
                
                const primeraLetra = nombre.trim().charAt(0).toUpperCase();
                initialsElement.textContent = primeraLetra || "U";
            }
        }
    }
});
</script>


 <script src="javaScript/homepage.js"></script>

 <script src="javaScript/navbar-mobile.js"></script>



<footer class="footer">
  <div class="footer-container">

   <div class="footer-logo">
    <img src="img/123repetido.png" alt="Logo Coink">
</div>

<p class="footer-text">
    Ahorra inteligente, vive mejor
</p>

<p class="footer-text2">
    Save Smart, Save with Coink.
</p>

   
    <p class="footer-copy">
      © 2026 CoinK · Todos los derechos reservados
    </p>

  </div>
</footer>

    
</body>
</html>