<?php
include "db.php";
include "class.upload.php";
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>WebAPP Chat</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">

	<script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();

			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}

			req.open('GET', 'chat.php', true);
			req.send();
		}

		//linea que hace que se refreseque la pagina cada segundo
		setInterval(function(){ajax();}, 1000);
	</script>
</head>
<body onload="ajax();">

<div id="container">
	<div id="contenedor">
		<div class=".col-sm"><div id="caja-chat">
			<div id="chat"></div>
		</div></div>

		<form enctype="multipart/form-data" method="POST" action="index.php">
			<br>
			<b><?php echo $_POST["nombre"] ?></b>
			
			<input type="hidden" name="nombre" placeholder="" value="<?php echo $_POST["nombre"] ?>" readonly=""><br>

			<input class="texto" name="mensaje" placeholder="Escribe..." autofocus="autofocus" maxlength="150">
			<input id='image' type="file" name="image" size="30">		
			<input type="submit" name="enviar" value="Enviar">
		</form>

		<?php



		$image = new Upload($_FILES["image"]);
			if($image->uploaded){
				$image->Process("img/");
					if($image->processed){
						echo "Upload Success";
					}else{
						echo "Error: ".$image->error;
						}
				}

		echo 'ok'. $image->file_dst_name;
		$upimg = $image->file_dst_name;


			if (isset($_POST['enviar'])) {
				
				$nombre  = $_POST['nombre'];
				$mensaje = $_POST['mensaje'];

				$consulta = "INSERT INTO chat (nombre, mensaje, imagen) VALUES ('$nombre', '$mensaje', '$upimg')";

				$ejecutar = $conexion->query($consulta);

				
			}

		?>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>



