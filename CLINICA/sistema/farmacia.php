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
    <script type="text/javascript" src="js/functions.js"></script>
    <script src="js/medicina.js"></script>
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

        <div id="formCitas" class="main">
            <strong><span id="farmacia" >Productos de la Farmacia</span></strong><br />
            <?php
            $idCita = $_REQUEST['idCita'];
            

            ?>
             <div id="formCitas"  class="main">
            <h3>Datos de los medicamentos encontrados en Farmacia</h3>
            <br>
           
            <table id="medicamentos" class="table table-bordered table-hover table-responsive">
            </table>
            <a id='mensaje' ></a>
        </div>
             <input name="idCita" type="text" id="idCita" value='<?php echo $idCita ?>' hidden />
             <h3>Seleccione: </h3>
             <p>Escoga los medicamentos que necesite ingresando su identificador</p>
             <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th width="100px">ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripcion</th>
                    <th width="100px">Cantidad</th>
                    <th>Precio Total</th>
                    <th>Comentario</th>
                    <th>Accion</th>
                </tr>
                <tr>
                    <td><input type="text" name="txt_id_producto" id="txt_id_producto"></td>
                    <td id="txt_nombre">-</td>
                    <td id="txt_precio">0.00</td>
                    <td id="txt_descripcion">-</td>
                    <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                    <td id="txt_precio_total">-</td>
                    <td><input type="text" name="comentario" id="comentario"></td>
                    <td><a href="" class="btn btn-info" id="add_product_venta">Agregar</a></td>
                </tr>
            </thead>
            <div ID="pnlMensaje" title="Error" style="display:none">
                <div>
                    <strong>Atención!</strong> Se ha presentado el siguiente problema.
                    <br />
                    <br />
                    <p ID="blMensajes"></p>
                </div>
            </div>
            <div ID="pnlInfo" title="Mensaje" style="display : none;">
                <div>
                    <strong>Información!</strong> Procesamiento éxitoso.
                    <br />
                    <br />
                    <p ID="blInfo"></p>
                </div>
            </div>
            <tbody id="detalle_venta">
                
            </tbody>
            <tfoot id="detalle_totales">
                
            </tfoot>
        </table>
     
    </div>

    </div>
    </div>
  






    <div class="panel panel-default">
  <div class="panel-body">
  
  </div>
  <div >
  <footer>
        <p>
            
            <img src="imagenes/facebookflat.png" align="left" hspace="1" style="width:40px; height:40px"  alt="Facebook" id="FacebookLink" onclick="window.open('https://www.facebook.com/clinicaalpha24horas/')">
           
            <img src="imagenes/emailflat.png" align="left" hspace="1" style="width:40px; height:40px"     alt="email" id="emailLink" onclick="window.open('mailto:dr.ramirez@clinica-alpha.com')">
            <br><br>
        </p>
        <p >
           
            
           Alajuela 25 mts sur de la Cruz Roja - Teléfonos: +506 2440 4050 - Email: dr.ramirez@clinica-alpha.com
        </p>
    </footer>

  
  </div>


</body>

</html>