<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Bootstrap css --> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="css/index.css">
	<title>Prueba NETmx</title>
</head>
<body>

<!-- modal bootstra -->
<div class="modal" tabindex="-1" role="dialog" style="display: none">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrar_modal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="cerrar_modal()">OK</button>
      </div>
    </div>
  </div>
</div>
<!-- modal bootstra -->

	<div class="container" style="margin-top: 5%">
		<div class="row">
			<div class="col-6 offset-3">
				<form id="form_login" style="display: block">
					<div class="form-group">
						<label for="correo_login">Dirección de correo</label>
						<input type="email" name="correo_login" class="form-control" placeholder="Introduce tu correo">
						<div class="alert alert-danger" id="alert_name_login" style="display: none">
						</div>
					</div>
					<div class="form-group">
						<label for="password_login">Password</label>
						<input type="password" name="password_login" class="form-control" placeholder="Introduce tu contraseña">
						<div class="alert alert-danger" id="alert_pwd_login" style="display: none">
						</div>
					</div>
					<a href="#" id="enlace_login" onclick="swtich_reg_login(this)" class="badge badge-light link_reg_login">
						No tengo cuenta
					</a>
					<button type="button" class="btn btn-primary" onclick="login(event)">
					Iniciar sesión
					</button>
				</form>
				<form id="form_registro" style="display: none">
					<div class="form-group">
						<label for="nombre_reg">Nombre</label>
						<input type="text" name="nombre_reg" class="form-control" placeholder="Introduce tu nombre">
						<div class="alert alert-danger" id="alert_name_reg" style="display: none">
						</div>
					</div>
					<div class="form-group">
						<label for="correo_reg">Dirección de correo</label>
						<input type="email" name="correo_reg" class="form-control" aria-describedby="ayudaCorreo" placeholder="Introduce tu correo">
						<small id="ayudaCorreo" class="form-text text-muted">
						<div class="alert alert-danger" id="alert_email_reg" style="display: none">
						</div>
							Nunca compartiremos su correo electrónico con nadie más.
						</small>
					</div>
					<div class="form-group">
						<label for="password_login">Password</label>
						<input type="password" name="password_reg" class="form-control" placeholder="Introduce tu contraseña">
						<div class="alert alert-danger" id="alert_pwd_reg" style="display: none">
						</div>
					</div>
					<a href="#" id="enlace_registro" onclick="swtich_reg_login(this)" class="badge badge-light link_reg_login">
						Ya tengo cuenta
					</a>
					<button type="button" class="btn btn-primary" onclick="registrar(event)">
					Registrar
					</button>
				</form>
			</div>
		</div>
	</div>

	<!-- Bootstrap Jquery -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- Bootstrap Jquery -->
	<script src="js/index.js"></script>
</body>
</html>