<?php
  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['user']) && !empty($_POST['age']) && !empty($_POST['number'])) {
    $existingUserSql = "SELECT COUNT(*) AS count FROM users WHERE user = :user";
    $existingUserStmt = $conn->prepare($existingUserSql);
    $existingUserStmt->bindParam(':user', $_POST['user']);
    $existingUserStmt->execute();
    $existingUserResult = $existingUserStmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUserResult['count'] > 0) {
        $message = 'El nombre de usuario ya está en uso. Por favor, elija otro nombre de usuario.';
        echo "<script>var mensaje = '$message'; alert(mensaje);</script>";
    } else {
        // Continúa con la inserción del nuevo usuario
        $sql = "INSERT INTO users (email, password, user, age, number) VALUES (:email, :password, :user, :age, :number)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':user', $_POST['user']);
        $stmt->bindParam(':age', $_POST['age']);
        $stmt->bindParam(':number', $_POST['number']);

        if ($stmt->execute()) {
            $message = 'Su usuario ha sido creado con éxito';
            echo "<script>var mensaje = '$message'; alert(mensaje);</script>";
        } else {
            $message = 'Ocurrió un error al crear el usuario. Por favor, inténtelo de nuevo.';
            echo "<script>var mensaje = '$message'; alert(mensaje);</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regístrate - Preguntados</title>
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


    <div class="wrapper-register">
            <div class="form-box register">
                <h2>Preguntados</h2>
                <form action="register.php" method="POST">
                    <div class="input-box">
                        <span class="icon"><box-icon type='solid' name='user'></box-icon></span>
                        <input type="text" required name="user">
                        <label for="">Usuario</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><box-icon name='envelope' type='solid' ></box-icon></span>
                        <input type="email" required name="email">
                        <label for="">Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><box-icon name='user-check' type='solid' ></box-icon></span>
                        <input type="number" required name="age" oninput="javascript: if (this.value.length > 3) this.value = this.value.slice(0, 3);">
                        <label for="">Edad</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><box-icon name='phone' type='solid' ></box-icon></span>
                        <input type="number" required name="number" oninput="javascript: if (this.value.length > 9) this.value = this.value.slice(0, 9);">
                        <label for="">Número</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><box-icon name='lock-alt' type='solid' ></box-icon></span>
                        <input type="password" required name="password">
                        <label for="">Contraseña</label>
                    </div>
                    <div class="remember-forgot"><label for=""><input type="checkbox">Acepto los términos y condiciones</label>
                    </div>
                    <button type="submit" class="btn">Registrarse</button>
                    <div class="login-register">
                        <p>Ya tienes una cuenta?
                            <a href="login.php" class="login-link">Login</a>
                        </p>
                    </div>
                </form>
            </div>
     </div>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>




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