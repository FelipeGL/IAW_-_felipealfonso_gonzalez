<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
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
                        <li><a href="../categoria/categorias.php">Categorias</a></li>
                        <li></li>
                        <li>
                            <?php
                            if (!isset($_SESSION["tipo"])){
                                echo '<a href="../inicio_registro/inicio.php">Iniciar sesión</a>';
                            }
                            ?>
                        </li>

                        <li>
                            <?php
                            if (isset($_SESSION["nick"])){
                                echo '<span>Has iniciado sesión como '.$_SESSION['nick'].' '.'<a href="../inicio_registro/logout.php"><span style="color:red;font-weight:bold">Cerrar sesión</span></a></span>';
                            } 
                            ?>
                        </li>    
                        <li>
                            <?php
                            if (!isset($_SESSION["tipo"])){
                                echo '<a href="../inicio_registro/registro.php">Registrarse</a>';
                            }else{
                                if ($_SESSION["tipo"]=='admin'){
                                    echo '<a href="../usuarios/admin.php">Panel de Control</a>';
                                }elseif ($_SESSION["tipo"]=='user') {
                                    echo '<a href="../usuarios/usuario.php">Panel de Control</a>';
                                }
                            }
                            ?>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <!-- +++++ Welcome Section +++++ -->
        <div class="container pt">
            <div class="row mt">
                <div class="col-lg-6 col-lg-offset-3 centered">
                    <h3>Categorias</h3>
                </div>
            </div>
            <div class="row mt centered">	
                <?php 
                include("../conexion/conexion.php");



                if ($result = $connection->query("SELECT * FROM categoria;")) {

                    while($obj = $result->fetch_object()) {
                        echo '<div class="col-lg-4">';
                        echo "<a href='../categoria/categoriadeterminada.php?id=$obj->idcategoria'><p>$obj->nombre</p>";
                        echo "<a href='../suscripcion/suscripcion.php?idcategoria=$obj->idcategoria'><input type='button' value='suscribirse'/></a></p></a>";
                        echo'</div>'; 

                    }
                    $result->close();
                    unset($obj);
                    unset($connection);
                }
                ?>
            </div><!-- /row -->
        </div>


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