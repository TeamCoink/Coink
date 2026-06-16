<?php include 'components/navbar.php'; ?>
<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include("php/conexion.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

$usuarioId = $_SESSION['usuario_id'];
$nombreUsuario = $_SESSION['nombre'];


$guardado = isset($_GET['guardado']);


// ============================
// TOTAL AHORRADO
// ============================

$sqlAhorro = "
SELECT SUM(monto) AS total
FROM ahorros
WHERE usuario_id = ?
";

$stmtAhorro = $conn->prepare($sqlAhorro);
$stmtAhorro->bind_param("i", $usuarioId);
$stmtAhorro->execute();

$resultAhorro = $stmtAhorro->get_result();
$dataAhorro = $resultAhorro->fetch_assoc();

$totalAhorro = $dataAhorro['total'] ?? 0;


// ============================
// TOTAL METAS
// ============================

$sqlMetas = "
SELECT COUNT(*) AS total_metas
FROM metas
WHERE usuario_id = ?
";

$stmtMetas = $conn->prepare($sqlMetas);
$stmtMetas->bind_param("i", $usuarioId);
$stmtMetas->execute();

$resultMetas = $stmtMetas->get_result();
$dataMetas = $resultMetas->fetch_assoc();

$totalMetas = $dataMetas['total_metas'];


// ============================
// META MÁS AVANZADA
// ============================

$sqlMetaTop = "
SELECT nombre, objetivo, actual,
(actual / objetivo * 100) AS porcentaje
FROM metas
WHERE usuario_id = ?
ORDER BY porcentaje DESC
LIMIT 1
";

$stmtTop = $conn->prepare($sqlMetaTop);
$stmtTop->bind_param("i", $usuarioId);
$stmtTop->execute();

$resultTop = $stmtTop->get_result();
$metaTop = $resultTop->fetch_assoc();


// ============================
// GRAFICA DE AHORROS POR MES
// ============================

$sqlGrafica = "
SELECT 
    MONTH(fecha) AS mes,
    SUM(monto) AS total
FROM ahorros
WHERE usuario_id = ?
GROUP BY MONTH(fecha)
ORDER BY MONTH(fecha)
";

$stmtGrafica = $conn->prepare($sqlGrafica);
$stmtGrafica->bind_param("i", $usuarioId);
$stmtGrafica->execute();

$resultGrafica = $stmtGrafica->get_result();

$meses = [
    "Ene", "Feb", "Mar", "Abr",
    "May", "Jun", "Jul", "Ago",
    "Sep", "Oct", "Nov", "Dic"
];

$datosAhorro = array_fill(0, 12, 0);

while($fila = $resultGrafica->fetch_assoc()){

    $indice = $fila['mes'] - 1;

    $datosAhorro[$indice] = $fila['total'];
}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/dashboard.css">
    
</head>
<body>
    

  <?php if($guardado): ?>
      <div class="toast" id="toast">
          ✅ Ahorro guardado correctamente
      </div>
  <?php endif; ?>


<section class="dashboard">

<div class= "top-dashboard">
   
  <div class="left-cards">

      <!-- Saldo actual -->
      <div class="mini-card pink">

          <div class="icon-box">
              <span class="icon">💸</span>
          </div>

          <div class="card-info">
              <h4>Saldo actual</h4>

              <p>
                  $<?php echo number_format($totalAhorro, 2); ?>
              </p>
          </div>

      </div>


      <!-- Total ahorrado -->
      <div class="mini-card green">

          <div class="icon-box">
              <span class="icon">💰</span>
          </div>

          <div class="card-info">
              <h4>Total ahorrado</h4>

              <p>
                  $<?php echo number_format($totalAhorro, 2); ?>
              </p>
          </div>

      </div>


      <!-- Metas activas -->
      <div class="mini-card yellow">

          <div class="icon-box">
              <span class="icon">🎯</span>
          </div>

          <div class="card-info">
              <h4>Metas activas</h4>

              <p>
                  <?php echo $totalMetas; ?>
              </p>
          </div>

      </div>


      <!-- Meta más cercana -->
      <div class="mini-card pastel">

          <div class="icon-box">
              <span class="icon">🌴</span>
          </div>

          <div class="card-info">

              <h4>Meta más cercana</h4>

              <?php if($metaTop): ?>

                  <span class="meta-name">
                      <?php echo $metaTop['nombre']; ?>
                  </span>

                  <p>
                      <?php echo round($metaTop['porcentaje']); ?>%
                  </p>

              <?php else: ?>

                  <p>Sin metas</p>

              <?php endif; ?>

          </div>
    </div>
</div>


<!-- GRAFICA CENTRAL -->
<div class="chart-card">

    <div class="chart-header">
        <h2>Crecimiento de ahorro</h2>
        <p>Tus ahorros durante los últimos meses 📈</p>
    </div>

    <canvas id="savingsChart"></canvas>

</div>

<!-- PANEL DERECHO -->
<div class="right-panel">

    <!-- CERDITO -->
    <div class="coink-mascot">
        <img src="img/coink3.png" alt="Coink Mascota">
    </div>

    <!-- BOTONES -->
    <div class="dashboard-buttons">

        <a href="agregar-ahorro.php"
           class="dashboard-btn ahorro-btn">
            ➕ Agregar ahorro
        </a>

        <a href="metas.php"
           class="dashboard-btn meta-btn">
            🎯 Ver metas
        </a>

    </div>
</div>


<section class="calendar-section">

    <div class="calendar-card">

            <div class="calendar-header">

                <div>
                    <h2>Calendario de ahorro 📅</h2>
                    <p>Consulta tus movimientos diarios</p>
                </div>

                <div class="calendar-navigation">

                    <button id="prevMonth">
                        ←
                    </button>

                    <h3 id="monthYear"></h3>

                    <button id="nextMonth">
                        →
                    </button>

                </div>

            </div>

        <div id="calendar"></div>

    </div>
    </section>

</section>
     
<script>
const toast = document.getElementById("toast");

if(toast){

    setTimeout(() => {

        toast.style.opacity = "0";
        toast.style.transition = "0.5s";

        setTimeout(() => {
            toast.remove();
        }, 500);

    }, 3000);

}
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('savingsChart');

const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 350);

