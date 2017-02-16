<?php
$connection = new mysqli("localhost", "tf", "12345", "tf");


if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}

//el contenido del array lo convierto en un numero
$r= $_GET['id'];
//Comprobamos que la reparacion existe.
if ($result = $connection->query("SELECT * FROM REPARACIONES where IdReparacion=$r;")) {
    //Primero se borra de facturas para evitar problemas con la foreign key
    if ($result2 = $connection->query("DELETE FROM FACTURAS where IdReparacion=$r;")) {
        //Se borra de reparaciones
        if ($result2 = $connection->query("DELETE FROM REPARACIONES where IdReparacion=$r;")) {
            echo "Se ha borrado la reparación con ID $r.<br>";
        } else {
            mysqli_error($connection);
        }
    } else {
    }
    mysqli_error($connection);
}
mysqli_error($connection);
?>

<a href="reparaciones.php"><input type='submit' value='Volver' /></a>