<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
 ?>
<?php session_start(); ?>
<?php if(isset($_SESSION["user"])) : ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Bootstrap css --> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Página de inicio</title>
</head>
<body>
	<!-- modal guardar tarea -->
	<div class="modal fade" id="modalNuevaTarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Formulario nueva tarea</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form id="form_tarea">
				<div class="form-group">
					<label for="titulo">Titulo</label>
					<input type="text" name="titulo" class="form-control" placeholder="Introduce el titulo">
					<div class="alert alert-danger" id="alert_titulo" style="display: none">
					</div>
				</div>
				<div class="form-group">
					<label for="descripcion">Descripción</label>
					<textarea type="text" name="descripcion" class="form-control" placeholder="Introduce la descripción">
					</textarea>
					<div class="alert alert-danger" id="alert_descripcion" style="display: none">
					</div>
				</div>
	        	<button type="button" class="btn btn-primary" style="float: right" onclick="guarda_tarea(event);">
	        	Guardar
	        	</button>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- modal guardar tarea -->

	<!-- modal actualizar -->
	<div id="modal_actualizar" class="modal" tabindex="-1" style="display: none; background: rgba(0,0,0,0.5);">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrar_modal();">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<form id="form_tarea_udp">
				<div class="form-group">
					<label for="titulo_udp">Titulo</label>
					<input type="text" name="titulo_udp" class="form-control">
					<div class="alert alert-danger" id="alert_titulo_udp" style="display: none">
					</div>
				</div>
				<div class="form-group">
					<label for="descripcion_udp">Descripción</label>
					<textarea type="text" name="descripcion_udp" class="form-control">
					</textarea>
					<div class="alert alert-danger" id="alert_descripcion_udp" style="display: none">
					</div>
				</div>
				<div id="inpt_id_tarea"></div>
	        	<button id="boton_udp" type="button" class="btn btn-primary" style="float: right" onclick="actualizar_tarea(event);">
	        		Modificar
	        	</button>
	      	</form>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- modal actualizar -->

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

	<div class="container" style="margin-top: 5%">
		<div class="row">
			<div class="col-10 offset-1">
				<h1>
					Bienvenido <?php echo $_SESSION["user"]["nombre"]; ?> al panel principal
				</h1>
			</div>
			<div class="col-10 offset-1">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNuevaTarea" style="float: right">
					Agregar nueva tarea
				</button>
			</div>
			<div class="col-10 offset-1" style="padding: 2%">
				<?php include_once("../models/model_tasks.php"); ?>
				<?php 

					$modelo = new Tasks();
					$tareas_usuario = $modelo->get_tasks_user();
					if (is_array($tareas_usuario)) {
						$tareas_html = "";
						$tareas_html = "<div class='row'>";

						$tareas_html .= "<div class='col-4' style='text-align: center; margin-bottom: 1%'>";
						$tareas_html .= "TITULO";
						$tareas_html .= "</div>";

						$tareas_html .= "<div class='col-4' style='text-align: center; margin-bottom: 1%'>";
						$tareas_html .= "ENLACE";
						$tareas_html .= "</div>";

						$tareas_html .= "<div class='col-2' style='text-align: center; margin-bottom: 1%'>";
						$tareas_html .= "ESTATUS";
						$tareas_html .= "</div>";

						$tareas_html .= "<div class='col-2' style='text-align: center; margin-bottom: 1%'>";
						$tareas_html .= "ACCIÓN";
						$tareas_html .= "</div>";

						foreach ($tareas_usuario as $key => $tarea_usuario) {
							$tareas_html .= "<div class='col-4'>";
							$tareas_html .= $tarea_usuario["titulo"];
							$tareas_html .= "</div>";							

							$tareas_html .= "<div class='col-4'>";
							$tareas_html .= "<a target='_blank' style='display: block; text-align: center' href='tarea.php?idt=".$tarea_usuario["id_tarea"]."'>Ver detalles</a>";
							$tareas_html .= "</div>";

							$estatus = $tarea_usuario["estatus"];
							$boton_html_estatus = "";

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

							$tareas_html .= "<div class='col-2'>";
							$tareas_html .= "<p style='text-align: center'>";

							$tareas_html .= $boton_html_estatus;

							$tareas_html .= "</p>";
							$tareas_html .= "</div>";

							$tareas_html .= "<div class='col-2' style='text-align: center; margin-bottom: 1%'>";
							$boton_editar = "<svg width='1.5em' height='1.5em' viewBox='0 0 16 16' class='bi bi-pencil-square' fill='currentColor' xmlns='http://www.w3.org/2000/svg' style='color: #28a745; cursor: pointer' data-id_t='".$tarea_usuario["id_tarea"]."' onclick='abrir_modal_udp(this);'>
							  <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
							  <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
							</svg>";

							$boton_eliminar = "<svg width='1.5em' height='1.5em' viewBox='0 0 16 16' class='bi bi-trash' fill='currentColor' xmlns='http://www.w3.org/2000/svg' style='color: #dc3545; cursor: pointer' data-id_t_eliminar='".$tarea_usuario["id_tarea"]."' onclick='eliminar_tarea(this);'>
							  <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
							  <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
							</svg>";
							$tareas_html .= $boton_editar;
							$tareas_html .= $boton_eliminar;
							$tareas_html .= "</div>";
						}
						$tareas_html .= "</div>";
						echo $tareas_html;
					}else if(is_string($tareas_usuario) 
							&& !isset($tareas_usuario["query_error"])){
						$menesaje_html = "";
						$menesaje_html .= "<div class='row'>";
						$menesaje_html .= "<div class='col-12'>";
						$menesaje_html .= "<h5>Aun no tienes tareas.</h5>";
						$menesaje_html .= "</div>";
						$menesaje_html .= "</div>";
						echo $menesaje_html;
					}
				 ?>
			</div>
		</div>
	</div>

	<!-- Bootstrap Jquery -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- Bootstrap Jquery -->

	<!-- swtee alert js -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!-- swtee alert js -->

	<script src="js/home.js"></script>

</body>
</html>
<?php else : ?>
	<?php header('Location: ../'); ?>
<?php endif;  ?>