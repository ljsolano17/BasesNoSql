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
            <strong><span id="idFotograma" >MODIFICA DATOS DEL PACIENTE</span></strong><br />
            <br />
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
            <?php
            $idCita = $_REQUEST['idCita'];
            

            ?>
           <div id="formCitas"  class="navbar-form navbar-left">
            <strong><span  >CITA</span></strong><br />
            <br />
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
           <div class="row">
                <div  class="col-xs-3">
                <input name="idCita" type="text" id="idCita" value='<?php echo $idCita ?>' hidden />
                   Paciente:
                  <input class="form-control" name="nombrePaciente" type="text" id="nombrePaciente"  /><br><br>
                </div>
  
                <div  class="col-xs-3">
                   Cédula:
                  <input class="form-control" name="cedula" type="text" id="cedula"  placeholder="1-1111-1111" />
                </div>

                <div  class="col-xs-3">
                  Correo:<br>
                  <input  class="form-control"name="correo" type="text" id="correo"  />
                 </div>

           </div>

              <br>
             <div class="row">
                 <div  class="col-xs-3">
                 Con el doctor:
                   <select class="form-control" name="idDoctor" id="idDoctor" >

                   </select>
                 </div>
                 <div  class="col-xs-4">
                 Hora:</br>
                
                <span id="sHora">
                    <label for="lHora10">10</label>
                    <input id="hora" type="radio" name="hora" value="10" checked="checked" />
                    <label for="lhora12">12</label>
                    <input id="hora" type="radio" name="hora" value="12" />
                    <label for="lhora16">16</label>
                    <input id="hora" type="radio" name="hora" value="16" />
                    <label for="lhora18">18</label>
                    <input id="hora" type="radio" name="hora" value="18" />
                </span>
                    
                 </div>
              

             </div>
             <br>
              <div class="row">
                <div class="col-xs-3">
 
                <br>
                <div id="datepicker">Seleccione la fecha de la cita:</div>
                <script>

                 $(function () {
                 $.datepicker.setDefaults($.datepicker.regional["es"]);
                 $("#datepicker").datepicker({
                 firstDay: 1,
                 onSelect: function (date) {
                          },
                      });
                  });


</script>
              </div>
              </div>
              
              <br><br>
             <div class="row">
              <div class="col-xs-3">
                Descripcion:<br />
                <textarea class="form-control" name="descripcion" rows="2" cols="20" id="descripcion"></textarea>
              </div>
           </div>

                <br><br>
               <div class="row">
                   <div class="col-xs-3">
                   <input class="form-control" type="submit" name="btEnviar" value="Enviar datos" id="btEnviar"  /><br><br>
                   </div>
                   <div class="col-xs-3">
                <input class="form-control" type="reset" name="btRestablecer" value="Restablecer" id="btRestablecer"  /><br><br>
                   </div>
               
               </div>
                
            
        </div>
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

    <script src="js/actualiza.js"></script>
</body>

</html>