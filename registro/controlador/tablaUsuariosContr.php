<?php
include_once 'Database.php';
include_once 'Item.php';

// Obtener la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Inicializar el objeto
$item = new Item($db);

// Leer los registros
$stmt = $item->read();
$num = $stmt->rowCount();

if($num > 0) {
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nombre</th>";
    echo "<th>Descripción</th>";
    echo "<th>Precio</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$nombre}</td>";
        echo "<td>{$descripcion}</td>";
        echo "<td>{$precio}</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron registros.";
}
?>
