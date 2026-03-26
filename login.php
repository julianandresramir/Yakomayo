<?php
session_start();

// Si el CEO ya está logueado, lo mandamos directo al panel
if (isset($_SESSION['admin_logueado']) && $_SESSION['admin_logueado'] === true) {
    header("Location: admin.php");
    exit();
}

$error = "";
// 🔐 AQUÍ PONES TU CONTRASEÑA MAESTRA DE CEO
$password_maestra = "J2@15r1984*"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password_ingresada = $_POST['password'];
    
    if ($password_ingresada === $password_maestra) {
        // ¡Contraseña correcta! Le damos la llave VIP
        $_SESSION['admin_logueado'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "<div class='alerta-error'><i class='fas fa-shield-alt'></i> Acceso denegado. Contraseña incorrecta.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Restringido - Yakomayo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #2c3e50; height: 100vh; display: flex; justify-content: center; align-items: center; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); width: 100%; max-width: 350px; text-align: center; }
        .login-box h2 { color: #2c3e50; margin-bottom: 5px; }
        .login-box p { color: #7f8c8d; font-size: 0.9rem; margin-bottom: 25px; }
        .input-group { margin-bottom: 20px; text-align: left; }
        .input-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; font-size: 0.9rem; }
        .input-group input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem; box-sizing: border-box; }
        .btn-login { background-color: #FFC107; color: black; border: none; padding: 12px; width: 100%; font-size: 1.1rem; font-weight: bold; border-radius: 5px; cursor: pointer; transition: 0.3s; }
        .btn-login:hover { background-color: #e0a800; transform: translateY(-2px); }
        .alerta-error { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px; font-size: 0.9rem; font-weight: bold; }
    </style>
</head>
<body>

    <div class="login-box">
        <i class="fas fa-lock" style="font-size: 3rem; color: #FFC107; margin-bottom: 10px;"></i>
        <h2>JAR Lab Admin</h2>
        <p>Centro de mando exclusivo para el CEO</p>
        
        <?php echo $error; ?>

        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="password">Contraseña Maestra:</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn-login">Ingresar al Sistema</button>
        </form>
    </div>

</body>
</html>