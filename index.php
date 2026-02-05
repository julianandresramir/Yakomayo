<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yakomayo.com - Directorio del Putumayo</title>
    
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <header>
        <h1>🌴 Yakomayo<span>.com</span></h1>
        <p>Descubre los mejores negocios, servicios y lugares del Putumayo en un solo lugar.</p>
    </header>

    <main class="contenedor">
        <?php
        $sql = "SELECT * FROM categorias";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0):
            while($fila = $resultado->fetch_assoc()):
        ?>
                <a href="categoria.php?id=<?php echo $fila['id']; ?>" class="tarjeta">
                    <span class="icono"><?php echo $fila["icono"]; ?></span>
                    <span class="nombre"><?php echo $fila["nombre"]; ?></span>
                </a>
                <?php 
            endwhile; 
        else: 
        ?>
            <div class="mensaje-vacio">No hay categorías cargadas aún.</div>
        <?php endif; ?>
    </main>

</body>
</html>