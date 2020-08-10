<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
 ?>
<?php session_start(); ?>
<?php $idt = $_GET["idt"]; ?>
<?php if(isset($_SESSION["user"])) : ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Bootstrap css --> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="css/tarea.css">
	<title>Tarea</title>
</head>
<body>
	<div class="Box" style="display: none">
		<span style="margin-left: 42%"></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
	</div>

	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="home.php">Inicio<span class="sr-only">(current)</span></a>
				</li>
			</ul>
			<ul class="navbar-nav nav-right">
				<li class="nav-item">
					<a href="../controllers/ctrl_logout.php" id="boton_udp" type="button" class="btn btn-primary" >
						Cerrar sesión
					</a>
				</li>
			</ul>
		</div>
	</nav>

	<?php include_once("../models/model_tasks.php"); ?>
	<?php 
		$modelo = new Tasks();
		$id_task = $idt;
		$tarea = $modelo->get_task_by_id($id_task);

		$html = "<div class='col-10 offset-1' style='padding: 2%'>";
		
		$html .= "<div class='row'>";
		$html .= "<div class='col-12'>";
		$html .= "<h3>";
		$html .= $tarea["titulo"];
		$html .= "</h3>";
		$html .= "</div>";
		$html .= "</div>";

		$html .= "<div class='row' style='margin-top: 2%'>";
		$html .= "<div class='col-12'>";
		$html .= $tarea["descripcion"];
		$html .= "</div>";
		$html .= "</div>";

		$boton_html_estatus = "";
		$estatus = $tarea["estatus"];
		switch ($estatus) {
			case 'abierta':
				$boton_html_estatus .= "<button type='button' class='btn btn-danger'>";
				$boton_html_estatus .= $estatus;
				$boton_html_estatus .= "</button>";
				break;
			case 'en proceso':
				$boton_html_estatus .= "<button type='button' class='btn btn-warning'>";
				$boton_html_estatus .= $estatus;
				$boton_html_estatus .= "</button>";
				break;
			case 'cerrada':
				$boton_html_estatus .= "<button type='button' class='btn btn-success'>";
				$boton_html_estatus .= $estatus;
				$boton_html_estatus .= "</button>";
				break;
		}

		$html .= "<div class='row' style='margin-top: 2%'>";
		$html .= "<div class='col-6'>";
		$html .= $boton_html_estatus;
		$html .= "</div>";

		$html .= "<div class='col-6'>";
		$html .= $tarea["fecha_alta"];
		$html .= "</div>";
		$html .= "</div>";

		$html .= "</div>";
		$html .= "</div>";
		echo $html;
	 ?>
</body>
	<!-- Bootstrap Jquery -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- Bootstrap Jquery -->
	<script src="js/tarea.js"></script>
</html>
<?php else : ?>
	<?php header('Location: ../'); ?>
<?php endif;  ?>
