const presupuesto = {

    ingreso: 0,

    asignado: 0,

    disponible: 0,

    porcentaje: 0,

    categorias: [],

    fecha: null

};

const ingresoInput = document.getElementById("monthlyIncome");

const categoriesGrid = document.querySelector(".categories-grid");

const progressFill = document.getElementById("progressFill");
const progressPercentage = document.getElementById("progressPercentage");
const assignedBudget = document.getElementById("assignedBudget");
const remainingBudget = document.getElementById("remainingBudget");

const saveBudgetBtn = document.getElementById("saveBudget");

const budgetStatus = document.getElementById("budgetStatus");

const healthStars = document.getElementById("healthStars");
const healthChecks = document.getElementById("healthChecks");
const healthTitle = document.getElementById("healthTitle");
const healthDescription = document.getElementById("healthDescription");

const incomeValue = document.getElementById("incomeValue");
const spentValue = document.getElementById("spentValue");
const remainingValue = document.getElementById("remainingValue");
const progressPercent = document.getElementById("progressPercent");
const budgetAdvice = document.getElementById("budgetAdvice");

const summaryProgressFill = document.getElementById("summaryProgressFill");

const budgetAnalysis = document.getElementById("budgetAnalysis");
const analysisStart = document.getElementById("analysisStart");
const analysisLoading = document.getElementById("analysisLoading");
const analysisResult = document.getElementById("analysisResult");
const analyzeBudget = document.getElementById("analyzeBudget");
const loadingTitle = document.getElementById("loadingTitle");
const loadingText = document.getElementById("loadingText");

const analysisWarning = document.getElementById("analysisWarning");

const categoriesSection = document.getElementById("categoriesSection");

const openModal = document.getElementById("openCategoryModal");
const closeModal = document.getElementById("closeCategoryModal");
const cancelBtn = document.querySelector(".cancel-category");
const modal = document.getElementById("categoryModal");
const createCategoryBtn = document.getElementById("createCategory");
const categoryName = document.getElementById("categoryName");
let selectedEmoji = "";
const emojiButtons = document.querySelectorAll(".emoji-option");


   function iniciarModalCategorias(){

    openModal.addEventListener("click",()=>{

        modal.classList.add("active");

    });

    closeModal.addEventListener("click",()=>{

        modal.classList.remove("active");

    });

    cancelBtn.addEventListener("click",()=>{

        modal.classList.remove("active");

    });

    modal.addEventListener("click",(e)=>{

        if(e.target===modal){

            modal.classList.remove("active");

        }

    });

    emojiButtons.forEach(button=>{

        button.addEventListener("click",()=>{

            emojiButtons.forEach(btn=>btn.classList.remove("selected"));

            button.classList.add("selected");

            selectedEmoji = button.textContent;

        });

    });

    createCategoryBtn.addEventListener("click",crearCategoria);

    categoriesGrid.addEventListener("click",eliminarCategoria);

}

function crearCategoria(){

    const nombre = categoryName.value.trim();

    if(nombre==="" || selectedEmoji===""){

        alert("Completa todos los campos 😊");

        return;

    }

    const nuevaCategoria=document.createElement("div");

    nuevaCategoria.className="category-card custom-category";

    nuevaCategoria.innerHTML=`

        <div class="category-icon">

            ${selectedEmoji}

        </div>

        <h3>${nombre}</h3>

        <input
            type="number"
            class="category-amount"
            placeholder="$0.00">

        <button class="delete-category">

            ✖

        </button>

    `;

    const addCard=document.querySelector(".add-category-card");

    categoriesGrid.insertBefore(nuevaCategoria,addCard);

    presupuesto.categorias.push({

        nombre,

        emoji:selectedEmoji,

        monto:0

    });

    escucharCategorias();

    calcularPresupuesto();

    actualizarBarra();

    actualizarDiagnostico();

    actualizarResumen();

    generarRecomendaciones();

    categoryName.value="";

    selectedEmoji="";

    emojiButtons.forEach(btn=>btn.classList.remove("selected"));

    modal.classList.remove("active");

}

function eliminarCategoria(e){

    if(!e.target.classList.contains("delete-category")) return;

    const tarjeta = e.target.parentElement;

    const nombre = tarjeta.querySelector("h3").textContent;

    presupuesto.categorias = presupuesto.categorias.filter(categoria => categoria.nombre !== nombre);

    tarjeta.remove();

    calcularPresupuesto();

    actualizarBarra();

    actualizarDiagnostico();

    actualizarResumen();

    generarRecomendaciones();

}

