<!DOCTYPE html>
<html lang="">
<?php
  session_start();
  if ($_SESSION["tipo"]!=='user'){
    session_destroy();
    header("Location: error.php");
  }
?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="usuario.css">
        <title>Kitect.com</title>
    </head>

    <body>
        <div id="contenedor">
            <div id="barra">
                <h3 class="logo">KITECT.COM</h3>
                <h3 class="logo2">PANEL DE CONTROL DEL USUARIO</h3>
            </div>
            <div id="contenido">
                <?php
                $connection = new mysqli("localhost", "felipe", "2asirtriana", "proyecto");


        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }
                $user=$_SESSION['id'];
                if ($result = $connection->query("SELECT * FROM usuarios where IdUsuario='$user';")) {
                    echo'<div id="lista">';
                    echo"<table style='border:1px solid black'>";
                    echo"<h3>datos del usuarios</h3>";
                    echo"<thead>";
                    echo"<tr>";
                    echo"<th>IdUsuario </th>";
                    echo"<th>Nombre</th>";
                    echo"<th>Apellidos</th>";
                    echo"<th>Correo</th>";
                    echo "<th></th>";
                    echo"</thead>";
                    while($obj = $result->fetch_object()) {
                        echo "<tr>";
                        echo "<td>".$obj->IdUsuario."</td>";
                        echo "<td>".$obj->Nombre."</td>";
                        echo "<td>".$obj->Apellidos."</td>";
                        echo "<td>".$obj->Correo."</td>";
                        echo "<td>
                                                 <a href='borrar.php?id=$obj->IdUsuario'>
                                                 <img src='eliminar.png' width='10%';/>
                                               </a></td>";
                        echo "</tr>";
                    }
                    $result->close();
                    unset($obj);
                    unset($connection);
                }
                echo"</table>";
                echo"</div>";
                ?>
            </div>
            <div id="info"><p>Contacte con nosotros</p></div>
        </div>
    </body>
</html>