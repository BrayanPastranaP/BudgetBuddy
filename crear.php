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


      <!-- Main Content -->
      <main class="main-content login_container">
      <form class="login" action="config/register.php" method="POST">
  <h2>Registro de Datos</h2>

  <label for="nombre">Nombre</label>
  <input type="text" id="nombre" name="nombre" required>

  <label for="edad">Edad</label>
  <input type="number" id="edad" name="edad" required>

  <label for="genero">Género</label>
  <input type="text" id="genero" name="genero" required>

  <label for="ocupacion">Ocupación</label>
  <input type="text" id="ocupacion" name="ocupacion" required>

  <label for="localidad">Localidad</label>
  <input type="text" id="localidad" name="localidad" required>

  <label for="ingreso_mensual">Ingreso aproximado por mes</label>
  <input type="number" id="ingreso_mensual" name="ingreso_mensual" required>

  <label for="meta_financiera">Meta financiera</label>
  <input type="text" id="meta_financiera" name="meta_financiera" required>

  <label for="capital_inicial">Arranco mis finanzas con...</label>
  <input type="number" id="capital_inicial" name="capital_inicial" required>

  <label for="usuario">Usuario</label>
  <input type="text" id="usuario" name="usuario" required>

  <label for="password">Contraseña</label>
  <input type="password" id="password" name="password" required>

  <div class="button-container">
    <button type="submit" class="btn__register">Crear Cuenta</button>
  </div>
</form> 
      </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="app.js"></script>
  </body>
</html>