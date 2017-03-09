<?php
session_start();
$usuario = $_GET['idusuario'];
include("../conexion/conexion.php");
if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
if ($result = $connection->query("DELETE FROM usuarios
     where idusuario=$usuario")) {
    header("Location: ../usuarios/admin.php");
} else {
    mysqli_error($connection);
}
?>