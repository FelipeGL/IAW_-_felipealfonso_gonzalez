<?php
  session_start();
  if ($_SESSION["tipo"]!=='admin'){
    session_destroy();
    header("Location: error.php");
  }
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
          <a class="navbar-brand" href="index.php">KITECT.COM</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
              <h3>Añadir una nueva noticia</h3>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<!-- +++++ Welcome Section +++++ -->
	<div id="ww">
        <?php if (!isset($_POST["titulo"])) : ?>
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 centered">
				<form name="inisesion" id="sesion" novalidate method="post" enctype="multipart/form-data">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Título</label>
                            <input type="text" class="form-control" name="titulo" placeholder="Titulo" id="titulo" >
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Categoría</label>
                            <select class="form-control" name="categoria" placeholder="Categoría" id="categoria"> 
                            <?php
                              $connection = new mysqli("localhost", "felipe", "2asirtriana", "proyecto");
                              if ($connection->connect_errno) {
                                  printf("Connection failed: %s\n", $connection->connect_error);
                                  exit();
                              }
                                         if ($result = $connection->query("SELECT *
                                            FROM categoria order by idcategoria;")) {
                                                 while($obj = $result->fetch_object()) {
                                                  echo "<option value='$obj->idcategoria'>$obj->nombre</option>";
                                                 }
                                                 $result->close();
                                                 unset($obj);
                                                 unset($connection);
                                               }
                              ?>
                                </select>
                            <a href="nuevacategoria.php"><input type="button" value="Añadir nueva categoría"></a>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Cuerpo de la noticia</label>
                            <textarea rows="5" class="form-control" name="cuerpo" placeholder="Cuerpo de la noticia" id="cuerpo"></textarea>
                                <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                          <label>Seleciona una imágen para la notícia:</label>
                            <input type="file" name="image" id="fileToUpload">
                          </div>
                        </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-default">Enviar</button>
                        </div>
                    </div>
                </form>
				</div><!-- /col-lg-8 -->
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /ww -->
      <?php else :?>

          <?php
                //Temp file. Where the uploaded file is stored temporary
                $tmp_file = $_FILES['imagen']['tmp_name'];
                //Dir where we are going to store the file
                $target_dir = "img/";
                //Full name of the file.
                $target_file = strtolower($target_dir . basename($_FILES['imagen']['name']));
                //Can we upload the file
                $valid= true;
                //Check if the file already exists
                if (file_exists($target_file)) {
                  echo "Esa imagen ya está en el sistema.";
                  $valid = false;
                }
                //Check the size of the file. Up to 2Mb
                if ($_FILES['image']['size'] > (2048000)) {
			            $valid = false;
			            echo 'Oops!  Your file\'s size is to large.';
		            }
                //Check the file extension: We need an image not any other different type of file
                $file_extension = pathinfo($target_file, PATHINFO_EXTENSION); // We get the entension
                if ($file_extension!="jpg" && $file_extension!="jpeg" && $file_extension!="png" && $file_extension!="gif") {
                  $valid = false;
                  echo "Only JPG, JPEG, PNG & GIF files are allowed";
                }
                if ($valid) {
                  //Put the file in its place
                  move_uploaded_file($tmp_file, $target_file);
                  //CREATING THE CONNECTION
                  $connection = new mysqli("localhost", "root", "2asirtriana", "proyecto_blog2");
                   //TESTING IF THE CONNECTION WAS RIGHT
                   if ($connection->connect_errno) {
                     printf("Connection failed: %s\n", $connection->connect_error);
                       exit();
                     }

                    $titular = $_POST['titulo'];
                    $categoria = $_POST['categoria'];
                    $cuerpo = nl2br($_POST['cuerpo']);
                    $id = $_SESSION["id"];
            $consulta="INSERT INTO noticias (idnoticia,titulo,cuerpo,fecha_de_creacion,fecha_modificacion,fkidUsuario)
             VALUES(NULL ,'$titulo','$cuerpo',sysdate(),NULL,'$id')";
  	        $result = $connection->query($consulta);
  	        if (!$result) {
   		         echo "Query Error";
               var_dump($consulta);
            } else {

              echo "<br/><br/><br/><h2>La noticia se ha añadido correctamente</h2>";
              header("Refresh:1; url=paneladmin.php");
              echo "<br/><br/>";
              //echo "<a href='../'><h4 id='homeHeading'>Volver al panel</h4></a>";
              echo "<br/><br/>";

            }

            }

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