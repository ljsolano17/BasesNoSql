<?php

	session_start();
	print_r($_SESSION['nombre']);


	include "../connection.php";
	require_once '../pdf/vendor2/autoload.php';
	//require_once '../vendor/dompdf/dompdf';
	use Dompdf\Dompdf;



		$codCliente = $_REQUEST['cl'];
		$noFactura = $_REQUEST['f'];
		print_r($codCliente);
		$_SESSION['pruebaid']=$codCliente;

		
		$infoFactura=LookUp(2,$codCliente);
		$infoProductos=LookUp(1,$codCliente);
		
		$infoCompleta=array();
 
		for($i=0;$i<count($infoFactura);$i++){
			if($infoFactura[$i]['id']==$codCliente){
           $infoCompleta=$infoFactura[$i];

			}
		}
		$idSala=$infoCompleta['idSala'];
		$salas=findData(0,"sala",$idSala);

		//Son .findOne(), entonces solo traen un resultado array que esta en la posicion 0
         //  print_r($infoCompleta);
			$_SESSION['NFactura']=$noFactura;
			$_SESSION['idPaciente']=$codCliente;
			$_SESSION['NombrePaciente']=$infoCompleta['nombre'];
			$_SESSION['CorreoElectronico']=$infoCompleta['correo'];
			$_SESSION['Doctor']=$infoCompleta['idDoctor'][0]['NOMBRE'];
			$_SESSION['FechaCita']=$infoCompleta['fecha'];
			$_SESSION['Cedula']=$infoCompleta['cedula'];
			$_SESSION['DatosDoctor']=$infoCompleta['idDoctor'][0]['departamentos'][0]['nombre_depart'];
			$_SESSION['CorreoDoctor']=$infoCompleta['idDoctor'][0]['correo'];
			$_SESSION['Descripcion']=$infoCompleta['descripcion'];
			$_SESSION['HoraCita']=$infoCompleta['hora'];
			$today = date('d-m-Y');
			$_SESSION['FechaGenerarFactura']=$today;
			
			insertarFactura($codCliente);

           cambiarEstadoPaciente($codCliente);

			ob_start();
			include(dirname('__FILE__').'/factura.php');
			
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			ob_get_clean();
			$dompdf->stream('factura_'.$noFactura.'.pdf',array('Attachment'=>0));
			exit;
	//	}
	//}

?>