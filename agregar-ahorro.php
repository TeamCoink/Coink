<?php include 'components/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Ahorro</title>
    <link rel="stylesheet" href="style/agregar-ahorro.css">
    <link rel="stylesheet" href="style/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

 <section class="formulario-ahorro">
  <div class="contenedor-form">
    <form action="php/guardar-ahorro.php" method="POST">
      <h2>Agregar ahorro</h2>

      <label for="nombre">Nombre del ahorro:</label>
      <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre del ahorro" required>
      

      <label for="categoria">¿Para qué es el ahorro?</label>
      <input type="text" id="categoria" name="categoria" placeholder="Ingrese la categoría del ahorro" required>

      <label for="monto">Monto:</label>
      <input type="number" id="monto" name="monto" placeholder="Ingrese el monto del ahorro" required>

      <label for="fecha">Fecha:</label>
      <input type="date" id="fecha" name="fecha" required>

      <div class="acciones">
        <button type="submit" class="btn amarillo">Agregar</button>
        <button type="reset" class="btn verde"><a href="dashboard.php">Cancelar</a></button>
      </div>
    </form>
  </div>

  <!-- Cerdito a la par del formulario -->
  <div class="cerdito">
    <img src="img/coink3.png" alt="Cerdito ahorro">
  </div>
</section>

<!-- Waves verdes -->
<div class="waves">
  <svg viewBox="0 0 1440 320" preserveAspectRatio="none">
    <path fill="#4caf50" fill-opacity="1" 
          d="M0,160L60,165.3C120,171,240,181,360,176C480,171,600,149,720,160C840,171,960,213,1080,213.3C1200,213,1320,171,1380,149.3L1440,128L1440,320L0,320Z"></path>
    <path fill="#81c784" fill-opacity="0.7" 
          d="M0,192L80,186.7C160,181,320,171,480,176C640,181,800,203,960,213.3C1120,224,1280,224,1360,224L1440,224L1440,320L0,320Z"></path>
    <path fill="#a5d6a7" fill-opacity="0.5" 
          d="M0,224L60,213.3C120,203,240,181,360,176C480,171,600,181,720,192C840,203,960,213,1080,213.3C1200,213,1320,203,1380,197.3L1440,192L1440,320L0,320Z"></path>
  </svg>
</div>

<script src="javaScript/agregar-ahorro.js"></script>
 <script src="javaScript/homepage.js"></script>
</body>
</html>