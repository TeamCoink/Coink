<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include("php/conexion.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuarioId = $_SESSION['usuario_id'];
$nombreUsuario = $_SESSION['nombre'];


$guardado = $_GET['guardado'] ?? '';



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



$sqlGraficaGastos = "
SELECT
    MONTH(fecha) AS mes,
    SUM(monto) AS total
FROM gastos
WHERE usuario_id = ?
GROUP BY MONTH(fecha)
ORDER BY MONTH(fecha)
";

$stmtGraficaGastos = $conn->prepare($sqlGraficaGastos);
$stmtGraficaGastos->bind_param("i", $usuarioId);
$stmtGraficaGastos->execute();

$resultGraficaGastos =
    $stmtGraficaGastos->get_result();

$datosGastos =
    array_fill(0, 12, 0);

while($fila =
    $resultGraficaGastos->fetch_assoc()){

    $indice = $fila['mes'] - 1;

    $datosGastos[$indice] =
        $fila['total'];
}




$sqlCalendario = "
SELECT 
    DATE(fecha) AS fecha,
    SUM(monto) AS total
FROM ahorros
WHERE usuario_id = ?
GROUP BY DATE(fecha)
";

$stmtCalendario = $conn->prepare($sqlCalendario);
$stmtCalendario->bind_param("i", $usuarioId);
$stmtCalendario->execute();

$resultCalendario = $stmtCalendario->get_result();

$ahorrosPorDia = [];

while($fila = $resultCalendario->fetch_assoc()){

    $ahorrosPorDia[$fila['fecha']] = $fila['total'];
}


$sqlGastos = "
SELECT SUM(monto) AS total
FROM gastos
WHERE usuario_id = ?
";

$stmtGastos = $conn->prepare($sqlGastos);
$stmtGastos->bind_param("i", $usuarioId);
$stmtGastos->execute();

$resultGastos = $stmtGastos->get_result();
$dataGastos = $resultGastos->fetch_assoc();

$totalGastado = $dataGastos['total'] ?? 0;
$balance = $totalAhorro - $totalGastado;

$sqlPresupuesto = "

SELECT *

FROM presupuestos

WHERE usuario_id = ?

LIMIT 1

";

$stmtPresupuesto =
    $conn->prepare($sqlPresupuesto);

$stmtPresupuesto->bind_param(
    "i",
    $usuarioId
);

$stmtPresupuesto->execute();

$resultPresupuesto =
    $stmtPresupuesto->get_result();

$presupuesto =
    $resultPresupuesto->fetch_assoc();



$sqlGastosDia = "
SELECT
    DATE(fecha) AS fecha,
    SUM(monto) AS total
FROM gastos
WHERE usuario_id = ?
GROUP BY DATE(fecha)
";

$stmtGastosDia = $conn->prepare($sqlGastosDia);
$stmtGastosDia->bind_param("i", $usuarioId);
$stmtGastosDia->execute();

$resultGastosDia = $stmtGastosDia->get_result();

$gastosPorDia = [];

while($fila = $resultGastosDia->fetch_assoc()){

    $gastosPorDia[$fila['fecha']] = $fila['total'];
}
?>

<?php include 'components/navbar.php'; ?>
<?php include 'components/navbar-mobile.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/dashboard.css">
     <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
</head>
<body>
    
<?php if($guardado == 'ahorro'): ?>

    <div class="toast" id="toast">
         Ahorro guardado correctamente
    </div>

<?php elseif($guardado == 'gasto'): ?>

    <div class="toast" id="toast">
         Gasto registrado correctamente
    </div>

<?php endif; ?>

<section class="dashboard">

    <div class= "top-dashboard">
    
    <div class="left-cards">

        <div class="mini-card pink">

            <div class="icon-box">
                <span class="icon">💸</span>
            </div>

            <div class="card-info">
                <h4>Balance actual</h4>

                    <p>
                        $<?php echo number_format($balance, 2); ?>
                    </p>
            </div>

        </div>

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


     
        <div class="mini-card yellow">

            <div class="icon-box">
                <span class="icon">💸</span>
            </div>

            <div class="card-info">
                <h4>Total gastado</h4>

                    <p>
                        $<?php echo number_format($totalGastado, 2); ?>
                    </p>
            </div>

        </div>


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

        <div class="stat-card presupuesto-card">

                <div class="stat-icon">

                    📊

                </div>

                <div class="stat-info">

                    <h3>Presupuesto</h3>

                    <h2 id="presupuestoPorcentaje">

                        <?php echo round($presupuesto["porcentaje"] ?? 0); ?>%

                    </h2>
                    
                    <p id="presupuestoDisponible">

                        Disponible:
                        $<?php echo number_format($presupuesto["disponible"] ?? 0,2); ?>

                    </p>

                </div>
            </div>
    </div>


    <div class="chart-card">

        <div class="chart-header">
            <h2>Resumen financiero</h2>
            <p>Compara tus ahorros y gastos mes a mes 💰</p>
        </div>

        <canvas id="savingsChart"></canvas>

    </div>
    
    <div class="right-panel">

        
        <div class="coink-assistant">

            <img
                src="img/coink3.png"
                alt="Coink"
                class="assistant-img">

        </div>

      
        <div class="dashboard-buttons">

            <button
                id="openSavingModal"
                class="dashboard-btn ahorro-btn">

                ➕ Agregar ahorro
            </button>

           <button
                id="openExpenseModal"
                class="dashboard-btn gasto-btn">

                💸 Agregar gasto
            </button>

            <a href="metas.php"
            class="dashboard-btn meta-btn">
                🎯 Ver metas
            </a>

            <a href="presupuesto.php"
            class="dashboard-btn ahorro-btn">
                📋 Ver presupuesto
            </a>

        </div>

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

            <div class="calendar-content">

                <div class="calendar-left">

                    <div id="calendar"></div>

                </div>

                <div
                    class="calendar-details"
                    id="calendarDetails">

                    <div class="calendar-placeholder">

                        <div class="placeholder-icon">
                            📅
                        </div>

                        <h3>Selecciona un día</h3>

                        <p>
                            Haz clic en cualquier fecha del calendario
                            para visualizar los movimientos registrados.
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>

    </section>

</section>



<div class="modal-overlay" id="savingModal">

    <div class="dashboard-modal">

        <button class="close-modal" id="closeSavingModal">✖</button>

        <img src="img/123repetido.png" class="modal-pig">

        <h2>Nuevo ahorro</h2>

        <p>Registra un nuevo ahorro.</p>

        <form
            id="savingForm">

            <input
                type="text"
                name="nombre"
                placeholder="Nombre del ahorro"
                required>

            <select
                name="categoria"
                required>

                <option value="">Categoría</option>

                <option>Educación</option>

                <option>Viaje</option>

                <option>Emergencia</option>

                <option>personal</option>

                <option>Hogar</option>

                <option>Otro</option>

            </select>

            <input
                type="number"
                name="monto"
                placeholder="Monto"
                step="0.01"
                required>

            <input
                type="date"
                name="fecha"
                required>

            <div class="modal-buttons">

                <button
                    type="button"
                    class="cancel-btn"
                    id="cancelSaving">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="save-btn">

                     Guardar

                </button>

            </div>

        </form>

    </div>

</div>


<div class="modal-overlay" id="expenseModal">

    <div class="dashboard-modal expense">

        <button class="close-modal" id="closeExpenseModal">✖</button>

        <img src="img/123repetido.png" class="modal-pig">

        <h2>Nuevo gasto</h2>

        <p>Registra un nuevo gasto.</p>

        <form
            id="expenseForm">

            <input
                type="text"
                name="nombre"
                placeholder="Nombre del gasto"
                required>

            <select
                name="categoria"
                required>

                <option value="">Categoría</option>

                <option>Alimentación</option>

                <option>Transporte</option>

                <option>Educación</option>

                <option>Salud</option>

                <option>Entretenimiento</option>

                <option>Otro</option>

            </select>

            <input
                type="number"
                name="monto"
                placeholder="Monto"
                step="0.01"
                required>

            <input
                type="date"
                name="fecha"
                required>

            <div class="modal-buttons">

                <button
                    type="button"
                    class="cancel-btn"
                    id="cancelExpense">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="expense-btn">

                     Guardar

                </button>

            </div>

        </form>

    </div>

</div>
     
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

const presupuesto = {

    ingreso: <?php echo $presupuesto['ingreso'] ?? 0; ?>,

    asignado: <?php echo $presupuesto['asignado'] ?? 0; ?>,

    disponible: <?php echo $presupuesto['disponible'] ?? 0; ?>,

    porcentaje: <?php echo $presupuesto['porcentaje'] ?? 0; ?>

};
console.log(presupuesto);
</script>

<script>
const ctx = document.getElementById('savingsChart');

const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 350);

