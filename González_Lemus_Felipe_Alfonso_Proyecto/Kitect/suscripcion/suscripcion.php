<?php
session_start();
$categoria = $_GET['idcategoria'];
include("../conexion/conexion.php");
$nick=$_SESSION['nick'];
if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}

$sql= "SELECT * FROM usuarios WHERE nick='$nick'";
if ($result = $connection->query($sql)){
    $obj = $result->fetch_object();
    $user=$obj->idusuario; 
}

if ($result = $connection->query("INSERT INTO suscripcion (idusuario,idcategoria) VALUES ('$user','$categoria')")) {

} else {
    mysqli_error($connection);
}
header("Location: ../usuarios/usuario.php");
?>