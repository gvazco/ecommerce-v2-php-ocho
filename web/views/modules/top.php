<?php 

/*=============================================
Datos de las redes sociales
=============================================*/

$url = "socials";
$method = "GET";
$fields = array();

$socials = CurlController::request($url,$method,$fields);

if($socials->status == 200){

	$socials = $socials->results;	

}


?>

<div class="container-fluid topColor">
	
	<div class="container">
		
		<div class="d-flex justify-content-between">
			
			<div class="p-2">
				
				<div class="d-flex justify-content-center">

					<?php foreach ($socials as $key => $value): ?>

						<div class="p-2">
							
							<a href="<?php echo $value->url_social ?>" target="_blank">
								
								<i class="<?php echo $value->icon_social ?> <?php echo $value->color_social ?>"></i>
							
							</a>

						</div>
						
					<?php endforeach ?>

				</div>

			</div>

			<div class="p-2">
				
				<div class="d-flex justify-content-center small">
					
					<div class="p-2">
						
						<a href="#" class="text-white">
							
							Ingresar
						
						</a>

					</div>

					<div class="p-2">

						|
						
					</div>

					<div class="p-2">
						
						<a href="#" class="text-white">
							
							Crear cuenta
						
						</a>

					</div>

					
				</div>

			</div>

		</div>


	</div>


</div>