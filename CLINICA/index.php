
<?php 
	
$alert = '';
session_start();


	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) || empty($_POST['contraseña']))
		{
			$alert = 'Ingrese su usuario y su contraseña';
		}else{

			require_once "conexion.php";
           
            $user=$_POST['usuario'];
            $alert = $_POST['contraseña'];
			$pass =$_POST['contraseña'];

			$query = getUserCount($user,$pass,1);
			
			$query2=getUserCount($user,$pass,0);
print_r($query);
			if($query > 0)
			{
				$data=$query2;
				print_r($data);
				//$alert=$data['4'];

				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['3'];
				$_SESSION['nombre'] = $data['5'];
				$_SESSION['email']  = $data['4'];
				$_SESSION['user']   = $data['1'];

				// $alert=$_SESSION['nombre'];
				header('location: sistema/');
			}else{
				$alert = 'El usuario o la contraseña son incorrectos';
				session_destroy();
			}


		}

	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login | Sistema Facturación</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<section id="container">
		
		<form action="" method="post">
			<br>
			<h3>Iniciar Sesión</h3>

			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="contraseña" placeholder="Contraseña">
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<input type="submit" value="INGRESAR">

		</form>

	</section>
</body>
</html>