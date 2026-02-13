<?php
// 1. Conexión a la Base de Datos
$host = "localhost";
$user = "root";
$pass = "";
$db   = "yakomayo_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// 2. Capturar el ID de la URL (ej: categoria.php?id=4)
$id_categoria = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 3. EL DICCIONARIO MAESTRO (Aquí definimos los Títulos Nuevos)
// Esto es lo que estaba desactualizado
$nombres_categorias = [
    1 => "🍔 Restaurantes y Comidas Rápidas",
    2 => "🥐 Panaderías y Repostería",
    3 => "🛒 Supermercados y Carnicerías",
    4 => "🍻 Licores, Bares y Discotecas",
    5 => "🧗 Turismo y Aventura",
    6 => "🛏️ Hoteles y Hospedaje",
    7 => "🎁 Regalos y Artesanías",
    8 => "🎉 Eventos y Entretenimiento",
    9 => "🏥 Salud, Clínicas y Droguerías",
    10 => "💄 Belleza, Spa y Maquillaje",
    11 => "💈 Peluquerías y Barberías",
    12 => "🐾 Veterinarias y Mascotas",
    13 => "🎓 Educación y Colegios",
    14 => "💼 Servicios Profesionales",
    15 => "🚚 Transporte y Domicilios",
    16 => "📱 Tecnología y Celulares",
    17 => "👗 Moda, Ropa y Zapatos",
    18 => "🔨 Construcción y Ferretería",
    19 => "🚜 Agro y Campo",
    20 => "🏠 Inmobiliarias",
    21 => "🏛️ Entidades de Gobierno"
];

// Si el ID existe en la lista, usamos ese nombre. Si no, ponemos "Categoría".
$titulo_categoria = isset($nombres_categorias[$id_categoria]) ? $nombres_categorias[$id_categoria] : "Resultados";

// 4. Buscar los negocios de esa categoría en la BD
$sql = "SELECT * FROM negocios WHERE categoria_id = $id_categoria";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_categoria; ?> - Yakomayo</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <header style="background-color: #2c2c2c; padding: 20px; color: white; display: flex; align-items: center; gap: 20px;">
        <a href="index.php" style="color: #FFC107; text-decoration: none; font-size: 1.2rem; font-weight: bold;">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h1 style="margin: 0; font-size: 1.5rem; color: white;"><?php echo $titulo_categoria; ?></h1>
    </header>

    <main style="padding: 20px; max-width: 1200px; margin: 0 auto;">
        
        <?php if ($result->num_rows > 0): ?>
            <div class="grid-resultados" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="tarjeta-negocio" style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        
                        <div class="foto-negocio" style="height: 200px; background-color: #eee; overflow: hidden;">
                            <img src="img/negocios/<?php echo $row['foto']; ?>" alt="<?php echo $row['nombre']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <div class="info" style="padding: 20px;">
                            <h3 style="margin-top: 0; color: #333;"><?php echo $row['nombre']; ?></h3>
                            <p style="color: #666; font-size: 0.9rem; margin-bottom: 15px;"><?php echo $row['descripcion']; ?></p>
                            
                            <p style="font-size: 0.85rem; color: #555;"><i class="fas fa-map-marker-alt" style="color: #FFC107;"></i> <?php echo $row['direccion']; ?> - <strong><?php echo $row['municipio']; ?></strong></p>
                            
                            <a href="https://wa.me/57<?php echo $row['telefono']; ?>" target="_blank" style="display: block; background-color: #25D366; color: white; text-align: center; padding: 10px; margin-top: 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                                <i class="fab fa-whatsapp"></i> Contactar
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 50px;">
                <i class="fas fa-store-slash" style="font-size: 4rem; color: #ccc; margin-bottom: 20px;"></i>
                <h2>Aún no hay negocios aquí</h2>
                <p>¡Sé el primero en aparecer en esta categoría!</p>
                <a href="registro.php" style="background-color: #FFC107; color: black; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Registrar mi Negocio</a>
            </div>
        <?php endif; ?>

    </main>

</body>
</html>