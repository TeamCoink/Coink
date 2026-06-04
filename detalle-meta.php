<?php
session_start();

// CONTROL DE SEGURIDAD: Si no hay sesión activa, lo manda directo al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

// Capturamos el ID del usuario en sesión de forma segura para JavaScript
$usuarioId = $_SESSION['usuario_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de la Meta - COINK</title>
    <!-- 1. Cargamos fuentes de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- 2. Cargamos el diseño del Navbar -->
    <link rel="stylesheet" href="style/navbar.css">
    <!-- 3. Cargamos los estilos de metas al final -->
    <link rel="stylesheet" href="style/metas.css"> 
</head>
<body>


  


    <section class="goals-container">
        <a href="metas.php" class="back-link">← Volver a mis metas</a>

        <div class="detail-card">
            <h1 id="detalleNombre">NOMBRE DE LA META</h1>
            <p id="detalleMontoTotal">Meta: $0</p>

            <div class="progress-label-wrapper">
                <label>Tu Progreso...</label>
                <span id="detallePorcentaje">0%</span>
            </div>
            
            <div class="progress-bar-container detail-bar-layout">
                <div id="detalleBarra" class="progress-bar-fill"></div>
            </div>

            <div class="amount-labels-row">
                <span id="detalleAhorrado">$0</span>
                <span id="detalleFalta">Falta: $0</span>
            </div>

            <form id="formAbono" onsubmit="agregarAbonoForm(event)">
                <input type="number" id="inputAbono" placeholder="$ Cantidad a agregar..." required min="1">
                <button type="submit">Agregar</button>
            </form>
        </div>
    </section>

    <script>
        // 1. VARIABLES DE CONTROL DE SESIÓN Y DOM
        const ID_USUARIO = "<?php echo addslashes($usuarioId); ?>";
        const CLAVE_LOCAL = `misMetas_user_${ID_USUARIO}`;

        const detalleNombre = document.getElementById('detalleNombre');
        const detalleMontoTotal = document.getElementById('detalleMontoTotal');
        const detallePorcentaje = document.getElementById('detallePorcentaje');
        const detalleBarra = document.getElementById('detalleBarra');
        const detalleAhorrado = document.getElementById('detalleAhorrado');
        const detalleFalta = document.getElementById('detalleFalta');
        const inputAbono = document.getElementById('inputAbono');

        // Lógica de activación del menú desplegable "More" que tienes en tu navbar
        const moreBtn = document.getElementById('moreBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');
        if (moreBtn && dropdownMenu) {
            moreBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });
            document.addEventListener('click', function() {
                dropdownMenu.classList.remove('show');
            });
        }

        // 2. RECUPERAR EL CAJÓN ESPECÍFICO DE ESTE USUARIO
        let misMetas = JSON.parse(localStorage.getItem(CLAVE_LOCAL)) || [];
        let metaIndex = localStorage.getItem("metaSeleccionada");

        if (metaIndex === null || !misMetas[metaIndex]) {
            window.location.href = "metas.php";
        }

        let metaActual = misMetas[metaIndex];

        // 3. ACTUALIZAR INTERFAZ GRÁFICA
        function actualizarVistaDetalle() {
            const porcentaje = metaActual.objetivo > 0 ? Math.round((metaActual.actual / metaActual.objetivo) * 100) : 0;
            const falta = metaActual.objetivo - metaActual.actual;

            detalleNombre.textContent = metaActual.nombre;
            detalleMontoTotal.textContent = `Meta: $${metaActual.objetivo}`;
            detallePorcentaje.textContent = `${porcentaje}%`;
            detalleAhorrado.textContent = `$${metaActual.actual}`;
            
            if (falta > 0) {
                detalleFalta.textContent = `Falta: $${falta}`;
            } else {
                detalleFalta.textContent = `Falta: $0 (¡Completada!)`;
            }

            if (detalleBarra) {
                detalleBarra.style.width = `${Math.min(porcentaje, 100)}%`; 
            }
        }

        // 4. FUNCIÓN PARA AGREGAR ABONOS
        window.agregarAbonoForm = function(event) {
            event.preventDefault();

            const montoAbono = parseFloat(inputAbono.value) || 0;
            if (montoAbono <= 0) return;

            metaActual.actual += montoAbono;
            misMetas[metaIndex] = metaActual;
            localStorage.setItem(CLAVE_LOCAL, JSON.stringify(misMetas));

            actualizarVistaDetalle();
            event.target.reset();
        };

        actualizarVistaDetalle();
    </script>
</body>
</html>