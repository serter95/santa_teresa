<?php
	ob_start();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Santa Teresa</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">
    <link href="css/sticky-footer.css" rel="stylesheet">
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #000; border-color: #000;">
      <div class="container">
        <div class="navbar-header">
          
          <img id="imgHeader2" src="imagenes/urbicor.jpg">
          

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" style="">
          
          <div id="cabecera">
              <img id="imgHeader" src="imagenes/urbicor.jpg">
        
              <div id="titulo" style="color: #fff;">Monitoreo del Proceso de Envasado</div>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <div id="titulo2" style="color: #fff;">Monitoreo del Proceso de Envasado</div>

            <button id="boton" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              Iniciar Sesión
            </button>
          </ul>
        
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Carousel
    ================================================== -->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
      <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
      <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
    </ol>
    <div class="carousel-inner">
      <div class="item active">
        <img alt="First slide" src="imagenes/1.png">
      </div>
      <div class="item">
        <img alt="Second slide" src="imagenes/3.png">
      </div>
      <div class="item">
        <img class="third-slide" alt="Third slide" src="imagenes/2.png">
      </div>
      <div class="item">
        <img class="fourt-slide" alt="Fourth slide" src="imagenes/4.jpg">
      </div>
    </div>
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
  </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Monitoreo del Proceso de Envasado</h4>
        </div>
        <div class="modal-body">
           <form class="form-signin" action="" method="post">
            <h2 class="form-signin-heading">Por Favor Ingrese al Sistema</h2>
            <label for="inputNombre" class="sr-only">Nombre de Usuario</label>
            <input type="text" id="inputNombre" name="usuario" class="form-control" placeholder="Ingrese su nombre de Usuario" autofocus="true" required>
            <label for="inputPassword" class="sr-only">Contraseña</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Ingrese su Contraseña" required>
            <div class="checkbox">
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="errorSms" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="error">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #d00; color: #fff;">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Monitoreo del Proceso de Envasado</h4>
        </div>
        <div class="modal-body">
          <center>
           <h1>¡Error!</h1>
           <h2>Usuario y Contraseña no coinciden</h2>
          </center>
        </div>
      </div>
    </div>
  </div>

    <footer class="footer" style="background-color: #000;">
      <div class="container">
        <p class="text-muted" style="color: #fff;">
          <b> Ing. Sergei Terán serter95@gmail.com (0426)-4341756 </b> - | - <b> Ing. Caupolicán Querales caupolicanquerales@gmail.com (0412)-0480500 </b> <br> Todos los Derechos Reservados <b>URBICOR</b> &copy; 2016
        </p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

    <?php

      if($_POST)
      {
          require_once 'envasado/Modelos/Conexion.php';
          require_once 'envasado/Modelos/Modelos.php';
          require_once 'envasado/Modelos/Login.php';
          require_once 'envasado/Controladores/loginController.php';
          
          $obj = new Controladores\loginController();

          if (!$obj->index())
          {
    ?>
          <script type="text/javascript">
            
            $('#errorSms').modal({
                show:true,
                backdrop:'static'
            });
          
          </script>
    <?php
          }
      }
    ?>
  </body>
</html>
<?php
  ob_end_flush();
?>