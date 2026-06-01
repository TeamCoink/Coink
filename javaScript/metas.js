// 1. Capturar los elementos de la pantalla
const goalsForm = document.querySelector('.goals-form');
const goalsList = document.getElementById('goalsList');
const goalsListWrapper = document.getElementById('goalsListWrapper');
const counterTotal = document.querySelector('.counter-total');
const counterCompleted = document.querySelector('.counter-completed');

// 2. Crear una lista vacía para almacenar las metas del usuario
let misMetas = [];

// 3. Función principal para dibujar las metas en la pantalla
function renderizarMetas() {
    // Limpiamos la lista para que no se dupliquen las tarjetas
    goalsList.innerHTML = '';

    // Si no hay metas, escondemos la tarjeta blanca contenedora para mantener limpio el diseño
    if (misMetas.length === 0) {
        goalsListWrapper.style.display = 'none';
    } else {
        goalsListWrapper.style.display = 'block'; // Aparece en cuanto hay al menos una meta
    }

    // Recorremos cada meta creada por el usuario y generamos su HTML idéntico a tu captura
    misMetas.forEach((meta, index) => {
        // Calculamos el porcentaje basado en lo ahorrado (inicia en 0%)
        const porcentaje = meta.objetivo > 0 ? Math.round((meta.actual / meta.objetivo) * 100) : 0;

        // Creamos la estructura idéntica de la tarjeta
        const li = document.createElement('li');
        li.className = 'goal-item';
        li.innerHTML = `
            <div class="goal-status">
                <input type="checkbox" id="goal-${index}" ${meta.completada ? 'checked' : ''} onchange="cambiarEstadoMeta(${index})">
                <label for="goal-${index}" class="checkbox-circle"></label>
            </div>
            
            <div class="goal-content">
                <div class="goal-info">
                    <span class="goal-title">${meta.nombre}</span>
                    <span class="goal-percentage">${porcentaje}%</span>
                </div>
                
                <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: ${porcentaje}%"></div>
                </div>
                
                <div class="goal-amounts">
                    <span class="current-amount">$${meta.actual}</span>
                    <span class="amount-separator">/</span>
                    <span class="target-amount">$${meta.objetivo}</span>
                </div>
            </div>
        `;
        
        // Inyectamos la tarjeta dentro del contenedor de la lista <ul>
        goalsList.appendChild(li);
    });

    // Actualizar los contadores superiores automáticamente
    counterTotal.textContent = `${misMetas.length} Total`;
    
    const completadas = misMetas.filter(m => m.completada).length;
    counterCompleted.textContent = `${completadas} Completadas`;
}

// 4. Capturar el evento del botón "Agregar"
goalsForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que la página se recargue y se borren los datos

    // Obtener los inputs del formulario
    const inputNombre = goalsForm.querySelector('input[type="text"]:nth-child(1)');
    const inputMonto = goalsForm.querySelector('input[type="text"]:nth-child(2)');

    // Crear el objeto con la información que el usuario digitó
    const nuevaMeta = {
        nombre: inputNombre.value.trim(),
        objetivo: parseFloat(inputMonto.value) || 0,
        actual: 0, // Inicia en $0 tal como lo quieres
        completada: false
    };

    // Guardar la nueva meta en nuestra lista
    misMetas.push(nuevaMeta);

    // Volver a dibujar la interfaz para que se vea reflejada la nueva tarjeta
    renderizarMetas();

    // Limpiar los inputs para que queden listos para escribir otra meta
    goalsForm.reset();
});

// 5. Función interactiva para marcar la meta como completada al hacer click en el círculo
window.cambiarEstadoMeta = function(index) {
    misMetas[index].completada = !misMetas[index].completada;
    
    // Si la completa, la barra se llena al máximo. Si la desmarca, vuelve a $0.
    if (misMetas[index].completada) {
        misMetas[index].actual = misMetas[index].objetivo;
    } else {
        misMetas[index].actual = 0;
    }

    renderizarMetas();
};

// Ejecutar al cargar la página por primera vez
renderizarMetas();