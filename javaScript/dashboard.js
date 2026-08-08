console.log("Dashboard.js cargado");

const savingModal = document.getElementById("savingModal");
const expenseModal = document.getElementById("expenseModal");

const openSavingModal = document.getElementById("openSavingModal");
const openExpenseModal = document.getElementById("openExpenseModal");

const closeSavingModal = document.getElementById("closeSavingModal");
const closeExpenseModal = document.getElementById("closeExpenseModal");

const cancelSaving = document.getElementById("cancelSaving");
const cancelExpense = document.getElementById("cancelExpense");

const savingForm = document.getElementById("savingForm");
const expenseForm = document.getElementById("expenseForm");


function abrirModal(modal){

    modal.classList.add("active");

}


function cerrarModal(modal){

    modal.classList.remove("active");

}


openSavingModal.addEventListener("click",()=>{

    document.getElementById("savingForm").reset();

    document.querySelector("#savingForm input[type='date']").valueAsDate = new Date();

    abrirModal(savingModal);

});

openExpenseModal.addEventListener("click",()=>{

    document.getElementById("expenseForm").reset();

    document.querySelector("#expenseForm input[type='date']").valueAsDate = new Date();

    abrirModal(expenseModal);

});


closeSavingModal.addEventListener("click",()=>{

    cerrarModal(savingModal);

});

closeExpenseModal.addEventListener("click",()=>{

    cerrarModal(expenseModal);

});


cancelSaving.addEventListener("click",()=>{

    cerrarModal(savingModal);

});

cancelExpense.addEventListener("click",()=>{

    cerrarModal(expenseModal);

});


savingModal.addEventListener("click",(e)=>{

    if(e.target===savingModal){

        cerrarModal(savingModal);

    }

});

expenseModal.addEventListener("click",(e)=>{

    if(e.target===expenseModal){

        cerrarModal(expenseModal);

    }

});


document.addEventListener("keydown",(e)=>{

    if(e.key==="Escape"){

        cerrarModal(savingModal);

        cerrarModal(expenseModal);

    }

});

savingForm.addEventListener("submit", guardarAhorro);

async function guardarAhorro(e){

    e.preventDefault();

    const formData = new FormData(savingForm);

    try{

        const respuesta = await fetch(
            "php/guardar-ahorro.php",
            {
                method: "POST",
                body: formData
            }
        );

        const data = await respuesta.json();

        if(data.success){

            cerrarModal(savingModal);

            window.location.href =
                "dashboard.php?guardado=ahorro";

        }else{

            alert(data.mensaje);

        }

    }catch(error){

        console.error(error);

    }

}
savingForm.addEventListener(
    "submit",
    guardarAhorro
);


async function guardarGasto(e){

    e.preventDefault();

    const formData = new FormData(expenseForm);

    try{

        const respuesta = await fetch(
            "php/guardar-gasto.php",
            {
                method:"POST",
                body:formData
            }
        );

        const data = await respuesta.json();

        if(data.success){

            cerrarModal(expenseModal);

            window.location.href="dashboard.php?guardado=gasto";

        }else{

            alert(data.mensaje);

        }

    }catch(error){

        console.error(error);

    }

}
expenseForm.addEventListener("submit",guardarGasto);


const openHistorySavings =
document.getElementById("openHistorySavings");

const historySavingsModal =
document.getElementById("historySavingsModal");

const closeHistorySavings =
document.getElementById("closeHistorySavings");

openHistorySavings.addEventListener("click", () => {

    historySavingsModal.classList.add("active");

});

closeHistorySavings.addEventListener("click", () => {

    historySavingsModal.classList.remove("active");

});

const openHistoryExpenses =
document.getElementById("openHistoryExpenses");

const historyExpensesModal =
document.getElementById("historyExpensesModal");

const closeHistoryExpenses =
document.getElementById("closeHistoryExpenses");


openHistoryExpenses.addEventListener("click", () => {

    historyExpensesModal.classList.add("active");

});


closeHistoryExpenses.addEventListener("click", () => {

    historyExpensesModal.classList.remove("active");

});