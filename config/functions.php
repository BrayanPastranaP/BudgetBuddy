<?php
// db.php
require 'config.php';

// Función para agregar un ingreso
function agregarIngreso($monto, $fecha, $nota) {
    global $conn;
    $sql = "INSERT INTO ingresos (monto, fecha, nota) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dss", $monto, $fecha, $nota);
    $stmt->execute();
}

// Función para agregar un gasto
// Función para agregar un gasto
function agregarGasto($cantidad_gasto, $fecha_gasto, $tipo_gasto) {
    global $conn;
    $sql = "INSERT INTO gastos (cantidad_gasto, fecha_gasto, tipo_gasto) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dss", $cantidad_gasto, $fecha_gasto, $tipo_gasto);
    $stmt->execute();

    header("Location: index.php");
}

// Función para obtener ingresos
function obtenerIngresos() {
    global $conn;
    $sql = "SELECT * FROM ingresos";
    return $conn->query($sql);
}

// Función para obtener gastos
function obtenerGastos() {
    global $conn;
    $sql = "SELECT * FROM gastos";
    return $conn->query($sql);
}

function evaluarFinanzas() {
    global $conn;

    // Obtener todos los ingresos
    $sql_ingresos = "SELECT SUM(monto) as total_ingreso FROM ingresos";
    $result_ingresos = $conn->query($sql_ingresos);
    $total_ingreso = $result_ingresos->fetch_assoc()['total_ingreso'] ?? 0;

    // Obtener todos los gastos
    $sql_gastos = "SELECT SUM(cantidad_gasto) as total_gasto FROM gastos";
    $result_gastos = $conn->query($sql_gastos);
    $total_gasto = $result_gastos->fetch_assoc()['total_gasto'] ?? 0;

    // Cálculo de porcentaje restante
    $saldo_restante = $total_ingreso - $total_gasto;
    $porcentaje_restante = ($saldo_restante / $total_ingreso) * 100;

    // Recomendaciones basadas en el resultado
    if ($porcentaje_restante > 10) {
        if ($total_ingreso >= 15000) {
            return "Te recomendamos invertir en fondos indexados o bienes raíces.";
        } else {
            return "Te recomendamos invertir en CETES o sofipos para generar rendimientos.";
        }
    } else {
        return "Te recomendamos reducir tus deudas o gastos antes de realizar inversiones.";
    }
}

// Manejar la solicitud para evaluar finanzas
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_type']) && $_POST['form_type'] === 'evaluar') {
    $recomendacion = evaluarFinanzas();
    echo "<h3>Recomendación Financiera:</h3><p>$recomendacion</p>";
}



?>