function cargarCategoriasIniciales(){

    const cards = document.querySelectorAll(".category-card");

    presupuesto.categorias = [];

    cards.forEach(card => {

        const nombre = card.querySelector("h3").textContent.trim();

        const emoji = card.querySelector(".category-icon").textContent.trim();

        presupuesto.categorias.push({

            nombre,

            emoji,

            monto:0

        });

    });
}

function escucharCategorias(){

    const inputs = document.querySelectorAll(".category-amount");

    inputs.forEach((input,index)=>{

        input.addEventListener("input",()=>{

            presupuesto.categorias[index].monto =
                Number(input.value) || 0;

            calcularPresupuesto();

            actualizarBarra();

            actualizarDiagnostico();

            actualizarResumen();

            generarRecomendaciones();

            if(presupuesto.asignado > 0){

                analysisWarning.classList.remove("show");

            }

        });

     });

}

function actualizarIngreso(){

    const ingreso = Number(ingresoInput.value) || 0;

    presupuesto.ingreso = ingreso;

    calcularPresupuesto();

    actualizarBarra();

    actualizarDiagnostico();

    actualizarResumen();

    generarRecomendaciones();

}

function calcularPresupuesto(){

    let totalAsignado = 0;

    presupuesto.categorias.forEach(categoria=>{

        totalAsignado += categoria.monto;

    });

    presupuesto.asignado = totalAsignado;

    presupuesto.disponible =
        presupuesto.ingreso - totalAsignado;

    if(presupuesto.ingreso > 0){

        presupuesto.porcentaje =
            (totalAsignado/presupuesto.ingreso)*100;

    }else{

        presupuesto.porcentaje = 0;

    }

    actualizarPieChart();

}

function actualizarBarra(){

    const porcentaje = Math.min(presupuesto.porcentaje,100);

    progressFill.style.width = porcentaje + "%";

    progressPercentage.textContent =
        porcentaje.toFixed(0) + "%";

    assignedBudget.textContent =
        "$" + presupuesto.asignado.toFixed(2) + " asignados";

    remainingBudget.textContent =
        "Disponible: $" + presupuesto.disponible.toFixed(2);

    if(presupuesto.porcentaje <= 50){

        progressFill.style.background = "#69C36B";

    }else if(presupuesto.porcentaje <= 80){

        progressFill.style.background = "#FFD76A";

    }else{

        progressFill.style.background = "#F47C7C";

    }

}

function actualizarDiagnostico(){

    const healthCard = document.querySelector(".coink-health-card");

        healthCard.classList.remove(

            "health-good",
            "health-medium",
            "health-warning",
            "health-danger"

        );

    if(presupuesto.porcentaje <= 60){

        healthStars.textContent = "⭐⭐⭐⭐⭐";

        healthTitle.textContent =
            "¡Vas excelente!";
        healthDescription.textContent =
            "Tu presupuesto está muy equilibrado y aún tienes dinero disponible para ahorrar.";

        healthChecks.innerHTML = `

            <div class="health-item">
                ✔ Excelente distribución
            </div>

            <div class="health-item">
                ✔ Buen margen de ahorro
            </div>

            <div class="health-item">
                ✔ Finanzas saludables
            </div>

        `;

    }

    else if(presupuesto.porcentaje <= 80){

        healthStars.textContent = "⭐⭐⭐⭐";

        healthTitle.textContent =
            "¡Vas por buen camino!";

        healthDescription.textContent =
            "Has distribuido gran parte de tu presupuesto. Procura dejar un margen para ahorrar.";

        healthChecks.innerHTML = `

            <div class="health-item">
                ✔ Presupuesto organizado
            </div>

            <div class="health-item">
                ✔ Aún tienes dinero disponible
            </div>

            <div class="health-item">
                ✔ Puedes mejorar el ahorro
            </div>

        `;

    }

    else if(presupuesto.porcentaje <= 100){

        healthStars.textContent = "⭐⭐⭐";

        healthTitle.textContent =
            "Presupuesto ajustado";

        healthDescription.textContent =
            "Casi todo tu ingreso ya está comprometido. Revisa tus gastos antes de seguir asignando dinero.";

        healthChecks.innerHTML = `

            <div class="health-item">
                ✔ Reduce gastos innecesarios
            </div>

            <div class="health-item">
                ✔ Prioriza necesidades
            </div>

            <div class="health-item">
                ✔ Intenta ahorrar un poco más
            </div>

        `;

    }

    else{

        healthStars.textContent = "⭐";

        healthTitle.textContent =
            "¡Has excedido tu presupuesto!";

        healthDescription.textContent =
            "Tus gastos superan tus ingresos. Es recomendable reorganizar tu presupuesto.";

        healthChecks.innerHTML = `

            <div class="health-item">
                ✔ Ajusta tus categorías
            </div>

            <div class="health-item">
                ✔ Reduce gastos
            </div>

            <div class="health-item">
                ✔ Evita nuevas compras
            </div>

        `;

        const healthCard = document.querySelector(".coink-health-card");

            healthCard.classList.remove("health-animate");

            void healthCard.offsetWidth;

            healthCard.classList.add("health-animate");

    }

}

