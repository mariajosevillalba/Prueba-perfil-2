<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; // tu contraseña de MySQL
$dbname = "prueba2"; // el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$email = $_POST['email'];
$contraseña = $_POST['password'];

$sql = "SELECT nombre FROM usuarios WHERE email = ? AND contraseña = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $contraseña);
$stmt->execute();
$stmt->bind_result($nombre);

if ($stmt->fetch()) {
    $_SESSION['nombre'] = $nombre;
    header("Location: dashboard.php");
} else {
    echo "Email o contraseña incorrectos.";
}

$stmt->close();
$conn->close();
?>