gradient.addColorStop(0, 'rgba(248, 200, 210, 0.55)');
gradient.addColorStop(1, 'rgba(217, 237, 191, 0.12)');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: [
            'Ene',
            'Feb',
            'Mar',
            'Abr',
            'May',
            'Jun',
            'Jul',
            'Ago',
            'Sep',
            'Oct',
            'Nov',
            'Dic'
        ],

        datasets: [{

            label: 'Ahorros',

            data: <?php echo json_encode($datosAhorro); ?>,

            borderColor: '#F4A6B8',

            backgroundColor: gradient,

            fill: true,

            borderWidth: 4,

            tension: 0.45,

            pointRadius: 7,

            pointHoverRadius: 10,

            pointBackgroundColor: '#FFE89A',

            pointBorderColor: '#4E9F5A',

            pointBorderWidth: 2,

            pointHoverBorderWidth: 3,

            pointHoverBackgroundColor: '#FFD66B'
        }]
    },

    options: {

        responsive: true,
        maintainAspectRatio: false,

        interaction: {
            intersect: false,
            mode: 'index'
        },

        plugins: {

            legend: {
                display: false
            },

            tooltip: {

                backgroundColor: '#ffffff',

                titleColor: '#333',

                bodyColor: '#4E9F5A',

                borderColor: '#D9EDBF',

                borderWidth: 2,

                cornerRadius: 16,

                padding: 14,

                displayColors: false,

                callbacks: {

                    label: function(context){
                        return '$' + context.raw + ' ahorrados 💰';
                    }
                }
            }
        },

        scales: {

            x: {

                grid: {
                    display: false
                },

                border: {
                    display: false
                },

                ticks: {
                    color: '#777',
                    font: {
                        size: 13
                    }
                }
            },

            y: {

                beginAtZero: true,

                border: {
                    display: false
                },

                grid: {
                    color: 'rgba(0,0,0,0.05)'
                },

                ticks: {

                    color: '#777',

                    callback: function(value){
                        return '$' + value;
                    }
                }
            }
        },

        animation: {

            duration: 2200,

            easing: 'easeOutQuart'
        }
    }
});
</script>


</body>
</html>