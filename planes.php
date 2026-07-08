 <?php include 'components/navbar.php'; ?>
 <?php include 'components/navbar-mobile.php'; ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/planes.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
 </head>
 <body>

   <section class="hero-planes">

      <div class="hero-wave">

         <svg viewBox="0 0 1440 320" preserveAspectRatio="none">

            <path fill="#7CB342" fill-opacity="0.25"
            d="M0,224L80,208C160,192,320,160,480,160C640,160,800,192,960,202.7C1120,213,1280,203,1360,197.3L1440,192L1440,320L0,320Z">
            </path>

            <path fill="#A5D6A7" fill-opacity="0.4"
            d="M0,256L80,240C160,224,320,192,480,181.3C640,171,800,181,960,197.3C1120,213,1280,235,1360,245.3L1440,256L1440,320L0,320Z">
            </path>

         </svg>
      </div>

    <div class="hero-texto">

        <span class="badge">
            ⭐ Planes Coink
        </span>

        <h1>
            Elige el plan perfecto
            <span>para ti</span>
        </h1>

        <p>
            Más herramientas, más control y más posibilidades
            para alcanzar tus metas financieras.
        </p>

        <a href="#planes" class="btn-empezar">
            Ver planes
        </a>

    </div>

    <div class="hero-imagen">

      <div class="floating-card card-1">

         🎯 Metas ilimitadas

         <span>
               Organiza tus objetivos
         </span>

      </div>

      <img src="img/coink3.png"
            alt="Cerdito"
            class="hero-pig">

      <div class="floating-card card-2">

         💎 Premium

         <span>
               Plan más elegido
         </span>

      </div>
   </div>

</section>

<section class="planes-section" id="planes">

    <div class="section-title">

        <h2>Elige tu plan ideal</h2>

        <p>
            Empieza gratis o desbloquea herramientas
            avanzadas para alcanzar tus metas más rápido.
        </p>

    </div>

    <div class="planes-grid">

        <!-- GRATIS -->
        <div class="plan-card gratis">
              <img src="img/imagen1.png" alt="Plan Gratis" class="plan-img">

            <h3>🌱 Gratis</h3>

            <div class="precio">

                <span>$0</span>/mes

            </div>

            <ul>

                <li>✅ Registrar ahorros</li>
                <li>✅ Registrar gastos</li>
                <li>✅ Dashboard básico</li>
                <li>✅ Calendario financiero</li>
                <li>✅ Hasta 3 metas</li>

            </ul>

            <a href="#" class="btn-plan">
                Empezar gratis
            </a>

        </div>

        <!-- PREMIUM -->
        <div class="plan-card premium">

             <img src="img/imagen 2.png" alt="Plan Premium" class="plan-img">

            <div class="popular">
                ⭐ Más popular
            </div>

            <h3>💎 Premium</h3>

            <div class="precio">

                <span>$2.99</span>/mes

            </div>

            <ul>

                <li>✅ Todo lo del plan Gratis</li>
                <li>✅ Metas ilimitadas</li>
                <li>✅ Reportes PDF</li>
                <li>✅ Estadísticas avanzadas</li>
                <li>✅ Temas exclusivos</li>
                <li>✅ Sin anuncios</li>

            </ul>

            <a href="#" class="btn-plan premium-btn">
                Obtener Premium
            </a>

        </div>

        <!-- FAMILIAR -->
        <div class="plan-card familiar">
            <img src="img/imagen3.png" alt="Plan Familiar" class="plan-img">

            <h3>👨‍👩‍👧‍👦 Familiar</h3>

            <div class="precio">

                <span>$4.99</span>/mes

            </div>

            <ul>

                <li>✅ Todo lo de Premium</li>
                <li>✅ Hasta 5 miembros</li>
                <li>✅ Metas compartidas</li>
                <li>✅ Ahorro grupal</li>
                <li>✅ Retos familiares</li>

            </ul>

            <a href="#" class="btn-plan">
                Elegir Familiar
            </a>

        </div>

    </div>

</section>

<section class="comparison">

    <h2>
        Compara nuestros planes
    </h2>

    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>Funciones</th>
                    <th>🌱 Gratis</th>
                    <th>💎 Premium</th>
                    <th>👨‍👩‍👧‍👦 Familiar</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>Metas de ahorro</td>
                    <td>3</td>
                    <td>Ilimitadas</td>
                    <td>Ilimitadas</td>
                </tr>

                <tr>
                    <td>Reportes</td>
                    <td>Básicos</td>
                    <td>Avanzados</td>
                    <td>Avanzados</td>
                </tr>

                <tr>
                    <td>Sin anuncios</td>
                    <td>❌</td>
                    <td>✅</td>
                    <td>✅</td>
                </tr>

                <tr>
                    <td>Estadísticas</td>
                    <td>❌</td>
                    <td>✅</td>
                    <td>✅</td>
                </tr>

                <tr>
                    <td>Compartir cuenta</td>
                    <td>❌</td>
                    <td>❌</td>
                    <td>✅</td>
                </tr>

                <tr>
                    <td>Soporte prioritario</td>
                    <td>❌</td>
                    <td>✅</td>
                    <td>✅</td>
                </tr>

            </tbody>

        </table>

    </div>

</section>

<section class="cta-planes">

    <div class="cta-content">

        <h2>
            ¿Listo para alcanzar tus metas?
        </h2>

        <p>
            Comienza gratis hoy mismo o desbloquea todo el potencial de Coink con Premium.
        </p>

        <div class="cta-buttons">

            <a href="#" class="btn-cta btn-gratis">
                🌱 Comenzar Gratis
            </a>

            <a href="#" class="btn-cta btn-premium">
                💎 Probar Premium
            </a>

        </div>

        <img src="img/acostado.png"
             alt="Cerdito Premium"
             class="cta-pig">

    </div>

</section>



    
 <script src="javaScript/navbar-mobile.js"></script>
 <script src="javaScript/homepage.js"></script>

 <footer class="footer">
  <div class="footer-container">

   <div class="footer-logo">
    <img src="img/123repetido.png" alt="Logo Coink">
</div>

<p class="footer-text">
    Ahorra inteligente, vive mejor
</p>

    <div class="footer-social">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-whatsapp"></i></a>
    </div>

    <p class="footer-copy">
      © 2026 CoinK · Todos los derechos reservados
    </p>

  </div>
</footer>

 </body>
 </html>