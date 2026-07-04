 <?php include 'components/navbar.php'; ?>
 <?php include 'components/navbar-mobile.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto</title>
    <link rel="stylesheet" href="style/presupuesto.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <section class="budget-header">

    <div class="budget-title">

        <h1>Mi Presupuesto</h1>

        <p>
            Organiza tus ingresos y distribuye tu dinero
            de forma inteligente.
        </p>

    </div>

    <div class="budget-mascot">

        <img src="img/cerdito_presupuesto.png"
             alt="Cerdito Coink">

    </div>
</section>

<section class="income-section">

    <div class="income-card">

        <div class="income-text">

            <h2>Ingreso mensual</h2>

            <p>
                Ingresa cuánto dinero recibes este mes.
            </p>

        </div>

        <div class="income-input">

            <span>$</span>

           <input
                type="number"
                id="monthlyIncome"
                placeholder="$0.00"
                min="0">
        </div>

        <button class="continue-btn">
            Continuar →
        </button>

    </div>

    <div class="budget-progress-card">

        <div class="progress-header">

            <div>

                <h3>Estado del presupuesto</h3>

                <p>
                    Distribución actual de tu presupuesto mensual.
                </p>

            </div>

            <span id="progressPercentage">

                0%

            </span>

        </div>

        <div class="progress-bar">

            <div class="progress-fill" id="progressFill"></div>

        </div>

        <div class="progress-footer">

            <span id="assignedBudget">

                $0 asignados

            </span>

            <span id="remainingBudget">

                Disponible: $0

            </span>

        </div>

    </div>

</section>

<section class="categories-section" >

    <div class="section-title">

        <h2> Distribuye tu dinero</h2>

        <p>
            Asigna cuánto deseas destinar a cada categoría.
        </p>

    </div>

    <div class="categories-grid"  id="categoriesGrid">

        <div class="category-card" data-category="Alimentación">

            <div class="category-icon">🍔</div>

            <h3>Alimentación</h3>

            <input
                type="number"
                class="category-amount"
                placeholder="$0.00"
                min="0">

        </div>

        <div class="category-card" data-category="Transporte">

            <div class="category-icon">🚌</div>

            <h3>Transporte</h3>

            <input
                type="number"
                class="category-amount"
                placeholder="$0.00"
                min="0">

        </div>

        <div class="category-card" data-category="Educación">

            <div class="category-icon">📚</div>

            <h3>Educación</h3>

           <input
                type="number"
                class="category-amount"
                placeholder="$0.00"
                min="0">

        </div>

        <div class="category-card" data-category="Entretenimiento">

            <div class="category-icon">🎮</div>

            <h3>Entretenimiento</h3>

           <input
                type="number"
                class="category-amount"
                placeholder="$0.00"
                min="0">
        </div>

        <div class="category-card" data-category="Ahorro">

            <div class="category-icon">💵</div>

            <h3>Ahorro</h3>

            <input
                type="number"
                class="category-amount"
                placeholder="$0.00"
                min="0">

        </div>

        <div class="add-category-card">

            <button id="openCategoryModal">

                ➕ Crear categoría

            </button>

        </div>

    </div>

    <div class="budget-save-section">

        <button id="saveBudget">

            <i class="fa-solid fa-floppy-disk"></i>

            Guardar mi presupuesto

        </button>

    </div>

</section>

<section class="summary-section">

    <div class="summary-card">

        <div class="summary-header">

            <div>

                <h2>Resumen de tu presupuesto</h2>

                <p>
                    Así va la distribución de tu dinero.
                </p>

            </div>

        </div>

        <div class="summary-grid">

            <div class="summary-box income">

                <span> Ingreso</span>

                <h3 id="incomeValue">$0.00</h3>

            </div>

            <div class="summary-box spent">

                <span> Distribuido</span>

                <h3 id="spentValue">$0.00</h3>

            </div>

            <div class="summary-box remaining">

                <span> Disponible</span>

                <h3 id="remainingValue">$0.00</h3>

            </div>

        </div>

        <div class="progress-container">

            <div class="progress-info">

                <span>Progreso del presupuesto</span>

                <span id="progressPercent">0%</span>

            </div>

            <div class="progress-bar">

                <div class="progress-fill"></div>

            </div>

        </div>

        <div class="coink-tip">

            <div class="tip-icon">
                💡
            </div>

            <div>

                <h4>Consejo de Coink</h4>

                <p id="budgetAdvice">

                    Empieza distribuyendo tu ingreso para recibir recomendaciones.

                </p>

            </div>

        </div>

    </div>

</section>

<section class="coink-health-section" id="budgetAnalysis">

    <div class="analysis-loading" id="analysisLoading">

        <img src="img/coink5.png" alt="Coink">

        <h2>Analizando...</h2>

        <p>

            Estoy preparando algunas recomendaciones para ti.

        </p>

    </div>

    <!-- Resultado -->
    <div class="coink-health-card" id="analysisResult">

        <div class="health-header">

            <img src="img/coink5.png" alt="Coink">

            <div>

                <h2>¿Cómo está tu presupuesto?</h2>

                <p>

                    Analizamos tu presupuesto para ayudarte a tomar mejores decisiones.

                </p>

            </div>

        </div>

        <div class="health-stars">

            ⭐⭐⭐⭐⭐

        </div>

        <h3 id="healthTitle">

            ¡Excelente trabajo!

        </h3>

        <p id="healthDescription">

            Tu presupuesto está muy equilibrado y aún tienes dinero disponible para ahorrar.

        </p>

        <div class="health-checks">

            <div class="health-item">

                ✔ Buena distribución

            </div>

            <div class="health-item">

                ✔ Excelente ahorro

            </div>

            <div class="health-item">

                ✔ Gastos saludables

            </div>

        </div>

    </div>

</section>
<div class="category-modal" id="categoryModal">

    <div class="category-box">

        <button class="close-category" id="closeCategoryModal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="category-header">

            <h2>Nueva categoría</h2>

            <p>
                Personaliza tu presupuesto creando una nueva categoría.
            </p>

        </div>

        <h3>Escoge un emoji</h3>

        <div class="emoji-grid">

            <button class="emoji-option">🍔</button>
            <button class="emoji-option">🚗</button>
            <button class="emoji-option">🎮</button>
            <button class="emoji-option">📚</button>
            <button class="emoji-option">🏠</button>
            <button class="emoji-option">🐶</button>
            <button class="emoji-option">🎁</button>
            <button class="emoji-option">💊</button>
            <button class="emoji-option">🧳</button>
            <button class="emoji-option">💼</button>

        </div>

        <div class="category-input">

            <label>

                Nombre de la categoría

            </label>

            <input
                type="text"
                id="categoryName"
                placeholder="Ej. Mascotas">
        </div>

        <div class="category-buttons">

            <button class="cancel-category">

                Cancelar

            </button>

           <button
                class="create-category"
                id="createCategory">

                Crear categoría

            </button>

        </div>

    </div>

</div>

    <script src="javaScript/presupuesto.js"></script>
    <script src="javaScript/navbar-mobile.js"></script>
    <script src="javaScript/homepage.js"></script>
</body>
</html>