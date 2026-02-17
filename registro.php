<?php
$mensaje = "";
date_default_timezone_set('America/Bogota');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $conn = new mysqli("localhost", "root", "", "yakomayo_db");
    if ($conn->connect_error) { die("Error de conexión: " . $conn->connect_error); }

    // Datos visibles
    $nombre = $_POST['nombre'];
    $categoria_id = $_POST['categoria_id'];
    $descripcion = $_POST['descripcion'];
    $direccion = $_POST['direccion'];
    $municipio = $_POST['municipio'];
    $telefono = $_POST['telefono'];
    $foto = 'default.jpg'; 

    // DATOS INVISIBLES (Auditoría Legal SIC)
    $fecha_registro = date('Y-m-d H:i:s'); 
    $ip_usuario = $_SERVER['REMOTE_ADDR']; 
    $version_terminos = 'v1.0'; // Versión actual de tus reglas
    
    // Validar los 3 Checkboxes
    $acepta_datos = isset($_POST['acepta_datos']) ? 'SI' : 'NO';
    $acepta_veracidad = isset($_POST['acepta_veracidad']) ? 'SI' : 'NO';
    $acepta_exencion = isset($_POST['acepta_exencion']) ? 'SI' : 'NO';

    // Inyectar a la base de datos
    $sql = "INSERT INTO negocios (categoria_id, nombre, descripcion, direccion, telefono, municipio, foto, fecha_registro, ip_usuario, acepta_datos, acepta_veracidad, acepta_exencion, version_terminos) 
            VALUES ('$categoria_id', '$nombre', '$descripcion', '$direccion', '$telefono', '$municipio', '$foto', '$fecha_registro', '$ip_usuario', '$acepta_datos', '$acepta_veracidad', '$acepta_exencion', '$version_terminos')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "<div style='background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center; font-weight: bold;'>¡Negocio registrado con éxito! 🎉</div>";
    } else {
        $mensaje = "<div style='background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center;'>Hubo un error: " . $conn->error . "</div>";
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
            <img src="img/jaguar-solo.png" alt="Yakomayo Logo" style="max-height: 80px; border-radius: 8px;">
        </div>

        <h2 style="text-align: center; color: #333; margin-top: 0;">Suma tu negocio a Yakomayo </h2>
        <?php echo $mensaje; ?>

        <form action="registro.php" method="POST">
            <div class="form-group"><label>Nombre del Negocio:</label><input type="text" name="nombre" required></div>
            
            <div class="form-group">
                <label>Categoría (Petición 5 - Todas las categorías):</label>
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