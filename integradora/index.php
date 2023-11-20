<!DOCTYPE html>
<?php
include("conexion.php");
/*$queryCounterWorker = "CALL count_worker;";
$resultCounterWorker = mysqli_query($conexion, $queryCounterWorker);
$columnCntWrk = mysqli_fetch_array($resultCounterWorker);
$counterWorkers = $columnCntWrk['conteo_trabajadores'];
mysqli_free_result($resultCounterWorker);
// Free any additional result sets
while (mysqli_next_result($conexion)) {
  if ($result = mysqli_store_result($conexion)) {
      mysqli_free_result($result);
  }
}
if (isset($_POST["ejecucion"])){
  $ejecucion = $_POST["ejecucion"];
  switch ($ejecucion){
    case 'login':
      $correo = $_POST["email"];
      $contrasena = $_POST["password"];
      $query = "CALL log_in ('$correo','$contrasena');";
      $resultado = mysqli_query($conexion, $query);
      $columna = mysqli_fetch_array($resultado);
      $id_usuario = $columna['id_usuario'];
      if ($id_usuario != NULL){
        echo "Bienvenido";
      } else {
        echo "Verifica los datos ingresados o registrate";
      }
  }
}*/
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>YoChambeo</title>
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
          <ul class="links">
              <span class="close-btn material-symbols-rounded">close</span>
              <li><a href="#">Home</a></li>
              <li><a href="#">Portfolio</a></li>
              <li><a href="#">DevDestiny</a></li>
              <li><a href="#">Contacto</a></li>
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
              <form action="#">
                  <div class="input-field">
                      <input type="text" required>
                      <label>Email</label>
                  </div>
                  <div class="input-field">
                      <input type="password" required>
                      <label>Password</label>
                  </div>
                  <a href="#" class="forgot-pass-link">Forgot password?</a>
                  <button type="submit">Log In</button>
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
              <form action="#">
                  <div class="input-field">
                      <input type="text" required>
                      <label>Enter your email</label>
                  </div>
                  <div class="input-field">
                      <input type="password" required>
                      <label>Create password</label>
                  </div>
                  <div class="policy-text">
                      <input type="checkbox" id="policy">
                      <label for="policy">
                          I agree the
                          <a href="#" class="option">Terms & Conditions</a>
                      </label>
                  </div>
                  <button type="submit">Sign Up</button>
              </form>
              <div class="bottom-link">
                  Already have an account? 
                  <a href="#" id="login-link">Login</a>
              </div>
          </div>
      </div>
  </div>
    <main class="main">
      <!-- HOME -->
      <section class="home container" id="home">
        <div class="swiper home-swiper">
          <div class="swiper-wrapper">
            <!-- HOME SLIDER 1 -->
            <section class="swiper-slide">
              <div class="home__content grid" style="align-items:center">
                <div class="home__group">
                  <img
                    src="img/YoChambeoLOGO.png"
                    alt=""
                    style="width = 100%"
                    class="" /> 
                  <div class="home__details-img">
                  </div>
                </div>
                <div class="home__data">
                  <h1 class="home__title">
                    Un trabajo BIEN hecho
                  </h1>
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
                  </p>
            </section>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </section>
      <!-- CATEGORY -->
      <section class="section category">
        <h2 class="section__title">
          Más buscados <br />
        </h2>
        <div class="category__container container grid">
          <div class="category__data">
            <img
              src="img/Albañilería.png"
              alt=""
              class="category__img"
            />
            <h3 class="category__title">Albañilería</h3>
            <p class="category__description">
            Trabajos de construcción y reparación estructural en albañilería para proyectos residenciales y comerciales.
            </p>
          </div>
          <div class="category__data">
            <img
              src="img/Carpintería.png"
              alt=""
              class="category__img"
            />
            <h3 class="category__title">Carpintería</h3>
            <p class="category__description">
            Trabajos de diseño, fabricación y reparación de estructuras y elementos de madera en carpintería.
            </p>
          </div>
          <div class="category__data">
            <img
              src="img/Plomería.png"
              alt=""
              class="category__img"
            />
            <h3 class="category__title">Plomería</h3>
            <p class="category__description">
            Servicios especializados en instalación, mantenimiento y reparación de sistemas de fontanería y tuberías.
            </p>
          </div>
        </div>
      </section>
      <!-- ABOUT 
      <section class="section about" id="about">
        <div class="about__container container grid">
          <div class="about__data">
            <h2 class="section__title about__title">
              About Halloween <br />
              Night
            </h2>
            <p class="about__description">
              Night of all the saints, or all the dead, is celebrated on October
              31 and it is a very fun international celebration, this
              celebration comes from ancient origins, and is already celebrated
              by everyone.
            </p>
            <a href="#" class="book--now">
              <img
                src="https://assets.codepen.io/7773162/svgviewer-output+%281%29_3.svg"
                alt=""
              />
            </a>
          </div>
          <img
            src="https://assets.codepen.io/7773162/about-img.png"
            alt=""
            class="about__img"
          />
        </div>
      </section>-->

      <!-- Trabajos-->
      <section class="section trick" id="trick">
        <h2 class="section__title">Trabajos</h2>
        <div class="trick__container container grid">
          <?php
          $queryVacant = "CALL vacants();";
          $vacante = mysqli_query($conexion, $queryVacant);
          if (!$vacante) {
            die('Query fallido: ' . mysqli_error($conexion));
          }
          if ($vacante->num_rows > 0){
            while ($row = $vacante->fetch_assoc()) {
              $nombreImg = $row['servicio'];
              echo '<div class="trick__content">';
              echo '<img class="new__img"';
              echo 'src="img/' . $nombreImg . '.png" ';
              echo 'alt="" class="trick__img" />';
              echo '<div class="trick__content">';
              echo '<h3 class="trick__title">' . $row['titulo'] . '</h3>';
              echo '<span class="trick__subtitle">' . $row['servicio'] . '</span>';
              echo '<span class="trick__price">' . $row['pago'] . '</span>';
              echo '<button class="button trick__button">';
              echo '<i class="bx bx-cart-alt trick__icon"></i>';
              echo '</button>';
              echo '</div>';
              echo '</div>';
            }
          }
          mysqli_free_result($vacante);
          // Free any additional result sets
          while (mysqli_next_result($conexion)) {
              if ($result = mysqli_store_result($conexion)) {
                  mysqli_free_result($result);
              }
          }

          ?>
        </div>
      </section>
      <!-- NEW ARRIVALS -->
      <section class="section new" id="new">
        <h2 class="section__title">Trabajadores destacados</h2>
        <div class="new__container container">
          <div class="swiper new-swiper">
            <div class="swiper-wrapper">
              <?php
              $contadorTrabajador = 0;
                $queryWorkers = "CALL best_workers();";
                $trabajadores = mysqli_query($conexion, $queryWorkers);             
                if (!$trabajadores) {
                  die('Query fallido: ' . mysqli_error($conexion));
                }
                if ($trabajadores->num_rows > 0){
                  while (($row = $trabajadores->fetch_assoc()) /*&& $counterWorkers > $contadorTrabajador*/ ) {
                    //$nombreImg = $row['servicio']
                    echo '<div class="new__content swiper-slide">';
                    echo '<img class="new__img"';
                    echo 'src="img/user.png" ';
                    echo 'alt="" class="new__img" />';
                    echo '<div class="new__content">';
                    echo '<h3 class="new__title">' . $row['nombre'] . '</h3>';
                    echo '<span class="new__subtitle">' . $row['servicio'] . '</span>';
                    echo '<span class="new__price">' . $row['calificacion'] . '</span>';
                    echo '<button class="button new__button">';
                    echo '<i class="bx bx-cart-alt new__icon"></i>';
                    echo '</button>';
                    echo '</div>';
                    echo '</div>';
                    /*$contadorTrabajador = $contadorTrabajador + 1;*/
                  }
                }
                mysqli_free_result($trabajadores);
                // Free any additional result sets
                while (mysqli_next_result($conexion)) {
                    if ($result = mysqli_store_result($conexion)) {
                        mysqli_free_result($result);
                    }
                }
              ?>
            </div>
          </div>
        </div>
      </section>
      <!-- OUR NEWSLETTER -->
      <section class="section newsletter">
        <div class="newsletter__container container">
          <h2 class="section__title">Notificacion a correo</h2>
          <p class="newsletter__description">
            Trabajos nuevos directo a tu correo
          </p>
          <form action="" class="newsletter__form">
            <input
              type="text"
              placeholder="Enter your email"
              class="newsletter__input"
            />
            <a href="/" class="bn3637 bn36">Button</a>
          </form>
        </div>
      </section>
    </main>
    <!-- SCROLL UP -->
    <a href="#" class="scrollup" id="scroll-up">
      <i class="bx bx-up-arrow-alt scrollup__icon"></i>
    </a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.2/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.9/scrollreveal.min.js"></script>
    <script src="./script.js"></script>
    <script src="js/contra.js"></script>
  </body>
</html>
