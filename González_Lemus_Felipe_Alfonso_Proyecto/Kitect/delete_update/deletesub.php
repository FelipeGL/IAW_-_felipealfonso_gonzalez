<?php
session_start();
$categoria = $_GET['idcategoria'];
include("../conexion/conexion.php");
if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
if ($result = $connection->query("DELETE FROM suscripcion
     where idcategoria=$categoria")) {
    header("Location: ../usuarios/usuario.php");
} else {
    mysqli_error($connection);
}
?>