function analizarPerfilFinanciero(){

    const perfil = {

        nivel: "",

        ahorro: "ninguno",

        ahorroPorcentaje: 0,

        disponible: presupuesto.disponible,

        porcentaje: presupuesto.porcentaje,

        mensajes: []

    };

    const categoriaAhorro = presupuesto.categorias.find(categoria =>

        categoria.nombre.toLowerCase().includes("ahorro")

    );

    if(categoriaAhorro){

        perfil.ahorroPorcentaje =

            (categoriaAhorro.monto / presupuesto.ingreso) * 100;

    }


    if(perfil.ahorroPorcentaje === 0){

        perfil.ahorro = "ninguno";

    }

    else if(perfil.ahorroPorcentaje < 10){

        perfil.ahorro = "bajo";

    }

    else if(perfil.ahorroPorcentaje < 20){

        perfil.ahorro = "medio";

    }

    else{

        perfil.ahorro = "alto";

    }



    if(presupuesto.porcentaje <= 60){

        perfil.nivel = "excelente";

    }

    else if(presupuesto.porcentaje <= 80){

        perfil.nivel = "organizado";

    }

    else if(presupuesto.porcentaje <= 100){

        perfil.nivel = "ajustado";

    }

    else{

        perfil.nivel = "riesgoso";

    }

    return perfil;

}

function generarRecomendaciones(){

    const perfil = analizarPerfilFinanciero();

    let recomendaciones = [];

    switch(perfil.nivel){

        case "excelente":

            recomendaciones.push({

                icono:"🌟",

                texto:"Tu presupuesto está muy equilibrado. Has administrado muy bien tus ingresos."

            });

            break;

        case "organizado":

            recomendaciones.push({

                icono:"👍",

                texto:"Vas por muy buen camino. Tu presupuesto mantiene un buen equilibrio."

            });

            break;

        case "ajustado":

            recomendaciones.push({

                icono:"⚠️",

                texto:"Has utilizado gran parte de tu ingreso. Procura evitar nuevos gastos este mes."

            });

            break;

        case "riesgoso":

            recomendaciones.push({

                icono:"🚨",

                texto:"Tu presupuesto ha sido sobrepasado. Te recomiendo reorganizar tus gastos."

            });

            break;

    }

   

    switch(perfil.ahorro){

        case "ninguno":

            recomendaciones.push({

                icono:"🐷",

                texto:"Aún no has destinado dinero al ahorro. Incluso una pequeña cantidad puede ayudarte a alcanzar tus metas."

            });

            break;

        case "bajo":

            recomendaciones.push({

                icono:"💰",

                texto:"Ya comenzaste a ahorrar. Si aumentas un poco esa cantidad cada mes avanzarás mucho más rápido."

            });

            break;

        case "medio":

            recomendaciones.push({

                icono:"✨",

                texto:"Mantienes un buen nivel de ahorro. Sigue así."

            });

            break;

        case "alto":

            recomendaciones.push({

                icono:"🏆",

                texto:"Excelente hábito de ahorro. Estás construyendo una base financiera muy sólida."

            });

            break;

    }


    if(perfil.disponible > presupuesto.ingreso*0.30){

        recomendaciones.push({

            icono:"🎯",

            texto:"Todavía tienes dinero disponible. Puedes ahorrar más o comenzar una nueva meta."

        });

    }

    else if(perfil.disponible <=0){

        recomendaciones.push({

            icono:"📋",

            texto:"Ya no tienes dinero disponible. Evita nuevos gastos antes de terminar el mes."

        });

    }

    mostrarRecomendaciones(recomendaciones);

}

