<?php
session_start();
if ($_SESSION["tipo"]!=='admin'){
    session_destroy();
    header("Location: ../error.php");
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
        <link href="../assets/css/bootstrap.css" rel="stylesheet">


        <!-- Custom styles for this template -->
        <link href="assets/css/main.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="../assets/js/hover.zoom.js"></script>
        <script src="../assets/js/hover.zoom.conf.js"></script>

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
                    <a class="navbar-brand" href="../index.php"><img src="../iconos/kitect.png" width='4%';>KITECT.COM</a>
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
                        <form method="post" action="insertnoticia.php">
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>Título</label>
                                    <input type="text" class="form-control" name="titulo" placeholder="Titulo" id="titulo" >
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
                                    <label>Categoría</label>
                                    <br>    

                                    <?php
                                    include("../conexion/conexion.php");
                                    if ($connection->connect_errno) {
                                        printf("Connection failed: %s\n", $connection->connect_error);
                                        exit();
                                    }
                                    if ($result = $connection->query("SELECT *
                                            FROM categoria order by idcategoria;")) {
                                        while($obj = $result->fetch_object()) {
                                            echo "<input type='checkbox' value='$obj->idcategoria' name='categoria'>$obj->nombre<br>";
                                        }
                                        $result->close();
                                        unset($obj);
                                        unset($connection);
                                    }
                                    ?>


                                    <p></p>
                                </div>
                            </div>
                            <br>
                            <div id="success"></div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <button type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /col-lg-8 -->
                </div><!-- /row -->
            </div> <!-- /container -->
        </div><!-- /ww -->
        <?php else :?>

        <?php
        include("../conexion/conexion.php");

        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        $titulo = $_POST['titulo'];
        $cat = $_POST['categoria'];
        $cuerpo = nl2br($_POST['cuerpo']);

        $sql="INSERT INTO noticias (idnoticia,titulo,cuerpo,fecha_de_creacion,fecha_modificacion,idUsuario,idcategoria)
             VALUES(NULL ,'$titulo','$cuerpo',sysdate(),NULL,'1','$cat')";
        //var_dump($sql);
        if ($result = $connection->query($sql)){
            echo "La noticia se ha creado correctamente";
            echo "<br>";
            header("Location: ../index.php");
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

        <?php
    include("../pie.php")
        ?>


        <!-- Bootstrap core JavaScript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../assets/js/bootstrap.min.js"></script>
    </body>
</html>