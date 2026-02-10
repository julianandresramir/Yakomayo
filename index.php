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

    <header class="main-header">
    <div class="contenedor header-content">
        
        <a href="index.php" class="logo-compuesto">
            <img src="img/jaguar-solo.png" alt="Logo Jaguar Yakomayo" class="logo-img-jaguar">
            <h1 class="logo-texto">Yakomayo.com</h1>
        </a>

        <p class="slogan">Descubre los mejores negocios, servicios y lugares del Putumayo.</p>
        
        <form action="buscar.php" method="GET" class="form-busqueda">
            <input type="text" name="q" placeholder="¿Qué buscas? Ej: Pizza, Ropa..." required>
            <select name="ciudad" class="select-ciudad">
    <option value="">📍 Todo el Putumayo</option>
    <option value="Mocoa"selected>Mocoa</option>
    <option value="Puerto Asís">Puerto Asís</option>
    <option value="Orito">Orito</option>
    <option value="Sibundoy">Sibundoy</option>
    <option value="San Francisco">San Francisco</option>
    <option value="Villagarzón">Villagarzón</option>
    <option value="Puerto Guzmán">Puerto Guzmán</option>
    <option value="Puerto Leguízamo">Puerto Leguízamo</option>
    <option value="Valle del Guamuez">Valle del Guamuez (La Hormiga)</option>
    <option value="San Miguel">San Miguel (La Dorada)</option>
    <option value="Santiago">Santiago</option>
    <option value="Colón">Colón</option>
    <option value="Puerto Caicedo">Puerto Caicedo</option>
</select>
            <button type="submit">Buscar 🔍</button>
        </form>

    </div>
</header>

    <main class="contenedor">
        
        <h2 style="text-align: center; margin-bottom: 30px; color: #555; font-weight: 600;">
            ¿Qué estás buscando hoy?
        </h2>

        <div class="grid-categorias">
            
            <?php
            $sql = "SELECT * FROM categorias";
            $res = $conn->query($sql);

            while ($cat = $res->fetch_assoc()):
            ?>
                <a href="categoria.php?id=<?php echo $cat['id']; ?>" class="card-categoria">
                    <span class="icono"><?php echo $cat['icono']; ?></span>
                    <span class="nombre"><?php echo $cat['nombre']; ?></span>
                </a>
            <?php endwhile; ?>

        </div>

    </main>

    <footer style="text-align: center; padding: 40px 0; color: #888; font-size: 0.9rem;">
        <p>&copy; 2026 Yakomayo.com - Conectando al Putumayo</p>
    </footer>

</body>
</html> 