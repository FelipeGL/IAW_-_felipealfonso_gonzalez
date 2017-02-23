<!DOCTYPE html>
<html lang="">
<?php
  session_start();
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
  <title>Kitect.com</title>
</head>

<body>
    <div id="contenedor">
        <div id="barra">
            <h3 class="logo">KITECT.COM</h3>
            <div id="cuadro">
                <?php
                if (!isset($_SESSION["id"])){
                  echo'<p class="inicio"><a href="inicio.php">Iniciar Sesión</a></p>';
                    echo'<p class="registro">¿Quieres unirte para obtener ventajas?.';
                    echo'<a href="registro.php">Resgistrate</a></p>';
                } else {
                  $id=$_SESSION["id"];
                    echo '<p>Has iniciado sesión como '.$_SESSION['id'].' '.'<a href="logout.php">Cerrar sesión</a>';
                    echo'<p><a href="usuario.php">Ir al panel de control</a></p>';
                }
                ?>    
            </div>
        </div>
        <div id="menu">
            <div id="inicio">Inicio</div>
            <div id="noticias">Noticias</div>
            <div id="categorias">Categorías</div>
        </div>
        <div id="contenido">
            <div id="c1"></div>
            <div id="c2"></div>
            <div id="c3"></div>
            <div id="c4"></div>
        </div>
        <div id="info"><p>Contactanos</p></div>
    </div>
<?php

?>
</body>
</html>
