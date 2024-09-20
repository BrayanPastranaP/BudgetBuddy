<?php
require 'config/functions.php';


// Obtener todos los ingresos
$sql_ingresos = "SELECT monto, fecha, nota FROM ingresos";
$result_ingresos = $conn->query($sql_ingresos);

// Obtener todos los gastos
$sql_gastos = "SELECT cantidad_gasto, fecha_gasto, tipo_gasto FROM gastos";
$result_gastos = $conn->query($sql_gastos);
?>


<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finanzas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para obtener los datos financieros generales
function obtenerDatosFinancierosGenerales($conn)
{
    // Obtener el primer usuario de la tabla usuarios
    $sql_usuario = "SELECT nombre FROM usuarios LIMIT 1";
    $resultado_usuario = $conn->query($sql_usuario);
    $usuario = $resultado_usuario->fetch_assoc()['nombre'];

    // Obtener el total de todos los ingresos
    $sql_ingresos = "SELECT SUM(monto) AS total_ingresos FROM ingresos";
    $resultado_ingresos = $conn->query($sql_ingresos);
    $total_ingresos = $resultado_ingresos->fetch_assoc()['total_ingresos'];

    // Obtener el total de todos los gastos
    $sql_gastos = "SELECT SUM(cantidad_gasto) AS total_gastos FROM gastos";
    $resultado_gastos = $conn->query($sql_gastos);
    $total_gastos = $resultado_gastos->fetch_assoc()['total_gastos'];

    // Obtener los datos financieros adicionales de la tabla finanzas
    $sql_finanzas = "SELECT SUM(gastos_fijos) AS total_gastos_fijos, 
                            SUM(gastos_variable) AS total_gastos_variables, 
                            SUM(caprichos) AS total_caprichos, 
                            SUM(ahorros) AS total_ahorros, 
                            SUM(saldo_restante) AS total_saldo_restante, 
                            SUM(deuda) AS total_deuda 
                     FROM finanzas";
    $resultado_finanzas = $conn->query($sql_finanzas);
    $finanzas = $resultado_finanzas->fetch_assoc();

    // Calcular el saldo final
    $saldo_final = $total_ingresos - $total_gastos;

    // Consulta para obtener el total de gastos por categoría
    $sql_gastos_por_categoria = "SELECT tipo_gasto, SUM(cantidad_gasto) AS total_por_categoria FROM gastos GROUP BY tipo_gasto";
    $resultado_gastos_por_categoria = $conn->query($sql_gastos_por_categoria);

    // Generar el reporte financiero
    $prompt = "Reporte Financiero de " . $usuario . ":\n";
    $prompt .= "Total Ingresos: $" . number_format($total_ingresos, 2) . "\n";
    $prompt .= "Total Gastos: $" . number_format($total_gastos, 2) . "\n";
    $prompt .= "Gastos Fijos: $" . number_format($finanzas['total_gastos_fijos'], 2) . "\n";
    $prompt .= "Gastos Variables: $" . number_format($finanzas['total_gastos_variables'], 2) . "\n";
    $prompt .= "Caprichos: $" . number_format($finanzas['total_caprichos'], 2) . "\n";
    $prompt .= "Ahorros: $" . number_format($finanzas['total_ahorros'], 2) . "\n";
    $prompt .= "Saldo Restante: $" . number_format($saldo_final, 2) . "\n";
    $prompt .= "Deuda Pendiente: $" . number_format($finanzas['total_deuda'], 2) . "\n\n";

    // Añadir el desglose de gastos por categoría
    $prompt .= "Desglose de gastos por categoría:\n";
    while ($fila = $resultado_gastos_por_categoria->fetch_assoc()) {
        $prompt .= $fila['tipo_gasto'] . ": $" . number_format($fila['total_por_categoria'], 2) . "\n";
    }

    return $prompt;
}

// Obtener y mostrar el reporte financiero general
$reporte_financiero = obtenerDatosFinancierosGenerales($conn);


