// 1. Capturar los elementos de la pantalla principal basados exactamente en tu HTML
const goalsForm = document.querySelector('.goals-form');
const goalsList = document.getElementById('goalsList');
const counterTotal = document.querySelector('.counter-total');
const counterCompleted = document.querySelector('.counter-completed');

// 2. Cargar metas guardadas en localStorage o empezar vacío
let misMetas = JSON.parse(localStorage.getItem("misMetas")) || [];

// 3. Función principal para dibujar las metas en la pantalla
function renderizarMetas() {
    if (!goalsList) return; // Seguridad por si no encuentra el elemento
    
    // Limpiamos la lista para evitar que se dupliquen las tarjetas anteriores
    goalsList.innerHTML = '';

    // Si no hay metas, muestra el mensaje rosa de aviso
    if (misMetas.length === 0) {
        goalsList.innerHTML = `<p class="no-goals-msg" style="text-align: center; color: #E633AA; font-weight: bold; margin: 15px 0;">No tienes metas aún. ¡Agrega tu primera meta!</p>`;
        actualizarContadores();
        return;
    }

    // Recorremos cada meta y generamos su estructura visual
    misMetas.forEach((meta, index) => {
        const porcentaje = meta.objetivo > 0 ? Math.round((meta.actual / meta.objetivo) * 100) : 0;

        const li = document.createElement('li');
        li.className = 'goal-item';
        
        // Al hacer clic en la tarjeta, guarda la selección y viaja al detalle
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

// 4. Función para actualizar los contadores superiores ("0 total", "0 completadas")
function actualizarContadores() {
    if (counterTotal) counterTotal.textContent = `${misMetas.length} total`;
    if (counterCompleted) {
        const completadas = misMetas.filter(m => m.actual >= m.objetivo).length;
        counterCompleted.textContent = `${completadas} completadas`;
    }
}

// 5. Guardar la meta seleccionada y cambiar a la pantalla de abonos
window.verDetalleMeta = function(index) {
    localStorage.setItem("metaSeleccionada", index);
    window.location.href = "detalle-meta.html";
};

// 6. Capturar el evento cuando el usuario da clic en "+ Agregar"
if (goalsForm) {
    goalsForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita que la página se recargue
        
        // Buscamos los inputs exactamente dentro del div .form-inputs de tu HTML
        const inputNombre = goalsForm.querySelector('.form-inputs input[type="text"]');
        const inputMonto = goalsForm.querySelector('.form-inputs input[type="number"]');

        if (!inputNombre || !inputMonto) return;

        // Creamos la nueva estructura del objeto
        const nuevaMeta = {
            nombre: inputNombre.value.trim(),
            objetivo: parseFloat(inputMonto.value) || 0,
            actual: 0 // Empieza con $0 acumulados
        };

        // Guardamos la meta y actualizamos la memoria local
        misMetas.push(nuevaMeta);
        localStorage.setItem("misMetas", JSON.stringify(misMetas));
        
        // Redibujamos la pantalla
        renderizarMetas();
        
        // Reseteamos el formulario
        goalsForm.reset();
    });
}

// 7. Función para eliminar metas
window.eliminarMeta = function(event, index) {
    event.stopPropagation(); // Evita que se abra la ventana de abonos al borrar
    misMetas.splice(index, 1);
    localStorage.setItem("misMetas", JSON.stringify(misMetas));
    renderizarMetas();
};

// Renderizar al cargar la página por primera vez
renderizarMetas();