// Pie chart
const ctxPie = document.getElementById("graficoPie").getContext("2d");
new Chart(ctxPie, {
  type: "pie",
  data: {
    labels: ["Ocio", "Hogar", "Ahorro"],
    datasets: [{
      data: [40, 35, 25],
      backgroundColor: ["#ff6fa1", "#4caf50", "#ffd54f"]
    }]
  }
});

// Line chart
// Line chart con animación
const ctxMensual = document.getElementById("graficoMensual").getContext("2d");
const lineChart = new Chart(ctxMensual, {
  type: "line",
  data: {
    labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun"],
    datasets: [{
      label: "Crecimiento de ahorro",
      data: [0, 500, 1000, 1500, 1800, 2000],
      borderColor: "#4caf50",
      backgroundColor: "rgba(76,175,80,0.2)",
      fill: true,
      tension: 0.3   // suaviza la curva
    }]
  },
  options: {
    animation: {
      duration: 1500,   // animación más lenta
      easing: "easeOutBounce" // efecto rebote
    },
    plugins: {
      tooltip: {
        enabled: true,
        callbacks: {
          label: function(context) {
            return `$${context.parsed.y}`;
          }
        }
      }
    }
  }
});

// Ejemplo: actualizar datos cada 5 segundos
setInterval(() => {
  lineChart.data.datasets[0].data = [
    Math.floor(Math.random() * 500),
    Math.floor(Math.random() * 1000),
    Math.floor(Math.random() * 1500),
    Math.floor(Math.random() * 2000),
    Math.floor(Math.random() * 2500),
    Math.floor(Math.random() * 3000)
  ];
  lineChart.update();
}, 5000);


// Calendario: mostrar detalle del día
// Generar calendario Abril 2026
const calendarioGrid = document.getElementById("calendarioGrid");
for (let dia = 1; dia <= 30; dia++) {
  const cell = document.createElement("div");
  cell.innerText = dia;
  cell.addEventListener("click", () => seleccionarDia(dia));
  calendarioGrid.appendChild(cell);
}

function seleccionarDia(dia) {
  // Quitar selección previa
  document.querySelectorAll(".calendario-grid div").forEach(c => c.classList.remove("selected"));
  // Marcar día seleccionado
  const cell = [...document.querySelectorAll(".calendario-grid div")].find(c => c.innerText == dia);
  cell.classList.add("selected");

  // Ejemplo de datos por día
  if (dia === 15) {
    document.getElementById("detalle-dia").innerText = "Ingresado: $100 | Gastado: $0 | Total: $100";
  } else {
    document.getElementById("detalle-dia").innerText = `Día ${dia}: No hay datos registrados.`;
  }
}

