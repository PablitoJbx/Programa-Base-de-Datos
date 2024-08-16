<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ingredient_name = $_POST['ingredient_name'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];
    $added_by = $_POST['added_by'];

    $sql = "INSERT INTO inventory (ingredient_name, quantity, unit, added_by) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siss", $ingredient_name, $quantity, $unit, $added_by);

    if ($stmt->execute()) {
        echo "Ingrediente agregado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
