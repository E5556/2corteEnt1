<?php
include_once 'conexion.php'; // Incluye el archivo de conexión

// Obtiene los datos enviados desde JavaScript
$data = json_decode(file_get_contents('php://input'));

// Inserta los datos en la base de datos
foreach ($data as $item) {
    $nombrePlato = $item->name;
    $precioPlato = $item->price;
    $unidadesPlato = $item->quantity;

    $query = "INSERT INTO pedidos (NombrePlato, PrecioPlato, UnidadesPlato) VALUES ('$nombrePlato', $precioPlato, $unidadesPlato)";

    // Ejecuta la consulta
    $resultado = mysqli_query($conectar, $query);
}

if ($resultado) {
    echo json_encode(['mensaje' => 'Pedido guardado exitosamente']);
} else {
    echo json_encode(['error' => 'Error al guardar el pedido']);
}

mysqli_close($conectar);
?>
