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
$sql = "SELECT * FROM comercios WHERE categoria_id = $id_categoria ORDER BY es_premium DESC, id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_categoria; ?> - Yakomayo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .tarjeta-yakomayo {
            background: white !important; 
            border-radius: 10px !important; 
            overflow: hidden !important; 
            border: 1px solid #ddd !important;
            transition: all 0.3s ease !important;
            cursor: pointer !important;
        }
        .tarjeta-yakomayo:hover {
            transform: translateY(-8px) scale(1.02) !important;
            box-shadow: 0 15px 25px rgba(0,0,0,0.2) !important;
        }
        .tarjeta-premium {
            border: 2px solid #FFC107 !important;
            box-shadow: 0 0 15px rgba(255,193,7,0.3) !important;
        }
        .tarjeta-premium:hover {
            transform: translateY(-8px) scale(1.02) !important;
            box-shadow: 0 15px 30px rgba(255,193,7,0.7) !important;
        }
    </style>
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
                    // LOGICA PREMIUM SIMPLIFICADA
                    $clase_premium = ($row['es_premium'] == 1) ? 'tarjeta-premium' : '';
                ?>
                
                <div class="tarjeta-yakomayo <?php echo $clase_premium; ?>">
                    
                    <?php if($row['es_premium']): ?>
                        <div style="background: #FFC107; color: black; text-align: center; font-weight: bold; padding: 5px; font-size: 0.8rem; letter-spacing: 1px;">
                            <i class="fas fa-star"></i> NEGOCIO DESTACADO
                        </div>
                    <?php endif; ?>

                   <div style="height: 200px; background-color: #eee; display: flex; gap: 8px; overflow-x: auto; scroll-snap-type: x mandatory; scrollbar-width: none;">
    <?php 
        $foto_mostrar = !empty($row['imagen']) ? "img/Negocios/" . $row['imagen'] : "img/jaguar-solo.png"; 
        $ancho_foto = ($row['es_premium'] == 1 && !empty($row['imagen_2'])) ? '90%' : '100%';
    ?>
    <img src="<?php echo $foto_mostrar; ?>" style="min-width: <?php echo $ancho_foto; ?>; height: 100%; object-fit: cover; scroll-snap-align: start; border-radius: 4px;">
    
    <?php if($row['es_premium'] == 1 && !empty($row['imagen_2'])): ?>
    <img src="img/Negocios/<?php echo $row['imagen_2']; ?>" style="min-width: 90%; height: 100%; object-fit: cover; scroll-snap-align: start; border-radius: 4px;">
    <?php endif; ?>
</div>

                    <div style="padding: 20px;">
                        <h3 style="margin-top: 0; color: #333;"><?php echo $row['nombre']; ?></h3>
                        <p style="color: #666; font-size: 0.9rem; margin-bottom: 15px;"><?php echo $row['descripcion']; ?></p>
                        <p style="font-size: 0.85rem; color: #555;"><i class="fas fa-map-marker-alt" style="color: #FFC107;"></i> <?php echo $row['direccion']; ?> - <strong><?php echo $row['municipio']; ?></strong></p>
                        
                        <div style="background-color: #fff3cd; color: #856404; padding: 8px; border-radius: 5px; font-size: 0.75rem; margin-top: 15px; margin-bottom: 15px; border-left: 3px solid #ffeeba;">
                            <i class="fas fa-exclamation-triangle"></i> Yakomayo no procesa pagos. Verifica al vendedor.
                        </div>

                       <div style="display: flex; gap: 8px; margin-top: 15px;">
    
    <a href="https://wa.me/57<?php echo $row['telefono']; ?>" target="_blank" style="flex-grow: 1; background-color: #25D366; color: white; padding: 10px; border-radius: 8px; text-align: center; text-decoration: none; font-weight: bold; font-size: 0.95rem; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <i class="fab fa-whatsapp" style="font-size: 1.2rem;"></i> WhatsApp
    </a>

    <?php if($row['es_premium'] == 1): ?>
        
        <?php if(!empty($row['url_mapa'])): ?>
        <a href="<?php echo $row['url_mapa']; ?>" target="_blank" style="width: 42px; height: 42px; background-color: #ffffff; color: #EA4335; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.2rem; border: 1px solid #e0e0e0; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <i class="fas fa-map-marker-alt"></i>
        </a>
        <?php endif; ?>

        <?php if(!empty($row['instagram'])): ?>
        <a href="<?php echo $row['instagram']; ?>" target="_blank" style="width: 42px; height: 42px; background-color: #ffffff; color: #E1306C; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.2rem; border: 1px solid #e0e0e0; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <i class="fab fa-instagram"></i>
        </a>
        <?php endif; ?>

        <?php if(!empty($row['facebook'])): ?>
        <a href="<?php echo $row['facebook']; ?>" target="_blank" style="width: 42px; height: 42px; background-color: #ffffff; color: #1877F2; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.2rem; border: 1px solid #e0e0e0; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <i class="fab fa-facebook-f"></i>
        </a>
        <?php endif; ?>

    <?php endif; ?>
