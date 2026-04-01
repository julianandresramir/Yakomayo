<?php
$mensaje = "";
date_default_timezone_set('America/Bogota');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include 'db.php';

    // Datos visibles
    $nombre = $_POST['nombre'];
    $categoria_id = $_POST['categoria_id'];
    $descripcion = $_POST['descripcion'];
    $direccion = $_POST['direccion'];
    $municipio = $_POST['municipio'];
    $telefono = $_POST['telefono'];
    $palabras_clave = $_POST['palabras_clave'] ?? '';
    $foto = 'img/jaguar-solo.png';

    // DATOS INVISIBLES (Auditoría Legal SIC)
    $fecha_registro = date('Y-m-d H:i:s'); 
    $ip_usuario = $_SERVER['REMOTE_ADDR']; 
    $version_terminos = 'v1.0'; // Versión actual de tus reglas
    
    // Validar los 3 Checkboxes
    $acepta_datos = isset($_POST['acepta_datos']) ? 'SI' : 'NO';
    $acepta_veracidad = isset($_POST['acepta_veracidad']) ? 'SI' : 'NO';
    $acepta_exencion = isset($_POST['acepta_exencion']) ? 'SI' : 'NO';

    // Inyectar a la base de datos
   // --- 🕵️‍♂️ INICIO DEL BLINDAJE LEGAL ---
    
    // 1. Configuramos el reloj del servidor para la hora de Colombia (Putumayo)
    date_default_timezone_set('America/Bogota'); 
    $fecha_registro = date('Y-m-d H:i:s'); // Captura el momento exacto
    
    // 2. Capturamos la huella digital (Dirección IP)
    $ip_registro = $_SERVER['REMOTE_ADDR']; 
    
    // 3. Verificamos que las 3 casillas legales obligatorias fueron marcadas
    if (isset($_POST['acepta_datos']) && isset($_POST['acepta_veracidad']) && isset($_POST['acepta_exencion'])) {
        $acepta_terminos = 1; // El 1 maestro que significa: "Aceptó el paquete legal completo"
    } else {
        $acepta_terminos = 0; // Por si alguien intenta hacer trampa saltándose el HTML
    }

    // --- 🛑 FIN DEL BLINDAJE LEGAL ---

    // La instrucción SQL BLINDADA (Prepared Statement)
    // NOTA DEL CTO: Cambiamos el 1 por un 0 en 'es_premium' para que todos nazcan con plan básico
    $sql = "INSERT INTO comercios (categoria_id, nombre, descripcion, palabras_clave, direccion, telefono, municipio, imagen, es_premium, acepta_terminos, ip_registro, fecha_registro) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?, ?, ?)";

    // Preparamos la consulta (La base de datos se pone el escudo)
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vinculamos las variables a los signos de interrogación (?)
        // La cadena "isssssssiss" le dice a la base de datos qué tipo de dato es cada uno (i = entero, s = texto)
        $stmt->bind_param("isssssssiss", $categoria_id, $nombre, $descripcion, $palabras_clave, $direccion, $telefono, $municipio, $foto, $acepta_terminos, $ip_registro, $fecha_registro);

        // Ejecutamos la consulta de forma segura
        if ($stmt->execute()) {
            $mensaje = "<div style='background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center; font-weight: bold;'>¡Negocio registrado con éxito! 🎉</div>";
        } else {
            $mensaje = "<div style='background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center;'>Hubo un error al guardar: " . $stmt->error . "</div>";
        }
        
        $stmt->close(); // Cerramos el escudo
    } else {
        $mensaje = "<div style='background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center;'>Error de seguridad en la base de datos: " . $conn->error . "</div>";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Negocio - Yakomayo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f4f4f4; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; }
        .form-container { max-width: 650px; margin: 40px auto; background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 8px; color: #333; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; box-sizing: border-box; font-size: 1rem; }
        .btn-submit { background-color: #FFC107; color: black; border: none; padding: 15px 20px; font-size: 1.1rem; font-weight: bold; border-radius: 8px; cursor: pointer; width: 100%; }
        .legal-box { background-color: #f8f9fa; border: 1px solid #dee2e6; padding: 15px; border-radius: 8px; font-size: 0.85rem; color: #555; margin-top: 25px; margin-bottom: 20px; }
        .legal-check { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 12px; cursor: pointer; line-height: 1.4; }
        .legal-check input { width: 20px; height: 20px; margin-top: 2px; cursor: pointer; }
    </style>
</head>
<body>
    <header style="background-color: #2c2c2c; padding: 20px; display: flex; align-items: center; gap: 20px;">
        <a href="index.php" style="color: #FFC107; text-decoration: none; font-size: 1.2rem; font-weight: bold; margin-left: 20px;"><i class="fas fa-arrow-left"></i> Volver al Directorio</a>
    </header>

    <div class="form-container">
        <div style="text-align: center; margin-bottom: 20px;">
    <img src="img/jaguar-solo.png" alt="Logo Yakomayo" style="max-height: 80px; margin-bottom: 5px;">
    <h1 style="font-size: clamp(1.8rem, 7vw, 3.5rem); font-weight: bold; margin: 0; color: #333;">Yakomayo.com</h1>
    <h2 style="font-size: clamp(1rem, 4vw, 1.5rem); text-align: center; color: #666; margin-top: 5px;">Suma tu negocio a Yakomayo</h2>
</div>
        <?php echo $mensaje; ?>

        <form action="registro.php" method="POST">
            <div class="form-group"><label>Nombre del Negocio:</label><input type="text" name="nombre" required></div>
            
            <div class="form-group">
                <label>Categoría:</label>
                <select name="categoria_id" required>
                    <option value="">Selecciona una categoría...</option>
                    <option value="1">🍔 Restaurantes y Comidas Rápidas</option>
                    <option value="2">🥐 Panaderías y Repostería</option>
                    <option value="3">🛒 Supermercados y Carnicerías</option>
                    <option value="4">🍻 Licores, Bares y Discotecas</option>
                    <option value="5">🧗 Turismo y Aventura</option>
                    <option value="6">🛏️ Hoteles y Hospedaje</option>
                    <option value="7">🎁 Regalos y Artesanías</option>
                    <option value="8">🎉 Eventos y Entretenimiento</option>
                    <option value="9">🏥 Salud, Clínicas y Droguerías</option>
                    <option value="10">💄 Belleza, Spa y Maquillaje</option>
                    <option value="11">💈 Peluquerías y Barberías</option>
                    <option value="12">🐾 Veterinarias y Mascotas</option>
                    <option value="13">🎓 Educación y Colegios</option>
                    <option value="14">💼 Servicios Profesionales</option>
                    <option value="15">🚚 Transporte y Domicilios</option>
                    <option value="16">📱 Tecnología y Celulares</option>
                    <option value="17">👗 Moda, Ropa y Zapatos</option>
                    <option value="18">🔨 Construcción y Ferretería</option>
                    <option value="19">🚜 Agro y Campo</option>
                    <option value="20">🏠 Inmobiliarias</option>
                    <option value="21">🏛️ Entidades de Gobierno</option>
                </select>
            </div>

            <div class="form-group"><label>Descripción corta:</label><textarea name="descripcion" required rows="3"></textarea></div>
            <div class="form-group">
    <label>Palabras Clave (Ocultas al público):</label>
    <input type="text" name="palabras_clave" placeholder="Ej: ropa, vestidos, alquiler, moda">
</div>

            <div class="form-group"><label>Dirección:</label><input type="text" name="direccion" required></div>
            
            <div class="form-group">
                <label>Municipio:</label>
                <select name="municipio" required>
                    <option value="Mocoa">Mocoa</option>
                    <option value="Villagarzón">Villagarzón</option>
                    <option value="Puerto Asís">Puerto Asís</option>
                    <option value="Orito">Orito</option>
                    <option value="Sibundoy">Sibundoy</option>
                    <option value="Puerto Caicedo">Puerto Caicedo</option>
                    <option value="La Hormiga">La Hormiga</option>
                    <option value="Puerto Guzmán">Puerto Guzmán</option>
                    <option value="San Francisco">San Francisco</option>
                    <option value="Colón">Colón</option>
                    <option value="Santiago">Santiago</option>
                    <option value="Puerto Leguízamo">Puerto Leguízamo</option>
                    <option value="San Miguel">San Miguel</option>
  </select>
    </div>

    <div class="form-group">
        <label>Link de Facebook (Opcional):</label>
        <input type="text" name="facebook" placeholder="Ej: https://facebook.com/tu-pagina">
    </div>

    <div class="form-group">
        <label>Link de Instagram (Opcional):</label>
        <input type="text" name="instagram" placeholder="Ej: https://instagram.com/tu-perfil">
    </div>

            <div class="form-group"><label>Teléfono (WhatsApp):</label><input type="number" name="telefono" required></div>

            <div class="legal-box">
                
                <p style="margin-top: 0; font-weight: bold; color: #333; font-size: 1rem;"><i class="fas fa-balance-scale"></i> Acuerdos Legales Obligatorios</p>
                
                <label class="legal-check">
                    <input type="checkbox" name="acepta_datos" required>
                    <span><strong>1. Tratamiento de Datos:</strong> Autorizo a Yakomayo para recolectar y tratar mis datos y los de mi negocio conforme a la Ley 1581 de 2012 (Habeas Data), con el fin de ser publicados en el directorio.</span>
                </label>

                <label class="legal-check">
                    <input type="checkbox" name="acepta_veracidad" required>
                    <span><strong>2. Veracidad y Propiedad:</strong> Declaro que la información e imágenes suministradas son verídicas y poseo los derechos de autor necesarios para su difusión.</span>
                </label>

                <label class="legal-check">
                    <input type="checkbox" name="acepta_exencion" required>
                    <span><strong>3. Exención de Responsabilidad:</strong> Acepto que Yakomayo es solo una vitrina digital. La plataforma no es responsable por mis obligaciones tributarias, ni por las garantías de mis productos/servicios.</span>
                </label>
            </div>

            <button type="submit" class="btn-submit">Registrar Mi Negocio <i class="fas fa-check-circle"></i></button>
        </form>
    </div>
</body>
</html>