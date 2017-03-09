<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    if ($_SESSION["tipo"]!=='admin'){
        session_destroy();
        header("Location: ../error.php");

    }
    ?>
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
        <link href="../assets/css/main.css" rel="stylesheet">

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
                        <h3>MODIFICAR LA NOTICIA</h3>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <!-- +++++ Welcome Section +++++ -->
        <div id="ww">
            <div class="col-lg-8 col-lg-offset-2 centered">
                <?php if (!isset($_POST["titulo"])) : ?>
                <form method="post" action="updatenoticia.php">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Título</label>
                            <?php
                            include("../conexion/conexion.php");

                            $id= $_GET["id"];

                            if ($connection->connect_errno) {
                                printf("Connection failed: %s\n", $connection->connect_error);
                                exit();
                            }
                            if ($result = $connection->query("SELECT titulo
                                    FROM noticias where idnoticia='$id';")) {
                                while($obj = $result->fetch_object()) {
                                    echo"<input type='text' name='titulo' class='form-control' value='$obj->titulo' id='titulo'>";
                                    echo "<p></p>";
                                }
                                $result->close();
                                unset($obj);
                                unset($connection);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Cuerpo de la noticia</label>
                            <?php
                            include("../conexion/conexion.php");

                            if ($connection->connect_errno) {
                                printf("Connection failed: %s\n", $connection->connect_error);
                                exit();
                            }
                            if ($result = $connection->query("SELECT cuerpo
                                    FROM noticias where idnoticia='$id';")) {
                                while($obj = $result->fetch_object()) {
                                    echo"<textarea rows='5' class='form-control' name='cuerpo' placeholder='Cuerpo de la noticia'>$obj->cuerpo</textarea>";
                                    echo "<p></p>";
                                }
                                $result->close();
                                unset($obj);
                                unset($connection);
                            }
                            ?>

                        </div>
                    </div>
                    <?php
                    echo '<div class="row control-group">';
                    echo '<div class="form-group col-xs-12 floating-label-form-group controls">';
                    echo "<input name='id' value='$id' type='hidden'>";   
                    echo '</div>';
                    echo '</div>';
                    ?>
                    <div class="form-group col-xs-12">
                        <button type="submit">Enviar</button>
                    </div>
                </form>
                <?php else :?>

                <?php 
                include("../conexion/conexion.php");


                if ($connection->connect_errno) {
                    printf("Connection failed: %s\n", $connection->connect_error);
                    exit();
                }


                $titulo = $_POST['titulo'];
                $cuerpo = nl2br($_POST['cuerpo']);
                $idnot = $_POST['id'];

                $modificar = "UPDATE noticias SET titulo='$titulo', fecha_modificacion=NOW(), cuerpo='$cuerpo' WHERE idnoticia='$idnot'";

                if($result = $connection->query($modificar)) 
                { 
                    header("Location: ../index.php");
                } 
                else 
                { 
                    echo 'La noticia no se modificó'; 
                } 


                ?>  

                <?php endif ?>
            </div>
        </div><!-- /ww -->


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
