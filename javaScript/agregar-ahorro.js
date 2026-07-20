const inputs = document.querySelectorAll("form input");

inputs.forEach(input => {
  input.addEventListener("focus", () => {
    input.style.borderColor = "#ff6fa1"; // rosado más vivo
    input.style.boxShadow = "0 0 12px rgba(255,111,161,0.6)";
  });
  input.addEventListener("blur", () => {
    input.style.boxShadow = "none";
  });
});

window.addEventListener("load", () => {
  const contenedor = document.querySelector(".contenedor-form");
  const cerdito = document.querySelector(".cerdito img");

  contenedor.style.opacity = 0;
  cerdito.style.opacity = 0;

  setTimeout(() => {
    contenedor.style.transition = "all 1s ease";
    contenedor.style.opacity = 1;
    contenedor.style.transform = "translateY(0)";
  }, 300);

  setTimeout(() => {
    cerdito.style.transition = "all 1.2s ease";
    cerdito.style.opacity = 1;
    cerdito.style.transform = "translateY(0)";
  }, 600);
});

const cerdito = document.querySelector(".cerdito img");

function bounceCerdito() {
  cerdito.animate([
    { transform: "translateY(0)" },
    { transform: "translateY(-10px)" },
    { transform: "translateY(0)" }
  ], {
    duration: 2000,
    iterations: Infinity
  });
}

bounceCerdito();

const botones = document.querySelectorAll(".acciones button");

botones.forEach(boton => {
  boton.addEventListener("click", () => {
    boton.style.transform = "scale(0.9)";
    setTimeout(() => {
      boton.style.transform = "scale(1)";
    }, 150);
  });
});




