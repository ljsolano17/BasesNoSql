<?php 
	session_start();
	include "connection.php";	

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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  <title>Lista de Usuarios</title>
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
	
		
		<h1>Lista de usuarios</h1>
		

		<table class="table">
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Acciones</th>
			</tr>
		<?php 
			$query = getTotalUsers(0);

			
			$cant = getTotalUsers(-1);
			
		//	print_r($query);
			
			if($cant > 0){
				$data=$query;
				//Sele resta 2 porque estoy utilizando el metodo para hacer autoincremental el id del usuario
				$cant=$cant-2;
				for($i=0;$i<=$cant;$i++){
					
			?>
				<tr>
					<td><?php echo $data[$i]['idusuario']; ?></td>
					<td><?php echo $data[$i]['nombre']; ?></td>
					<td><?php echo $data[$i]['email']; ?></td>
					<td><?php echo $data[$i]['user']; ?></td>
					<td>
						<!--<a class="link_edit btn btn-primary" href="editar_usuario.php?idUsuario=<?php echo $data[$i]["idusuario"]; ?>">Editar</a>-->

					<?php if($data[$i]["idusuario"] != 1){//este id es el de admin  ?>
						<a class="link_delete btn btn-danger" href="eliminar_usuario.php?id=<?php echo $data[$i]["idusuario"]; ?>">Eliminar</a>
					<?php } ?>
						
					</td>
				</tr> 
			
		<?php 
				}

			}
		 ?>


		</table>
		
	
	
</body>
</html>