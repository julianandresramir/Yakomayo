<?php 
include 'db.php'; 

// 1. Validar ID
if (isset($_GET['id'])) {
    $categoria_id = $_GET['id'];
} else {
    header("Location: index.php");
    exit();
}

// 2. Sacar info de la CATEGORÍA
$sql_cat = "SELECT * FROM categorias WHERE id = $categoria_id";
$res_cat = $conn->query($sql_cat);
$categoria = $res_cat->fetch_assoc();

// 3. Sacar los NEGOCIOS (Aquí es donde buscamos a Casa Maurrose)
$sql_negocios = "SELECT * FROM negocios WHERE categoria_id = $categoria_id";
$res_negocios = $conn->query($sql_negocios);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $categoria['nombre']; ?> - Yakomayo.com</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="pagina-categoria">

    <header class="header-cat">
        <a href="index.php" class="btn-volver">⬅ Volver al inicio</a>
        <div class="titulo-cat">
            <span class="icono-cat"><?php echo $categoria['icono']; ?></span>
            <h1><?php echo $categoria['nombre']; ?></h1>
        </div>
    </header>

    <main class="contenedor lista-negocios">
        <?php if ($res_negocios->num_rows > 0): ?>
            
            <?php while($negocio = $res_negocios->fetch_assoc()): ?>
                
                <article class="tarjeta-negocio">
    <img src="img/negocios/<?php echo $negocio['foto']; ?>" alt="Foto de <?php echo $negocio['nombre']; ?>" class="foto-negocio">
    
    <div class="info-negocio">
        <h2><?php echo $negocio['nombre']; ?></h2>
        <p class="descripcion"><?php echo $negocio['descripcion']; ?></p>
        
        <div class="detalles">
            <p class="direccion">📍 <?php echo $negocio['direccion']; ?></p>
            <p>📞 <?php echo $negocio['telefono']; ?></p>
        </div>

        <a href="https://wa.me/57<?php echo $negocio['telefono']; ?>" class="btn-whatsapp" target="_blank">
            Chat en WhatsApp
        </a>
    </div>
</article>

            <?php endwhile; ?>

        <?php else: ?>
            <p>No hay negocios en esta categoría todavía.</p>
        <?php endif; ?>
    </main>

</body>
</html>