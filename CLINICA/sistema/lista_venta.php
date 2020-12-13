<?php 
	session_start();
	include "connection.php";	
	$alert = '';
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

  <title>Alpha</title>
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
	<section id="container">
		
		<h1>Pacientes a cobrar</h1>

		<table class="table table-bordered table-hover table-responsive">
			<tr>
				<th>ID</th>
				<th>Nombre Paciente</th>
				<th>Cedula</th>
                <th>Fecha</th>
			
				<th>Atendido Por</th>
				<th>Acciones</th>
			</tr>
		<?php 
			
			 $cant = getPacienteCantidad();
			 $query = findData(-1,"paciente",0);
			// $query2 = findData(-1,"medicinas",null);
			
		//	 $query3 = findData(-1,"farmacia",null);
			 

			//$_SESSION['PRECIOS']=1;
			//json_encode($query);
			//print_r($data);



			//print_r($query);
			//print_r($cant);
			//$alert=$cant;


			//Ingresar los datos del paciente a la coleccion de facturas para cargar los datos de la factura desde ahi
			
			
			if($cant > 0){

				$cant--;
				for($i=0;$i<=$cant;$i++){
		if($query[$i]['Estado']=="Pendiente"){
				
			?>
				<tr >
					<td><?php echo $query[$i]['id']; ?></td>
					<td><?php echo $query[$i]['nombre']; ?></td>
					<td><?php echo $query[$i]['cedula']; ?></td>
					<td><?php echo $query[$i]['fecha']; ?></td>
					
					<td><?php echo $_SESSION['nombre']; ?></td>
					
					
					<td>	
						<a class="btn btn-danger" href="factura/generaFactura.php?cl=<?php echo $query[$i]['id'];?>&f=<?php echo $query[$i]['id']; ?>">Imprimir
                        </a>
					</td>	
				</tr>
			
		<?php 
				}
				}

			}
		 ?>


		</table>
		<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
	</section>
	
</body>
</html>
