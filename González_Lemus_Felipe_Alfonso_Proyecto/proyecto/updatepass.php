<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    if ($_SESSION["tipo"]!=='user'){
        session_destroy();
        header("Location: error.php");
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
                        <h3>CAMBIO DE CONTRASEÑA</h3>
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
                            <span>Nick: </span><input type="text" name="nick"/><p></p>
                            <span>Nueva contraseña: </span><input type="password" name="pass1"/><p></p>
                            <input type="submit" name="enviar" value="Cambiar contraseña">
                        </form>
                        <?php else :?>
                        <?php
                        include("conexion.php");

                        if ($connection->connect_errno) {
                            printf("Connection failed: %s\n", $connection->connect_error);
                            exit();
                        }
                        
                        $nick= $_POST["nick"];
                        $passnueva= $_POST["pass1"];
                        
                         $sql= "UPDATE usuarios SET password=md5('$passnueva') WHERE nick='$nick'";
                        if ($result = $connection->query($sql)){
                             echo "La contraseña ha sido cambiada exitoamente.";
                            header("Location: inicio.php");
                        } else {
                            echo "Error en la consulta";
                        }
                    
                        unset($connection);
                        ?>
                        <?php endif ?>
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


        <!-- Bootstrap core JavaScript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>