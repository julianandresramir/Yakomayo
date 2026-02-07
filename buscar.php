<?php include 'db.php'; 

// 1. Capturamos lo que el usuario escribió
$busqueda = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

// 2. Preparamos la consulta "inteligente"
// Busca si el nombre O la descripción contienen la palabra
$sql = "SELECT * FROM negocios 
        WHERE nombre LIKE '%$busqueda%' 
        OR descripcion LIKE '%$busqueda%'";

$res = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados para: <?php echo $busqueda; ?> - Yakomayo</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

    <header class="header-cat">
        <a href="index.php" class="btn-volver">← Volver al inicio</a>
        <div class="titulo-cat">
            <h1>Resultados de búsqueda</h1>
            <p>Mostrando resultados para: <strong>"<?php echo $busqueda; ?>"</strong></p>
        </div>
    </header>

    <main class="contenedor lista-negocios"> <?php if ($res->num_rows > 0): ?>
            
            <?php while($negocio = $res->fetch_assoc()): ?>
                
                <article class="tarjeta-negocio">
                    <img src="img/negocios/<?php echo $negocio['foto']; ?>" alt="<?php echo $negocio['nombre']; ?>" class="foto-negocio">
                    
                    <div class="info-negocio">
                        <h2><?php echo $negocio['nombre']; ?></h2>
                        <p class="descripcion"><?php echo $negocio['descripcion']; ?></p>
                        
                        <div class="detalles">
                            <p>📍 <?php echo $negocio['direccion']; ?></p>
                            <p>📞 <?php echo $negocio['telefono']; ?></p>
                        </div>

                        <a href="https://wa.me/57<?php echo $negocio['telefono']; ?>" class="btn-whatsapp" target="_blank">
                            Chat en WhatsApp
                        </a>
                    </div>
                </article>

            <?php endwhile; ?>

        <?php else: ?>
            
            <div style="text-align: center; width: 100%; grid-column: 1 / -1; padding: 50px;">
                <p style="font-size: 3rem;">🤷‍♂️</p>
                <h3>No encontramos nada con "<?php echo $busqueda; ?>"</h3>
                <p>Intenta buscar con otra palabra o revisa la ortografía.</p>
                <a href="index.php" style="display:inline-block; margin-top:20px; color:#3498db;">Ver todas las categorías</a>
            </div>

        <?php endif; ?>

    </main>

</body>
</html>