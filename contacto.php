<!DOCTYPE html>
<?php include("conexion.php"); ?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>DevDinasty</title>
    <link
      rel="stylesheet"
      href="https://assets.codepen.io/7773162/swiper-bundle.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
    />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="css/contra.css">
  </head>
  <body>
    <!-- HEADER -->
  <header>
      <nav class="navbar">
          <span class="hamburger-btn material-symbols-rounded">menu</span>
          <img src="img/YoChambeoLOGO.png" style="width:10%">
          <ul class="links">
              <span class="close-btn material-symbols-rounded">close</span>
              <li><a href="index.php">Home</a></li>
              <li><a href="about.php">Sobre YoChambeo</a></li>
              <li><a href="devdinasty.php">DevDinasty</a></li>
              <li><a href="contacto.php">Contacto</a></li>
          </ul>
          <button class="login-btn">LOG IN</button>
      </nav>
  </header>
  <div class="blur-bg-overlay"></div>
  <div class="form-popup">
      <span class="close-btn material-symbols-rounded">close</span>
      <div class="form-box login">
          <div class="form-details">
              <h2>Welcome Back</h2>
              <p>Please log in using your personal information to stay connected with us.</p>
          </div>
          <div class="form-content">
              <h2>LOGIN</h2>
              <form action="#" method="post"> <!-- Envío de datos por método POST -->
                  <div class="input-field"> <!-- Inserción de Correo -->
                      <input name="email" type="text" required>
                      <label>Email</label>
                  </div>
                  <div class="input-field"> <!-- Inserción de Contraseña -->
                      <input name="password" type="password" required>
                      <label>Password</label>
                  </div>
                  <a href="#" class="forgot-pass-link">Forgot password?</a>
                  <button type="submit" name="accion" value="login">Log In</button>
              </form>
              <div class="bottom-link">
                  Don't have an account?
                  <a href="#" id="signup-link">Signup</a>
              </div>
          </div>
      </div>
      <div class="form-box signup">
          <div class="form-details">
              <h2>Create Account</h2>
              <p>To become a part of our community, please sign up using your personal information.</p>
          </div>
          <div class="form-content">
              <h2>SIGNUP</h2>
              <form action="#" method="post"> <!-- Envío de datos por método POST -->
                  <h4>As of now, 
                        <?php 
                        $queryALL = "SELECT COUNT(*) FROM usuarios_general;"; // Cantidad de personas totales registradas
                        $resultadoALL = mysqli_query($conexion, $queryALL);
                        $columnasALL = mysqli_fetch_array($resultadoALL);
                        echo $columnasALL['COUNT(*)'];
                        ?>
                        people have signed up, 
                        <?php 
                        $queryCOUNT = "SELECT cantidad FROM conteo WHERE fecha = CURDATE();"; // Cantidad de personas registradas hoy (Trigger)
                        $resultadoCOUNT = mysqli_query($conexion, $queryCOUNT);
                        $columnasCOUNT = mysqli_fetch_array($resultadoCOUNT);
                        if ($columnasCOUNT != null){
                            echo $columnasCOUNT['cantidad'];
                        } else {
                            echo '0';
                        }
                        ?>
                         member(s) have signed up today!</h4>
                  <div class="input-field"> <!-- Inserción de Nombre -->
                      <input name="name" type="text" required>
                      <label>Name</label>
                  </div>
                  <div class="input-field"> <!-- Inserción de Apellido -->
                      <input name="lastname" type="text" required>
                      <label>Last Name</label>
                  </div>
                  <div class="input-field"> <!-- Inserción de Correo -->
                      <input name="email" type="text" required>
                      <label>Enter your email</label>
                  </div>
                  <div class="input-field"> <!-- Inserción de Contraseña -->
                      <input name="password" type="password" required>
                      <label>Create password</label>
                  </div>
                  <div class="policy-text">
                      <input type="checkbox" id="policy">
                      <label for="policy">
                          I agree the
                          <a href="#" class="option">Terms & Conditions</a>
                      </label>
                  </div>
                  <button type="submit" name="accion" value="signup">Sign Up</button>
              </form>
              <div class="bottom-link">
                  Already have an account? 
                  <a href="#" id="login-link">Login</a>
              </div>
          </div>
      </div>
  </div>
</body>
</html>