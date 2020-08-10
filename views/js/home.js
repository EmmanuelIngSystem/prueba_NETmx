let titulo_reg_req = document.getElementById("alert_titulo");
let descripcion_reg_req = document.getElementById("alert_descripcion");
let msj_guardado_exitoso = document.getElementById("msj_guardado_exitoso");
let modal_actualizar = document.getElementById("modal_actualizar");

let inpt_id_tarea = document.getElementById("inpt_id_tarea");

$('#modalNuevaTarea').on('shown.bs.modal', function () {
	console.log("se abrio la modal...");
	document.getElementsByName("titulo")[0].value = "";
	document.getElementsByName("descripcion")[0].value = "";
});

function guarda_tarea(e){
	e.preventDefault();
	let form_tarea = document.getElementById("form_tarea");
	let datos_tarea = new FormData(form_tarea);

	if (datos_tarea.get("titulo")) {
	    titulo_reg_req.style.display = "none";
	    titulo_reg_req.innerHTML = "";
	}else{
	    titulo_reg_req.style.display = "block";
	    titulo_reg_req.innerHTML = "El titulo es requerido.";
	}

	if (datos_tarea.get("descripcion")) {
	    descripcion_reg_req.style.display = "none";
	    descripcion_reg_req.innerHTML = "";
	}else{
	    descripcion_reg_req.style.display = "block";
	    descripcion_reg_req.innerHTML = "La descripción es requerida.";
	}
	if (datos_tarea.get("titulo") && datos_tarea.get("descripcion")) {
	    fetch("../controllers/ctrl_tasks.php", {
	      method: 'POST',
	      body: datos_tarea
	    }).then(res => res.json())
	    .catch(error => {
	        console.error('Error:', error);
	    })
	    .then(response => {
	        console.log('Success:', response);
	        if (response.id_task) {
				let id_task = response.id_task;
				console.log("id task; ", id_task);
				document.getElementById("form_tarea").reset();
				location.reload();
	        }else if(response.query_error){
	        	console.log(response.query_error);
				document.getElementById("form_tarea").reset();
	        }
	    });
	}
}

function actualizar_tarea(e){
	e.preventDefault();
	let form_tarea_udp = document.getElementById("form_tarea_udp");
	let datos_tarea_udp = new FormData(form_tarea_udp);
	datos_tarea_udp.append("udp", "ok");
	fetch("../controllers/ctrl_tasks.php", {
	  method: 'POST',
	  body: datos_tarea_udp
	}).then(res => res.json())
	.catch(error => {
	    console.error('Error:', error);
	})
	.then(response => {
	    console.log('Success:', response);
		inpt_id_tarea.innerHTML = "";
		location.reload();
	});
}

function abrir_modal_udp(e){
	let id_tarea = e.dataset.id_t;
	let datos_id_tarea = new FormData();
	datos_id_tarea.append("id_tarea", id_tarea);
	fetch("../controllers/ctrl_tasks.php", {
	  method: 'POST',
	  body: datos_id_tarea
	}).then(res => res.json())
	.catch(error => {
	    console.error('Error:', error);
	})
	.then(response => {
	    console.log('Success:', response);
	    if (response.id) {
	    	let titulo = response.titulo;
	    	let descripcion = response.descripcion;
	    	let id_tarea = response.id;
			document.getElementsByName("titulo_udp")[0].value = titulo;
			document.getElementsByName("descripcion_udp")[0].value = descripcion;
			let input_id_tarea = "<input type='hidden' name='id_tarea' id='id_tarea' value='"+id_tarea+"'>";
			inpt_id_tarea.innerHTML = input_id_tarea;
			modal_actualizar.style.display = "block";
	    }
	});
}

function eliminar_tarea(elemento){
	Swal.fire({
		title: '¿Estas seguro que deseas eliminar esta tarea?',
		text: "¡No podrás revertir esto!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, eliminar tarea!'
	}).then((result) => {
		if (result.value) {
			let id_t_eliminar = elemento.dataset.id_t_eliminar;
			let data_eliminar = new FormData();
			data_eliminar.append("id_tarea_eliminar", id_t_eliminar);
			fetch("../controllers/ctrl_tasks.php", {
			  method: 'POST',
			  body: data_eliminar
			}).then(res => res.json())
			.catch(error => {
			    console.error('Error:', error);
			})
			.then(response => {
			    console.log('Success:', response);
			    if (response.response_delete_task) {
					Swal.fire(
					  '¡Eliminado!',
					  'La tarea ha sido eliminada.',
					  'éxito'
					)
					location.reload();
			    }
			});
		}
	})
}

function cerrar_modal(){
	modal_actualizar.style.display = "none";
}