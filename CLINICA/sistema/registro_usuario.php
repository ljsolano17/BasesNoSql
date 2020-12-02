<?php 
	session_start();
	include "connection.php";
 
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['contraseña']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$nombre = $_POST['nombre'];
			$email  = $_POST['correo'];
			$user   = $_POST['usuario'];
			$contraseña  = $_POST['contraseña'];


			
			$result = getUserExist($user,$contraseña,-1);

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
			}else{

				$query_insert =insertUsers($nombre,$email,$user,$contraseña);
				 
				if($query_insert){
					$alert='<p class="msg_save">Usuario creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el usuario.</p>';
				}
				

			}


		}

	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Alpha</title>
    
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.css">
    <script src="js/index.js"></script>
    <script src="js/ingresaCita.js"></script>
  
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
	
		
		<div class="navbar-form navbar-left" >
			
				<br>
				<h1>Registro usuario</h1>
				<hr>
				<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			

			<form action="" method="post">




			<div class="row">
                <div  class="col-xs-4">
                   Nombre:
				   <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre completo"><br><br>
                </div>
  
                <div  class="col-xs-4">
                   Correo Electronico:
				   <input class="form-control" type="email" name="correo" id="correo" placeholder="Correo electrónico">
                </div>

		   </div>
		   
		   <div class="row">
                <div  class="col-xs-4">
				Usuario:
				<input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario"><br><br>
                </div>
  
                <div  class="col-xs-4">
				Contraseña:
				<input class="form-control" type="password" name="contraseña" id="contraseña" placeholder="Contraseña">
				</div>
				
				<div class="form-group col-md-4">
					<br>
					<input type="submit" value="Crear usuario" class="btn btn-primary btn_save center">
				</div>
           </div>



<!--
				<div class="form-group col-md-6">
					<label for="nombre">Nombre</label>
					<input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre completo">
				</div>
				<div class="form-group col-md-6">
					<label for="correo">Correo electrónico</label>
					<input class="form-control" type="email" name="correo" id="correo" placeholder="Correo electrónico">
				</div>
				<div class="form-group col-md-6">
					<label for="usuario">Usuario</label>
					<input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario">
				</div>
				<div class="form-group col-md-6">
					<label for="contraseña">Contraseña</label>
					<input class="form-control" type="password" name="contraseña" id="contraseña" placeholder="Contraseña">
				</div>
				<div class="form-group col-md-6">
					<input type="submit" value="Crear usuario" class="btn btn-primary btn_save center">
				</div>-->
			</form>


		</div>



	
</body>
</html>