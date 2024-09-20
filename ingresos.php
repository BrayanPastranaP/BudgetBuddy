<?php
require 'config/functions.php';

// Inicializar variables
$monto = $fecha_ingreso = $nota = null;
$gastos_fijos = $gastos_variable = $caprichos = $ahorros = $saldo_restante = $deuda = $fecha_pago = null;

// Manejo del formulario de ingresos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_type']) && $_POST['form_type'] === 'ingreso') {
    if (isset($_POST['monto'], $_POST['fecha_ingreso'], $_POST['nota'])) {
        $monto = $_POST['monto'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $nota = $_POST['nota'];
        agregarIngreso($monto, $fecha_ingreso, $nota);
    }
}

// Manejo del formulario de gastos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_type']) && $_POST['form_type'] === 'gasto') {
    if (isset($_POST['cantidad_gasto'], $_POST['fecha_gasto'], $_POST['tipo_gasto'])) {
        $cantidad_gasto = $_POST['cantidad_gasto'];
        $fecha_gasto = $_POST['fecha_gasto'];
        $tipo_gasto = $_POST['tipo_gasto'];
        agregarGasto($cantidad_gasto, $fecha_gasto, $tipo_gasto);
    }
}

// Obtener datos de ingresos y gastos
$result_ingresos = obtenerIngresos();
$result_gastos = obtenerGastos();
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BudgetBuddy Dashboard</title>
    <link rel="stylesheet" href="styles.css" />

    <!--==================== UNICONS ====================-->
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v3.0.6/css/line.css"
    />
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
                <a href="index.php"
                  ><i class="uil uil-estate"></i> Menú principal</a
                >
              </li>
              <li>
                <a href="ingresos.php" class="nav__active"><i class="uil uil-plus-circle"></i> Ingresos</a>
              </li>
              <li>
                <a href="gastos.php"><i class="uil uil-minus-circle"></i> Gastos</a>
              </li>
              <li>
                <a href="movimientos.php"
                  ><i class="uil uil-minus-circle"></i> Movimientos</a
                >
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
      <main class="main-content ingresos_container">
        <form method="POST">
        <input type="hidden" name="form_type" value="ingreso">

          <h2>¡Registremos tus ingresos!</h2>
          <label for="cantidad">Cantidad de ingreso:</label>
          <input type="number" step="0.01" name="monto" required><br>
      
          <label for="fecha">Fecha de ingreso:</label>
          <input type="date" name="fecha_ingreso" required><br>
      
          <label for="nota">Nota del ingreso:</label>
          <textarea id="nota" name="nota" ></textarea>
      
          <button type="submit">Registrar</button>
        </form>

        <div class="anuncios">
          <img src="img/stori.png" alt="tarjeta">
          <img src="img/klar.png" alt="tarjeta">
        </div>
      </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="app.js"></script>
  </body>
</html>
