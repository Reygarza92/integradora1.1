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
          <a href="login.php"><button class="login-btn" href="login.php">LOG IN</button></a>
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
  <section class="home container" id="home">
        <div class="swiper home-swiper">
          <div class="swiper-wrapper">
            <!-- HOME SLIDER 1 -->
            <section class="swiper-slide">
              <div class="" style="display: flex; justify-content: center;">
                <div>
                  <img
                    src="img/YoChambeoLOGO.png"
                    alt=""
                    style="width: 60%; margin-top: 120px;"
                    class="" /> 
                  <div class="">
                  </div>
                </div>
              </div>
              <p class="home__description">
                  <b>¡Bienvenido a YoChambeo!</b><br />
                  <br />
                  En YoChambeo, conectamos tus necesidades con habilidades excepcionales. ¿Buscas un plomero, albañil, carpintero o cualquier otro profesional para hacer el trabajo? ¡Estás en el lugar indicado! Explora nuestra plataforma para encontrar expertos confiables y calificados que se encargarán de tus proyectos con dedicación y eficiencia.<br />
                  <br />
                  ¿Eres un profesional en busca de oportunidades para mostrar tus habilidades? Únete a nuestra comunidad y promociona tus servicios. En YoChambeo, creemos en la calidad del trabajo y en hacer conexiones que beneficien a ambas partes.<br />
                  <br />
                  Descubre la forma más sencilla y efectiva de abordar tus proyectos y encontrar a los profesionales adecuados. YoChambeo: donde las habilidades se encuentran con las necesidades. ¡Comienza hoy mismo!<br />
                  <br />  <br />
                </p>
                <p class="home__description">
                <b>Sobre YoChambeo</b><br />
                <br />
                En el bullicioso corazón de Monterrey, Nuevo León, nació una solución innovadora a través de la creatividad y la determinación de la empresa de software local, DevDinasty. En el año 2023, surgió una respuesta a los desafíos del desempleo que afectaban a la región: YoChambeo.<br />
                <br />
                La idea detrás de YoChambeo se originó en una intensa sesión de lluvia de ideas en las oficinas de DevDinasty. Conscientes de la creciente necesidad de trabajo informal y servicios especializados, el equipo de desarrolladores se propuso crear una plataforma que conectara a las personas con habilidades diversas con aquellos que necesitaban sus servicios.<br />
                <br />
                Desde plomería y mecánica hasta albañilería y servicios domésticos, YoChambeo se convirtió en el puente virtual que vinculaba a trabajadores calificados con clientes en busca de soluciones prácticas. La página no solo permitía a los usuarios buscar profesionales para realizar trabajos específicos, sino que también ofrecía la posibilidad de publicar trabajos que necesitaban ser realizados, brindando así una oportunidad para que aquellos con las habilidades adecuadas aplicaran.<br />
                <br />
                La interfaz intuitiva de YoChambeo facilitaba la búsqueda y aplicación de trabajos. Los usuarios podían navegar por perfiles, leer reseñas de otros clientes y tomar decisiones informadas sobre a quién contratar para sus proyectos. Esta plataforma no solo impulsó la economía local al fomentar el trabajo independiente, sino que también creó una red sólida de profesionales y clientes satisfechos.<br />
                <br />
                Monterrey, conocida por su espíritu emprendedor, adoptó rápidamente YoChambeo como una herramienta indispensable en la búsqueda de servicios rápidos y eficientes. La página se convirtió en un testimonio del poder de la tecnología para abordar problemas locales de manera innovadora, ofreciendo una solución práctica para el desempleo y la demanda de servicios informales en la región.<br />
                <br />
                Con el tiempo, YoChambeo se expandió a otras ciudades, llevando consigo la promesa de oportunidades laborales y la conexión entre habilidades y necesidades. La historia de YoChambeo demostró que, a veces, las respuestas más efectivas pueden surgir de las mentes creativas que buscan hacer una diferencia en su comunidad.<br />
                </p>
            </section>
</body>
</html>