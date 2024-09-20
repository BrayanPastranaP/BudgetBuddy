<?php
// login.php
session_start();
require 'config.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Buscar el usuario en la base de datos
    $sql = "SELECT id, usuario, password FROM usuarios WHERE usuario = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Verificar la contraseña
            $stmt->bind_result($id, $usuario_db, $hashed_password);
            $stmt->fetch();
            
            if (password_verify($password, $hashed_password)) {
                // Contraseña correcta, iniciar sesión
                $_SESSION['usuario'] = $usuario_db;
                $_SESSION['id'] = $id;

                header("Location: ../index.php"); // Redirigir al dashboard
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "No se encontró el usuario.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
