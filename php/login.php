<?php

session_start();

if (isset($_SESSION['user_id'])) ;

require 'database.php';

if (!empty($_POST['user']) && !empty($_POST['password'])) {
  $user = $_POST['user'];
  $password = $_POST['password'];

  // Buscar en la tabla "users"
  $records = $conn->prepare('SELECT id, user, password FROM users WHERE user = :user');
  $records->bindParam(':user', $user);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if (count($results) > 0 && password_verify($password, $results['password'])) {
    $_SESSION['user_id'] = $results['id'];
    header('Location: inicio.php');
  } elseif ($user === 'Admin' && $password === 'Tecsup1234') {
    header('Location: read_usuarios.php');
  } else {
    $message = 'Lo sentimos, las credenciales no coinciden';
    echo "<script>alert('$message');</script>"; // Mostrar el mensaje de error con una ventana emergente
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Preguntados</title>
    <link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css">

</head>

<body>

    <header>

        <div class="menu" container>
            <img class="menu__logo" src="../img/logo.png" alt="">
            <input type="checkbox" id="menu" />
            <label for="menu" onclick="toggleMenu()">
              <img src="../svg/menu.svg" class="menu-icon" alt="" id="menuIcon">
              <img src="../svg/aspa.svg" alt="" class="close-icon" id="closeIcon">
            </label>
            <nav class="navbar">
                <div class="menu-1">
                    <ul>
                        <li><i class='bx bxs-user-plus bx-md'></i><a href="../index.html">Inicio</a></li>
                    </ul>
                    <ul>
                        <li><i class="bx bx-support bx-md"></i><a href="../contactar.html">Soporte</a></li>
                    </ul>
                    <ul>
                        <li><i class="bx bx-group bx-md"></i><a href="../acerca.html">Acerca de nosotros</a></li>
                    </ul>
                    <ul>
                        <li><i class="bx bx-joystick bx-md"></i><a href="../jugar.html">Como jugar</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <script src="../js/header.js"></script>


    </header>


    <div class="wrapper-login">
        <div class="form-box login">
            <h2>Preguntados</h2>
            <form action="login.php" method="POST">
            <div class="input-box">
                    <span class="icon"><box-icon type='solid' name='user'></box-icon></span>
                    <input type="text" required name="user">
                    <label for="">Usuario</label>
                </div>
                <div class="input-box">
                    <span class="icon"><box-icon name='lock-alt' type='solid' ></box-icon></span>
                    <input type="password" required name="password">
                    <label for="">Contraseña</label>
                </div>
                <div class="remember-forgot ">
                    <label for="remember-me ">
                        <input type="checkbox" name="remember-me ">Remember me
                    </label>
                </div>
                <button type="submit " class="btn " id="submit-btn ">Iniciar sesión</button>
                <div class="login-register ">
                    <p>¿No tienes una cuenta?
                        <a href="register.php" class="register-link ">Regístrate</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js "></script>



    <footer class="footer__container ">
        <div class="footer__content ">
        </div>
        <div class="footer__websites ">
            <div class="footer__websites__content ">
                <div class="footer__navSection ">
                    <span class="footer__nav-title-text "><img src="../svg/facebook.svg " alt=" " class="social--svg ">
                    <span class="footer_nav-title-label ">FACEBOOK</span>
                    </span>
                </div>
                <div class="footer__navSection ">
                    <span class="footer__nav-title-text "><img src="../svg/instagram.svg " alt=" "  class="social--svg ">
                    <span class="footer_nav-title-label ">INSTAGRAM</span>
                    </span>
                </div>

                <div class="footer__navSection ">
                    <span class="footer__nav-title-text "><img src="../svg/tiktok.svg " alt=" "  class="social--svg ">
                    <span class="footer_nav-title-label ">TIKTOK</span>
                    </span>
                </div>
                <div class="footer__navSection ">
                    <span class="footer__nav-title-text "><img src="../svg/twitter.svg " alt=" "  class="social--svg ">
                    <span class="footer_nav-title-label ">TWITTER</span>
                    </span>
                </div>

            </div>
        </div>
        <div class="footer__copyright ">
            <p>©2021- 2023</p>
            <h2>Tecsup</h2>
            <p>- Todos los Derechos Reservados.</p>
        </div>
    </footer>

</body>

</html>