<?php
session_start();
$categoria = $_GET['idcategoria'];
include("conexion.php");
 if ($connection->connect_errno) {
   printf("Connection failed: %s\n", $connection->connect_error);
   exit();
   }
    if ($result = $connection->query("DELETE FROM categoria
     where idcategoria=$categoria")) {
      header("Location: admin.php");
    } else {
        mysqli_error($connection);
  }
?>