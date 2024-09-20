<?php
require 'config/functions.php';

session_start();

if (!isset($_SESSION['usuario'])) {
  header("Location: config/logout.php");
  exit();
}

// Obtener todos los ingresos
$sql_ingresos = "SELECT SUM(monto) as total_ingreso FROM ingresos";
$result_ingresos = $conn->query($sql_ingresos);
$total_ingreso = $result_ingresos->fetch_assoc()['total_ingreso'] ?? 0;

// Obtener todos los gastos
$sql_gastos = "SELECT SUM(cantidad_gasto) as total_gasto FROM gastos";
$result_gastos = $conn->query($sql_gastos);
$total_gasto = $result_gastos->fetch_assoc()['total_gasto'] ?? 0;

// Obtener el primer usuario de la tabla usuarios
$sql_usuario = "SELECT nombre FROM usuarios LIMIT 1";
$resultado_usuario = $conn->query($sql_usuario);
$usuario = $resultado_usuario->fetch_assoc()['nombre'];

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BudgetBuddy Dashboard</title>
  <link rel="stylesheet" href="styles.css" />

  <!--==================== UNICONS ====================-->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css" />
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
              <a href="index.php" class="nav__active"><i class="uil uil-estate"></i> Menú principal</a>
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
              <a href="movimientos.php"><i class="uil uil-file-download-alt"></i> Histórico</a>
            </li>
          </ul>
        </nav>
      </div>

      <div class="sidebar-footer">
        <a href="#"><i class="uil uil-setting"></i> Configuración</a>
        <a href="config/logout.php"><i class="uil uil-sign-out-alt"></i> Cerrar sesión</a>
      </div>

    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <header>
        <h1>¡Bienvenido de nuevo!</h1>
        <h2><?php echo $usuario;?></h2>
      </header>

      <div class="content-flex">
        <!-- Stats Section -->
        <section class="stats">
          <div class="stat-item chart banner_inicial">
            <h3>Recomendaciones</h3>
            <br>

            <p>
              <?php echo evaluarFinanzas(); ?>
            </p>
          </div>
          <div class="stat-item">
            <h3>Ingresos semanales</h3>
            <p class="degradado total_ingreso">$<?php echo $total_ingreso; ?></p>
          </div>
          <div class="stat-item">
            <h3>Gasto semanal</h3>
            <p class="degradado total_gasto">$<?php echo $total_gasto; ?></p>
          </div>
          <div class="stat-item chart">
            <h3>Veamos cómo van tus finanzas</h3>
            <!-- Contenedor para la gráfica -->
            <canvas id="myChart" width="400" height="200"></canvas>
          </div>
        </section>

        <!-- Ads Section -->
        <section class="ads">
          <div class="ad">
            <img src="img/add.png" alt="Anuncio 1" />
          </div>

          <?php $diferencia = $total_ingreso - $total_gasto;?>

          <div class="stat-item comparacion_mensual">
            <h3>Saldo semanal</h3>
            <p>
              Tienes un saldo de <br /><span class="degradado">$<?php echo $diferencia; ?></span><br />
              
            </p>
            <a href="movimientos.php"><button>Generar reporte</button></a>
          </div>
        </section>
      </div>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="app.js"></script>
</body>

</html>