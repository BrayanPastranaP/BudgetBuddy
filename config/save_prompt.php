<?php
require 'config.php';

$data = json_decode(file_get_contents("php://input"), true);
$prompt = $data['prompt'];
$response = $data['response'];

// Preparar e insertar los datos en la tabla (ajusta el nombre de la tabla y los campos según tu estructura)
$sql = "INSERT INTO prompts (prompt_text, generated_response) VALUES (?, ?)";

// Usar prepared statements para evitar inyecciones SQL
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $prompt, $response);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Datos guardados correctamente"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al guardar los datos"]);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>