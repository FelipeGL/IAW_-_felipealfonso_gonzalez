<?php
  session_start();
?>
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
              <h3>Añadir un nuevo comentario</h3>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<!-- +++++ Welcome Section +++++ -->
	<div id="ww">
        <?php if (!isset($_POST["comentario"])) : ?>
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 centered">
				<form method="post" action="comentario.php">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Comentario</label>
                            <textarea rows="2" class="form-control" name="comentario"></textarea>
                                <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <?php
                    $id=$_GET["idnoticia"];
                    echo '<div class="row control-group">';
                    echo '<div class="form-group col-xs-12 floating-label-form-group controls">';
                    echo "<input name='id' value='$id' type='hidden'>";   
                    echo '</div>';
                    echo '</div>';
                    ?>
                    <br>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit">Enviar comentario</button>
                        </div>
                    </div>
                </form>
				</div><!-- /col-lg-8 -->
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /ww -->
      <?php else :?>

          <?php
                  include("conexion.php");
                    $id=$_GET["idnoticia"];
                
                   if ($connection->connect_errno) {
                     printf("Connection failed: %s\n", $connection->connect_error);
                       exit();
                     }
                    
                    $nick=$_SESSION['nick'];
                    $comentario = nl2br($_POST['comentario']);
                    $idnot=$_POST['id'];
            
            $sql="INSERT INTO comentario (idcomentario,contenido,fecha,usuario,idnoticia)
             VALUES(NULL,'$comentario',sysdate(),'$nick','$idnot')";
            //var_dump($sql);
            if ($result = $connection->query($sql)){
            echo "El comentario se ha insertado correctamente";
            echo "<br>";
            header("Location: index.php");
            } else {
            echo "Error en la consulta";
            }

            unset($connection);

            ?>

          <?php endif ?>
	
	
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
	

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>