<?php include 'components/navbar.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Métodos</title>

    <link rel="stylesheet" href="style/metodos.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- FUENTE -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>

</header>
    <!-- CONTENEDOR -->
    <main class="container">

        <!-- TITULO -->
        <div class="title">
            <h1>MÉTODOS</h1>
        </div>

        <!-- TARJETAS -->
        <section class="cards">

            <!-- CARD -->
            <label class="card">

                <input type="radio" name="metodo">

                <div class="card-box">

                    <a href="metodoh.php">
                        <img src="img/HORMIGA 3.png">
                    </a>

                     <h3>Hormiga</h3>

                </div>

            </label>

            <!-- CARD -->
            <label class="card">

                <input type="radio" name="metodo">
                
                <div class="card-box">

                    <a href="metodom.php">
                        <img src="img/META 2.png">
                    </a>
                    

                    <h3>METAS</h3>

                </div>

            </label>

            <!-- CARD -->
            <label class="card">

                <input type="radio" name="metodo">

                <div class="card-box">

                    <img src="img/img invertido.png">

                    <h3>INVERTIDO</h3>

                </div>

            </label>

            <!-- CARD -->
            <label class="card">

                <input type="radio" name="metodo">

                <div class="card-box">

                    <a href="metodods.php">
                        <img src="img/img sobres.png">
                    </a>
                    

                    <h3>SOBRES</h3>

                </div>

            </label>

        </section>

        <!-- RECORDATORIO -->
        <section class="recordatorio">

            <div class="icon">
                🔔
            </div>

            <div class="text">

                <h4>RECUERDA</h4>

                <p>
                    “Ahorrar no se trata de cuánto ganas,
                    sino de cuánto decides guardar con propósito.”
                </p>

            </div>

        </section>

    </main>
   <script src="javaScript/homepage.js"></script>
</body>
</html>