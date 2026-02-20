<?php
// 1. CONEXIÓN A LA BASE DE DATOS
$conn = new mysqli("localhost", "root", "", "yakomayo_db");
if ($conn->connect_error) { 
    die("Error de conexión: " . $conn->connect_error); 
}

// 2. CAPTURAR QUÉ BUSCÓ EL CLIENTE
$busqueda = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';
$ciudad = isset($_GET['ciudad']) ? $conn->real_escape_string($_GET['ciudad']) : '';

// 3. LA CONSULTA SQL (Busca por nombre o descripción, y prioriza a los VIP)
$sql = "SELECT * FROM negocios WHERE (nombre LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%')";

if (!empty($ciudad)) {
    $sql .= " AND municipio = '$ciudad'";
}

// Magia: Ordena primero los Premium (1) y luego los básicos (0)
$sql .= " ORDER BY es_premium DESC, id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados para "<?php echo htmlspecialchars($busqueda); ?>" - Yakomayo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* ESTILOS DE LAS TARJETAS */
        .tarjeta-yakomayo { background: white !important; border-radius: 10px !important; overflow: hidden !important; border: 1px solid #ddd !important; transition: all 0.3s ease !important; cursor: pointer !important; }
        .tarjeta-yakomayo:hover { transform: translateY(-8px) scale(1.02) !important; box-shadow: 0 15px 25px rgba(0,0,0,0.2) !important; }
        .tarjeta-premium { border: 2px solid #FFC107 !important; box-shadow: 0 0 15px rgba(255,193,7,0.3) !important; }
        .tarjeta-premium:hover { transform: translateY(-8px) scale(1.02) !important; box-shadow: 0 15px 30px rgba(255,193,7,0.7) !important; }
        
        /* ESTILOS DE LA PÁGINA */
        body { background-color: #f4f4f4; margin: 0; font-family: sans-serif; }
        header { background-color: #2c2c2c; padding: 15px 20px; border-bottom: 4px solid #FFC107; display: flex; align-items: center; justify-content: space-between; }
        .volver-inicio { color: white; text-decoration: none; font-weight: bold; }
        .volver-inicio:hover { color: #FFC107; }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="volver-inicio"><i class="fas fa-arrow-left"></i> Volver al inicio</a>
        <h1 style="color: white; margin: 0; font-size: 1.5rem;">Yakomayo.com</h1>
    </header>

    <main style="padding: 20px; max-width: 1200px; margin: 0 auto;">
        <h2 style="color: #333; margin-bottom: 5px;">Resultados de búsqueda</h2>
        <p style="color: #666; margin-top: 0; margin-bottom: 30px;">
            Mostrando resultados para: <strong>"<?php echo htmlspecialchars($busqueda); ?>"</strong> 
            <?php echo !empty($ciudad) ? "en <strong>$ciudad</strong>" : ""; ?>
        </p>

        <?php if ($result && $result->num_rows > 0): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                
                <?php while($row = $result->fetch_assoc()): 
                    $clase_premium = ($row['es_premium'] == 1) ? 'tarjeta-premium' : '';
                ?>
                    <div class="tarjeta-yakomayo <?php echo $clase_premium; ?>">
                        
                        <?php if($row['es_premium']): ?>
                            <div style="background: #FFC107; color: black; text-align: center; font-weight: bold; padding: 5px; font-size: 0.8rem; letter-spacing: 1px;">
                                <i class="fas fa-star"></i> NEGOCIO DESTACADO
                            </div>
                        <?php endif; ?>

                        <div style="height: 200px; background-color: #eee; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                            <?php $foto_mostrar = !empty($row['foto']) ? "img/negocios/" . $row['foto'] : "img/jaguar-solo.png"; ?>
                            <img src="<?php echo $foto_mostrar; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <div style="padding: 20px;">
                            <h3 style="margin-top: 0; color: #333;"><?php echo $row['nombre']; ?></h3>
                            <p style="color: #666; font-size: 0.9rem; margin-bottom: 15px;"><?php echo $row['descripcion']; ?></p>
                            <p style="font-size: 0.85rem; color: #555;"><i class="fas fa-map-marker-alt" style="color: #FFC107;"></i> <?php echo $row['direccion']; ?> - <strong><?php echo $row['municipio']; ?></strong></p>
                            
                            <div style="background-color: #fff3cd; color: #856404; padding: 8px; border-radius: 5px; font-size: 0.75rem; margin-top: 15px; margin-bottom: 15px; border-left: 3px solid #ffeeba;">
                                <i class="fas fa-exclamation-triangle"></i> Yakomayo no procesa pagos. Verifica al vendedor.
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                <a href="https://wa.me/57<?php echo $row['telefono']; ?>" target="_blank" style="display: block; background-color: #25D366; color: white; text-align: center; padding: 10px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                                    <i class="fab fa-whatsapp"></i> Contactar
                                </a>

                                <?php if($row['es_premium'] == 1): ?>
                                    <div style="display: flex; gap: 8px; justify-content: space-between; align-items: center;">
                                        <?php if(!empty($row['url_mapa'])): ?>
                                            <a href="<?php echo $row['url_mapa']; ?>" target="_blank" style="flex-grow: 1; background-color: #e74c3c; color: white; text-align: center; padding: 8px; border-radius: 5px; text-decoration: none; font-weight: bold; font-size: 0.9rem; transition: 0.2s;">
                                                <i class="fas fa-map-marked-alt"></i> Cómo Llegar
                                            </a>
                                        <?php endif; ?>
                                        <div style="display: flex; gap: 8px;">
                                            <?php if(!empty($row['link_facebook'])): ?>
                                                <a href="<?php echo $row['link_facebook']; ?>" target="_blank" style="background-color: #1877F2; color: white; width: 35px; height: 35px; display: flex; justify-content: center; align-items: center; border-radius: 5px; text-decoration: none; font-size: 1.1rem;">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if(!empty($row['link_instagram'])): ?>
                                                <a href="<?php echo $row['link_instagram']; ?>" target="_blank" style="background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); color: white; width: 35px; height: 35px; display: flex; justify-content: center; align-items: center; border-radius: 5px; text-decoration: none; font-size: 1.1rem;">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 50px; background: white; border-radius: 10px; border: 1px solid #ddd;">
                <i class="fas fa-search" style="font-size: 3rem; color: #ccc; margin-bottom: 15px;"></i>
                <h2 style="color: #555;">No encontramos negocios para esta búsqueda</h2>
                <p style="color: #888;">Intenta buscar con otras palabras o selecciona "Todo el Putumayo".</p>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>