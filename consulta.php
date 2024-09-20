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
function obtenerDatosFinancierosGenerales($conn) {
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
echo nl2br($reporte_financiero);

// Cerrar la conexión
$conn->close();
?>
