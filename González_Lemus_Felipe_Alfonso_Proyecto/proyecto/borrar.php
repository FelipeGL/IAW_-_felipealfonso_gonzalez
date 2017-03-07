<?php
session_start();
if (empty($_GET))
$usuario = $_GET['id'];
$connection= new mysqli("localhost", "felipe", "2asirtriana", "proyecto");
 if ($connection->connect_errno) {
   printf("Connection failed: %s\n", $connection->connect_error);
   exit();
   }
    if ($result = $connection->query("DELETE FROM usuarios
     where idusuario=$usuario")) {
      header("Location: admin.php");
    } else {
        mysqli_error($connection);
  }
?>