</div>

                        </div>
                        
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
    <footer style="background-color: #1a1a1a; color: #fff; padding: 60px 20px 30px; margin-top: 60px; border-top: 4px solid #FFC107; font-family: 'Poppins', sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 50px;">
        
        <div>
            <h3 style="color: #FFC107; margin-top: 0; font-size: 1.6rem; display: flex; align-items: center; gap: 12px;">
                <img src="img/jaguar-solo.png" alt="Yakomayo Logo" style="height: 45px;"> 
                Yakomayo.com
            </h3>
            <p style="color: #bbb; font-size: 1rem; line-height: 1.7; margin-top: 20px;">
                todo el Putumayo a un clic. Únete a la plataforma digital más inclusiva y potente de la región.
            </p>
        </div>

        <div>
            <h4 style="color: #fff; margin-bottom: 25px; font-size: 1.3rem;">Explora</h4>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 15px;">
                <li><a href="index.php" style="color: #bbb; text-decoration: none; font-size: 1rem; transition: 0.3s; display: flex; align-items: center; gap: 8px;" onmouseover="this.style.color='#FFC107'; this.style.transform='translateX(5px)';" onmouseout="this.style.color='#bbb'; this.style.transform='translateX(0)';"><i class="fas fa-chevron-right" style="font-size: 0.8rem; color: #555;"></i> Inicio</a></li>
                <li><a href="registro.php" style="color: #bbb; text-decoration: none; font-size: 1rem; transition: 0.3s; display: flex; align-items: center; gap: 8px;" onmouseover="this.style.color='#FFC107'; this.style.transform='translateX(5px)';" onmouseout="this.style.color='#bbb'; this.style.transform='translateX(0)';"><i class="fas fa-chevron-right" style="font-size: 0.8rem; color: #555;"></i> Registrar mi Negocio</a></li>
                <li><a href="planes.php" style="color: #bbb; text-decoration: none; font-size: 1rem; transition: 0.3s; display: flex; align-items: center; gap: 8px;" onmouseover="this.style.color='#FFC107'; this.style.transform='translateX(5px)';" onmouseout="this.style.color='#bbb'; this.style.transform='translateX(0)';"><i class="fas fa-chevron-right" style="font-size: 0.8rem; color: #555;"></i> Planes Publicitarios</a></li>
                <li><a href="contacto.php" style="color: #bbb; text-decoration: none; font-size: 1rem; transition: 0.3s; display: flex; align-items: center; gap: 8px;" onmouseover="this.style.color='#FFC107'; this.style.transform='translateX(5px)';" onmouseout="this.style.color='#bbb'; this.style.transform='translateX(0)';"><i class="fas fa-chevron-right" style="font-size: 0.8rem; color: #555;"></i> Contacto</a></li>
            </ul>
        </div>

        <div>
            <h4 style="color: #fff; margin-bottom: 25px; font-size: 1.3rem;">Síguenos</h4>
            <p style="color: #bbb; font-size: 1rem; margin-bottom: 25px;">Únete a la comunidad y no te pierdas nada.</p>
            
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <a href="https://www.facebook.com/people/Yakomayo/61588034483560/" target="_blank" rel="noopener noreferrer" 
                   style="background: #2a2a2a; color: white; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; border-radius: 50%; text-decoration: none; font-size: 1.6rem; border: 2px solid #444; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.2);" 
                   onmouseover="this.style.background='#1877F2'; this.style.borderColor='#1877F2'; this.style.transform='translateY(-5px) scale(1.1)'; this.style.boxShadow='0 10px 20px rgba(24, 119, 242, 0.4)';" 
                   onmouseout="this.style.background='#2a2a2a'; this.style.borderColor='#444'; this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <a href="https://www.instagram.com/yakomayo" target="_blank" rel="noopener noreferrer" 
                   style="background: #2a2a2a; color: white; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; border-radius: 50%; text-decoration: none; font-size: 1.6rem; border: 2px solid #444; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.2);" 
                   onmouseover="this.style.background='linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%)'; this.style.borderColor='#dc2743'; this.style.transform='translateY(-5px) scale(1.1)'; this.style.boxShadow='0 10px 20px rgba(220, 39, 67, 0.4)';" 
                   onmouseout="this.style.background='#2a2a2a'; this.style.borderColor='#444'; this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';">
                    <i class="fab fa-instagram"></i>
                </a>
                
                <a href="#" onclick="alert('¡Estamos preparando nuestros bailes! Síguenos pronto.'); return false;" 
                   style="background: #2a2a2a; color: white; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; border-radius: 50%; text-decoration: none; font-size: 1.6rem; border: 2px solid #444; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.2);" 
                   onmouseover="this.style.background='#000000'; this.style.borderColor='#ffffff'; this.style.transform='translateY(-5px) scale(1.1)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.4)';" 
                   onmouseout="this.style.background='#2a2a2a'; this.style.borderColor='#444'; this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';">
                    <i class="fab fa-tiktok"></i>
                </a>

                <a href="#" onclick="alert('¡Canal en construcción! Pronto videos de historia.'); return false;" 
                   style="background: #2a2a2a; color: white; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; border-radius: 50%; text-decoration: none; font-size: 1.6rem; border: 2px solid #444; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.2);" 
                   onmouseover="this.style.background='#FF0000'; this.style.borderColor='#FF0000'; this.style.transform='translateY(-5px) scale(1.1)'; this.style.boxShadow='0 10px 20px rgba(255, 0, 0, 0.4)';" 
                   onmouseout="this.style.background='#2a2a2a'; this.style.borderColor='#444'; this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div style="text-align: center; color: #777; font-size: 0.9rem; margin-top: 60px; padding-top: 30px; border-top: 1px solid #333;">
        &copy; <?php echo date("Y"); ?> <strong>Yakomayo.com</strong> - Todos los derechos reservados.<br>
        <span style="font-size: 0.85rem; color: #666; display: block; margin-top: 10px;">Diseñado con <i class="fas fa-heart fa-pulse" style="color:#e74c3c; margin: 0 5px;"></i> en el Putumayo para el mundo</span>
    </div>
</footer>
</body>
</html>