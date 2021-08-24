// Función para obtener los parametros de la URL actual
function obtenerParametro(Parametro) {
	var sPaginaURL = window.location.search.substring(1);
	var sURLVariables = sPaginaURL.split('&');

	for (var i = 0; i < sURLVariables.length; i++) {
		var sParametro = sURLVariables[i].split('=');
		if (sParametro[0] == Parametro) {
			return sParametro[1];
		}
	}
	
	// Si no puede obtener el parametro, retorna null
	return null;
}

function Inicio() {
	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	// Chequea si existen los parametros "Token" o "Recovery"
	if (!obtenerParametro('Token') && !obtenerParametro('Recovery')) {
		document.location = 'index.php';
		return;
	}
}

Inicio();