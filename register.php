<?php
$servername = "localhost";
$username = "root";
$password = "tu_contraseña"; // tu contraseña de MySQL
$dbname = "mi_base_de_datos"; // el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contraseña = $_POST['password'];

$sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $email, $contraseña);

if ($stmt->execute()) {
    echo "Usuario registrado exitosamente.";
} else {
    echo "Error al registrar el usuario: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
