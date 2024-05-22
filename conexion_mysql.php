<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "prueba2";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear tabla
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla 'usuarios' creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error;
}

// Insertar registros
$sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES 
    ('Juan Perez', 'juan@example.com', 'pass123'),
    ('Maria Lopez', 'maria@example.com', 'pass456'),
    ('Carlos Gomez', 'carlos@example.com', 'pass789')";

if ($conn->query($sql) === TRUE) {
    echo "Registros insertados exitosamente\n";
} else {
    echo "Error al insertar registros: " . $conn->error;
}

// Función para obtener el nombre por email
function getUserNameByEmail($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT nombre FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($nombre);
    $stmt->fetch();
    $stmt->close();
    return $nombre;
}

// Función para actualizar la contraseña por nombre
function updatePasswordByName($name, $newPassword) {
    global $conn;
    $stmt = $conn->prepare("UPDATE usuarios SET contrasena = ? WHERE nombre = ?");
    $stmt->bind_param("ss", $newPassword, $name);
    $stmt->execute();
    $stmt->close();
}

// Ejemplos de uso
echo "Nombre del usuario con email 'juan@example.com': " . getUserNameByEmail('juan@example.com') . "\n";
updatePasswordByName('Juan Perez', 'newpass123');
echo "Contraseña actualizada para 'Juan Perez'\n";

$conn->close();
?>
