// Archivo: Scripts/Reclamos.js
// Autor: Armas, Juan Manuel
// Proposito: Funcionamiento de los reclamos del lado del cliente
// Fecha: 03/12/2020
// Ultima edición: 14/12/2020

// Función al pulsar el botón "Crear Reclamo"
function NuevoReclamo() {
	// Se obtienen el CUIL y la clave
	var Asunto = document.getElementById("Asunto").value;
	var Departamento = document.getElementById("Departamento").selectedIndex;
	var Mensaje = document.getElementById("Mensaje").value;
	var Contenido = Mensaje.replace(/\n/g, "<br />");

	// Si no se escribió un CUIL, se notifica
	if (Asunto.length == 0) {
		Notiflix.Notify.Failure("¡Es necesario especificar el asunto!");
		return;
	}

	// Si no seleccionó un departamento, se notifica
	if (Departamento == 0) {
		Notiflix.Notify.Failure("¡Debes especificar un departamento!");
		return;
	}

	// Si no se escribió un mensaje, se notifica
	if (Mensaje.length == 0) {
		Notiflix.Notify.Failure("¡Es necesario que escribas un mensaje!");
		return;
	}

	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	$.ajax({
		type: 'POST',
		url: './Inyector.php',
		data: {Archivo: 'Reclamos.php', Tipo: 'Nuevo', Asunto: Asunto, Departamento: Departamento, Mensaje: Contenido},
		dataType: 'html',
		success: function(data) {
			var Resultado = JSON.parse(data);
			Notiflix.Loading.Remove();

			if (Resultado.error) {
				Notiflix.Notify.Failure(Resultado.error);
				return;
			}

			if (Resultado.success) {
				Notiflix.Report.Success(
					'¡Listo!',
					'El reclamo ha sido creado correctamente. Será respondido a la brevedad.',
					'Aceptar',
					function(){
						document.location = '?Seccion=VerReclamo&Reclamo=' + Resultado.success;
					}
				);

				return;
			}

			Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
			return;
		},
		error: function(data) {
			Notiflix.Loading.Remove();
			Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");
			console.log(data);
			return;
		}
	});
}

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

// Función al responder un reclamo como usuario
function RespuestaUsuario() {
	// Se obtienen los datos necesarios
	var Reclamo = obtenerParametro('Reclamo');
	var Mensaje = document.getElementById("Mensaje").value;
	var Contenido = Mensaje.replace(/\n/g, "<br />");

	// Si no se escribió un CUIL, se notifica
	if (Mensaje.length == 0) {
		Notiflix.Notify.Failure("¡Debes escribir un mensaje!");
		return;
	}

	// Si no se escribió un mensaje, se notifica
	if (!Reclamo || Reclamo.length == 0) {
		Notiflix.Notify.Failure("¡Número de reclamo inválido, por favor actualiza la página!");
		return;
	}

	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	$.ajax({
		type: 'POST',
		url: './Inyector.php',
		data: {Archivo: 'Reclamos.php', Tipo: 'Respuesta usuario', Reclamo: Reclamo, Mensaje: Contenido},
		dataType: 'html',
		success: function(data) {
			var Resultado = JSON.parse(data);

			if (Resultado.error) {
				Notiflix.Loading.Remove();
				Notiflix.Notify.Failure(Resultado.error);
				return;
			}

			if (Resultado.success) {
				document.location = '?Seccion=VerReclamo&Reclamo=' + Reclamo;
				return;
			}

			Notiflix.Loading.Remove();
			Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
			return;
		},
		error: function(data) {
			Notiflix.Loading.Remove();
			Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");
			console.log(data);
			return;
		}
	});
}

// Función al responder un reclamo como soporte
function RespuestaSoporte() {
	// Se obtienen los datos necesarios
	var Reclamo = obtenerParametro('Reclamo');
	var Mensaje = document.getElementById("Mensaje").value;
	var Contenido = Mensaje.replace(/\n/g, "<br />");

	// Si no se escribió un CUIL, se notifica
	if (Mensaje.length == 0) {
		Notiflix.Notify.Failure("¡Debes escribir un mensaje!");
		return;
	}

	// Si no se escribió un mensaje, se notifica
	if (!Reclamo || Reclamo.length == 0) {
		Notiflix.Notify.Failure("¡Número de reclamo inválido, por favor actualiza la página!");
		return;
	}

	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	$.ajax({
		type: 'POST',
		url: './Inyector.php',
		data: {Archivo: 'Reclamos.php', Tipo: 'Respuesta soporte', Reclamo: Reclamo, Mensaje: Contenido},
		dataType: 'html',
		success: function(data) {
			var Resultado = JSON.parse(data);

			if (Resultado.error) {
				Notiflix.Loading.Remove();
				Notiflix.Notify.Failure(Resultado.error);
				return;
			}

			if (Resultado.success) {
				document.location = '?Seccion=VerReclamo&Reclamo=' + Reclamo;
				return;
			}

			Notiflix.Loading.Remove();
			Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
			return;
		},
		error: function(data) {
			Notiflix.Loading.Remove();
			Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");
			console.log(data);
			return;
		}
	});
}

// Función para cerrar un reclamo como soporte
function CerrarReclamo() {
	// Se obtienen los datos necesarios
	var Reclamo = obtenerParametro('Reclamo');

	// Si no se escribió un mensaje, se notifica
	if (!Reclamo || Reclamo.length == 0) {
		Notiflix.Notify.Failure("¡Número de reclamo inválido, por favor actualiza la página!");
		return;
	}

	Notiflix.Confirm.Show( 'Cerrar reclamo #' + Reclamo, '¿Desea cerrar el reclamo? Al confirmar, ya no se admitirán más respuestas en el mismo.', 'Cerrar reclamo', 'Volver',
		function(){
			// Activa la pantalla de carga
			Notiflix.Loading.Circle('Cargando...');

			$.ajax({
				type: 'POST',
				url: './Inyector.php',
				data: {Archivo: 'Reclamos.php', Tipo: 'Cerrar reclamo', Reclamo: Reclamo},
				dataType: 'html',
				success: function(data) {
					var Resultado = JSON.parse(data);

					if (Resultado.error) {
						Notiflix.Loading.Remove();
						Notiflix.Notify.Failure(Resultado.error);
						return;
					}

					if (Resultado.success) {
						document.location = '?Seccion=VerReclamo&Reclamo=' + Reclamo;
						return;
					}

					Notiflix.Loading.Remove();
					Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
					return;
				},
				error: function(data) {
					Notiflix.Loading.Remove();
					Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");
					console.log(data);
					return;
				}
			});
		}
	);
}