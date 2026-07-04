const presupuesto = {

    ingreso: 0,

    asignado: 0,

    disponible: 0,

    porcentaje: 0,

    categorias: [],

    fecha: null

};


// Ingreso mensual
const ingresoInput = document.getElementById("monthlyIncome");

// Categorías
const categoriesGrid = document.querySelector(".categories-grid");

// Barra de progreso
const progressFill = document.getElementById("progressFill");
const progressPercentage = document.getElementById("progressPercentage");
const assignedBudget = document.getElementById("assignedBudget");
const remainingBudget = document.getElementById("remainingBudget");

// Botón guardar
const saveBudgetBtn = document.getElementById("saveBudget");

// Estado
const budgetStatus = document.getElementById("budgetStatus");

// Diagnóstico
const budgetAnalysis = document.getElementById("budgetAnalysis");
const analysisLoading = document.getElementById("analysisLoading");
const analysisResult = document.getElementById("analysisResult");

/*==================================================
            MODAL CATEGORÍAS
==================================================*/

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

}



/*==================================================
                CATEGORÍAS
==================================================*/

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

        });

    });

}

/*==================================================
                PRESUPUESTO
==================================================*/

function actualizarIngreso(){

    const ingreso = Number(ingresoInput.value) || 0;

    presupuesto.ingreso = ingreso;

    calcularPresupuesto();

    actualizarBarra();

    console.log(presupuesto);

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

/*==================================================
                DIAGNÓSTICO
==================================================*/



/*==================================================
                LOCAL STORAGE
==================================================*/



/*==================================================
                INICIALIZACIÓN
==================================================*/

cargarCategoriasIniciales();

// cargarLocalStorage();

escucharCategorias();

iniciarModalCategorias();

ingresoInput.addEventListener("input", actualizarIngreso);