<?php
session_start();
if ($_SESSION["tipo"]!=='admin'){
        session_destroy();
        header("Location: ../error.php");

    }
$noticia = $_GET['idnoticia'];
include("../conexion/conexion.php");
if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
if ($result = $connection->query("DELETE FROM noticias
     where idnoticia=$noticia")) {
    header("Location: ../usuarios/admin.php");
} else {
    mysqli_error($connection);
}
?>