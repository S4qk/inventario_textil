<?php
// Parámetros de conexión
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'inventario_textil';

// Crear conexión
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si quieres, puedes agregar esta línea para usar UTF-8
$conn->set_charset("utf8");
?>