gradient.addColorStop(0, 'rgba(248, 200, 210, 0.55)');
gradient.addColorStop(1, 'rgba(217, 237, 191, 0.12)');

new Chart(ctx, {

    type: 'bar',

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

        datasets: [

            {
                label: ' Ahorros',

                data: <?php echo json_encode($datosAhorro); ?>,

                backgroundColor: '#B8E6A3',

                borderColor: '#7BC96F',

                borderWidth: 2,

                borderRadius: 12,

                borderSkipped: false,

                maxBarThickness: 35
            },

            {
                label: ' Gastos',

                data: <?php echo json_encode($datosGastos); ?>,

                backgroundColor: '#F8C8D2',

                borderColor: '#F4A6B8',

                borderWidth: 2,

                borderRadius: 12,

                borderSkipped: false,

                maxBarThickness: 35
            }

        ]
    },

    options: {

        responsive: true,
        maintainAspectRatio: false,

        datasets:{

            bar:{

                categoryPercentage:0.6,

                barPercentage:0.8

            }

        },

        interaction: {
            intersect: false,
            mode: 'index'
        },

        plugins: {
            legend: {

                display: true,

                position: 'top',

                labels: {

                    usePointStyle: true,

                    padding: 20,

                    font: {
                        size: 13
                    }
                }
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

                callbacks:{

                        label:function(context){

                            return context.dataset.label + ': $' + context.raw;

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

<script>

const calendar = document.getElementById('calendar');
const monthYear = document.getElementById('monthYear');

const prevMonth = document.getElementById('prevMonth');
const nextMonth = document.getElementById('nextMonth');

const savingsData =
<?php echo json_encode($ahorrosPorDia); ?>;

const expenseData =
<?php echo json_encode($gastosPorDia); ?>;

let currentDate = new Date();

const meses = [
    'Enero', 'Febrero', 'Marzo',
    'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre',
    'Octubre', 'Noviembre', 'Diciembre'
];

function renderCalendar(){

    calendar.innerHTML = '';

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    monthYear.textContent =
        `${meses[month]} ${year}`;

    const firstDay =
        new Date(year, month, 1).getDay();

    const daysInMonth =
        new Date(year, month + 1, 0).getDate();
 
    const diasSemana = [
        'L','M','M','J','V','S','D'
    ];
 

    diasSemana.forEach(day => {

       const dayName =
        document.createElement('div');

        dayName.classList.add('week-day');

        dayName.innerHTML =
            `<strong>${day}</strong>`;

        calendar.appendChild(dayName);
    });

    for(let i = 0; i < firstDay; i++){

        const empty =
            document.createElement('div');

        calendar.appendChild(empty);
    }

    for(let day = 1; day <= daysInMonth; day++){

        const dayElement =
            document.createElement('div');

        dayElement.classList.add('day');

        const fechaCompleta =
            `${year}-${String(month + 1)
            .padStart(2,'0')}-${String(day)
            .padStart(2,'0')}`;

        const ahorro =
            savingsData[fechaCompleta];

        const gasto =
            expenseData[fechaCompleta];

        if(ahorro && gasto){

            dayElement.classList.add('has-both');

            dayElement.title =
                `💰 Ahorro: $${ahorro}
        💸 Gasto: $${gasto}`;

        }
        else if(ahorro){

            dayElement.classList.add('has-saving');

            dayElement.title =
                `💰 Ahorro: $${ahorro}`;

        }
        else if(gasto){

            dayElement.classList.add('has-expense');

            dayElement.title =
                `💸 Gasto: $${gasto}`;
        }
                dayElement.innerHTML = `
                    <div class="day-number">
                        ${day}
                    </div>
                `;

                dayElement.style.cursor = "pointer";

                dayElement.addEventListener('click', () => {

                    cargarDetalleDia(fechaCompleta);

                });

                calendar.appendChild(dayElement);
            }
     }

prevMonth.addEventListener('click', () => {

    currentDate.setMonth(
        currentDate.getMonth() - 1
    );

    renderCalendar();
});

nextMonth.addEventListener('click', () => {

    currentDate.setMonth(
        currentDate.getMonth() + 1
    );

    renderCalendar();
});

renderCalendar();

async function cargarDetalleDia(fecha){

    const panel =
        document.getElementById(
            'calendarDetails'
        );

    const response =
        await fetch(
            `php/obtener-ahorros-dia.php?fecha=${fecha}`
        );

    const data =
        await response.json();

        if(data.length === 0){

    panel.innerHTML = `
        <div class="empty-day">

            <div class="empty-icon">
                📅
            </div>

            <h3>Sin movimientos</h3>

            <p>
                No registraste ahorros ni gastos
                este día 🐷
            </p>

        </div>
    `;

    return;
}

    let total = 0;

    let html = `
        <div class="details-header">

            <h3>
                💰 Movimientos 
            </h3>

            <div class="selected-date">
                ${fecha}
            </div>

        </div>
    `;

    data.forEach(item => {

        if(item.tipo === 'ahorro'){
            total += parseFloat(item.monto);
        }else{
            total -= parseFloat(item.monto);
        }

        html += `
            <div class="saving-item">

                <div class="saving-left">

                    <div class="saving-icon">
                        ${item.tipo === 'ahorro' ? '💰' : '💸'}
                    </div>

                    <div class="saving-info">

                        <div class="saving-name">
                            ${item.nombre}
                        </div>

                        <div class="saving-category">
                            ${item.categoria}
                        </div>

                    </div>

                </div>

                <div class="saving-amount">
                   ${item.tipo === 'ahorro' ? '+' : '-'}$${parseFloat(item.monto).toFixed(2)}
                </div>

            </div>
        `;
    });

    html += `
        <div class="total-day">

            <span>
                Total ahorrado del día
            </span>

            <div class="total-money">
                $${total.toFixed(2)}
            </div>

        </div>
    `;

    panel.innerHTML = html;
}
</script>

<script src="javaScript/homepage.js"></script>
<script src="javaScript/dashboard.js"></script>
<script src="javaScript/navbar-mobile.js"></script>

    <footer class="footer">
    <div class="footer-container">

    <div class="footer-logo">
        <img src="img/123repetido.png" alt="Logo Coink">
    </div>

    <p class="footer-text">
        Ahorra inteligente, vive mejor
    </p>

        <div class="footer-social">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-whatsapp"></i></a>
        </div>

        <p class="footer-copy">
        © 2026 CoinK · Todos los derechos reservados
        </p>

    </div>
    </footer>

</body>
</html>