// Cerrar la conexión
$conn->close();
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
        <!-- Botón del menú hamburguesa -->
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
                        <li class="nav__active">
                            <a href="movimientos.php"><i class="uil uil-minus-circle"></i>Movimientos</a>
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
            <h1>Movimientos</h1>
            <div class="container">
                <div class="content-flex">
                    <div class="movimientos__content">
                        <!-- Tabla de Ingresos -->
                        <section>

                            <h2>Ingresos</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Monto</th>
                                        <th>Fecha</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Recorrer y mostrar los ingresos
                                    if ($result_ingresos->num_rows > 0) {
                                        while ($row = $result_ingresos->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>$" . $row['monto'] . "</td>";
                                            echo "<td>" . $row['fecha'] . "</td>";
                                            echo "<td>" . $row['nota'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No hay ingresos registrados</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </section>

                        <!-- Tabla de Gastos -->
                        <section>
                            <h2>Gastos</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Cantidad</th>
                                        <th>Tipo de Gasto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Recorrer y mostrar los gastos
                                    if ($result_gastos->num_rows > 0) {
                                        while ($row = $result_gastos->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['fecha_gasto'] . "</td>";
                                            echo "<td>$" . $row['cantidad_gasto'] . "</td>";
                                            echo "<td>" . $row['tipo_gasto'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No hay gastos registrados</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </section>
                    </div>

                    <div class="movimientos_content">
                        <section>
                            <h3>Estado de cuenta</h3>
                            <p class="estado_cuenta"><?php
                                                        echo nl2br($reporte_financiero);
                                                        ?></p>
                            <button id="generateButton">Generar Recomendacion</button>
                        </section>

                        <section>
                            <p id="responseText"></p>
                        </section>
                    </div>

                </div>

                <script>
                    const estado_cuenta = document.querySelector(".estado_cuenta").textContent;
                    const promtp_inicial = "A parir de estos datos, dame una recomendacion financiera que me ayude a mejorar mis finanzas personales, estoy interesado en pagar mis deudas, en hacer un ahorro para mi retiro y probablemente una inversion. \n";
                    const promtp_final = promtp_inicial + estado_cuenta + "\nResume mas la informacion para alguien de 18 a 25 años. no pases de mas de 200 tokens."

                    console.log(promtp_final);
                </script>

                <script type="importmap">
                    {
        "imports": {
          "@google/generative-ai": "https://esm.run/@google/generative-ai"
        }
      }
    </script>
                <script type="module">
                    import {
                        GoogleGenerativeAI
                    } from "@google/generative-ai";

                    const API_KEY = "AIzaSyATZ2E9oH5J99GfJB0d4LrE4S0mZ-NozFQ";
                    const genAI = new GoogleGenerativeAI(API_KEY);

                    document
                        .getElementById("generateButton")
                        .addEventListener("click", async () => {
                            const inputText = promtp_final;
                            const model = genAI.getGenerativeModel({
                                model: "gemini-1.5-pro-latest",
                            });
                            const prompt = inputText;

                            try {
                                const result = await model.generateContent(prompt);
                                const response = await result.response;
                                const generatedText = await response.text();



                                // Mostrar el resultado en el frontend
                                function eliminarAsteriscos(cadena) {
                                    // Expresión regular para encontrar todos los asteriscos
                                    const regex = /\*/g;

                                    // Reemplazar todos los asteriscos por una cadena vacía
                                    const cadenaSinAsteriscos = cadena.replace(regex, '');

                                    return cadenaSinAsteriscos;
                                }

                                // Ejemplo de uso:
                                const miCadena = "Hola*mundo*cómo*estás";
                                const resultado = eliminarAsteriscos(miCadena);
                                console.log(resultado); // Imprimirá: Hola mundo cómo estás






                                document.getElementById("responseText").innerText = eliminarAsteriscos(generatedText);

                                // Enviar el resultado generado a un archivo PHP para guardarlo en la base de datos
                                await fetch('config/save_prompt.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        prompt: inputText,
                                        response: generatedText
                                    }),
                                });
                            } catch (error) {
                                console.error("Error al generar contenido:", error);
                            }
                        });
                </script>
        </main>
    </div>
</body>

</html>