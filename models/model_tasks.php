<?php 

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	class Tasks{
		
		private $connect_db, $username = "root", $password = "";
		public $data_response = array();
		public $user;

		function __construct(){
			// session_start();
			// verify_session();
		    if(!isset($_SESSION)) {
		        session_start();
		    }
			$this->user = $_SESSION["user"];
			$this->connect_db = new PDO("mysql:host=localhost;dbname=prueba_nextmx; charset=utf8",$this->username, $this->password);
			$this->connect_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		function create_task($title, $description){
			try{
				$status = "abierta";
				$datetime_current = date("Y-m-d H:i:s");
				$save_task = $this->connect_db->prepare("INSERT INTO tareas 
										(id_usuario, titulo, descripcion, estatus, fecha_alta) VALUES(?, ?, ?, ?, ?)");
				$save_task->bindParam(1 , $this->user["id"], PDO::PARAM_INT);
				$save_task->bindParam(2 , $title, PDO::PARAM_STR);
				$save_task->bindParam(3 , $description, PDO::PARAM_STR);
				$save_task->bindParam(4 , $status, PDO::PARAM_STR);
				$save_task->bindParam(5 , $datetime_current, PDO::PARAM_STR);
				$save_task->execute();
				$id_task = $this->connect_db->lastInsertId();
				$data_response["id_task"] = $id_task;
			}catch(PDOException $e){
				$error_query = $e->getMessage();
				$data_response["query_error"] = $error_query;
			}
			return $data_response;
		}

		function update_task($id_task, $title_udp, $description_udp){
			try{
				$update_task = $this->connect_db->prepare("UPDATE tareas 
															SET titulo = :titulo, 
															descripcion = :descripcion
															WHERE id = :id_tarea");
				$update_task->bindParam(":titulo" , $title_udp, PDO::PARAM_STR);
				$update_task->bindParam(":descripcion" , $description_udp, PDO::PARAM_STR);
				$update_task->bindParam(":id_tarea" , $id_task, PDO::PARAM_INT);
				$update_task->execute();
				$data_response["response_udp_task"] = "ok_udp_task";
			}catch(PDOException $e){
				$error_query = $e->getMessage();
				$data_response["query_error"] = $error_query;
			}
			return $data_response;
		}

		function delete_task($id_task_to_delete){
			try{
				$update_task = $this->connect_db->prepare("DELETE FROM tareas 
															WHERE id = :id_tarea");
				$update_task->bindParam(":id_tarea" , $id_task_to_delete, PDO::PARAM_INT);
				$update_task->execute();
				$data_response["response_delete_task"] = "ok_delete_task";
			}catch(PDOException $e){
				$error_query = $e->getMessage();
				$data_response["query_error"] = $error_query;
			}
			return $data_response;
		}

		function get_task_by_id($id_task){
			try{
				$query_task = $this->connect_db->prepare("SELECT id, id_usuario, titulo, 
													descripcion, estatus, fecha_alta 
													FROM tareas 
													WHERE id = :id_tarea");
				$query_task->bindParam(':id_tarea', $id_task);
				$query_task->execute();
				$task = $query_task->fetch(PDO::FETCH_ASSOC);
				if (count($task) >= 1) {
					$data_response = $task;
				}else{
					$data_response = "no_task_user";
				}
			}catch(PDOException $e){
				$error_query = $e->getMessage();
				$data_response["query_error"] = $error_query;
			}
			return $task;
		}

		function get_tasks_user(){
			try{
				$query_tasks = $this->connect_db->prepare("SELECT u.id AS id_usuario, 
													u.nombre, u.correo, u.password, 
													t.id AS id_tarea, t.id_usuario, t.titulo, 
													t.descripcion, t.estatus, t.fecha_alta 
													FROM usuarios AS u INNER JOIN tareas AS t 
													ON u.id = t.id_usuario 
													WHERE t.id_usuario = :id_usuario");
				$query_tasks->bindParam(':id_usuario', $this->user["id"]);
				$query_tasks->execute();
				$tasks_user = $query_tasks->fetchAll(PDO::FETCH_ASSOC);
				if (count($tasks_user) >= 1) {
					$data_response = $tasks_user;
				}else{
					$data_response = "no_tasks_user";
				}
			}catch(PDOException $e){
				$error_query = $e->getMessage();
				$data_response["query_error"] = $error_query;
			}
			return $data_response;
		}

		/* function verify_session(){

		} */

	}

 ?>