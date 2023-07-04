<?php
require 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $query = $conn->prepare("DELETE FROM users WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();

        $affectedRows = $query->rowCount();
        if ($affectedRows > 0) {
            header("Location: read_usuarios.php"); // Redirige de vuelta a la página principal después de eliminar el usuario
            exit();
        } else {
            echo "No se encontró ningún usuario con el ID proporcionado.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>










