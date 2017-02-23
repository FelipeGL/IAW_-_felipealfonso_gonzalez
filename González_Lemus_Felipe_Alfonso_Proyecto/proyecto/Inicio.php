<!DOCTYPE html>
<html lang="">
<?php
  session_start();
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="inicio.css">
  <title>Kitect.com</title>
</head>

<body>
    <?php
        if (isset($_POST["id"])) {

          $connection = new mysqli("localhost", "felipe", "2asirtriana", "proyecto");
            
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

          
          $consulta="select * from usuarios where
          IdUsuario='".$_POST["id"]."' and Password=md5('".$_POST["pass"]."');";

          var_dump($consulta);
          
          if ($result = $connection->query($consulta)) {

              if ($result->num_rows===0) {
                echo "Datos inválidos";
              } else {
                
                $_SESSION["id"]=$_POST["id"];

                header("location: principal.php");
              }

          } else {
            echo "Consulta inválida";
          }
      }
    ?> 
    <div id="contenedor">
        <div id="barra">
            <h3 class="logo">KITECT.COM</h3>
        </div>
        <div id="contenido">
            <div id="login"> 
                    <form action="Inicio.php" method="post" autocomplete="off">
                        <span>Id de usuario: </span><input type="text" name="id"/><p></p>
                        <span>Contraseña: </span><input type="password" name="pass"/><p></p>
                        <input type="submit" name="iniciar" value="Iniciar" class="boton">
                    </form>
                </div>
        </div>
        <div id="info"><p>Contactanos</p></div>
    </div>
 
</body>
</html>
