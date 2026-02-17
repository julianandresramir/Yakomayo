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
$sql = "SELECT * FROM negocios WHERE categoria_id = $id_categoria ORDER BY es_premium DESC, id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_categoria; ?> - Yakomayo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body style="background-color: #f4f4f4; margin: 0; font-family: sans-serif;">

    <header style="background-color: #2c2c2c; padding: 15px 20px; display: flex; align-items: center; justify-content: space-between; border-bottom: 4px solid #FFC107;">
        <a href="index.php" style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: white;">
            <img src="img/jaguar-solo.png" alt="Yakomayo" style="height: 40px; border-radius: 5px; object-fit: contain;"> 
            <span style="color: #FFC107; font-weight: bold;"><i class="fas fa-arrow-left"></i> Inicio</span>
        </a>
        <h1 style="margin: 0; font-size: 1.3rem; color: white;"><?php echo $titulo_categoria; ?></h1>
    </header>

    <main style="padding: 20px; max-width: 1200px; margin: 0 auto;">
        <?php if ($result->num_rows > 0): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                
                <?php while($row = $result->fetch_assoc()): 
                    // LOGICA PREMIUM: Si es premium, borde dorado. Si no, borde gris normal.
                    $estilo_borde = $row['es_premium'] ? 'border: 2px solid #FFC107; box-shadow: 0 0 15px rgba(255,193,7,0.5); transform: scale(1.02);' : 'border: 1px solid #ddd;';
                ?>
                    
                    <div style="background: white; border-radius: 10px; overflow: hidden; transition: 0.3s; <?php echo $estilo_borde; ?>">
                        
                        <?php if($row['es_premium']): ?>
                            <div style="background: #FFC107; color: black; text-align: center; font-weight: bold; padding: 5px; font-size: 0.8rem; letter-spacing: 1px;">
                                <i class="fas fa-star"></i> NEGOCIO DESTACADO
                            </div>
                        <?php endif; ?>

                        <div style="height: 200px; background-color: #eee; overflow: hidden;">
                            <img src="img/negocios/<?php echo $row['foto']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <div style="padding: 20px;">
                            <h3 style="margin-top: 0; color: #333;"><?php echo $row['nombre']; ?></h3>
                            <p style="color: #666; font-size: 0.9rem; margin-bottom: 15px;"><?php echo $row['descripcion']; ?></p>
                            <p style="font-size: 0.85rem; color: #555;"><i class="fas fa-map-marker-alt" style="color: #FFC107;"></i> <?php echo $row['direccion']; ?> - <strong><?php echo $row['municipio']; ?></strong></p>
                            
                            <div style="background-color: #fff3cd; color: #856404; padding: 8px; border-radius: 5px; font-size: 0.75rem; margin-top: 15px; margin-bottom: 10px; border-left: 3px solid #ffeeba;">
                                <i class="fas fa-exclamation-triangle"></i> Yakomayo no procesa pagos. Verifica al vendedor.
                            </div>

                            <a href="https://wa.me/57<?php echo $row['telefono']; ?>" target="_blank" style="display: block; background-color: #25D366; color: white; text-align: center; padding: 10px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                                <i class="fab fa-whatsapp"></i> Contactar
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 50px;">
                <h2>Aún no hay negocios aquí</h2>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>