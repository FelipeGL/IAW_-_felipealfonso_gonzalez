<?php
session_start();
unset ($SESSION['nick']);
session_destroy();
var_dump("Sesión cerrada con éxito");
header('Location: ../index.php');
?>