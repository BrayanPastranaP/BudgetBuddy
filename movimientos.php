<?php
require 'config/functions.php';


// Obtener todos los ingresos
$sql_ingresos = "SELECT monto, fecha, nota FROM ingresos";
$result_ingresos = $conn->query($sql_ingresos);

// Obtener todos los gastos
$sql_gastos = "SELECT cantidad_gasto, fecha_gasto, tipo_gasto FROM gastos";
$result_gastos = $conn->query($sql_gastos);
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

        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="app.js"></script>
</body>

</html>