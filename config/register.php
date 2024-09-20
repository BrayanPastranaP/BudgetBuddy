<?php
// register.php
require 'config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $genero = $_POST['genero'];
    $ocupacion = $_POST['ocupacion'];
    $localidad = $_POST['localidad'];
    $ingreso_mensual = $_POST['ingreso_mensual'];
    $meta_financiera = $_POST['meta_financiera'];
    $capital_inicial = $_POST['capital_inicial'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar datos del usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, edad, genero, ocupacion, localidad, ingreso_mensual, meta_financiera, capital_inicial, usuario, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sisssdssss", $nombre, $edad, $genero, $ocupacion, $localidad, $ingreso_mensual, $meta_financiera, $capital_inicial, $usuario, $hashed_password);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: ../login.php");
            // echo "Registro exitoso. Ahora puedes iniciar sesión.";
        } else {
            echo "Error al registrar usuario. Por favor, inténtalo nuevamente.";

        }
        $stmt->close();
    }
    $conn->close();
}
?>