function mostrarRecomendaciones(lista){

    const contenedor =

    document.getElementById("recommendationsList");

    contenedor.innerHTML="";

    lista.forEach(recomendacion=>{

        contenedor.innerHTML += `

            <div class="recommendation">

                <span>

                    ${recomendacion.icono}

                </span>

                <p>

                    ${recomendacion.texto}

                </p>

            </div>

        `;

    });

}

function actualizarResumen(){

    incomeValue.textContent =
        "$" + presupuesto.ingreso.toFixed(2);

    spentValue.textContent =
        "$" + presupuesto.asignado.toFixed(2);

    remainingValue.textContent =
        "$" + presupuesto.disponible.toFixed(2);

    progressPercent.textContent =
        presupuesto.porcentaje.toFixed(0) + "%";

    if(presupuesto.porcentaje <= 60){

    budgetAdvice.textContent =
    "¡Excelente! Aún tienes bastante dinero disponible para ahorrar o cumplir una meta.";

}

    else if(presupuesto.porcentaje <= 80){

        budgetAdvice.textContent =
        "Vas muy bien. Solo procura no gastar todo tu ingreso y deja espacio para ahorrar.";

    }

    else if(presupuesto.porcentaje <= 100){

        budgetAdvice.textContent =
        "Tu presupuesto está bastante ajustado. Antes de hacer nuevas compras revisa tus gastos.";

    }

    else{

        budgetAdvice.textContent =
        "Has sobrepasado tu presupuesto. Es recomendable reorganizar tus categorías.";

    }

    summaryProgressFill.style.width =
    presupuesto.porcentaje + "%";

    if(presupuesto.porcentaje<=60){

    summaryProgressFill.style.background="#69C36B";

    }
    else if(presupuesto.porcentaje<=80){

        summaryProgressFill.style.background="#FFD76A";

    }
    else{

        summaryProgressFill.style.background="#F47C7C";

    }
 }

function iniciarBotonContinuar(){

    const continueBtn = document.querySelector(".continue-btn");

    continueBtn.addEventListener("click",()=>{

       if(presupuesto.ingreso <= 0){

            ingresoInput.classList.add("shake");

            ingresoInput.focus();

            setTimeout(()=>{

                ingresoInput.classList.remove("shake");

            },400);

            return;

        }

        categoriesSection.scrollIntoView({

            behavior:"smooth",

            block:"start"

        });

    });

}

function guardarLocalStorage(){

    localStorage.setItem(

        "presupuesto",

        JSON.stringify(presupuesto)

    );

}

function cargarLocalStorage(){

    calcularPresupuesto();

    actualizarBarra();

    actualizarResumen();

    actualizarDiagnostico();

    const datos = localStorage.getItem("presupuesto");

    if(!datos) return;

    Object.assign(

        presupuesto,

        JSON.parse(datos)

    );

    ingresoInput.value =
        presupuesto.ingreso;

    actualizarBarra();

    actualizarResumen();

    actualizarDiagnostico();

}

function guardarPresupuesto(){

   
    saveBudgetBtn.disabled = true;

    saveBudgetBtn.textContent = "⏳ Guardando...";

    fetch("php/guardar_presupuesto.php",{

        method:"POST",

        headers:{

            "Content-Type":"application/json"

        },

        body:JSON.stringify(presupuesto)

    })
    .then(res=>res.json())
    .then(data=>{

        console.log(data);

    });
   
    setTimeout(()=>{

       
        guardarLocalStorage();

        saveBudgetBtn.textContent =
            "✔ ¡Presupuesto guardado!";

        saveBudgetBtn.style.background =
            "#69C36B";

        setTimeout(()=>{

            saveBudgetBtn.disabled = false;

            saveBudgetBtn.textContent =

                 "Guardar presupuesto";

            saveBudgetBtn.style.background = "";

        },2000);

    },1200);

}

