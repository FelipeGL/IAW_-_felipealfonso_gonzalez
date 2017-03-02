<?php
session_start();
if (empty($_GET))
die("No hay parametro");
$user = $_GET['id'];
$connection= new mysqli("localhost", "felipe", "2asirtriana", "proyecto");
 if ($connection->connect_errno) {
   printf("Connection failed: %s\n", $connection->connect_error);
   exit();
   }
    if ($result = $connection->query("DELETE FROM usuarios
     where idusuario=$user")) {
      echo "El usuario $user ha sido borrado<br>";
      header("Location: admin.php");
    } else {
        mysqli_error($connection);
  }
?>