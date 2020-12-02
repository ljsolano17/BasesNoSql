<?php 
	session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha</title>
   
    
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.css">
    <script src="js/medicina.js"></script>
    <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  </head>




    <body>

      
    <div  class="navbar navbar-inverse ">
    <a class="navbar-brand" runat="server" href="index.php">CLINICA ALPHA</a>
       <ul class="nav navbar-nav">
          <li> <a style="color:white!important;" href="index.php">Inicio</a></li>
          <li> <a style="color:white!important;" href="ingresarPaciente.php">Ingresar Datos del Paciente</a> </li>
          <li> <a style="color:white!important;" href="citas.php">Mostrar Citas</a> </li>
          <li> <a style="color:white!important;" href="medicinas.php">Visualizar Medicamentos </a> </li>
          <li> <a style="color:white!important;" href="lista_venta.php">Generar Factura</a> </li>
          <li class="dropdown">
          <a href="#" style="color:white!important;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li> <a class="dropdown-item" href="registro_usuario.php">Nuevo Usuario</a></li>
            <li><a class="dropdown-item" href="lista_usuario.php">Lista de Usuarios</a></li>
        </ul>
        </li>

          <li> <a style="color:white!important;"  class="nav-item nav-link" href="salir.php" >Salir</a> </li>
          <li> <a style="color:white!important; " class="nav-item nav-link"><?php echo $_SESSION['nombre'] ?></a></li>
        </ul> 
                 
    </div>
        
         <div id="formCitas"  class="main">
            <h3>Datos de los medicamentos ingresados al sistema</h3>
            <br>
           
            <table id="medicamentos" class="table">
            </table>
            <a id='mensaje' ></a>
        </div>
       
    
        <!-- Footer -->
     
    </body>














</html>