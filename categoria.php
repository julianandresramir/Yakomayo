<?php 
include 'db.php'; 

// 1. ATRAPAR EL ID QUE VIENE DE LA PORTADA
if (isset($_GET['id'])) {
    $categoria_id = $_GET['id'];
} else {
    die("❌ Error: No has seleccionado ninguna categoría.");
}

// 2. CONSULTAR EL NOMBRE DE LA CATEGORÍA (Para ponerlo en el título)
$sql_cat = "SELECT * FROM categorias WHERE id = $categoria_id";
$res_cat = $conn->query($sql_cat);
$categoria = $res_cat->fetch_assoc();

// 3. CONSULTAR LOS NEGOCIOS DE ESA CATEGORÍA
// (Nota: Como aún no tenemos tabla de negocios, esto estará vacío por ahora)
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $categoria['nombre']; ?> - Yakomayo.com</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <header>
        <a href="index.php" style="text-decoration:none; font-size: 20px;">⬅ Volver al inicio</a>
        <h1>
            <span style="font-size: 50px; display:block;"><?php echo $categoria['icono']; ?></span>
            <?php echo $categoria['nombre']; ?>
        </h1>
        <p>Listado de negocios en esta categoría</p>
    </header>

    <main class="contenedor">
        <p style="width: 100%; text-align: center; color: #999;">
            🚧 Aquí se mostrarán los negocios de <strong><?php echo $categoria['nombre']; ?></strong>.
            <br>
            (Todavía no hemos creado la base de datos de negocios).
        </p>
    </main>

</body>
</html>