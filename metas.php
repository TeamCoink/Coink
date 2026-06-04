<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}
$usuarioId = $_SESSION['usuario_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Metas - COINK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="style/metas.css">
</head>
<body>

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
                    <input type="text" id="inputNombre" placeholder="Escribe una nueva meta..." required>
                    <input type="number" id="inputMonto" placeholder="Monto objetivo ($)..." required min="1">
                </div>
                <button type="submit">+ Agregar</button>
            </form>
        </div>

        <div class="goals-list-wrapper" id="goalsListWrapper">
            <ul class="goals-list" id="goalsList"></ul>
        </div>
    </section>

    <script>
        const goalsList = document.getElementById('goalsList');
        const counterTotal = document.querySelector('.counter-total');
        const counterCompleted = document.querySelector('.counter-completed');
        let misMetas = [];

        function cargarMetas() {
            fetch('php/obtener_metas.php')
                .then(res => res.json())
                .then(data => {
                    misMetas = data;
                    renderizarMetas();
                })
                .catch(err => console.error("Error al cargar:", err));
        }

        function renderizarMetas() {
            goalsList.innerHTML = '';
            if (misMetas.length === 0) {
                goalsList.innerHTML = `<p class="no-goals-msg">No tienes metas aún.</p>`;
            } else {
                misMetas.forEach((meta) => {
                    const porcentaje = meta.objetivo > 0 ? Math.round((meta.actual / meta.objetivo) * 100) : 0;
                    const li = document.createElement('li');
                    li.className = 'goal-item';
                    li.innerHTML = `
                        <div class="checkbox-circle ${meta.actual >= meta.objetivo ? 'checked' : ''}"></div>
                        <div class="goal-content" onclick="verDetalle(${meta.id})">
                            <div class="goal-info">
                                <span class="goal-title">${meta.nombre}</span>
                                <span class="goal-percentage">${porcentaje}%</span>
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar-fill" style="width: ${Math.min(porcentaje, 100)}%"></div>
                            </div>
                            <span class="goal-amounts">$${meta.actual} / $${meta.objetivo}</span>
                        </div>`;
                    goalsList.appendChild(li);
                });
            }
            actualizarContadores();
        }

        function actualizarContadores() {
            counterTotal.textContent = `${misMetas.length} total`;
            counterCompleted.textContent = `${misMetas.filter(m => parseFloat(m.actual) >= parseFloat(m.objetivo)).length} completadas`;
        }

        window.agregarMetaForm = function(event) {
            event.preventDefault();
            const nombre = document.getElementById('inputNombre').value;
            const objetivo = document.getElementById('inputMonto').value;

            fetch('php/guardar_meta.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({nombre: nombre, objetivo: objetivo})
            }).then(() => {
                event.target.reset();
                cargarMetas();
            });
        };

        window.verDetalle = function(id) {
            localStorage.setItem("idMetaActual", id);
            window.location.href = "detalle-meta.php";
        };

        cargarMetas();
    </script>
</body>
</html>