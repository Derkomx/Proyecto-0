// Archivo: Scripts/Usuarios.js
// Autor: Armas, Juan Manuel
// Proposito: Manejo de las opciones de usuario del lado cliente
// Fecha: 28/01/2021
// Ultima edición: 22/02/2021

// Función para activar un usuario
function ActivarUsuario() {
	// Crea un formulario bootbox para confirmar que quiere activar al usuario
	bootbox.confirm({
		centerVertical: true,
		title: "Activar usuario",
		message: "Desea activar la cuenta del usuario <b>#" + uID + "</b>?",
		buttons: {
			confirm: {
				label: '<i class="fa fa-check"></i> Confirmar',
				className: 'btn-success'
			},

			cancel: {
				label: '<i class="fa fa-times"></i> Cancelar',
				className: 'btn-danger'
			}
		},

		// Callback al pulsar los botones
		callback: function (result) {
			if (result) {
				// Activa la pantalla de carga
				Notiflix.Loading.Circle('Cargando...');

				// Se utiliza AJAX para llamar a PHP
				$.ajax({
					type: 'POST',
					url: './Inyector.php',
					data: {Archivo: 'Usuarios.php', Tipo: 'Activar usuario', uID: uID},
					dataType: 'html',
					
					// Resultado correcto
					success: function(data) {
						var Resultado = JSON.parse(data);
						Notiflix.Loading.Remove();

						if (Resultado.error) {
							Notiflix.Loading.Remove();
							Notiflix.Notify.Failure(Resultado.error);
							return;
						}

						if (Resultado.success) {
							Notiflix.Notify.Success("¡Ahora el usuario se encuentra activo!");
							location.reload();
							return;
						}

						Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
						return;
					},

					// Error (sin resultados)
					error: function(data) {
						Notiflix.Loading.Remove();

						Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");

						return;
					}
				});
			}
		}
	});
}

// Función para cambiar el correo de un usuario
function CambiarCorreo() {
	// Crea un formulario bootbox para cambiar el correo de dicho usuario
	bootbox.prompt({
		centerVertical: true,
		title: "Cambiar correo electrónico",
		inputType: 'email',
		message: "Ingrese el nuevo correo electrónico para el usuario <b>#" + uID + "</b></br></br>",
		buttons: {
			confirm: {
				label: '<i class="fa fa-check"></i> Cambiar',
				className: 'btn-success'
			},

			cancel: {
				label: '<i class="fa fa-times"></i> Cancelar',
				className: 'btn-danger'
			}
		},

		// Callback al pulsar los botones
		callback: function (result) {
			if (result) {
				// Activa la pantalla de carga
				Notiflix.Loading.Circle('Cargando...');

				// Se utiliza AJAX para llamar a PHP
				$.ajax({
					type: 'POST',
					url: './Inyector.php',
					data: {Archivo: 'Usuarios.php', Tipo: 'Cambiar correo', Correo: result, uID: uID},
					dataType: 'html',

					// Resultado correcto
					success: function(data) {
						var Resultado = JSON.parse(data);
						Notiflix.Loading.Remove();

						if (Resultado.error) {
							Notiflix.Loading.Remove();
							Notiflix.Notify.Failure(Resultado.error);
							return;
						}

						if (Resultado.success) {
							Notiflix.Notify.Success("¡Correo actualizado con éxito!");
							location.reload();
							return;
						}

						Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
						return;
					},

					// Error (sin resultados)
					error: function(data) {
						Notiflix.Loading.Remove();

						Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");

						return;
					}
				});
			}
		}
	});
}

// Función para reenviar el código de activación de un usuario
function ReenviarCodigo() {
	// Crea un formulario bootbox para confirmar que quiere reenviar el código
	bootbox.confirm({
		centerVertical: true,
		title: "Reenviar código de activación",
		message: "Desea reenviar el código de activación del usuario <b>#" + uID + "</b>?",
		buttons: {
			confirm: {
				label: '<i class="fa fa-check"></i> Confirmar',
				className: 'btn-success'
			},

			cancel: {
				label: '<i class="fa fa-times"></i> Cancelar',
				className: 'btn-danger'
			}
		},

		// Callback al pulsar los botones
		callback: function (result) {
			if (result) {
				// Activa la pantalla de carga
				Notiflix.Loading.Circle('Cargando...');

				// Se utiliza AJAX para llamar a PHP
				$.ajax({
					type: 'POST',
					url: './Inyector.php',
					data: {Archivo: 'Usuarios.php', Tipo: 'Reenviar código', uID: uID},
					dataType: 'html',

					// Resultado correcto
					success: function(data) {
						var Resultado = JSON.parse(data);
						Notiflix.Loading.Remove();

						if (Resultado.error) {
							Notiflix.Loading.Remove();
							Notiflix.Notify.Failure(Resultado.error);
							return;
						}

						if (Resultado.success) {
							Notiflix.Notify.Success("¡El código fue reenviado correctamente!");
							return;
						}

						Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
						return;
					},

					// Error (sin resultados)
					error: function(data) {
						Notiflix.Loading.Remove();

						Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");

						return;
					}
				});
			}
		}
	});
}

