<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coink</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

   <?php include 'components/navbar.php'; ?>
   
        <div class="container2">
          <img src="img/heroimage.png" alt="homepage photo" height="609vh">
          <div id="ap"><button class="button1">Aprender</button></div>
          <div id="un"><button class="button2">Unirme</button></div>
        </div>


    <div id="introduccion">
        <img src="" alt="">
    </div>

  <div id="features">
    <div class="cards">
        <img src="img/librito.png" alt="" width="250px">
        <h3>Aprender</h3>
        <p>Conceptos claros y metodos efectivos</p>
    </div>

    <div class="cards">
        <img src="img/flechaRosa.png" alt="" width="250px">
        <h3>Planifica</h3>
        <p>Organiza tus metas y finanzas propias</p>
    </div>

    <div class="cards">
        <img src="img/Plantita.png.png" alt="" width="250px">
        <h3>Ahorra</h3>
        <p>Pequeños hábitos, grandes cambios</p>
    </div>

    <div class="cards">
        <img src="img/barrita verde.png" alt="" width="250px">
        <h3>Invierte</h3>
        <p>Haz crecer tu dinero de manera rapidas</p>
    </div>

  </div>
    

  <div id="coink">
    <img src="" alt="">

    <div class="contenedor">

    <div id="coink">
    <img src="img/libroverde.jpg" alt="icono" width="450px">
  </div>

  <div class="texto">
     <h1>¿Qué es 
        <span class="c">C</span><span class="o">o</span><span class="i">i</span><span class="n">n</span><span class="k">k</span>
     ?</h1><br>
     <p>Somos una plataforma de educación financiera que busca ayudarte a comprender el dinero, aprender a administrar tus ingresos y que puedas usar Coink como una  herramienta para mejorar tu vida, ofreciendote herramientas que te ayudaran a que veas como tu dinero crece de manera inteligente. </p>

     <div id="knowmore"><button class="button3">Conoce más →</button></div>

  </div>
  

  </div>

  <div id="beneficios">
    

    <h1>Beneficios</h1>
    <div class="linea1"></div>

    <div class="cards2">
        <img src="img/agenda.jpg" alt="" width="300" height="207"><br>
        <p>Coink te brinda distintos métodos de ahorro que se ajustan a tus necesidades</p>
    </div>

    <div class="cards2">
        <img src="img/planta.jpg" alt="" width="300"><br>
        <p>Puedes crear metas individuales o con tus amigos y familiares de tu elección</p>
    </div>

    <div class="cards2">
        <img src="img/chart.jpg" alt="" width="300" height="207"><br>
        <p>Conoce el progreso diario y mensual de como llevas tus ahorros</p>
    </div>


  </div>

  <div class="hero2">
    <img src="img/planta2.jpg" alt="" height="655vh">
    <div id="start"><button class="button4">Comienza Ya!</button></div>
  </div>

  <div id="recursos">
    <h1>¡De <span class="c">C</span><span class="o">o</span><span class="i">i</span><span class="n">n</span><span class="k">k</span> para ti!</h1>

    <div class="cards3">
        <img src="img/mujer.jpg" alt="" width="350">
        <div class="texto1">
             <h3>Presupuesto y sus beneficios</h3><br>
             <p>¡Descubre que es un presupuesto y <br> que beneficios trae consigo!</p>
        </div>
      
    </div>

    <div class="cards3">
        <img src="img/hombtr.jpg" alt="" width="350">
        <div class="texto2">
            <h3>¿Deseo o necesidad?</h3><br>
            <p>Identifica si tu siguiente compra es <br> un solo un deseo o realmente lo <br> necesitas</p>
        </div>
        
    </div>

    <div class="cards3">
        <img src="img/hombre2.jpeg" alt="" width="350">
        <div class="texto3">
            <h3>Ahorro inteligente</h3><br>
            <p>Aprende a ahorrar correctamente y que <br> metodos se ajustan a tí</p>
        </div>
       
    </div>

  </div>
 

  </div>
  
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
        // Mantiene la lógica original del navbar que ya funciona
        if (loginBtn) loginBtn.style.display = "none";
        if (perfilLink) perfilLink.style.display = "block";

        // NUEVO: Lógica segura para el círculo del Perfil
        const nombre = localStorage.getItem("usuario") || "odaduu";
        const foto = localStorage.getItem("foto");

        const imgElement = document.getElementById("foto");
        const initialsElement = document.getElementById("iniciales");

        // Solo actúa si los elementos visuales del perfil existen en la página
        if (imgElement && initialsElement) {
            if (foto && foto !== "null" && foto !== "") {
                imgElement.src = foto;
                imgElement.style.display = "block";
                initialsElement.style.display = "none";
            } else {
                imgElement.style.display = "none";
                initialsElement.style.display = "flex";
                
                // Toma la primera letra del usuario en mayúscula (Ej: "O")
                const primeraLetra = nombre.trim().charAt(0).toUpperCase();
                initialsElement.textContent = primeraLetra || "U";
            }
        }
    }
});
</script>


 <script src="javaScript/homepage.js"></script>S
 </body>
 </html>