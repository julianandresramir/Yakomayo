<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yakomayo.com - El Directorio del Putumayo</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body>

  <header style="position: absolute; top: 0; left: 0; width: 100%; padding: 20px; display: flex; justify-content: flex-end; box-sizing: border-box; z-index: 10;">
        <nav>
            <a href="planes.php" style="background-color: #FFC107; color: black; padding: 10px 20px; border-radius: 25px; text-decoration: none; font-weight: bold; font-size: 0.95rem; box-shadow: 0 4px 10px rgba(0,0,0,0.4); transition: transform 0.3s;">
                <i class="fas fa-crown"></i> Publica tu Negocio
            </a>
        </nav>
    </header>

    <style>
        .hero-banner {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('img/portada-putumayo.webp') center/cover no-repeat;
            height: 65vh; /* Un poco más alto para que quepa todo bien */
            min-height: 450px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 0 20px;
        }
        
        /* NUEVO: Contenedor de la Marca Central */
        .hero-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        /* El Jaguar protagonista */
        .hero-brand img {
            height: 90px; /* Tamaño imponente */
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.5)); /* Sombra para que resalte del fondo */
        }
        
        /* El Título Principal H1 */
        .hero-brand h1 {
            font-size: 4rem;
            margin: 0;
            font-weight: 900;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.9);
            letter-spacing: -1px;
        }

        /* El subtítulo */
        .hero-slogan {
            font-size: 1.3rem;
            margin-bottom: 40px;
            max-width: 700px;
            color: #f0f0f0;
            font-weight: 500;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
        }
        
        /* Buscador (Igual que antes) */
        .search-box { display: flex; width: 100%; max-width: 850px; background: white; border-radius: 50px; overflow: hidden; box-shadow: 0 15px 30px rgba(0,0,0,0.3); }
        .search-box input, .search-box select { padding: 20px; border: none; outline: none; font-size: 1.1rem; color: #333; }
        .search-box input { flex-grow: 1; border-right: 1px solid #ddd; }
        .search-box select { cursor: pointer; background-color: transparent; width: 250px; font-weight: bold; color: #555; }
        .search-box button { background-color: #FFC107; color: black; border: none; padding: 0 40px; font-weight: bold; font-size: 1.1rem; cursor: pointer; transition: 0.3s; }
        .search-box button:hover { background-color: #e0a800; }
        
        /* Adaptación celular */
        @media (max-width: 768px) {
            .hero-brand { flex-direction: column; gap: 5px; }
            .hero-brand img { height: 70px; }
            .hero-brand h1 { font-size: 3rem; }
            .hero-slogan { font-size: 1.1rem; }
            
            .search-box { flex-direction: column; border-radius: 15px; }
            .search-box input, .search-box select { border-right: none; border-bottom: 1px solid #ddd; padding: 15px; text-align: center; width: 100%; box-sizing: border-box;}
            .search-box button { padding: 15px; width: 100%; }
        }
    </style>

    <div class="hero-banner">
        
        <div class="hero-brand">
            <img src="img/jaguar-solo.png" alt="Logo Yakomayo Jaguar">
            <h1>Yakomayo.com</h1>
        </div>
        
        <p class="hero-slogan">Descubre el Putumayo. Encuentra restaurantes, hoteles y servicios de confianza en un solo clic.</p>
        
        <form action="buscar.php" method="GET" class="search-box">
            <input type="text" name="q" placeholder="¿Qué buscas? (Ej. Pizza, Ropa, Hotel)..." required>
            <select name="ciudad">
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
                <option value="Colón">Colón</option>
                <option value="Puerto Caicedo">Puerto Caicedo</option>
            </select>
            <button type="submit"><i class="fas fa-search"></i> Buscar</button>
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

    <footer class="footer-principal">
    <div class="contenedor-footer">
        
        <div class="columna-footer">
            <h3>Yakomayo.com</h3>
            <p>La guía comercial más completa del Putumayo. Conectando negocios locales con clientes reales.</p>
        </div>

        <div class="columna-footer">
            <h4>Explora</h4>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="registro.php">Registrar mi Negocio</a></li>
                <li><a href="planes.php">Planes Publicitarios</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </div>

        <div class="redes-sociales">
    <a href="https:https://www.facebook.com/people/Yakomayo/61588034483560/?rdid=HO9GaGOc4U8qK8o1&share_url=https%253A%252F%252Fwww.facebook.com%252Fshare%252F1C2jNgMh3n%252F" target="_blank" rel="noopener noreferrer">Facebook</a> | 
    
    <a href="https://www.instagram.com/yakomayo?igsh=MWFkdWR4eGF1a2RmaA==" target="_blank" rel="noopener noreferrer">Instagram</a> | 
    
    <a href="#" onclick="alert('¡Estamos preparando nuestros bailes! Síguenos pronto.'); return false;">TikTok</a> | 
    
    <a href="#" onclick="alert('¡Canal en construcción! Pronto videos de historia.'); return false;">YouTube</a>
</div>
        </div>

    </div>
    
    <div class="copyright">
        <p>&copy; 2026 Yakomayo.com - Todos los derechos reservados.</p>
    </div>
</footer>

</body>
</html> 