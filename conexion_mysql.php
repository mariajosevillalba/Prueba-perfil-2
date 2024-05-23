<?php
// Datos de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // tu contraseña de MySQL
$dbname = "prueba2"; // el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear la tabla usuarios
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    contraseña VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla usuarios creada exitosamente.<br>";
} else {
    echo "Error al crear la tabla: " . $conn->error . "<br>";
}

// Insertar registros
$sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES
('Maria', 'maria@example.com', 'password'),
('Sara', 'sara@example.com', 'pass123'),
('Samuel', 'samuel@example.com', 'word789')";

if ($conn->query($sql) === TRUE) {
    echo "Registros insertados exitosamente.<br>";
} else {
    echo "Error al insertar registros: " . $conn->error . "<br>";
}



function obtenerNombrePorEmail($conn, $email) {
    $sql = "SELECT nombre FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $nombre_usuario = '';
    $stmt->bind_result($nombre_usuario);
    if ($stmt->fetch()) {
        return $nombre_usuario;
    } else {
        return "No se encontró el usuario con el email proporcionado.";
    }
    $stmt->close();
}

function actualizarContraseñaPorNombre($conn, $nombre, $nueva_contraseña) {
    $sql = "UPDATE usuarios SET contraseña = ? WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("ss", $nueva_contraseña, $nombre);
    if ($stmt->execute()) {
        return "Contraseña actualizada exitosamente.";
    } else {
        return "Error al actualizar la contraseña: " . $stmt->error;
    }
    $stmt->close();
}

?>

