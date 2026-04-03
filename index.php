<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yakomayo.com - El Directorio del Putumayo</title>
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#FFC107">
    <link rel="apple-touch-icon" href="img/jaguar-solo.png">

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('service-worker.js')
                    .then(registro => {
                        console.log('¡Motor PWA encendido! Alcance:', registro.scope);
                    })
                    .catch(error => {
                        console.log('Fallo al encender PWA:', error);
                    });
            });
        }
    </script>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <header
        style="position: absolute; top: 0; left: 0; width: 100%; padding: 20px; display: flex; justify-content: flex-end; box-sizing: border-box; z-index: 10;">
        <nav>
            <a href="planes.php"
                style="background-color: #FFC107; color: black; padding: 10px 20px; border-radius: 25px; text-decoration: none; font-weight: bold; font-size: 0.95rem; box-shadow: 0 4px 10px rgba(0,0,0,0.4); transition: transform 0.3s;">
                <i class="fas fa-crown"></i> Publica tu Negocio
            </a>
        </nav>
    </header>

    <div class="hero-banner">

        <div class="hero-brand">
            <img src="img/jaguar-solo.png" alt="Logo Yakomayo" width="100" height="100">
            <h1>Yakomayo</h1>
        </div>

        <p class="hero-slogan" style="margin: 15px 20px; text-align: center; color: white;">Si está en el Putumayo, está
            aquí. Conectamos negocios de todos los tamaños con clientes reales.</p>

        <form action="buscar.php" method="GET" class="search-smart-container">

            <input type="text" name="q" placeholder="¿Qué buscas? (Ej: Pizza, Ropa, Hotel)..." required
                class="search-smart-input">

            <select name="ciudad" class="search-smart-select">
                <option value="">📍 Todo el Putumayo</option>
                <option value="Mocoa" selected>Mocoa</option>
                <option value="Puerto Asís">Puerto Asís</option>
                <option value="Orito">Orito</option>
                <option value="Sibundoy">Sibundoy</option>
                <option value="San Francisco">San Francisco</option>
                <option value="Villagarzón">Villagarzón</option>
                <option value="Puerto Guzmán">Puerto Guzmán</option>
                <option value="Puerto Leguízamo">Puerto Leguízamo</option>
                <option value="Valle del Guamuez">Valle del Guamuez</option>
                <option value="San Miguel">San Miguel</option>
                <option value="Santiago">Santiago</option>
            </select>

            <button type="submit" class="search-smart-btn"><i class="fas fa-search"></i> Buscar</button>
        </form>
    </div>
    </header>

    <main class="contenedor">

        <h2 style="text-align: center; margin-bottom: 30px; color: #555; font-weight: 600;">
            ¿Qué estás buscando hoy?
        </h2>

        <div class="grid-categorias">

            <a href="categoria.php?id=1" class="categoria">
                <div class="icono-emoji">🍔</div>
                <h3>Restaurantes</h3>
                <span class="subtexto">Y Comidas Rápidas</span>
            </a>

            <a href="categoria.php?id=2" class="categoria">
                <div class="icono-emoji">🥐</div>
                <h3>Panaderías</h3>
                <span class="subtexto">Y Repostería</span>
            </a>

            <a href="categoria.php?id=3" class="categoria">
                <div class="icono-emoji">🛒</div>
                <h3>Mercado</h3>
                <span class="subtexto">Carnes y Tiendas</span>
            </a>

            <a href="categoria.php?id=4" class="categoria">
                <div class="icono-emoji">🍻</div>
                <h3>Licores</h3>
                <span class="subtexto">Bares y Discotecas</span>
            </a>

            <a href="categoria.php?id=5" class="categoria">
                <div class="icono-emoji">🧗</div>
                <h3>Aventura</h3>
                <span class="subtexto">Turismo y Viajes</span>
            </a>

            <a href="categoria.php?id=6" class="categoria">
                <div class="icono-emoji">🛏️</div>
                <h3>Hospedaje</h3>
                <span class="subtexto">Hoteles y Moteles</span>
            </a>

            <a href="categoria.php?id=7" class="categoria">
                <div class="icono-emoji">🎁</div>
                <h3>Regalos</h3>
                <span class="subtexto">Artesanías y Manualidades</span>
            </a>

            <a href="categoria.php?id=8" class="categoria">
                <div class="icono-emoji">🎉</div>
                <h3>Eventos</h3>
                <span class="subtexto">Entretenimiento</span>
            </a>

            <a href="categoria.php?id=9" class="categoria">
                <div class="icono-emoji">🏥</div>
                <h3>Salud</h3>
                <span class="subtexto">Clínicas y Droguerías</span>
            </a>

            <a href="categoria.php?id=10" class="categoria">
                <div class="icono-emoji">💄</div>
                <h3>Belleza</h3>
                <span class="subtexto">Spa y Maquillaje</span>
            </a>

            <a href="categoria.php?id=11" class="categoria">
                <div class="icono-emoji">💈</div>
                <h3>Barberías</h3>
                <span class="subtexto">Y Peluquerías</span>
            </a>

            <a href="categoria.php?id=12" class="categoria">
                <div class="icono-emoji">🐾</div>
                <h3>Mascotas</h3>
                <span class="subtexto">Veterinarias</span>
            </a>

            <a href="categoria.php?id=13" class="categoria">
                <div class="icono-emoji">🎓</div>
                <h3>Educación</h3>
                <span class="subtexto">Colegios y Universidades</span>
            </a>

            <a href="categoria.php?id=14" class="categoria">
                <div class="icono-emoji">💼</div>
                <h3>Profesionales</h3>
                <span class="subtexto">Servicios Especializados</span>
            </a>

            <a href="categoria.php?id=15" class="categoria">
                <div class="icono-emoji">🚚</div>
                <h3>Transporte</h3>
                <span class="subtexto">Y Domicilios</span>
            </a>

            <a href="categoria.php?id=16" class="categoria">
                <div class="icono-emoji">📱</div>
                <h3>Tecnología</h3>
                <span class="subtexto">Celulares y PC</span>
            </a>

            <a href="categoria.php?id=17" class="categoria">
                <div class="icono-emoji">👗</div>
                <h3>Moda</h3>
                <span class="subtexto">Ropa y Zapatos</span>
            </a>

            <a href="categoria.php?id=18" class="categoria">
                <div class="icono-emoji">🔨</div>
                <h3>Ferretería</h3>
                <span class="subtexto">Construcción y Técnico</span>
            </a>

            <a href="categoria.php?id=19" class="categoria">
                <div class="icono-emoji">🚜</div>
                <h3>El Campo</h3>
                <span class="subtexto">Agro e Insumos</span>
            </a>

            <a href="categoria.php?id=20" class="categoria">
                <div class="icono-emoji">🏠</div>
                <h3>Inmuebles</h3>
                <span class="subtexto">Venta y Alquiler</span>
            </a>

            <a href="categoria.php?id=21" class="categoria">
                <div class="icono-emoji">🏛️</div>
                <h3>Gobierno</h3>
                <span class="subtexto">Alcaldías y Trámites</span>
            </a>

        </div>

    </main>
    <section style="background-color: #f8f9fa; padding: 60px 20px; margin-top: 40px; border-top: 1px solid #eee;">
        <div class="contenedor" style="max-width: 1200px; margin: 0 auto;">
            <h2 style="text-align: center; margin-bottom: 10px; color: #333; font-weight: 800; font-size: 2rem;">
                <i class="fas fa-star" style="color: #FFC107;"></i> Negocios Destacados
            </h2>
            <p style="text-align: center; color: #777; margin-bottom: 40px; font-size: 1.1rem;">Los favoritos del
                Putumayo. ¡Conócelos!</p>

            <div
                style="display: flex; gap: 20px; overflow-x: auto; scroll-snap-type: x mandatory; padding-bottom: 20px; scrollbar-width: none;">

                <?php
                // Inteligencia Artificial del sistema: Buscar 5 negocios Premium al azar
                $sql_vip = "SELECT * FROM comercios WHERE es_premium = 1 ORDER BY RAND() LIMIT 5";
                $result_vip = $conn->query($sql_vip);

                if ($result_vip && $result_vip->num_rows > 0) {
                    while ($vip = $result_vip->fetch_assoc()) {
                        $foto_vip = !empty($vip['imagen']) ? "img/Negocios/" . $vip['imagen'] : "img/jaguar-solo.png";
                        ?>

                        <div
                            style="min-width: 260px; max-width: 320px; flex: 0 0 auto; background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); color: inherit; scroll-snap-align: start; overflow: hidden; display: flex; flex-direction: column; border: 2px solid #FFC107; transition: transform 0.3s;">

                            <div
                                style="aspect-ratio: 4/3; width: 100%; position: relative; background: #1a1a1a; overflow: hidden;">

                                <span
                                    style="position: absolute; top: 12px; left: 12px; background: #FFC107; color: black; font-weight: bold; padding: 4px 8px; font-size: 0.8rem; border-radius: 4px; z-index: 10;">
                                    <i class="fas fa-crown"></i> VIP
                                </span>

                                <div style="display: flex; overflow-x: auto; scroll-snap-type: x mandatory; height: 100%; width: 100%; position: absolute; top: 0; left: 0; scrollbar-width: none;"
                                    class="carrusel-vip">

                                    <?php if (!empty($vip['imagen'])): ?>
                                        <div style="min-width: 100%; height: 100%; scroll-snap-align: center; flex-shrink: 0;">
                                            <img src="<?php echo $vip['imagen']; ?>" loading="lazy"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($vip['imagen_2'])): ?>
                                        <div style="min-width: 100%; height: 100%; scroll-snap-align: center; flex-shrink: 0;">
                                            <img src="<?php echo $vip['imagen_2']; ?>" loading="lazy"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($vip['imagen_3'])): ?>
                                        <div style="min-width: 100%; height: 100%; scroll-snap-align: center; flex-shrink: 0;">
                                            <img src="<?php echo $vip['imagen_3']; ?>" loading="lazy"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($vip['imagen_4'])): ?>
                                        <div style="min-width: 100%; height: 100%; scroll-snap-align: center; flex-shrink: 0;">
                                            <img src="<?php echo $vip['imagen_4']; ?>" loading="lazy"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <style>
                                .carrusel-vip::-webkit-scrollbar {
                                    display: none;
                                }
                            </style>

                            <div style="padding: 15px; display: flex; flex-direction: column; flex-grow: 1;">
                                <h3
                                    style="margin: 0 0 5px; font-size: 1.1rem; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <?php echo htmlspecialchars($vip['nombre']); ?>
                                </h3>
                                <p style="margin: 0 0 10px; color: #777; font-size: 0.9rem; flex-grow: 1;"><i
                                        class="fas fa-map-marker-alt" style="color: #EA4335;"></i>
                                    <?php echo htmlspecialchars($vip['municipio']); ?></p>

                                <div style="display: flex; gap: 8px; margin-top: auto;">
                                    <a href="https://wa.me/57<?php echo $vip['telefono']; ?>" target="_blank"
                                        style="flex: 1; background-color: #25D366; color: white; text-align: center; padding: 10px; border-radius: 8px; font-weight: bold; font-size: 0.85rem; text-decoration: none; transition: 0.3s;">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>

                                    <?php if (!empty($vip['sitio_web'])): ?>
                                        <a href="<?php echo htmlspecialchars($vip['sitio_web']); ?>" target="_blank"
                                            style="flex: 1; background-color: #2c3e50; color: white; text-align: center; padding: 10px; border-radius: 8px; font-weight: bold; font-size: 0.85rem; text-decoration: none; transition: 0.3s;">
                                            <i class="fas fa-globe"></i> Web
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                        <?php
                    }
                } else {
                    // Si aún no hay VIPs, mostramos un mensaje que invita a ser el primero
                    echo "<div style='width: 100%; text-align: center; padding: 30px; background: white; border-radius: 15px; border: 1px dashed #ccc;'><p style='color: #777; font-size: 1.1rem; margin-bottom: 10px;'>Sé el primero en destacar en la portada de Yakomayo.</p><a href='planes.php' style='color: #FFC107; font-weight: bold; text-decoration: none; font-size: 1.1rem;'>¡Conviértete en VIP aquí!</a></div>";
                }
                ?>
            </div>
        </div>
    </section>

    <section
        style="background: linear-gradient(135deg, #FFC107, #FF9800); padding: 70px 20px; text-align: center; color: black;">
        <h2 style="margin-top: 0; font-size: 2.5rem; font-weight: 900; letter-spacing: -1px;">¿Tienes un negocio en el
            Putumayo?</h2>
        <p
            style="font-size: 1.2rem; margin-bottom: 40px; max-width: 700px; margin-left: auto; margin-right: auto; font-weight: 500;">
            Miles de personas buscan lo que tú vendes. Únete a Yakomayo y empieza a recibir clientes directo a tu
            WhatsApp hoy mismo.</p>

        <a href="registro.php"
            style="background: #1a1a1a; color: white; padding: 18px 45px; border-radius: 40px; font-size: 1.2rem; font-weight: bold; text-decoration: none; display: inline-block; box-shadow: 0 10px 25px rgba(0,0,0,0.3); transition: transform 0.3s;"
            onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <i class="fas fa-rocket"></i> Crear mi Vitrina Gratis
        </a>
    </section>

    <footer
        style="background-color: #1a1a1a; color: #fff; padding: 60px 20px 30px; margin-top: 60px; border-top: 4px solid #FFC107; font-family: 'Poppins', sans-serif;">
        <div
            style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 50px;">

            <div>
                <h3
                    style="color: #FFC107; margin-top: 0; font-size: 1.6rem; display: flex; align-items: center; gap: 12px;">
                    <img src="img/jaguar-solo.png" alt="Yakomayo Logo" style="height: 45px;">
                    Yakomayo.com
                </h3>
                <p style="color: #bbb; font-size: 1rem; line-height: 1.7; margin-top: 20px;">
                    Todo el Putumayo a un clic. Únete a la plataforma digital más inclusiva y potente de la región.
                </p>
            </div>

            <div>
                <h4 style="color: #fff; margin-bottom: 25px; font-size: 1.3rem;">Explora</h4>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 15px;">
                    <li><a href="index.php"
                            style="color: #bbb; text-decoration: none; font-size: 1rem; transition: 0.3s; display: flex; align-items: center; gap: 8px;"
                            onmouseover="this.style.color='#FFC107'; this.style.transform='translateX(5px)';"
                            onmouseout="this.style.color='#bbb'; this.style.transform='translateX(0)';"><i
                                class="fas fa-chevron-right" style="font-size: 0.8rem; color: #555;"></i> Inicio</a>
                    </li>
                    <li><a href="registro.php"
                            style="color: #bbb; text-decoration: none; font-size: 1rem; transition: 0.3s; display: flex; align-items: center; gap: 8px;"
                            onmouseover="this.style.color='#FFC107'; this.style.transform='translateX(5px)';"
                            onmouseout="this.style.color='#bbb'; this.style.transform='translateX(0)';"><i
                                class="fas fa-chevron-right" style="font-size: 0.8rem; color: #555;"></i> Registrar mi
                            Negocio</a></li>
                    <li><a href="planes.php"
                            style="color: #bbb; text-decoration: none; font-size: 1rem; transition: 0.3s; display: flex; align-items: center; gap: 8px;"
                            onmouseover="this.style.color='#FFC107'; this.style.transform='translateX(5px)';"
                            onmouseout="this.style.color='#bbb'; this.style.transform='translateX(0)';"><i
                                class="fas fa-chevron-right" style="font-size: 0.8rem; color: #555;"></i> Planes
                            Publicitarios</a></li>
                    <li><a href="https://wa.me/3208439170" target="_blank"
                            style="color: #bbb; text-decoration: none; font-size: 1rem; transition: 0.3s; display: flex; align-items: center; gap: 8px;"
                            onmouseover="this.style.color='#25D366'; this.style.transform='translateX(5px)';"
                            onmouseout="this.style.color='#bbb'; this.style.transform='translateX(0)';">
                            <i class="fab fa-whatsapp" style="font-size: 1rem; color: #25D366;"></i> WhatsApp:
                            3208439170
                        </a>
                        <?php if (!empty($vip['sitio_web'])): ?>
                            <a href="<?php echo htmlspecialchars($vip['sitio_web']); ?>" target="_blank"
                                style="flex: 1; background-color: #2c3e50; color: white; text-align: center; padding: 10px; border-radius: 8px; font-weight: bold; font-size: 0.85rem; text-decoration: none; display: inline-block; transition: 0.3s;">
                                <i class="fas fa-globe"></i> Web
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>

            <div>
                <h4 style="color: #fff; margin-bottom: 25px; font-size: 1.3rem;">Síguenos</h4>
                <p style="color: #bbb; font-size: 1rem; margin-bottom: 25px;">Únete a la comunidad y no te pierdas nada.
                </p>

                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <a href="https://www.facebook.com/people/Yakomayo/61588034483560/" target="_blank"
                        rel="noopener noreferrer"
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

                    <a href="https://www.tiktok.com/@yakomayo" target="_blank" rel="noopener noreferrer"
                        style="background: #2a2a2a; color: white; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; border-radius: 50%; text-decoration: none; font-size: 1.6rem; border: 2px solid #444; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.2);"
                        onmouseover="this.style.background='#000000'; this.style.borderColor='#ffffff'; this.style.transform='translateY(-5px) scale(1.1)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.4)';"
                        onmouseout="this.style.background='#2a2a2a'; this.style.borderColor='#444'; this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';">
                        <i class="fab fa-tiktok"></i>
                    </a>

                    <a href="https://www.youtube.com/channel/UC5YEX4cs9hc-nedWGesXSMA" target="_blank"
                        rel="noopener noreferrer"
                        style="background: #2a2a2a; color: white; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center; border-radius: 50%; text-decoration: none; font-size: 1.6rem; border: 2px solid #444; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.2);"
                        onmouseover="this.style.background='#FF0000'; this.style.borderColor='#FF0000'; this.style.transform='translateY(-5px) scale(1.1)'; this.style.boxShadow='0 10px 20px rgba(255, 0, 0, 0.4)';"
                        onmouseout="this.style.background='#2a2a2a'; this.style.borderColor='#444'; this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.2)';">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>

        <div
            style="text-align: center; color: #777; font-size: 0.9rem; margin-top: 60px; padding-top: 30px; border-top: 1px solid #333;">
            &copy; <?php echo date("Y"); ?> <strong>Yakomayo.com</strong> - Todos los derechos reservados.<br>
            <span style="font-size: 0.85rem; color: #666; display: block; margin-top: 10px;">Diseñado con <i
                    class="fas fa-heart fa-pulse" style="color:#e74c3c; margin: 0 5px;"></i> en el Putumayo para el
                mundo</span>
        </div>
    </footer>

</body>

</html>