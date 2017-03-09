<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Kitect.com</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/hover.zoom.js"></script>
    <script src="assets/js/hover.zoom.conf.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Static navbar -->
    <div class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="kitect.png" width='4%';>KITECT.COM</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <h3>Registro de usuario</h3> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<!-- +++++ Welcome Section +++++ -->
	<div id="ww">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 centered">
                    <?php if (!isset($_POST["nick"])) :?> 
                    <form  method="post">
                        <span>Nick </span><input type="text" name="nick"/><p></p>
                        <span>Nombre </span><input type="text" name="nombre"/><p></p>
                        <span>Apellidos </span><input type="text" name="apellidos"/><p></p>
                        <span>Correo electrónico </span><input type="email" name="email" value="@kitect.com"/><p></p>
                        <span>Contraseña </span><input type="password" name="pass"/><p></p>
                        <input type="submit" name="enviar" value="Insertar">
                    </form>
				</div><!-- /col-lg-8 -->
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /ww -->
	
	
	<!-- +++++ Projects Section +++++ -->
	
	<div class="container pt">
		
	</div><!-- /container -->
	
	
	<!-- +++++ Footer Section +++++ -->
	
	<div id="footer">
		<div class="container">
			<div class="row">				
				<div class="col-lg-4">
					<h4>Contactos</h4>
					<p>
						<a href="#">Twitter</a><br/>
						<a href="#">Facebook</a>
					</p>
				</div><!-- /col-lg-4 -->
				
			</div>
		
		</div>
	</div>
     <?php else :?>
        <?php
        $nick= $_POST["nick"];
        $nombre= $_POST["nombre"];
        $apellidos= $_POST["apellidos"];
        $correo= $_POST["email"];
        $password= $_POST["pass"];

        include("conexion.php");

        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }
        $sql="INSERT INTO usuarios (idusuario,nick,nombre,apellidos,correo,fecha_reg,password,tipo)
        VALUES (NULL,'$nick','$nombre','$apellidos','$correo',sysdate(),md5('$password'),'user')";
        

        if ($result = $connection->query($sql)){
            echo "Usuario Registrado correctamente";
            echo "<br>";
            echo '<a href="index.php"><input type="button" value="Inicio"></a>';
        } else {
            echo "Error en la consulta";
        }

        unset($connection);

        ?>
        <?php endif ?>
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
