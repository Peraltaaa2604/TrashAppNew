<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
	include 'header_trabajador.php';
	?>
	<!-- Carousel -->
		<div id="demo" class="carousel slide" data-ride="carousel">

			<!-- Indicators -->
			<ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
				<li data-target="#demo" data-slide-to="1"></li>
				<li data-target="#demo" data-slide-to="2"></li>
				<li data-target="#demo" data-slide-to="3"></li>
			</ul>

			<!-- The slideshow -->

			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="images/camion1.jpg" alt="s11" width="1290" style="height: 75vh">
					<div class="carousel-caption">
						<h1>Bienvenidos</h1>
						<p></p>
					</div>
				</div>
				<div class="carousel-item">
					<img src="images/camion4.jpg" alt="s55" width="1290" style="height: 75vh">
				</div>
				<div class="carousel-item">
					<img src="images/camion5.jpg" alt="s3" width="1290" style="height: 75vh">
				</div>
				<div class="carousel-item">
					<img src="images/camion2.jpg" alt="s4" width="1290" style="height: 75vh">
				</div>
			</div>

			<!-- Left and right controls -->
			<a class="carousel-control-prev" href="#demo" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#demo" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>
		</div>

		
		<div class="container-fluid  bg-success text-success"><br></div>
		<div class="container-fluid p-3  bg-dark" style="color: #ffaf2a"><br>


		</div>

	<?php 
} else{
	echo "Inicia Sesion para acceder a este contenido.<br>";
	echo "<br><a href='Index.php'>Login</a>";
	echo "<br><br><a href='R_cliente.php'>Registrarme</a>";
	//header('Location: http://localhost/Nueva/Index.php');
} 
?>