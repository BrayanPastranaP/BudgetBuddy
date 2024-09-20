<?php
require 'config/functions.php';

// Conexión a la base de datos (ajusta los parámetros de conexión según sea necesario)
$host = 'localhost';  // Servidor
$usuario = 'root';    // Usuario
$password = '';       // Contraseña
$nombre_db = 'finanzas';  // Nombre de la base de datos

// Crear conexión
$conexion = new mysqli($host, $usuario, $password, $nombre_db);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener los datos de la tabla 'prompts'
$sql = "SELECT id, prompt_text, generated_response FROM prompts";
$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BudgetBuddy Dashboard</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="style.css" />

    <!--==================== UNICONS ====================-->
    <link
        rel="stylesheet"
        href="https://unicons.iconscout.com/release/v3.0.6/css/line.css" />
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="hamburger-menu">
            <i class="uil uil-bars"></i>
        </div>

        <aside class="sidebar">
            <div class="container__nav">
                <div class="logo">
                    <img src="img/logo.png" alt="Logotipo" />
                    <h2>BudgetBuddy</h2>
                </div>

                <nav>
                    <ul>
                        <li>
                            <a href="index.php" class=""><i class="uil uil-estate"></i> Menú principal</a>
                        </li>
                        <li>
                            <a href="ingresos.php"><i class="uil uil-plus-circle"></i> Ingresos</a>
                        </li>
                        <li>
                            <a href="gastos.php"><i class="uil uil-minus-circle"></i> Gastos</a>
                        </li>
                        <li>
              <a href="movimientos.php"><i class="uil uil-expand-from-corner"></i> Movimientos</a>
            </li>
            <li>
              <a href="historial.php"><i class="uil uil-file-download-alt"></i> Histórico</a>
            </li>
                    </ul>
                </nav>
            </div>

            <div class="sidebar-footer">
                <a href="#"><i class="uil uil-setting"></i> Configuración</a>
                <a href="login.php"><i class="uil uil-sign-out-alt"></i> Cerrar sesión</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content movimientos">
            <h1>Histórico</h1>
            <div class="container">
                <div class="content-flex">
                    <div class="movimientos__content">
                        <!-- Tabla de Ingresos -->
                        <section>
                            <h2>Historial de registros</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Recomendación</th>
                                        <!-- <th>generated_response</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Comprobar si hay resultados
                                    if ($resultado->num_rows > 0) {
                                        // Recorrer y mostrar los resultados en la tabla
                                        while($fila = $resultado->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $fila["id"] . "</td>";
                                            //echo "<td>" . $fila["prompt_text"] . "</td>";
                                            echo "<td>" . $fila["generated_response"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No hay registros</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
