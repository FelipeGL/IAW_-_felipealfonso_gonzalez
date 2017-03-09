<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    if ($_SESSION["tipo"]!=='admin'){
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
                        <h3>PANEL DE ADMINISTRADOR</h3>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <!-- +++++ Welcome Section +++++ -->
        <div id="ww">
            
            <?php
            echo'<div class="container">';
            echo'<div class="row">';
            echo'<div class="col-lg-8 col-lg-offset-2 centered">';

            include("conexion.php");


            if ($connection->connect_errno) {
                printf("Connection failed: %s\n", $connection->connect_error);
                exit();
            }
            if ($result = $connection->query("SELECT * FROM usuarios;")) {
                echo"<table style='border:1px solid black'>";
                echo"<h3>Lista de usuarios</h3>";
                echo"<thead>";
                echo"<tr>";
                echo"<th>IDusuario </th>";
                echo"<th>Nombre </th>";
                echo"<th>Apellidos </th>";
                echo"<th>correo </th>";
                echo "<th>Fecha de registro </th>";
                echo "<th></th>";
                echo"</thead>";
                while($obj = $result->fetch_object()) {
                    echo "<tr>";
                    echo "<td>".$obj->idusuario."</td>";
                    echo "<td>".$obj->nombre."</td>";
                    echo "<td>".$obj->apellidos."</td>";
                    echo "<td>".$obj->correo."</td>";
                    echo "<td>".$obj->fecha_reg."</td>";
                    echo "<td>
                                                 <a href='borrar.php?idusuario=$obj->idusuario'>
                                                 <img src='eliminar.png' width='10%';/>
                                               </a></td>";
                    echo "</tr>";
                }
                $result->close();
                unset($obj);
                unset($connection);
            }
            echo"</table>";

            echo'</div>';
            echo'</div>';
            echo'</div>';
            ?>
          
            <?php
            echo'<div class="container">';
            echo'<div class="row">';
            echo'<div class="col-lg-8 col-lg-offset-2 centered">';

            include("conexion.php");


            if ($connection->connect_errno) {
                printf("Connection failed: %s\n", $connection->connect_error);
                exit();
            }
            $user=$_SESSION['nick'];
            if ($result = $connection->query("SELECT noticias.*, categoria.nombre FROM noticias join categoria where noticias.idcategoria=categoria.idcategoria;")) {
                echo"<table style='border:1px solid black'>";
                echo"<h3>Lista de noticias</h3>";
                echo"<thead>";
                echo"<tr>";
                echo"<th>ID </th>";
                echo"<th>Titulo </th>";
                echo"<th>Fecha Creación </th>";
                echo"<th>Fecha Modificación </th>";
                echo "<th>Categoría</th>";
                echo "<th>Borrar</th>";
                echo "<th>Editar</th>";
                echo"</thead>";
                while($obj = $result->fetch_object()) {
                    echo "<tr>";
                    echo "<td>".$obj->idnoticia."</td>";
                    echo "<td>".$obj->titulo."</td>";
                    echo "<td>".$obj->fecha_de_creacion."</td>";
                    echo "<td>".$obj->fecha_modificacion."</td>";
                    echo "<td>".$obj->nombre."</td>";
                    echo "<td>
                                                     <a href='deletenoticia.php?idnoticia=$obj->idnoticia'>
                                                     <img src='delete.png' width='20%';/>
                                                   </a></td>";
                    echo "<td>
                                                   <a href='updatenoticia.php?id=$obj->idnoticia'>
                                                   <img src='update.png' width='20%';/>
                                                 </a></td>";
                    echo "</tr>";
                }
                $result->close();
                unset($obj);
                unset($connection);
            }
            echo"</table>";

            echo'</div>';
            echo'</div>';
            echo'</div>';
            ?>

            <?php
            echo'<div class="container">';
            echo'<div class="row">';
            echo'<div class="col-lg-8 col-lg-offset-2 centered">';

            include("conexion.php");


            if ($connection->connect_errno) {
                printf("Connection failed: %s\n", $connection->connect_error);
                exit();
            }
            if ($result = $connection->query("SELECT * FROM categoria;")) {
                echo"<table style='border:1px solid black'>";
                echo"<h3>Lista de categorias</h3>";
                echo"<thead>";
                echo"<tr>";
                echo"<th>IDcategoria </th>";
                echo"<th>Nombre </th>";
                echo "<th></th>";
                echo"</thead>";
                while($obj = $result->fetch_object()) {
                    echo "<tr>";
                    echo "<td>".$obj->idcategoria."</td>";
                    echo "<td>".$obj->nombre."</td>";
                    echo "<td>
                                                 <a href='deletecategoria.php?idcategoria=$obj->idcategoria'>
                                                 <img src='deletecategoria.png' width='10%';/>
                                               </a></td>";
                    echo "</tr>";
                }
                $result->close();
                unset($obj);
                unset($connection);
            }
            echo"</table>";

            echo'</div>';
            echo'</div>';
            echo'</div>';
            ?>
            <div class="col-lg-8 col-lg-offset-2 centered">
                <p></p>
                <p></p>
                <a href="insertnoticia.php"><input type="button" value="Añadir nueva noticia"/></a>
                <a href="nuevacategoria.php"><input type="button" value="Añadir nueva categoría"></a>
            </div>
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
