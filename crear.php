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
        <form class="login">
          <h2>Registro de Datos</h2>
          <label for="cantidad">Nombre</label>
          <input type="text" id="cantidad" name="cantidad">

          <label for="cantidad">Edad</label>
          <input type="number" id="cantidad" name="cantidad">

          <label for="cantidad">Género</label>
          <input type="text" id="cantidad" name="cantidad">

          <label for="cantidad">Ocupación</label>
          <input type="text" id="cantidad" name="cantidad">

          <label for="cantidad">Localidad</label>
          <input type="text" id="cantidad" name="cantidad">

          <label for="cantidad">Ingreso aproximado por mes</label>
          <input type="number" id="cantidad" name="cantidad">

          <label for="cantidad">Meta financiera</label>
          <input type="text" id="cantidad" name="cantidad">

          <label for="cantidad">Arranco mis finanzas con...</label>
          <input type="number" id="cantidad" name="cantidad">

          
      
          <div class="button-container">
            <a href="index.php" class="btn__register" href="#">Crear Cuenta</a>
          </div>
        </form> 
      </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="app.js"></script>
  </body>
</html>
