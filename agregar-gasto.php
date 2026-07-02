<?php include 'components/navbar.php'; ?>
<?php include 'components/navbar-mobile.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Agregar gasto</title>

    <link rel="stylesheet"
          href="style/index.css">

    <link rel="stylesheet"
          href="style/agregar-gasto.css">
</head>

<body>

<section class="formulario-gasto">

    <div class="contenedor-form">

        <form action="php/guardar-gasto.php"
              method="POST">

            <h2>Agregar gasto 💸</h2>

            <label>
                Nombre del gasto
            </label>

            <input type="text"
                   name="nombre"
                   placeholder="Ej: Uber universidad"
                   required>

            <label>
                Categoría
            </label>

            <input type="text"
                   name="categoria"
                   placeholder="Ej: Transporte"
                   required>

            <label>
                Monto
            </label>

            <input type="number"
                   step="0.01"
                   name="monto"
                   placeholder="$0.00"
                   required>

            <label>
                Fecha
            </label>

            <input type="date"
                   name="fecha"
                   required>

            <div class="acciones">

                <button type="submit" class="btn-gasto">
                    Guardar gasto
                </button>

                <a href="dashboard.php" class="btn-cancelar">
                    Cancelar
                </a>

             </div>

             
            </button>

        </form>

    </div>

    <div class="gasto-img">
        <img src="img/coink3.png"
             alt="Coink">
    </div>


</section>

<!-- Waves verdes -->
<div class="waves">
  <svg viewBox="0 0 1440 320" preserveAspectRatio="none">

    <path fill="#4caf50" fill-opacity="1"
      d="M0,160L60,165.3C120,171,240,181,360,176C480,171,600,149,720,160C840,171,960,213,1080,213.3C1200,213,1320,171,1380,149.3L1440,128L1440,320L0,320Z">
    </path>

    <path fill="#81c784" fill-opacity="0.7"
      d="M0,192L80,186.7C160,181,320,171,480,176C640,181,800,203,960,213.3C1120,224,1280,224,1360,224L1440,224L1440,320L0,320Z">
    </path>

    <path fill="#a5d6a7" fill-opacity="0.5"
      d="M0,224L60,213.3C120,203,240,181,360,176C480,171,600,181,720,192C840,203,960,213,1080,213.3C1200,213,1320,203,1380,197.3L1440,192L1440,320L0,320Z">
    </path>

  </svg>
</div>

 <script src="javaScript/navbar-mobile.js"></script>
</body>
</html>