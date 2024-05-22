<?php
session_start();
if (!isset($_SESSION["nombre"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre"]); ?>!</h1>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
