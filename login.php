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
        <form class="login" action="config/login.php" method="POST">
          <h2>Iniciar Sesion</h2>
          <label for="usuario">Usuario</label>
          <input type="text" id="usuario" name="usuario">

          <label for="password">Password</label>
          <input type="password" id="password" name="password">
      
          <div class="button-container">
  <button type="submit" class="btn__login">Iniciar</button>
  <a href="crear.php" class="btn__register">Crear Cuenta</a>
</div>
        </form> 
      </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="app.js"></script>
  </body>
</html>
