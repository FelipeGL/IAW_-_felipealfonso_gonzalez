<?php
session_start();
$noticia = $_GET['idnoticia'];
include("conexion.php");
 if ($connection->connect_errno) {
   printf("Connection failed: %s\n", $connection->connect_error);
   exit();
   }
    if ($result = $connection->query("DELETE FROM noticias
     where idnoticia=$noticia")) {
      header("Location: admin.php");
    } else {
        mysqli_error($connection);
  }
?>