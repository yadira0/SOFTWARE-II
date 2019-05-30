<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['name'])) {
           $errors[] = "Nombre vacío";
        } else if (empty($_POST['objetivo'])){
			$errors[] = "Objetivo vacío";
		} else if (empty($_POST['alcance'])){
			$errors[] = "alcance vacío";
		} else if (empty($_POST['modalidad'])){
			$errors[] = "modalidad vacío";
		} else if (empty($_POST['fecha'])){
			$errors[] = "fecha vacía";
		}

		 else if (
			!empty($_POST['name']) &&
			!empty($_POST['objetivo']) &&
			!empty($_POST['alcance']) &&
			!empty($_POST['modalidad']) &&
			!empty($_POST['fecha'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$name = $_POST["name"];
		$objetivo = $_POST["objetivo"];
		$alcance = $_POST["alcance"];
		$modalidad = $_POST["modalidad"];
		$fecha=date("Y-m-d H:i:s");
		//$fecha = $_POST["fecha"];


		$sql="INSERT INTO project (name, objetivo, alcance, modalidad, fecha) value (\"$name\",\"$objetivo\",
		\"$alcance\",\"$modalidad\",\"$fecha\")";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Tu proyecto ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>