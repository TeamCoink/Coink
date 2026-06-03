// Elementos del DOM de la pantalla de detalle
const detalleNombre = document.getElementById('detalleNombre');
const detalleMontoTotal = document.getElementById('detalleMontoTotal');
const detallePorcentaje = document.getElementById('detallePorcentaje');
const detalleBarra = document.getElementById('detalleBarra');
const detalleAhorrado = document.getElementById('detalleAhorrado');
const detalleFalta = document.getElementById('detalleFalta');
const formAbono = document.getElementById('formAbono');
const inputAbono = document.getElementById('inputAbono');

// Recuperar el almacén total y el índice de la meta seleccionada
let misMetas = JSON.parse(localStorage.getItem("misMetas")) || [];
let metaIndex = localStorage.getItem("metaSeleccionada");

// Redirección de seguridad: si se ingresa directo sin seleccionar meta, regresa
if (metaIndex === null || !misMetas[metaIndex]) {
    window.location.href = "metas.html";
}

let metaActual = misMetas[metaIndex];

function actualizarVistaDetalle() {
    const porcentaje = metaActual.objetivo > 0 ? Math.round((metaActual.actual / metaActual.objetivo) * 100) : 0;
    const falta = metaActual.objetivo - metaActual.actual;

    // Pintar los datos dinámicos en la pantalla
    detalleNombre.textContent = metaActual.nombre;
    detalleMontoTotal.textContent = `Meta: $${metaActual.objetivo}`;
    detallePorcentaje.textContent = `${porcentaje}%`;
    detalleAhorrado.textContent = `$${metaActual.actual}`;
    
    // Calcular dinámicamente cuánto falta para la meta
    if (falta > 0) {
        detalleFalta.textContent = `Falta: $${falta}`;
    } else {
        detalleFalta.textContent = `Falta: $0 (¡Completada!)`;
    }

    // Llenar la barra rosa de manera fluida usando CSS transition
    detalleBarra.style.width = `${Math.min(porcentaje, 100)}%`; 
}

// Evento para procesar el abono de dinero
formAbono.addEventListener('submit', function(event) {
    event.preventDefault();

    const montoAbono = parseFloat(inputAbono.value) || 0;

    if (montoAbono <= 0) return;

    // Sumar el abono al progreso actual de la meta seleccionada
    metaActual.actual += montoAbono;

    // Guardar el estado actualizado en el almacenamiento global local
    misMetas[metaIndex] = metaActual;
    localStorage.setItem("misMetas", JSON.stringify(misMetas));

    // Refrescar los elementos de la interfaz
    actualizarVistaDetalle();
    formAbono.reset();
});

// Renderizar automáticamente al abrir la pantalla
actualizarVistaDetalle();