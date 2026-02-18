<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes Publicitarios - Yakomayo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; background-color: #f4f6f9; color: #333; }
        
        /* Encabezado */
        .header { background-color: #2c2c2c; padding: 20px; text-align: center; border-bottom: 4px solid #FFC107; }
        .header a { color: #FFC107; text-decoration: none; font-weight: bold; position: absolute; left: 20px; top: 25px; }
        .header h1 { color: white; margin: 0; font-size: 2rem; }
        
        /* Contenedor de Planes */
        .pricing-container { max-width: 1000px; margin: 50px auto; padding: 0 20px; display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; }
        
        /* Tarjetas de Precios */
        .pricing-card { background: white; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); padding: 40px 30px; width: 350px; text-align: center; position: relative; transition: 0.3s; }
        .pricing-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        
        .pricing-header h2 { margin-top: 0; font-size: 1.8rem; color: #2c3e50; }
        .price { font-size: 2.5rem; font-weight: bold; color: #333; margin: 20px 0; }
        .price span { font-size: 1rem; color: #7f8c8d; font-weight: normal; }
        
        /* Lista de Beneficios */
        .features-list { list-style: none; padding: 0; margin: 30px 0; text-align: left; }
        .features-list li { padding: 12px 0; border-bottom: 1px solid #eee; color: #555; display: flex; align-items: center; gap: 10px; }
        .features-list li i { color: #28a745; font-size: 1.2rem; }
        .features-list li.missing i { color: #e74c3c; }
        .features-list li.missing { color: #999; text-decoration: line-through; }
        
        /* Botones de Acción */
        .btn { display: block; padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 1.1rem; transition: 0.3s; }
        .btn-basic { background-color: #f1f2f6; color: #2c3e50; border: 2px solid #ddd; }
        .btn-basic:hover { background-color: #e2e4e9; }
        
        /* Estilos VIP / Premium */
        .card-premium { border: 2px solid #FFC107; transform: scale(1.05); }
        .card-premium:hover { transform: scale(1.05) translateY(-10px); }
        .ribbon { position: absolute; top: -15px; right: -15px; background: #FFC107; color: black; font-weight: bold; padding: 8px 20px; border-radius: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-premium { background-color: #FFC107; color: black; box-shadow: 0 4px 10px rgba(255,193,7,0.4); }
        .btn-premium:hover { background-color: #e0a800; }
        
        .subtitulo { text-align: center; color: #666; max-width: 600px; margin: 20px auto; font-size: 1.1rem; }
    </style>
</head>
<body>

    <div class="header" style="position: relative; padding: 25px 20px;">
        <a href="index.php" style="position: absolute; left: 20px; top: 35px;"><i class="fas fa-arrow-left"></i> Volver</a>
        
        <img src="img/jaguar-solo.png" alt="Yakomayo Logo" style="max-height: 70px; margin-bottom: 10px; border-radius: 8px; object-fit: contain;">
        
        <h1 style="margin: 0; font-size: 2rem; color: white;">Impulsa tu Negocio en el Putumayo</h1>
    </div>
    
    <p class="subtitulo">Miles de clientes potenciales están buscando negocios como el tuyo en Yakomayo. Elige el plan que mejor se adapte a tu crecimiento y empieza a recibir mensajes directo a tu WhatsApp.</p>

    <div class="pricing-container">
        
        <div class="pricing-card">
            <div class="pricing-header">
                <h2>Básico</h2>
                <p style="color: #7f8c8d;">Para negocios que apenas empiezan en el mundo digital.</p>
                <div class="price">Gratis <span>/ de por vida</span></div>
            </div>
            
            <ul class="features-list">
                <li><i class="fas fa-check-circle"></i> Aparición en el directorio web</li>
                <li><i class="fas fa-check-circle"></i> Botón directo a tu WhatsApp</li>
                <li><i class="fas fa-check-circle"></i> Dirección y categoría básica</li>
                <li class="missing"><i class="fas fa-times-circle"></i> Imagen genérica (Sin logo propio)</li>
                <li class="missing"><i class="fas fa-times-circle"></i> Posicionamiento debajo de los VIP</li>
                <li class="missing"><i class="fas fa-times-circle"></i> Sin botones a Redes Sociales</li>
                <li class="missing"><i class="fas fa-times-circle"></i> Sin botón de GPS "Cómo Llegar"</li>
            </ul>
            
            <a href="registro.php" class="btn btn-basic">Crear Registro Gratis</a>
        </div>

        <div class="pricing-card card-premium">
            <div class="ribbon"><i class="fas fa-star"></i> MÁS VENDIDO</div>
            <div class="pricing-header">
                <h2>VIP Destacado</h2>
                <p style="color: #7f8c8d;">La vitrina completa para aplastar a la competencia.</p>
                <div class="price">$30.000 <span>COP / mes</span></div> </div>
            
            <ul class="features-list">
                <li><i class="fas fa-check-circle"></i> <strong>Posición #1 en las búsquedas</strong></li>
                <li><i class="fas fa-check-circle"></i> <strong>Marco Dorado "Destacado"</strong></li>
                <li><i class="fas fa-check-circle"></i> <strong>Foto real de tu fachada o logo</strong></li>
                <li><i class="fas fa-check-circle"></i> <strong>Botones a Facebook e Instagram</strong></li>
                <li><i class="fas fa-check-circle"></i> <strong>Botón GPS para Google Maps</strong></li>
                <li><i class="fas fa-check-circle"></i> Botón directo a tu WhatsApp</li>
                <li><i class="fas fa-check-circle"></i> Soporte prioritario del equipo</li>
            </ul>
            
            <a href="https://wa.me/3002580755?text=Hola%20Julián,%20quiero%20el%20Plan%20VIP%20Destacado%20para%20mi%20negocio%20en%20Yakomayo!" target="_blank" class="btn btn-premium">¡Quiero ser Premium! <i class="fab fa-whatsapp"></i></a>
        </div>

    </div>

</body>
</html>