<?php
session_start();
// El Portero: Si no tienes la llave, te vas para el login
if (!isset($_SESSION['admin_logueado']) || $_SESSION['admin_logueado'] !== true) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$mensaje = "";
$negocio = null;

// 1. Si el CEO presiona "Guardar Cambios"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_editar = $_POST['id'];
    
    // Recibimos y "limpiamos" los datos (El escudo de seguridad para que no rompan la DB con comillas)
    $nombre = $conn->real_escape_string(trim($_POST['nombre']));
    $categoria_id = (int)$_POST['categoria_id'];
    $descripcion = $conn->real_escape_string(trim($_POST['descripcion']));
    $palabras_clave = $conn->real_escape_string(trim($_POST['palabras_clave']));
    $municipio = $conn->real_escape_string(trim($_POST['municipio']));
    $telefono = $conn->real_escape_string(trim($_POST['telefono']));
    $direccion = $conn->real_escape_string(trim($_POST['direccion']));
    $imagen = $conn->real_escape_string(trim($_POST['imagen']));
    $imagen_2 = $conn->real_escape_string(trim($_POST['imagen_2']));
    $imagen_3 = $conn->real_escape_string(trim($_POST['imagen_3']));
    $imagen_4 = $conn->real_escape_string(trim($_POST['imagen_4']));
    $url_mapa = $conn->real_escape_string(trim($_POST['url_mapa']));
    $facebook = $conn->real_escape_string(trim($_POST['facebook']));
    $instagram = $conn->real_escape_string(trim($_POST['instagram']));
    $sitio_web = $conn->real_escape_string(trim($_POST['sitio_web']));

    // Actualizamos TODOS los campos en la tabla
    $sql_update = "UPDATE comercios SET 
        nombre = '$nombre',
        categoria_id = $categoria_id,
        descripcion = '$descripcion',
        palabras_clave = '$palabras_clave',
        municipio = '$municipio',
        telefono = '$telefono',
        direccion = '$direccion',
        imagen = '$imagen',
        imagen_2 = '$imagen_2',
        imagen_3 = '$imagen_3',
        imagen_4 = '$imagen_4',
        url_mapa = '$url_mapa',
        facebook = '$facebook',
        instagram = '$instagram',
        sitio_web = '$sitio_web'
        WHERE id = $id_editar";
    
    if ($conn->query($sql_update) === TRUE) {
        $mensaje = "<div class='alerta exito'><i class='fas fa-check-circle'></i> ¡Todos los datos del negocio fueron actualizados con éxito!</div>";
    } else {
        $mensaje = "<div class='alerta error'><i class='fas fa-exclamation-triangle'></i> Error: " . $conn->error . "</div>";
    }
}

