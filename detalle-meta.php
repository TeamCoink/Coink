
<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Meta - COINK</title>
    
    <link rel="stylesheet" href="style/style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     
</head>
<body>

    <div class="bg-layer-pink"></div>
    <div class="bg-layer-green-top"></div>
    <div class="bg-hill-1"></div>
    <div class="bg-hill-2"></div>
    <div class="bg-hill-3"></div>

    <main class="main-container">
        <div class="form-card">
            
            <a href="metas.php" class="back-link" style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 25px; color: #ff4da3; text-decoration: none; font-weight: 700; font-size: 14px;">
                <i class="fa-solid fa-arrow-left"></i> Volver a mis metas
            </a>
            
            <h2 id="detalleNombre" style="text-align: left; margin-bottom: 5px;">Cargando...</h2>
            
            <div class="input-group" style="margin-bottom: 25px;">
                <p id="detalleMontoTotal" style="font-size: 15px; color: #666; font-weight: 600;">Meta objetivo: $0.00</p>
            </div>
            
            <div class="progress-container" style="margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; font-size: 13px; font-weight: 700; color: #444; margin-bottom: 6px;">
                    <span>Progreso total</span>
                    <span id="detallePorcentaje" style="color: #ff4da3;">0%</span>
                </div>
                <div style="background: #f0f0f0; height: 16px; border-radius: 25px; overflow: hidden; border: 1px solid #fae3e8;">
                    <div id="detalleBarra" style="background-color: #ff4da3; height: 100%; width: 0%; border-radius: 25px; transition: width 0.5s ease;"></div>
                </div>
            </div>
            
            <div style="display: flex; justify-content: space-between; font-size: 14px; font-weight: 700; margin-bottom: 30px;">
                <span id="detalleAhorrado" style="color: #ff4da3;">$0.00 ahorrados</span>
                <span id="detalleFalta" style="color: #7cb342;">Falta: $0.00</span>
            </div>

            <form action="php/agregar_dinero_meta.php" method="POST" style="display: flex; gap: 12px; align-items: center; width: 100%;">
                <input type="hidden" id="inputHiddenId" name="id">
                
                <div class="input-group" style="flex: 1; margin-bottom: 0;">
                    <div class="input-wrapper">
                        <i class="fa-solid fa-dollar-sign icon-left"></i>
                        <input type="number" name="monto" placeholder="Cantidad a sumar..." required min="1" step="any">
                    </div>
                </div>
                <button type="submit" class="btn-submit" style="margin-top: 0; width: auto; padding: 12px 28px; white-space: nowrap;">Agregar</button>
            </form>

        </div>
    </main>

    <script>
        const idMeta = localStorage.getItem("idMetaActual");

        if (!idMeta) {
            window.location.href = "metas.php";
        }

        // Asignar el ID actual al campo oculto del formulario antes de que el usuario envíe algo
        document.getElementById('inputHiddenId').value = idMeta;

        // Cargar los datos actuales desde la base de datos
        fetch(`php/obtener_detalle.php?id=${idMeta}`)
            .then(res => res.json())
            .then(meta => {
                if (!meta || meta.error) { 
                    window.location.href = "metas.php"; 
                    return; 
                }
                
                const actual = parseFloat(meta.actual) || 0;
                const objetivo = parseFloat(meta.objetivo) || 0;
                const porcentaje = objetivo > 0 ? Math.round((actual / objetivo) * 100) : 0;
                const falta = objetivo - actual;

                document.getElementById('detalleNombre').textContent = meta.nombre;
                document.getElementById('detalleMontoTotal').textContent = `Meta objetivo: $${objetivo.toFixed(2)}`;
                document.getElementById('detallePorcentaje').textContent = `${porcentaje}%`;
                document.getElementById('detalleAhorrado').textContent = `$${actual.toFixed(2)} ahorrados`;
                document.getElementById('detalleFalta').textContent = falta > 0 ? `Falta: $${falta.toFixed(2)}` : `¡Meta lograda! 🎉`;
                
                document.getElementById('detalleBarra').style.width = `${Math.min(porcentaje, 100)}%`;
            })
            .catch(err => console.error("Error al conectar con obtener_detalle.php:", err));
    </script>

   
</body>
</html>