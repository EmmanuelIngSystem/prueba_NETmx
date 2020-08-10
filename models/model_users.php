<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	class Users{

		private $connect_db, $username = "root", $password = "";
		public $data_response = array();
		
		function __construct(){
			$this->connect_db = new PDO("mysql:host=localhost;dbname=prueba_nextmx; charset=utf8",$this->username, $this->password);
			$this->connect_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		function create_user($name, $email, $password){
			try{
				$save_user = $this->connect_db->prepare("INSERT INTO usuarios 
										(nombre, correo, password) VALUES(?, ?, ?)");
				$save_user->bindParam(1 , $name, PDO::PARAM_STR);
				$save_user->bindParam(2 , $email, PDO::PARAM_STR);
				$save_user->bindParam(3 , $password, PDO::PARAM_STR);
				$save_user->execute();
				$id_user = $this->connect_db->lastInsertId();
				$data_response["id_user"] = $id_user;
			}catch(PDOException $e){
				$error_query = $e->getMessage();
				$data_response["status_query"] = $error_query;
			}
			return $data_response;
		}

		function login_user($email, $password){
			try{
				$query_login = $this->connect_db->prepare("SELECT id, nombre, correo, password 
													FROM usuarios WHERE correo = :correo");
				$query_login->bindParam(':correo', $email);
				$query_login->execute();
				$user_email = $query_login->fetch(PDO::FETCH_ASSOC);
				if (count($user_email) > 1) {
					if (password_verify($password, $user_email["password"])) {
						$sql_preparada = $this->connect_db->prepare("SELECT id, nombre, correo, password FROM usuarios WHERE password = :password");
						$sql_preparada->bindParam(':password', $user_email["password"]);
						$sql_preparada->execute();
						$data_response["query"] = $sql_preparada->fetch(PDO::FETCH_ASSOC);
					}else{
						$data_response["status_query_pwd"] = "no_password";
					}
				}else{
					$data_response["status_query_email"] = "no_correo";
				}
			}catch(PDOException $e){
				$error_query = $e->getMessage();
				$data_response["status_query"] = $error_query;
			}
			return $data_response;
		}

	}

 ?>