<?php include 'components/navbar.php'; ?>

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

            <button type="submit"
                    class="btn-gasto">

                Guardar gasto
            </button>

        </form>

    </div>

    <div class="gasto-img">
        <img src="img/coink3.png"
             alt="Coink">
    </div>

</section>

</body>
</html>