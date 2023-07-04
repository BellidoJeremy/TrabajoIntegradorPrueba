<?php
require 'database.php';

if (isset($_POST['submit'])) {
  // Obtener los datos actualizados del formulario
  $user = $_POST['user'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $number = $_POST['number'];

  try {
    // Realizar la consulta de actualización
    $query = $conn->prepare("UPDATE users SET user = :user, email = :email, age = :age, number = :number WHERE id = :id");
    $query->bindParam(':user', $user);
    $query->bindParam(':email', $email);
    $query->bindParam(':age', $age);
    $query->bindParam(':number', $number);
    $query->bindParam(':id', $_GET['id']);
    $query->execute();

    // Redireccionar a la página de visualización de usuarios
    header('Location: read_usuarios.php');
    exit();
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

// Obtener los datos del usuario actual para mostrarlos en el formulario
try {
  $query = $conn->prepare("SELECT * FROM users WHERE id = :id");
  $query->bindParam(':id', $_GET['id']);
  $query->execute();
  $user = $query->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/update.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css">
    <title>Actualización de</title>
</head>
<body>

    <header>

        <div class="menu" container>
            <img class="menu__logo" src="../img/logo.png" alt="">
            <input type="checkbox" id="menu" />
            <label for="menu" onclick="toggleMenu()">

            </label>
            <nav class="navbar">
                <div class="menu-1">
                </div>
            </nav>
        </div>

    </header>
    <h2 class="tittle--update">Actualizar usuario</h2>
    <form method="POST" class="my-form">
    <div class="form-group">
        <label for="user">Usuario</label>
        <input type="text" class="form-control" name="user" value="<?php echo $user['user']; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Correo</label>
        <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
    </div>
    <div class="form-group">
        <label for="age">Edad</label>
        <input type="number" class="form-control" name="age" value="<?php echo $user['age']; ?>" required  oninput="javascript: if (this.value.length > 3) this.value = this.value.slice(0, 3);">
    </div>
    <div class="form-group">
        <label for="number">Número</label>
        <input type="text" class="form-control" name="number" value="<?php echo $user['number']; ?>" required oninput="javascript: if (this.value.length > 9) this.value = this.value.slice(0, 9);">
    </div>
    <button type="submit" name="submit" >Actualizar</button>
</form>


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
