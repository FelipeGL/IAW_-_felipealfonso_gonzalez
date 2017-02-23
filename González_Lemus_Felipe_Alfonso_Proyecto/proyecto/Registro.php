<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="registro.css">
        <title>Kitect.com</title>
    </head>

    <body>
        <div id="contenedor">
            <div id="barra">
                <h3 class="logo">KITECT.COM</h3>
            </div>
            <div id="contenido">
                <div id="formulario">
                    <?php if (!isset($_POST["id"])) :?> 
                    <form  method="post">
                        <p>Nick</p><input type="text" name="id" value="nick para el foro"/><br>
                        <p>Nombre</p><input type="text" name="nombre" value="nombre"/><br>
                        <p>Apellidos</p><input type="text" name="apellidos" value="apellidos"/><br>
                        <p>Correo electrónico</p><input type="email" name="@kitect.com" value="correo"/><br>
                        <p>Contraseña</p><input type="password" name="pass" value="password"/><br>
                        <input type="submit" name="enviar" value="Insertar">
                    </form>
                </div>
            </div>
            <div id="info"><p>Contacte con nosotros</p></div>
        </div>
        <?php else :?>
        <?php
        $IdUsuario= $_POST["id"];
        $Nombre= $_POST["nombre"];
        $Apellidos= $_POST["apellidos"];
        $Correo= $_POST["email"];
        $Password= $_POST["pass"];

        $connection = new mysqli("localhost", "felipe", "2asirtriana", "proyecto");

        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }
        $sql="INSERT INTO usuarios (IdUsuario,Nombre,Apellidos,Correo,Password,Tipo)
        VALUES ('$IdUsuario','$Nombre','$Apellidos','$Correo',md5('$Password'),'user')";

        if ($result = $connection->query($sql)){
            echo "Usuario Registrado correctamente";
            echo "<br>";
            echo '<a href="principal.php"><input type="button" value="Inicio"></a>';
        } else {
            echo "Error en la consulta";
        }

        unset($connection);

        ?>
        <?php endif ?>
    </body>
</html>
