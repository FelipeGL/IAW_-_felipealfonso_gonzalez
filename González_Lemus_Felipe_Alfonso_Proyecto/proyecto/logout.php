<?php
session_start();
unset ($SESSION['id']);
session_destroy();
var_dump("Sesión cerrada con éxito");
header('Location: principal.php');
?>