// Función para obtener el código de activación de un usuario
function ObtenerCodigo() {
	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	// Se utiliza AJAX para llamar a PHP
	$.ajax({
		type: 'POST',
		url: './Inyector.php',
		data: {Archivo: 'Usuarios.php', Tipo: 'Obtener código', uID: uID},
		dataType: 'html',

		// Resultado correcto
		success: function(data) {
			var Resultado = JSON.parse(data);
			Notiflix.Loading.Remove();

			if (Resultado.error) {
				Notiflix.Loading.Remove();
				Notiflix.Notify.Failure(Resultado.error);
				return;
			}

			if (Resultado.success) {
				
				// Se crea una caja de alerta con el código de activación
				bootbox.alert({
					centerVertical: true,
					title: "Código de activación",
					message: "Código de activación del usuario <b>#" + uID + "</b></br>Tenga en cuenta que al ingresar al enlace, la cuenta será activada.</br></br><p class='text-muted'>https://practicacaemc.000webhostapp.com/?Token=" + Resultado.success + "</p>",
				})

				return;
			}

			Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
			return;
		},

		// Error (sin resultados)
		error: function(data) {
			Notiflix.Loading.Remove();

			Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");

			return;
		}
	});
}

// Función para aceptar la verificación de un usuario
function AceptarUsuario() {
	// Crea un formulario bootbox para confirmar que se quiere aceptar el usuario
	bootbox.confirm({
		centerVertical: true,
		title: "Aceptar usuario",
		message: "¿Desea aceptar al usuario <b>#" + uID + "</b> con los datos actuales?",
		buttons: {
			confirm: {
				label: '<i class="fa fa-check"></i> Confirmar',
				className: 'btn-success'
			},

			cancel: {
				label: '<i class="fa fa-times"></i> Cancelar',
				className: 'btn-danger'
			}
		},

		// Callback al pulsar los botones
		callback: function (result) {
			if (result) {
				// Activa la pantalla de carga
				Notiflix.Loading.Circle('Cargando...');

				// Se utiliza AJAX para llamar a PHP
				$.ajax({
					type: 'POST',
					url: './Inyector.php',
					data: {Archivo: 'Usuarios.php', Tipo: 'Aceptar usuario', uID: uID},
					dataType: 'html',

					// Resultado correcto
					success: function(data) {
						var Resultado = JSON.parse(data);
						Notiflix.Loading.Remove();

						if (Resultado.error) {
							Notiflix.Loading.Remove();
							Notiflix.Notify.Failure(Resultado.error);
							return;
						}

						if (Resultado.success) {
							Notiflix.Notify.Success("¡El usuario ha sido verificado con éxito!");
							location.reload();
							return;
						}

						Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
						return;
					},

					// Error (sin resultados)
					error: function(data) {
						Notiflix.Loading.Remove();

						Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");

						return;
					}
				});
			}
		}
	});
}

// Función para denegar la verificación de un usuario
function DenegarUsuario() {
	bootbox.prompt({
		title: "Denegar usuario",
		message: "¿Desea denegar al usuario <b>#" + uID + "</b>? </br></br>Seleccione las razones correspondientes.</br></br>",
		inputType: 'checkbox',
		centerVertical: true,
		
		buttons: {
			confirm: {
				label: '<i class="fa fa-check"></i> Confirmar',
				className: 'btn-success'
			},

			cancel: {
				label: '<i class="fa fa-times"></i> Cancelar',
				className: 'btn-danger'
			}
		},

		inputOptions: [{
			text: 'Imágenes inválidas',
			value: '1',
		},
		{
			text: 'Datos inválidos',
			value: '2',
		},
		{
			text: 'Usuario no correspondiente',
			value: '3',
		}],
		callback: function (result) {
			if (result) {
				if (result.length > 0) {
					// Activa la pantalla de carga
					Notiflix.Loading.Circle('Cargando...');

					// Se utiliza AJAX para llamar a PHP
					$.ajax({
						type: 'POST',
						url: './Inyector.php',
						data: {Archivo: 'Usuarios.php', Tipo: 'Denegar usuario', uID: uID, Opciones: result},
						dataType: 'html',
						
						// Resultado correcto
						success: function(data) {
							var Resultado = JSON.parse(data);
							Notiflix.Loading.Remove();

							if (Resultado.error) {
								Notiflix.Loading.Remove();
								Notiflix.Notify.Failure(Resultado.error);
								return;
							}

							if (Resultado.success) {
								Notiflix.Notify.Success("Usuario denegado con éxito.");
								location.reload();
								return;
							}

							Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
							return;
						},

						// Error (sin resultados)
						error: function(data) {
							Notiflix.Loading.Remove();

							Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");

							return;
						}
					});
				} else {
					Notiflix.Notify.Failure("Debes seleccionar una razón para denegar al usuario.");
					return;
				}
			}
		}
	});
}

