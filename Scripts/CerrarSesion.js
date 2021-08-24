
// Función al pulsar el botón "Cerrar sesión"
function CerrarSesion() {
	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	$.ajax({
		type: 'POST',
		url: '../includes/Logout.php',
		success: function(data) {
			var Resultado = JSON.parse(data);

			if (Resultado.location) {
				document.location = Resultado.location;
				return;
			}
		},
		error: function(data) {
			Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");
			return;
			console.log(data);
		}
	});
}