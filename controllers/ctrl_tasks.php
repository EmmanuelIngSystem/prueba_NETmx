<?php 

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include_once("../models/model_tasks.php");

	if (isset($_POST)) {
		$model = new Tasks();
		$respuesta_ctrl;
		if (!empty($_POST["titulo"]) && !empty($_POST["descripcion"])) {
			$titulo = $_POST["titulo"];
			$descripcion = $_POST["descripcion"];
			$respuesta_ctrl = $model->create_task($titulo, $descripcion);
			print_r(json_encode($respuesta_ctrl));
		}
		
		
		if (isset($_POST["udp"]) && $_POST["udp"] == "ok" && $_POST["id_tarea"]) {
			$id_tarea = $_POST["id_tarea"];
			$titulo_udp = $_POST["titulo_udp"];
			$descripcion_udp = $_POST["descripcion_udp"];
			$respuesta_ctrl = $model->update_task($id_tarea, $titulo_udp, $descripcion_udp);
			print_r(json_encode($respuesta_ctrl));
		}

		if (isset($_POST["id_tarea"]) && !isset($_POST["udp"])) {
			$id_tarea = $_POST["id_tarea"];
			$respuesta_ctrl = $model->get_task_by_id($id_tarea);
			print_r(json_encode($respuesta_ctrl));
		}

		if (isset($_POST["id_tarea_eliminar"])) {
			$id_tarea_eliminar = $_POST["id_tarea_eliminar"];
			$respuesta_ctrl = $model->delete_task($id_tarea_eliminar);
			print_r(json_encode($respuesta_ctrl));
		}

	}

 ?>