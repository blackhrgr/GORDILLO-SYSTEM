<?php
	$alert ='' ;
	session_start();

if (!empty($_SESSION['active']))
{
	header('location:sistema/index.php');
}else{

	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) || empty($_POST['clave']))
		{
			$alert = 'Ingrese su usuario y clave';

		}else{

			
			require_once "modelo/conexion.php";
			$usuario= mysqli_real_escape_string($conexion,$_POST['usuario']);
			$clave= md5(mysqli_real_escape_string($conexion,$_POST['clave']));

			$query = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario='$usuario' AND clave= '$clave'");
			mysqli_close($conexion);
			$result = mysqli_num_rows($query);

			if($result > 0)
			{
				$data = mysqli_fetch_array($query);
				
				$_SESSION['active']= true;
				$_SESSION['idusuario']= $data['idusuario'];
				$_SESSION['nombre']= $data['nombre'];
				$_SESSION['correo']= $data['correo'];
				$_SESSION['usuario']= $data['usuario'];
				$_SESSION['rol']= $data['rol'];
				

				header('location:sistema/index.php');

			}else{

				$alert='El Usuario y Clave son Incorrectos 
				Verifique que esten Bien Escritos';
				session_destroy();
				
			}

		}
	
	}
}
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1,minimum-scale=1">
		<link rel="stylesheet" href = "css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">


 
	<title>login | del | Sistema</title>

	


</head>
<body>
		<section id="container">
			
		<form action= "" method="POST">
			<h3> Inicia Sesion </h3>
			<img src="img/login2.jfif"  atl="login">

			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<div class="alert"><?php echo isset($alert)? $alert : '';?></div> 
			<input type="submit" value="INGRESAR">



		</section>

</body>
</html>