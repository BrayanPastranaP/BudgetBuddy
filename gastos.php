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
                <a href="ingresos.php" ><i class="uil uil-plus-circle"></i> Ingresos</a>
              </li>
              <li>
                <a href="gastos.php" class="nav__active"><i class="uil uil-minus-circle"></i> Gastos</a>
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
        <form>
          <h2>¡Registremos tus gastos!</h2>
          <label for="cantidad">Cantidad de gasto:</label>
          <input type="number" id="cantidad" name="cantidad">
      
          <label for="fecha">Fecha de gasto:</label>
          <input type="date" id="fecha" name="fecha">
      
          <label for="nota">Describe tu gasto:</label>
          <textarea id="nota" name="nota" ></textarea>
      
          <button type="submit">Registrar</button>
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
