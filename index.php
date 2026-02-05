<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yakomayo.com - Directorio del Putumayo</title>
    <style>
        /* Estilos básicos para que se vea bonito */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        h1 { color: #2c3e50; }
        p { color: #7f8c8d; }

        /* La parrilla de tarjetas */
        .contenedor {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-width: 1200px;
            margin: 30px auto;
        }

        /* Cada tarjeta individual */
        .tarjeta {
            background: white;
            padding: 20px;
            width: 150px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            cursor: pointer;
        }

        .tarjeta:hover {
            transform: translateY(-5px); /* Efecto de levitar al pasar el mouse */
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
        }

        .icono { font-size: 40px; display: block; margin-bottom: 10px; }
        .nombre { font-weight: bold; color: #333; font-size: 16px; }
    </style>
</head>
<body>

    <h1>🌴 Yakomayo<span style="color: #bbb; font-size: 0.6em;">.com</span></h1>
    <p>El directorio comercial más completo del Putumayo</p>

    <div class="contenedor">
        <?php
        // Consultar las categorías
        $sql = "SELECT * FROM categorias";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            // Recorrer cada categoría y crear su tarjeta
            while($fila = $resultado->fetch_assoc()) {
                echo '<div class="tarjeta">';
                echo '<span class="icono">' . $fila["icono"] . '</span>';
                echo '<div class="nombre">' . $fila["nombre"] . '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No hay categorías cargadas todavía.</p>";
        }
        ?>
    </div>

</body>
</html>