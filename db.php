<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yakomayo_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hubo error (solo avisa si falla)
if ($conn->connect_error) {
    die("Falló la conexión: " . $conn->connect_error);
}
?>