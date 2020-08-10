let nombre_reg_req = document.getElementById("alert_name_reg"); 
let correo_reg_req = document.getElementById("alert_email_reg"); 
let password_reg_req = document.getElementById("alert_pwd_reg"); 

let correo_login_req = document.getElementById("alert_name_login"); 
let password_login_req = document.getElementById("alert_pwd_login"); 

let modal = document.querySelectorAll(".modal");
let texto_modal = document.querySelectorAll(".modal-body p"); 

function registrar(e){
	e.preventDefault();
	let form_registro = document.getElementById("form_registro");
	let datos_reg = new FormData(form_registro);

	if (datos_reg.get("nombre_reg")) {
	    nombre_reg_req.style.display = "none";
	    nombre_reg_req.innerHTML = "";
	}else{
	    nombre_reg_req.style.display = "block";
	    nombre_reg_req.innerHTML = "El nombre de usuario es requerido.";
	}

	if (datos_reg.get("correo_reg")) {
	    correo_reg_req.style.display = "none";
	    correo_reg_req.innerHTML = "";
	}else{
	    correo_reg_req.style.display = "block";
	    correo_reg_req.innerHTML = "El correo es requerido.";
	}

	if (datos_reg.get("password_reg")) {
	    password_reg_req.style.display = "none";
	    password_reg_req.innerHTML = "";
	}else{
	    password_reg_req.style.display = "block";
	    password_reg_req.innerHTML = "La contraseña es requerida.";
	}

	if (datos_reg.get("nombre_reg") && datos_reg.get("correo_reg") 
		&& datos_reg.get("password_reg")) {
	    fetch("controllers/ctrl_users.php", {
	      method: 'POST',
	      body: datos_reg
	    }).then(res => res.json())
	    .catch(error => {
	        console.error('Error:', error);
	    })
	    .then(response => {
	        console.log('Success:', response);
	        if (response.id_user) {
				let id_usuario = response.id_user;

				document.getElementById("form_registro").reset();
				texto_modal.innerHTML = "Se han guardado sus datos exitosamente.";
				modal.style.display = "block";
	        }
	    });
	}
}

function login(e){
	e.preventDefault();
	let form_login = document.getElementById("form_login");
	let datos_login = new FormData(form_login);

	if (datos_login.get("correo_login")) {
	    correo_login_req.style.display = "none";
	    correo_login_req.innerHTML = "";
	}else{
	    correo_login_req.style.display = "block";
	    correo_login_req.innerHTML = "El correo es requerido.";
	}

	if (datos_login.get("password_login")) {
	    password_login_req.style.display = "none";
	    password_login_req.innerHTML = "";
	}else{
	    password_login_req.style.display = "block";
	    password_login_req.innerHTML = "La contraseña es requerida.";
	}

	if (datos_login.get("correo_login") && datos_login.get("password_login")) {
	    fetch("controllers/ctrl_users.php", {
	      method: 'POST',
	      body: datos_login
	    }).then(res => res.json())
	    .catch(error => {
	        console.error('Error:', error);
	    })
	    .then(response => {
	        console.log('Success:', response);
	        if (response.query) {
				let datos_usuario = response.query;
				document.getElementById("form_login").reset();
				window.location.href = "views/home.php";
	        }
	    });
	}
}

function swtich_reg_login(elemento){
	let id = elemento.id;
	let form_registro  = document.getElementById("form_registro");
	let form_login = document.getElementById("form_login");
	switch(id){
		case "enlace_login":
			form_registro.style.display = "block";
			form_login.style.display = "none";
		break;
		case "enlace_registro":
			form_login.style.display = "block";
			form_registro.style.display = "none";
		break;
	}
}