function analizarConCoink(){

    if(presupuesto.asignado <= 0){

        categoriesSection.classList.add("shake");

        analysisWarning.textContent =
            "💡 Primero distribuye tu dinero en al menos una categoría.";

        analysisWarning.classList.add("show");

        setTimeout(()=>{

            categoriesSection.classList.remove("shake");

        },400);

        return;

    }

    analysisStart.style.display = "none";

    analysisLoading.style.display = "flex";

    loadingTitle.textContent =
        "Analizando categorías...";

    loadingText.textContent =
        "Estoy revisando cómo distribuiste tu dinero.";

    setTimeout(()=>{

        loadingTitle.textContent =
            "Calculando distribución...";

        loadingText.textContent =
            "Verificando el equilibrio de tu presupuesto.";

    },1000);

    setTimeout(()=>{

        loadingTitle.textContent =
            "Preparando recomendaciones...";

        loadingText.textContent =
            "Ya casi termino ";

    },2000);

    setTimeout(()=>{

        analysisLoading.style.display = "none";

        analysisResult.style.display = "block";

        actualizarDiagnostico();

        generarRecomendaciones();

    },3000);
}


function cargarPresupuesto(){

    fetch("php/cargar_presupuesto.php")

    .then(res=>res.json())

    .then(data=>{

        if(!data.success){

            return;

        }

        const p = data.presupuesto;

        presupuesto.ingreso = Number(p.ingreso);

        presupuesto.asignado = Number(p.asignado);

        presupuesto.disponible = Number(p.disponible);

        presupuesto.porcentaje = Number(p.porcentaje);

        presupuesto.categorias = p.categorias;

        ingresoInput.value = presupuesto.ingreso;


        const inputs = document.querySelectorAll(".category-amount");

        inputs.forEach((input,index)=>{

            if(presupuesto.categorias[index]){

                input.value = presupuesto.categorias[index].monto;

            }

        });

        actualizarBarra();
        actualizarResumen();
        actualizarDiagnostico();
        generarRecomendaciones();
        actualizarPieChart();

    })

    .catch(error=>{

        console.error(error);

    });

}

let budgetChart = null;

function actualizarPieChart(){

    const labels = [];
    const datos = [];

    const colores = [
        "#FFD76A",
        "#B8E6A3",
        "#A8D8FF",
        "#F8C8D2",
        "#D8B4F8",
        "#FFBFA3",
        "#B5EAD7",
        "#C7CEEA",
        "#FFEAA7",
        "#FFDAC1"
    ];

    console.log("=== PIE CHART ===");
    console.log(presupuesto.categorias);

    presupuesto.categorias.forEach(categoria=>{


        if(categoria.monto>0){

            labels.push(categoria.nombre);

            datos.push(categoria.monto);

        }
        

    });

    document.getElementById("pieIngreso").textContent =
        "$" + presupuesto.ingreso.toFixed(2);

    document.getElementById("pieAsignado").textContent =
        "$" + presupuesto.asignado.toFixed(2);

    document.getElementById("pieDisponible").textContent =
        "$" + presupuesto.disponible.toFixed(2);

    const canvas = document.getElementById("budgetPieChart");

    if(!canvas) return;

    const ctx = canvas.getContext("2d");

    if(budgetChart){

        budgetChart.destroy();

    }

    budgetChart = new Chart(ctx,{

        type:"doughnut",

        data:{

            labels:labels,

            datasets:[{

                data:datos,

                backgroundColor:colores,

                borderColor:"#fff",

                borderWidth:3,

                hoverOffset:10

            }]

        },

        options:{

            responsive:true,

            cutout:"65%",

            plugins:{

                legend:{

                    position:"bottom",

                    labels:{

                        usePointStyle:true,

                        padding:18,

                        font:{
                            size:13
                        }

                    }

                },

                tooltip:{

                    callbacks:{

                        label:function(context){

                            let total = context.dataset.data.reduce((a,b)=>a+b,0);

                            let porcentaje =
                                ((context.raw/total)*100).toFixed(1);

                            return context.label +
                            " - " +
                            porcentaje +
                            "% ($" +
                            context.raw.toFixed(2)+")";

                        }

                    }

                }

            }

        }

    });

}

cargarCategoriasIniciales();

escucharCategorias();

iniciarModalCategorias();

iniciarBotonContinuar();

ingresoInput.addEventListener("input", actualizarIngreso);

saveBudgetBtn.addEventListener("click", guardarPresupuesto);

analyzeBudget.addEventListener("click", analizarConCoink);


calcularPresupuesto();

actualizarBarra();

actualizarDiagnostico();

generarRecomendaciones();

cargarPresupuesto();

document.addEventListener("DOMContentLoaded",()=>{

    actualizarPieChart();

});