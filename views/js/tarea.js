  document.addEventListener("DOMContentLoaded", function(){
    console.log('pagina cargada');
    let box_loader = document.getElementsByClassName("Box")[0];
	box_loader.style.display = "flex";
	console.log("mostrando loader");
	setTimeout(function(){
		box_loader.style.display = "none";
		console.log("loader oculto");
	}, 2000);
  });