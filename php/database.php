<?php

function conectar()
{
  $conn = mysqli_connect('localhost', 'root', 'usbw', 'php_login_database');
  return $conn;
}

function desconectar($conn)
{
  mysqli_close($conn);
}

$server = 'localhost';
$username = 'root';
$password = 'usbw';
$database = 'php_login_database';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $conn->exec("ALTER TABLE users AUTO_INCREMENT = 1");
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>


