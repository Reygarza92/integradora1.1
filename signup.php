<!DOCTYPE html>
<?php
include("conexion.php");
if (isset($_POST["accion"])){
    $correo = $_POST["email"];
    $contrasena = $_POST["password"];
    $accion = $_POST["accion"];
    switch ($accion){
    case 'login':
        $queryLOGIN = "CALL log_in ('$correo','$contrasena');";
        $resultadoLOGIN = mysqli_query($conexion, $queryLOGIN);
        $columnasLOGIN = mysqli_fetch_array($resultadoLOGIN);
        if ($columnasLOGIN != null){ // Verificación del login
            $id_usuario = $columnasLOGIN['id_usuario'];
            $nombre_usuario = $columnasLOGIN['nombre'];
            echo 'Bienvenido de vuelta, '.$nombre_usuario;
            session_start();
            $_SESSION['id_usuario'] = $id_usuario;
        } else {
            echo 'Verifique sus datos o registrese';
        }
        break;
    case 'signup':
        $nombre = $_POST['name'];
        $apellido = $_POST['lastname'];
        $querySIGNUP = "CALL sign_up ('$nombre', '$apellido', '$correo', '$contrasena');";
        $queryApllySIGNUP = mysqli_query($conexion, $querySIGNUP);
        $echoSIGNUP = 'Usuario registrado con éxito, inicie sesión';
        // echo 'Usuario registrado con éxito, inicie sesión';
        break;
    }
} 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
          <a href="login.php"><button class="login-btn" href="login.php">LOG IN</button></a>
      </nav>
  </header>
<!--<div class="form-box login" style="margin-top:150px";>
          <div>
              <h2>Welcome Back</h2>
              <p style="display: flex; justify-content:center;">Please log in using your personal information to stay connected with us.</p>
          </div>
          <div class="form-content">
              <h2 action="login.php">LOGIN</h2>
              <form action="login.php" method="post">
                  <div class="input-field">
                      <input name="email" type="text" required>
                      <label>Email</label>
                  </div>
                  <div class="input-field">
                      <input name="password" type="password" required>
                      <label>Password</label>
                  </div>
                  <a href="#" class="forgot-pass-link">Forgot password?</a>
                  <button type="submit" name="accion" value="login">Log In</button>
              </form>
          </div>
      </div>-->

      </div>
      <div class="form-box signup" style="margin-top:200px; display: flex; justify-content:center;">
      <div style="margin-top:120px;">
      <h2><?php
      if (isset($_POST["accion"])){
      echo $echoSIGNUP;
      }
      ?></h2>
          <div>
              <h2>Create Account</h2>
              <p style="display: flex; justify-content:center;">To become a part of our community, please sign up using your personal information.</p>
          </div>
          <div class="form-content">
              <h2>SIGNUP</h2>
              <form action="#" method="post">
                    <h4>As of now, 
                        <?php 
                        $queryALL = "SELECT COUNT(*) FROM usuarios_general;";
                        $resultadoALL = mysqli_query($conexion, $queryALL);
                        $columnasALL = mysqli_fetch_array($resultadoALL);
                        echo $columnasALL['COUNT(*)'];
                        mysqli_free_result($resultadoALL);
                        // Free any additional result sets
                        while (mysqli_next_result($conexion)) {
                            if ($result = mysqli_store_result($conexion)) {
                                mysqli_free_result($result);
                            }
                        }
                        ?>
                        people have signed up, 
                        <?php 
                        $queryCOUNT = "SELECT cantidad FROM conteo WHERE fecha = CURDATE();";
                        $resultadoCOUNT = mysqli_query($conexion, $queryCOUNT);
                        $columnasCOUNT = mysqli_fetch_array($resultadoCOUNT);
                        if ($columnasCOUNT != null){
                            echo $columnasCOUNT['cantidad'];
                        } else {
                            echo '0';
                        }
                        mysqli_free_result($resultadoCOUNT);
                        // Free any additional result sets
                        while (mysqli_next_result($conexion)) {
                            if ($result = mysqli_store_result($conexion)) {
                                mysqli_free_result($result);
                            }
                        }
                        ?>
                         member(s) have signed up today!</h4>
                  <div class="input-field" style="background-color:#fff;">
                      <input name="name" type="text" required>
                      <label>Name</label>
                  </div>
                  <div class="input-field" style="background-color:#fff;">
                      <input name="lastname" type="text" required>
                      <label>Last Name</label>
                  </div>
                  <div class="input-field" style="background-color:#fff;">
                      <input name="email" type="text" required>
                      <label>Enter your email</label>
                  </div>
                  <div class="input-field" style="background-color:#fff;">
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
                  <a href="login.php"><button type="submit" name="accion" value="signup">Sign Up</button></a>
              </form>
          </div>
      </div>
</body>
</html>