<?php
// 1. Conexión a tu base de datos
$conn = new mysqli("localhost", "root", "", "yakomayo_db");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$mensaje = "";

// --- LÓGICA DE ACCIONES DEL CEO ---

// A. Si el CEO hace clic en "Eliminar"
if (isset($_GET['eliminar'])) {
    $id_eliminar = $_GET['eliminar'];
    $sql_delete = "DELETE FROM comercios WHERE id = $id_eliminar";
    if ($conn->query($sql_delete) === TRUE) {
        $mensaje = "<div class='alerta exito'><i class='fas fa-check-circle'></i> Negocio eliminado correctamente del directorio.</div>";
    } else {
        $mensaje = "<div class='alerta error'><i class='fas fa-exclamation-triangle'></i> Error al eliminar: " . $conn->error . "</div>";
    }
}

// B. Si el CEO hace clic en "Hacer Premium" o "Quitar Premium"
if (isset($_GET['toggle_premium']) && isset($_GET['estado_actual'])) {
    $id_premium = $_GET['toggle_premium'];
    // Cambiador mágico: si es 1 pasa a 0, si es 0 pasa a 1
    $nuevo_estado = $_GET['estado_actual'] == 1 ? 0 : 1; 
    
    $sql_premium = "UPDATE negocios SET es_premium = $nuevo_estado WHERE id = $id_premium";
    if ($conn->query($sql_premium) === TRUE) {
        $mensaje = "<div class='alerta exito'><i class='fas fa-star'></i> Estado Premium actualizado con éxito.</div>";
    } else {
        $mensaje = "<div class='alerta error'><i class='fas fa-exclamation-triangle'></i> Error al actualizar: " . $conn->error . "</div>";
    }
}

// 2. Traer todos los negocios para mostrarlos en la tabla (Los más nuevos primero)
$sql = "SELECT * FROM comercios ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Yakomayo CEO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; background-color: #f4f6f9; color: #333; }
        
        /* Barra Lateral (Sidebar) */
        .sidebar { width: 250px; background-color: #2c3e50; color: white; position: fixed; height: 100vh; padding: 20px; box-sizing: border-box; box-shadow: 2px 0 5px rgba(0,0,0,0.1); }
        .sidebar h2 { color: #FFC107; text-align: center; border-bottom: 1px solid #455667; padding-bottom: 15px; margin-top: 0; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 12px; margin-bottom: 10px; border-radius: 5px; transition: 0.3s; font-size: 1.05rem; }
        .sidebar a:hover { background-color: #34495e; color: #FFC107; padding-left: 15px; }
        
        /* Contenido Principal */
        .main-content { margin-left: 250px; padding: 30px; }
        .header-dashboard { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #ddd; padding-bottom: 15px; }
        
        /* Tabla de Control */
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #f8f9fa; font-weight: bold; color: #555; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; }
        tr:hover { background-color: #fcfcfc; }
        
        /* Botones de Acción */
        .btn { padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer; color: white; font-weight: bold; text-decoration: none; font-size: 0.85rem; display: inline-block; transition: 0.2s; }
        .btn-danger { background-color: #e74c3c; }
        .btn-danger:hover { background-color: #c0392b; transform: scale(1.05); }
        .btn-premium { background-color: #f1c40f; color: black; }
        .btn-premium:hover { background-color: #d4ac0d; transform: scale(1.05); }
        .btn-normal { background-color: #95a5a6; }
        .btn-normal:hover { background-color: #7f8c8d; transform: scale(1.05); }
        
        /* Etiquetas */
        .badge-premium { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: bold; }
        .alerta { padding: 15px; margin-bottom: 20px; border-radius: 5px; font-weight: bold; }
        .exito { background-color: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .error { background-color: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2> Yakomayo</h2>
        <a href="index.php" target="_blank"><i class="fas fa-external-link-alt"></i> Ver Sitio Web</a>
        <a href="admin.php" style="background-color: #FFC107; color: black; font-weight: bold;"><i class="fas fa-store"></i> Gestión de Negocios</a>
        <a href="#"><i class="fas fa-chart-bar"></i> Estadísticas <small>(Pronto)</small></a>
        <a href="#"><i class="fas fa-cog"></i> Configuraciones</a>
    </div>

    <div class="main-content">
        <div class="header-dashboard">
            <div>
                <h1 style="margin: 0; color: #2c3e50;">Panel de Control de Negocios</h1>
                <p style="margin: 5px 0 0 0; color: #7f8c8d;">Administra los registros y la monetización de la plataforma.</p>
            </div>
            <div style="background-color: #2c3e50; color: white; padding: 10px 20px; border-radius: 20px; font-weight: bold;">
                <i class="fas fa-user-tie"></i> CEO Admin
            </div>
        </div>

        <?php echo $mensaje; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Negocio</th>
                    <th>Municipio</th>
                    <th>WhatsApp</th>
                    <th>Plan Actual</th>
                    <th>Acciones Rápidas</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td style="color: #888;">#<?php echo $row['id']; ?></td>
                            <td><strong><?php echo $row['nombre']; ?></strong></td>
                            <td><?php echo $row['municipio']; ?></td>
                            <td><a href="https://wa.me/57<?php echo $row['telefono']; ?>" target="_blank" style="color: #25D366; text-decoration: none; font-weight: bold;"><i class="fab fa-whatsapp"></i> <?php echo $row['telefono']; ?></a></td>
                            
                            <td>
                                <?php if($row['es_premium'] == 1): ?>
                                    <span class="badge-premium"><i class="fas fa-crown"></i> Premium</span>
                                <?php else: ?>
                                    <span style="color: #95a5a6; font-size: 0.85rem;"><i class="fas fa-user"></i> Básico</span>
                                <?php endif; ?>
                            </td>

                            <td style="display: flex; gap: 8px;">
                                
                                <a href="admin.php?toggle_premium=<?php echo $row['id']; ?>&estado_actual=<?php echo $row['es_premium']; ?>" 
                                   class="btn <?php echo $row['es_premium'] == 1 ? 'btn-normal' : 'btn-premium'; ?>"
                                   title="Cambiar estado del plan">
                                   <?php echo $row['es_premium'] == 1 ? '<i class="fas fa-arrow-down"></i> Bajar a Básico' : '<i class="fas fa-star"></i> Subir a Premium'; ?>
                                </a>

                                <a href="admin.php?eliminar=<?php echo $row['id']; ?>" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('⚠️ ALERTA: ¿Estás seguro de que deseas eliminar permanentemente a <?php echo $row['nombre']; ?> de la base de datos? Esto no se puede deshacer.');">
                                    <i class="fas fa-trash-alt"></i> Borrar
                                </a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #7f8c8d;">
                            <i class="fas fa-folder-open" style="font-size: 2rem; margin-bottom: 10px;"></i><br>
                            Aún no hay negocios registrados en la plataforma.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>