<?php 

	include "db.php";


					$consulta = "SELECT * FROM chat ORDER BY id DESC";
					$ejecutar = $conexion->query($consulta);

					while ($fila = $ejecutar->fetch_array()):

?>
				<div id="datos-chat">
					<span style="color: blue;">     <?php echo $fila['nombre'];   ?>: </span>
					<span style="color: #848484;">	<?php echo $fila['mensaje']   ;?> </span><br>
					<span style="color: #848484;"> 

						<a href="img/<?php echo $fila['imagen'];?>" 


							target="popup-example" onClick="javascript:open('', 'popup-example', 'height=400,width=400,resizable=no')" 


							>
						<img 

							src="img/<?php echo $fila['imagen'];?>" 
							height='20' 
							width ='20'
							alt="<?php echo $fila['imagen'] ?>"

						/>	 
						</a>

					</span>
					
					<span style="float: right;">    <?php echo formatearFecha($fila['fecha']);   ?></span>
				</div>
				<?php

					endwhile;

				?>