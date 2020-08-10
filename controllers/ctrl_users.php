<?php 

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include_once("../models/model_users.php");

	if (isset($_POST)) {
		$respuesta_ctrl;

		if (!empty($_POST["nombre_reg"]) && !empty($_POST["correo_reg"]) 
			&& !empty($_POST["password_reg"])) {
        	$model_user = new Users();
			$nombre = $_POST["nombre_reg"];
			$correo = $_POST["correo_reg"];
			$password = $_POST["password_reg"];
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
        	$respuesta_ctrl = $model_user->create_user($nombre, $correo, $password_hash);
        	print_r(json_encode($respuesta_ctrl));
		}

		if (!empty($_POST["correo_login"]) && !empty($_POST["password_login"])) {
        	$model_user = new Users();
			$correo = $_POST["correo_login"];
			$password = $_POST["password_login"];
			$respuesta_ctrl = $model_user->login_user($correo, $password);
			if (isset($respuesta_ctrl["query"])) {
				session_start();
				$_SESSION["user"] = $respuesta_ctrl["query"];
			}
			print_r(json_encode($respuesta_ctrl));
		}

	}

 ?>