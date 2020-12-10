<?php
	$total 		= 0;
 //print_r($configuracion); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</head>
<body>

         <div >
                <div>
					<span >Factura</span>
					<p>No. Factura: <strong><?php echo $_SESSION['NFactura']; ?></strong></p>
					<p>Fecha: <?php print_r( $_SESSION['FechaGenerarFactura']); ?></p>
					
					<p>Atendido Por: <?php echo $_SESSION['nombre']; ?></p>

					

				<!--

					<p>ES PRUEBA DE FARMACIA: <?//php print_r($_SESSION['prueba']); ?> "termina aca"</p>
				-->
				</div>
			
	<table class="table table-bordered table-hover table-responsive">
		<tr>
			<td>
			<div class="row">
	
	<span >DATOS DEL DOCTOR</span><br><br>
                <div  class="col-xl-4">
				Nombre del doctor:<br>
				<?php 
	                echo $_SESSION['Doctor'];
	            ?>
			   <br><br>
                </div>
  
                <div  class="col-xl-4">
				Departamento del doctor:<br>
				<?php 
	                echo $_SESSION['DatosDoctor'];
				?>
				<br><br>
                </div>

                <div  class="col-xl-4">
				 
				Correo Electronico:<br>
				<?php 
	                echo $_SESSION['CorreoDoctor'];
				?>
				<br><br>
                 </div>

</div>
			</td>
			<td>
		
			<div class="row">
	
	<span >DATOS DEL PACIENTE</span><br><br>
                <div  class="col-xl-4">
				Nombre del paciente:<br>
				<?php 
	                echo $_SESSION['NombrePaciente'];
	            ?>
			   <br><br>
                </div>
  
                <div  class="col-xl-4">
				Cedula:<br>
				<?php 
	                echo $_SESSION['Cedula'];
				?>
				<br><br>
                </div>

                <div  class="col-xl-4">
				 
				Correo Electronico:<br>
				<?php 
	                echo $_SESSION['CorreoElectronico'];
				?>
				<br><br>
                 </div>

</div>
			</td>
			<td>
		
		<div class="row">

<span >DATOS DE LA CITA</span><br><br>
			<div  class="col-xl-4">
			Fecha de la cita:<br>
			<?php 
				echo $_SESSION['FechaCita'];
			?>
		   <br><br>
			</div>
			<div  class="col-xl-4">
			Hora de la cita:<br>
			<?php 
				echo $_SESSION['HoraCita'];
			?> h
		   <br><br>
			</div>
			<div  class="col-xl-4">
			Sala:<br>
			<?php 
				echo $_SESSION['Sala'];
			?>
			<br><br>
			</div>

			

</div>
		</td>
			
			
		</tr>
		
	</table>


	<table class='table table-bordered table-hover table-responsive'>
			<thead>
				<tr>
				<th width="50px">Nombre</th>
				<th width="50px">Cant.</th>
				<th>Descripción del Medicamento</th>	
				<th width="50px">Comentario del Doctor</th>	
				<th width="150px">Precio Unitario.</th>
				
					
				</tr>
			</thead>
			<tbody >

			<?php
			if(count($infoProductos)==0){
			?>	<tr>
			
				<td><?php print("Consulta Medica: 35000")?></td>
				
			</tr>
			<?php } ?>
			<?php
              for($i=0;$i<count($infoProductos);$i++){

            for($x=0;$x<count($infoProductos[$i]['receta']);$x++){

				

          
			 ?>
			 
				<tr>
					<td><?php print_r( $infoProductos[$i]['datos'][$x]['nombre']);?></td>
					<td><?php print_r( $infoProductos[$i]['receta'][$x]['cantidad']);?></td>
					<td><?php print_r( $infoProductos[$i]['datos'][$x]['descripcion']);?></td>
					<td><?php print_r( $infoProductos[$i]['receta'][$x]['comentario']);?></td>				
					<td><?php print_r( $infoProductos[$i]['datos'][$x]['precio']); ?></td>
					
					
				</tr>
			<?php
						$precio_total = $infoProductos[$i]['receta'][$x]['cantidad']*$infoProductos[$i]['datos'][$x]['precio'];
						$total = round($total + $precio_total, 2);
			
					}
     	}
				
//print_r($infoReceta);
			?>
			</tbody>
			<tfoot>
				<tr>
					<td><span>TOTAL</span></td>
					<td><span><?php echo $total+35000// echo $_SESSION['PrecioCita']*$_SESSION['PrecioMedicamentos']; ?></span></td>
				</tr>
		</tfoot>
	</table>
	<div>
		<p>Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
		<h4>¡Gracias!</h4>
	</div>

</div>

</body>
</html>