<?php
session_start();

$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    $stmt = $conn->prepare("SELECT nombre FROM usuarios WHERE email = ? AND contrasena = ?");
    $stmt->bind_param("ss", $email, $contrasena);
    $stmt->execute();
    $stmt->bind_result($nombre);
    $stmt->fetch();

    if ($nombre) {
        $_SESSION["nombre"] = $nombre;
        header("Location: dashboard.php");
    } else {
        echo "Email o contraseña incorrectos.";
    }

    $stmt->close();
}

$conn->close();
?>
