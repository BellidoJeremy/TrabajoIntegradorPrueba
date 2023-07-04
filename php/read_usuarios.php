<?php
require 'database.php';

try {
  $query = $conn->query("SELECT id, user, email, age, number FROM users");
  $users = $query->fetchAll(PDO::FETCH_ASSOC);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css">
    <title>Gestión de usuarios</title>
</head>
<body>

    <header>

        <div class="menu" container>
            <img class="menu__logo" src="../img/logo.png" alt="">
            <input type="checkbox" id="menu" />
        </div>


    </header>

    <div class="container ">
        <h1 class="text">Usuarios</h1>

        <div class="table-container table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="container--tr">
                        <th scope="col">Id</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Número</th>
                        <th scope="col">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['user']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['age']; ?></td>
                            <td><?php echo $user['number']; ?></td>
                            <td>
                            <a href="update.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Editar</a>
                            <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>    
            </table>
        </div>
        <div class="row">
            <div class="col-auto">
                <a class="btn btn-secondary" href="../index.html" target="_blank">Volver al menú</a>
            </div>
            <div class="col-auto">
                <a class="btn btn-secondary" type="button" href="register.php" target="_blank">Registrar un nuevo usuario</a>
            </div>
        </div>
        <br>
    </div>

    
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



