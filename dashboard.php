
<?php include 'components/navbar.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Financiero</title>
  <link rel="stylesheet" href="style/dashboard.css">
  <link rel="stylesheet" href="style/index.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <header>
    <h1>Bienvenido a tu ahorro</h1>
    <p>¡Vamos a alcanzar tus metas!</p>
  </header>


  <!-- KPIs -->
<section class="resumen">
  <!-- Columna izquierda -->
  <div class="resumen-izq">
    <div class="resumen-card rosa">Saldo actual: $100</div>
    <div class="resumen-card verde">Gastos totales: $0</div>
    <div class="resumen-card amarillo">Total de ingresos: $100</div>
    <div class="resumen-card rosa">Meta más cercana: Viaje</div>
  </div>

<div class="circle">
  <span id="porcentajeTexto">0% Ahorrado</span>
</div>


  <!-- Derecha con cerdito -->
  <div class="resumen-der">
    <img src="img/oink.png" alt="Cerdito ahorro" class="cerdito">
  </div>
</section>




  <!-- Metas -->
<section class="metas">
  <h2>Metas de ahorro</h2>
  <div class="metas-grid">
    <!-- Card Viaje -->
    <div class="meta-card">
      <img src="img/viaje.jpg" alt="Viaje">
      <div class="meta-info">
        <h3>Viaje</h3>
        <p>60%</p>
      </div>
    </div>

    <!-- Card Bicicleta -->
    <div class="meta-card">
      <img src="img/bici.jpg" alt="Bicicleta">
      <div class="meta-info">
        <h3>Bicicleta</h3>
        <p>25%</p>
      </div>
    </div>

    <!-- Card Laptop -->
    <div class="meta-card">
      <img src="img/laptop.jpg" alt="Laptop">
      <div class="meta-info">
        <h3>Nueva Laptop</h3>
        <p>80%</p>
      </div>
    </div>
  </div>

  <!-- Botones debajo de las cards -->
  <div class="metas-botones">
    <button class="btn rosa">Ver metas</button>
    <button class="btn verde"> <a href = agregar-ahorro.php> Agregar Ahorro </a> </button>
  </div>
</section>

<section class="fila-tres">
  <!-- Pie chart -->
  <div class="contenedor grafica" onclick="mostrarModal('graficoPie')">
    <h3>¡Analiza cómo has distribuido tu ahorro!</h3>
    <canvas id="graficoPie"></canvas>
  </div>

  <!-- Line chart -->
  <div class="contenedor grafica" onclick="mostrarModal('graficoMensual')">
    <h3>¡Revisa tu avance mensual!</h3>
    <canvas id="graficoMensual"></canvas>
  </div>

  <!-- Tareas -->
  <div class="contenedor tareas">
    <h3>Tareas</h3>
    <ul id="listaTareas">
      <li><input type="checkbox"> Depositar ahorro</li>
      <li><input type="checkbox"> Revisar presupuesto</li>
      <li><input type="checkbox"> Analizar gastos</li>
    </ul>
    <button class="btn verde">+ Añadir tarea</button>
  </div>
</section>




  <header>
    <h1>Calendario de Ahorro</h1>
    <p>Selecciona un día para ver tus movimientos</p>
  </header>

  <!-- Calendario visual -->
  <section class="calendario">
    <h2>Abril 2026</h2>
    <div class="calendario-grid" id="calendarioGrid">
      <!-- Los días se generan con JS -->
    </div>
    <div id="detalle-dia">Selecciona un día para ver detalles</div>
  </section>



  <script src="dashboard.js"></script>
  <script src="javaScript/homepage.js"></script>
</body>
</html>
