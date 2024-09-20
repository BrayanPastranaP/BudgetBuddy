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
              <a href="index.php"><i class="uil uil-estate"></i> Menú principal</a>
            </li>
            <li>
              <a href="ingresos.php"><i class="uil uil-plus-circle"></i> Ingresos</a>
            </li>
            <li>
              <a href="gastos.php" class="nav__active"><i class="uil uil-minus-circle"></i> Gastos</a>
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
        <input type="hidden" name="form_type" value="gasto">

        <h2>¡Registremos tus gastos!</h2>
        <label for="cantidad">Cantidad de gasto:</label>
        <input type="number" step="0.01" name="cantidad_gasto" required><br>

        <label for="fecha">Fecha de gasto:</label>
        <input type="date" name="fecha_gasto" required><br>

        <label for="tipo_gasto">Tipo de Gasto:</label>
        <select name="tipo_gasto" required>
          <option value="Gastos Fijos">Gastos Fijos</option>
          <option value="Gastos Variables">Gastos Variables</option>
          <option value="Caprichos">Caprichos</option>
          <option value="Ahorros">Ahorros</option>
          <option value="Saldo Restante">Saldo Restante</option>
          <option value="Deuda">Deuda</option>
        </select><br>



        <input type="submit" class="button_action" value="Agregar Gasto">
      </form>

      <div class="anuncios">
        <img src="img/klar.png" alt="tarjeta">
        <img src="img/stori.png" alt="tarjeta">
      </div>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="app.js"></script>
</body>

</html>