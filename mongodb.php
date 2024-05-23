<?php
require 'vendor/autoload.php'; 

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->prueba2->productos;

// Crear la colección productos y añadir documentos
$collection->insertMany([
    ['nombre' => 'Producto 1', 'precio' => 100, 'cantidad' => 10],
    ['nombre' => 'Producto 2', 'precio' => 200, 'cantidad' => 20],
    ['nombre' => 'Producto 3', 'precio' => 300, 'cantidad' => 30],
]);

// Función para obtener el precio por nombre de producto
function obtenerPrecioPorNombre($collection, $nombre) {
    $producto = $collection->findOne(['nombre' => $nombre]);
    if ($producto) {
        return $producto['precio'];
    } else {
        return "No se encontró el producto con el nombre proporcionado.";
    }
}
?>
