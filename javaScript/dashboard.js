
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
      tension: 0.3   
    }]
  },
  options: {
    animation: {
      duration: 1500,  
      easing: "easeOutBounce" 
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



const calendarioGrid = document.getElementById("calendarioGrid");
for (let dia = 1; dia <= 30; dia++) {
  const cell = document.createElement("div");
  cell.innerText = dia;
  cell.addEventListener("click", () => seleccionarDia(dia));
  calendarioGrid.appendChild(cell);
}

function seleccionarDia(dia) {
  
  document.querySelectorAll(".calendario-grid div").forEach(c => c.classList.remove("selected"));
  
  const cell = [...document.querySelectorAll(".calendario-grid div")].find(c => c.innerText == dia);
  cell.classList.add("selected");


  if (dia === 15) {
    document.getElementById("detalle-dia").innerText = "Ingresado: $100 | Gastado: $0 | Total: $100";
  } else {
    document.getElementById("detalle-dia").innerText = `Día ${dia}: No hay datos registrados.`;
  }
}


const metaUsuario = 60; 

function animarPorcentaje(meta) {
  let porcentaje = 0;
  const texto = document.getElementById("porcentajeTexto");
  const circle = document.querySelector(".circle");

  const intervalo = setInterval(() => {
    porcentaje++;
    texto.textContent = porcentaje + "% Ahorrado";

   
    if (porcentaje >= meta) {
      clearInterval(intervalo);
    }
  }, 30); 
  setTimeout(() => {
    circle.style.setProperty("--scale", meta / 100);
    circle.querySelector("::before"); // activa el pseudo-elemento
  }, 100);
}


window.onload = () => {
  animarPorcentaje(metaUsuario);
};

function actualizarAsistente(){

    if(presupuesto.porcentaje<=60){

        assistantTitle.textContent=
        "¡Excelente trabajo!";

        assistantMessage.textContent=
        "Todavía tienes bastante dinero disponible para ahorrar.";

        assistantStars.textContent=
        "⭐⭐⭐⭐⭐";

    }

    else if(presupuesto.porcentaje<=80){

        assistantTitle.textContent=
        "¡Vas muy bien!";

        assistantMessage.textContent=
        "Tu presupuesto sigue equilibrado, pero intenta guardar un poco más.";

        assistantStars.textContent=
        "⭐⭐⭐⭐";

    }

    else if(presupuesto.porcentaje<=100){

        assistantTitle.textContent=
        "Presupuesto ajustado";

        assistantMessage.textContent=
        "Ya has utilizado gran parte de tu ingreso este mes.";

        assistantStars.textContent=
        "⭐⭐⭐";

    }

    else{

        assistantTitle.textContent=
        "¡Cuidado!";

        assistantMessage.textContent=
        "Has sobrepasado tu presupuesto. Revisa tus gastos.";

        assistantStars.textContent=
        "⭐";

    }

}
