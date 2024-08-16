<?php
// Verificar si se han recibido datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_db";


    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar el nuevo plato
    $sql = "INSERT INTO platos (nombre, descripcion, precio) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $nombre, $descripcion, $precio);

    // Ejecutar la consulta SQL
    if ($stmt->execute() === TRUE) {
        // Devolver una respuesta JSON indicando que el plato fue agregado exitosamente
        echo json_encode(['success' => true]);
    } else {
        // Devolver una respuesta JSON con un mensaje de error si la inserción falló
        echo json_encode(['success' => false, 'error' => 'Error al agregar el plato']);
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    // Si no se recibieron datos por POST, devolver una respuesta JSON con un mensaje de error
    echo json_encode(['success' => false, 'error' => 'No se recibieron datos del formulario']);
}
?>
