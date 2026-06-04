<?php
session_start();

// CONTROL DE SEGURIDAD: Si no hay sesión activa de COINK, saca al intruso al login de inmediato
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

// Capturamos el ID único del usuario en sesión
$usuarioId = $_SESSION['usuario_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Metas - COINK</title>
    <!-- 1. Cargamos fuentes de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- 2. Cargamos el diseño del Navbar -->
  <link rel="stylesheet" href="/coink/style/navbar.css">
    <!-- 3. Cargamos los estilos de metas al final -->
    <link rel="stylesheet" href="style/metas.css">
</head>
<body>

<?php include 'components/navbar.php'; ?>
    
    <section class="goals-container">
        <!-- Todo tu contenido existente aquí -->
    </section>

    <script>
        // MANTÉN AQUÍ SOLO TU SCRIPT ORIGINAL DE METAS
        // No incluyas el script del "moreBtn" aquí, ¡ya está en el navbar!
    </script>
     
   

    <section class="goals-container">
        <header class="goals-header">
            <h1>Mis Metas</h1>
            <p class="subtitle">Organiza y alcanza tus objetivos</p>
            
            <div class="counters">
                <span class="counter-total">0 total</span>
                <span class="counter-completed">0 completadas</span>
            </div>
        </header>

        <div class="goals-form-wrapper">
            <form class="goals-form" onsubmit="agregarMetaForm(event)">
                <div class="form-inputs">
                    <input type="text" placeholder="Escribe una nueva meta..." required>
                    <input type="number" placeholder="Monto objetivo ($)..." required min="1">
                </div>
                <button type="submit">+ Agregar</button>
            </form>
        </div>

        <div class="goals-list-wrapper" id="goalsListWrapper">
            <ul class="goals-list" id="goalsList"></ul>
        </div>
    </section>

    <script>
        // 1. CAPTURA DE SESIÓN DESDE PHP
        const ID_USUARIO = "<?php echo addslashes($usuarioId); ?>";
        const CLAVE_LOCAL = `misMetas_user_${ID_USUARIO}`;

        const goalsList = document.getElementById('goalsList');
        const counterTotal = document.querySelector('.counter-total');
        const counterCompleted = document.querySelector('.counter-completed');

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

        // 2. CARGA INTELIGENTE DE DATOS
        let misMetas = JSON.parse(localStorage.getItem(CLAVE_LOCAL)) || [];

        // 3. RENDERIZAR LAS TARJETAS EN PANTALLA
        function renderizarMetas() {
            if (!goalsList) return;
            goalsList.innerHTML = '';

            if (misMetas.length === 0) {
                goalsList.innerHTML = `<p class="no-goals-msg" style="text-align: center; color: #E633AA; font-weight: bold; margin: 15px 0;">No tienes metas aún. ¡Agrega tu primera meta!</p>`;
                actualizarContadores();
                return;
            }

            misMetas.forEach((meta, index) => {
                const porcentaje = meta.objetivo > 0 ? Math.round((meta.actual / meta.objetivo) * 100) : 0;
                const li = document.createElement('li');
                li.className = 'goal-item';
                li.setAttribute('onclick', `verDetalleMeta(${index})`);
                
                li.innerHTML = `
                    <div class="goal-checkbox-wrapper">
                        <div class="checkbox-circle ${meta.actual >= meta.objetivo ? 'checked' : ''}"></div>
                    </div>
                    <div class="goal-content" style="flex-grow: 1; cursor: pointer;">
                        <div class="goal-info" style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span class="goal-title" style="font-weight: bold; color: #222222;">${meta.nombre}</span>
                            <span class="goal-percentage" style="color: #E633AA; font-weight: bold;">${porcentaje}%</span>
                        </div>
                        <div class="progress-bar-container" style="width: 100%; height: 12px; background-color: #E0E0E0; border-radius: 10px; overflow: hidden; margin-bottom: 6px;">
                            <div class="progress-bar-fill" style="height: 100%; background-color: #E633AA; border-radius: 10px; transition: width 0.4s ease; width: ${Math.min(porcentaje, 100)}%"></div>
                        </div>
                        <div class="goal-amounts" style="font-size: 0.9rem; color: #FA4BB1; font-weight: bold;">
                            $${meta.actual} / $${meta.objetivo}
                        </div>
                    </div>
                    <button class="btn-delete" onclick="eliminarMeta(event, ${index})" style="background: none; border: none; cursor: pointer; font-size: 1.2rem; opacity: 0.5;">🗑️</button>
                `;
                goalsList.appendChild(li);
            });
            actualizarContadores();
        }

        function actualizarContadores() {
            if (counterTotal) counterTotal.textContent = `${misMetas.length} total`;
            if (counterCompleted) {
                const completadas = misMetas.filter(m => m.actual >= m.objetivo).length;
                counterCompleted.textContent = `${completadas} completadas`;
            }
        }

        // 5. SELECCIONAR META Y VER DETALLES
        window.verDetalleMeta = function(index) {
            localStorage.setItem("metaSeleccionada", index);
            localStorage.setItem("usuarioMetaActiva", ID_USUARIO);
            window.location.href = "detalle-meta.php";
        };

        // 6. ACCIÓN AL AGREGAR UNA META NUEVA
        window.agregarMetaForm = function(event) {
            event.preventDefault();
            const goalsForm = event.target;
            const inputNombre = goalsForm.querySelector('input[type="text"]');
            const inputMonto = goalsForm.querySelector('input[type="number"]');

            if (!inputNombre || !inputMonto) return;

            const nuevaMeta = {
                nombre: inputNombre.value.trim(),
                objetivo: parseFloat(inputMonto.value) || 0,
                actual: 0
            };

            misMetas.push(nuevaMeta);
            localStorage.setItem(CLAVE_LOCAL, JSON.stringify(misMetas));
            renderizarMetas();
            goalsForm.reset();
        };

        // 7. BORRAR UNA META DE LA LISTA
        window.eliminarMeta = function(event, index) {
            event.stopPropagation();
            misMetas.splice(index, 1);
            localStorage.setItem(CLAVE_LOCAL, JSON.stringify(misMetas));
            renderizarMetas();
        };

        renderizarMetas();
    </script>
</body>
</html>