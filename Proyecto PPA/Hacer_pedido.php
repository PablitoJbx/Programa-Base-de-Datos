<?php
// Conexión a la base de datos (reemplaza con tus propios datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los platos agregados
$sql = "SELECT * FROM platos_agregados";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Convertir resultados a formato JSON y enviar respuesta
    $platos_agregados = array();
    while($row = $result->fetch_assoc()) {
        $platos_agregados[] = $row;
    }
    echo json_encode($platos_agregados);
} else {
    echo json_encode(array()); // Devolver un array vacío si no hay resultados
}

// Cerrar conexión
$conn->close();
?>