// 2. Traer los datos del negocio que seleccionamos
if (isset($_GET['id']) || isset($_POST['id'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
    $sql = "SELECT * FROM comercios WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $negocio = $result->fetch_assoc();
    } else {
        die("Negocio no encontrado.");
    }
} else {
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor Avanzado - Yakomayo CEO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; background-color: #f4f6f9; color: #333; }
        .sidebar { width: 250px; background-color: #2c3e50; color: white; position: fixed; height: 100vh; padding: 20px; box-sizing: border-box; box-shadow: 2px 0 5px rgba(0,0,0,0.1); }
        .sidebar h2 { color: #FFC107; text-align: center; border-bottom: 1px solid #455667; padding-bottom: 15px; margin-top: 0; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 12px; margin-bottom: 10px; border-radius: 5px; transition: 0.3s; font-size: 1.05rem; }
        .sidebar a:hover { background-color: #34495e; color: #FFC107; padding-left: 15px; }
        .main-content { margin-left: 250px; padding: 30px; }
        .header-dashboard { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #ddd; padding-bottom: 15px; }
        
        /* Formulario Grid Profesional */
        .caja-edicion { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 900px; }
        .section-title { font-size: 1.1rem; color: #2c3e50; border-bottom: 2px solid #f1f2f6; padding-bottom: 5px; margin-top: 25px; margin-bottom: 15px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 6px; color: #555; font-size: 0.9rem; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 0.95rem; box-sizing: border-box; font-family: inherit; }
        .form-group textarea { resize: vertical; min-height: 80px; }
        
        .btn-guardar { background-color: #28a745; color: white; border: none; padding: 15px 20px; font-size: 1.1rem; border-radius: 5px; cursor: pointer; font-weight: bold; width: 100%; margin-top: 20px; transition: 0.3s; }
        .btn-guardar:hover { background-color: #218838; transform: translateY(-2px); }
        .btn-volver { display: inline-block; margin-bottom: 20px; color: #3498db; text-decoration: none; font-weight: bold; }
        .btn-volver:hover { text-decoration: underline; }
        
        .alerta { padding: 15px; margin-bottom: 20px; border-radius: 5px; font-weight: bold; }
        .exito { background-color: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .error { background-color: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2> Yakomayo</h2>
        <a href="index.php" target="_blank"><i class="fas fa-external-link-alt"></i> Ver Sitio Web</a>
        <a href="admin.php" style="background-color: #FFC107; color: black; font-weight: bold;"><i class="fas fa-store"></i> Gestión de Negocios</a>
        <a href="#"><i class="fas fa-chart-bar"></i> Estadísticas <small>(Pronto)</small></a>
        <a href="#"><i class="fas fa-cog"></i> Configuraciones</a>
    </div>

    <div class="main-content">
        <div class="header-dashboard">
            <div>
                <h1 style="margin: 0; color: #2c3e50;">Editor Avanzado de Negocio</h1>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Control total sobre los datos del cliente.</p>
            </div>
            <div style="background-color: #2c3e50; color: white; padding: 10px 20px; border-radius: 20px; font-weight: bold;">
                <i class="fas fa-user-tie"></i> CEO Admin
            </div>
        </div>

        <a href="admin.php" class="btn-volver"><i class="fas fa-arrow-left"></i> Volver al panel</a>

        <?php echo $mensaje; ?>

        <div class="caja-edicion">
            <h2 style="margin-top: 0; color: #2c3e50;">
                <i class="fas fa-edit"></i> Editando: <span style="color: #3498db;"><?php echo $negocio['nombre']; ?></span>
            </h2>

            <form action="editar.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $negocio['id']; ?>">

                <h3 class="section-title"><i class="fas fa-info-circle"></i> Información Principal</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Nombre del Negocio:</label>
                        <input type="text" name="nombre" value="<?php echo htmlspecialchars($negocio['nombre']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>ID de Categoría (Número):</label>
                        <input type="number" name="categoria_id" value="<?php echo $negocio['categoria_id']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Descripción:</label>
                    <textarea name="descripcion"><?php echo htmlspecialchars($negocio['descripcion']); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Palabras Clave (SEO):</label>
                    <input type="text" name="palabras_clave" value="<?php echo htmlspecialchars($negocio['palabras_clave']); ?>">
                </div>

                <h3 class="section-title"><i class="fas fa-map-marker-alt"></i> Contacto y Ubicación</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Teléfono / WhatsApp:</label>
                        <input type="text" name="telefono" value="<?php echo htmlspecialchars($negocio['telefono']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Municipio:</label>
                        <input type="text" name="municipio" value="<?php echo htmlspecialchars($negocio['municipio']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Dirección Física:</label>
                    <input type="text" name="direccion" value="<?php echo htmlspecialchars($negocio['direccion']); ?>">
                </div>
                <div class="form-group">
                    <label>URL de Google Maps:</label>
                    <input type="text" name="url_mapa" value="<?php echo htmlspecialchars($negocio['url_mapa']); ?>">
                </div>

                <h3 class="section-title"><i class="fas fa-share-alt"></i> Redes Sociales</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label><i class="fab fa-facebook" style="color:#1877F2;"></i> Enlace Facebook:</label>
                        <input type="text" name="facebook" value="<?php echo htmlspecialchars($negocio['facebook']); ?>">
                    </div>
                    <div class="form-group">
                        <label><i class="fab fa-instagram" style="color:#E4405F;"></i> Enlace Instagram:</label>
                        <input type="text" name="instagram" value="<?php echo htmlspecialchars($negocio['instagram']); ?>">
                    </div>
                </div>
                
                <div class="form-group">
        <label><i class="fas fa-globe" style="color:#3498db;"></i> Sitio Web (Exclusivo VIP):</label>
        <input type="text" name="sitio_web" value="<?php echo htmlspecialchars($negocio['sitio_web']); ?>" placeholder="https://www.mipagina.com">
    </div>

                <h3 class="section-title"><i class="fas fa-images"></i> Recursos Gráficos (Nombres de archivo .webp/.png)</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Imagen Principal (Logo/Portada):</label>
                        <input type="text" name="imagen" value="<?php echo htmlspecialchars($negocio['imagen']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Imagen Galería 2:</label>
                        <input type="text" name="imagen_2" value="<?php echo htmlspecialchars($negocio['imagen_2']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Imagen Galería 3:</label>
                        <input type="text" name="imagen_3" value="<?php echo htmlspecialchars($negocio['imagen_3']); ?>">
                    </div>
                    <div class="form-group">
                        <label>Imagen Galería 4:</label>
                        <input type="text" name="imagen_4" value="<?php echo htmlspecialchars($negocio['imagen_4']); ?>">
                    </div>
                </div>

                <button type="submit" class="btn-guardar"><i class="fas fa-save"></i> Guardar Todos los Cambios</button>
            </form>
        </div>
    </div>

</body>
</html>