// Función para eliminar un usuario
function EliminarUsuario() {
	// Crea un formulario bootbox para confirmar que quiere eliminar dicho usuario
	bootbox.confirm({
		centerVertical: true,
		title: "Eliminar usuario",
		message: "Desea eliminar al usuario <b>#" + uID + "</b> permanentemente?</br>No podrá revertir este cambio.",
		buttons: {
			confirm: {
				label: '<i class="fa fa-check"></i> Confirmar',
				className: 'btn-success'
			},

			cancel: {
				label: '<i class="fa fa-times"></i> Cancelar',
				className: 'btn-danger'
			}
		},

		// Callback al pulsar los botones
		callback: function (result) {
			if (result) {
				// Activa la pantalla de carga
				Notiflix.Loading.Circle('Cargando...');

				// Se utiliza AJAX para llamar a PHP
				$.ajax({
					type: 'POST',
					url: './Inyector.php',
					data: {Archivo: 'Usuarios.php', Tipo: 'Eliminar usuario', uID: uID},
					dataType: 'html',
					
					// Resultado correcto
					success: function(data) {
						var Resultado = JSON.parse(data);
						Notiflix.Loading.Remove();

						if (Resultado.error) {
							Notiflix.Loading.Remove();
							Notiflix.Notify.Failure(Resultado.error);
							return;
						}

						if (Resultado.success) {
							Notiflix.Notify.Success("Usuario eliminado con éxito.");
							return;
						}

						Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
						return;
					},

					// Error (sin resultados)
					error: function(data) {
						Notiflix.Loading.Remove();

						Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");

						return;
					}
				});
			}
		}
	});
}

// Función cambiar nivel de un usuario
function CambiarNivel() {
	var Nivel = document.getElementById("sltNivel").value;
	
	if (Nivel == 0) {
		Notiflix.Notify.Failure('Debes seleccionar un nivel...');
		return;
	}

	console.log(Nivel);

	// Crea un formulario bootbox para confirmar que quiere cambiar el nivel de dicho usuario
	bootbox.confirm({
		centerVertical: true,
		title: "Cambiar nivel",
		message: "Desea que el usuario <b>#" + uID + "</b> (" + Usuario + ") sea ahora nivel " + Nivel + "?</br>Podrá realizar nuevamente este cambio cuando quiera.",
		buttons: {
			confirm: {
				label: '<i class="fa fa-check"></i> Confirmar',
				className: 'btn-success'
			},

			cancel: {
				label: '<i class="fa fa-times"></i> Cancelar',
				className: 'btn-danger'
			}
		},

		// Callback al pulsar los botones
		callback: function (result) {
			if (result) {
				// Activa la pantalla de carga
				Notiflix.Loading.Circle('Cargando...');

				// Se utiliza AJAX para llamar a PHP
				$.ajax({
					type: 'POST',
					url: './Inyector.php',
					data: {Archivo: 'Usuarios.php', Tipo: 'Cambiar nivel', uID: uID, Nivel: Nivel},
					dataType: 'html',

					// Resultado correcto
					success: function(data) {
						var Resultado = JSON.parse(data);
						Notiflix.Loading.Remove();

						if (Resultado.error) {
							Notiflix.Loading.Remove();
							Notiflix.Notify.Failure(Resultado.error);
							return;
						}

						if (Resultado.success) {
							Notiflix.Notify.Success("Nivel de usuario cambiado correctamente.");
							location.reload();
							return;
						}

						Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
						return;
					},

					// Error (sin resultados)
					error: function(data) {
						Notiflix.Loading.Remove();

						Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");

						return;
					}
				});
			}
		}
	});
}