<?php include('../header.php');
	if(isset($_POST["Consulta"])){
		$mensaje = "
		<h1 style='text-align: center;'>Contacto</h1>
		<p>
		Hola ".$_POST["fname"]." ".$_POST["lname"].", gracias por contactarnos.</p>
		<p>Hemos recibido el siguiente mensaje:</p>
		<p>".$_POST["comment"]."</p>
		<p>Le responderemos en breve.</p>
		<h4>Saludos cordiales, TINUSBOOKS.</h4>
		";
		crearEmail("Contacto",$mensaje,$_POST["email"]);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactanos</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="/js/validarForms.js"></script>
    <link rel="stylesheet" href="../../css/forms.css">
    
</head>

<body>
<section class="formulario">
	<div class="container contact">
		<div class="row">
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-3 contenedorMsj">
						<div class="contact-info">
							<img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
							<h2>Contactános</h2>
							<h4> Tu voz es muy importante </h4>
            </div>
          </div>
          <div class="col-sm-12 col-md-8 col-lg-9 contenedorContacto">
            <div class="contact-form">
              <div class="form-group">
                <div class="form-floating mb-2">      
                  <input type="text" class="form-control" id="fname" placeholder="Ingresa tu nombre" name="fname" onclick="validNameFormContact()">
                  <label for="fname">Nombre:</label>
                  <p style="display:none; color:black;" id="textErrfname"> Nombre no valido! Caracteres numericos no validos.</p>
                </div>
                <div class="form-floating mb-2">      
                  <input type="text" class="form-control" id="lname" placeholder="Ingresa tu apellido" name="lname" onclick="validlNameFormContact()">
                  <label for="lname">Apellido:</label>
                  <p style="display:none; color:black;" id="textErrlname"> Apellido no valido! Caracteres numericos no validos.</p>
                </div>
						<div class="form-floating mb-2">      
							<input type="email" class="form-control" id="email" placeholder="Ingresa tu email" name="email">
							<label for="email">Email:</label>
								</div>
							</div>
							<div class="form-group">
								<div class="form-floating mb-2">      
									<textarea required class="form-control" style="height: 20ch;" placeholder="Comentario:" name="comment" id="comment"></textarea>
									<label for="comment">Comentario:</label>
								</div>
							<div class="form-group">        
								<div class="text-center">
									<button type="submit" class="btn botonP" name="Consulta" id="boton-contacto">Enviar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>	
		</div>
	</div>
</section>

<section class="informacion">
    <h3>Conoce a nuestros distribuidores</h3>
    <h3 style="font-weight: lighter">Encuentra una sucursal</h3>
    <p>Distribuidor Aguascalientes Sur</p>
    <p> Av. Las Americas #500</p>
    <p> Aguascalientes, 1604</p><br><br>

    <p>Distribuidor Rincón de Romos</p>
    <p>Margaritas #122</p>
    <p>Aguascalientes, 06140</p><br><br>

    <p>Distribuidor Aguascalientes Norte</p>
    <p> Av. Siglo XXI #400</p>
    <p>Aguascalientes, 06140</p>
</section>

<!-- Barra descuento  --> 
<section class="descuento">
    <img class="zoom" src="../../media/indexmedia/linear.jpg" alt="">
    
    <h2 id="obtener">¡Obten 20% en toda la tienda!</h2>
    <h5 id="codigo" >Código: apertura20</h5>
</section>

<!-- Mapa --> 
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3702.233231530003!2d-102.29467398539583!3d21.887092785539757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8429ee6733bab0cb%3A0x64f5f203073c9e2a!2sCalle%20Gral.%20Ignacio%20Zaragoza%2C%20Zona%20Centro%2C%20Aguascalientes%2C%20Ags.!5e0!3m2!1ses-419!2smx!4v1670296660311!5m2!1ses-419!2smx" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<!-- Termina mapa -->

</body>
</html>
<?php
    include_once("../PHP/footer.php");
?>