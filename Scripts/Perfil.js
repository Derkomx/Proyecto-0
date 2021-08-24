const status = document.getElementById('status');
const output = document.getElementById('imgPerfil');
var Cropp = null;

if (window.FileList && window.File && window.FileReader) {
	document.getElementById('myFile').addEventListener('change', event => {
		if (Cropp) {
			Cropp.destroy();
			Cropp = null;
		}

		output.src = '';
		status.textContent = '';
		const file = event.target.files[0];

		if (!file.type) {
			status.textContent = 'Error: El tipo de archivo parece no ser soportado por el navegador actual.';
			return;
		}

		if (!file.type.match('image.*')) {
			status.textContent = 'Error: El archivo seleccionado no es una imágen.'
			return;
		}

		const reader = new FileReader();
		reader.addEventListener('load', event => {
            output.src = event.target.result;
			
			const image = document.getElementById('imgPerfil');
			Cropp = new Cropper(image, {
				aspectRatio: 1 / 1,
				guides: false,
				zoomable: false,
				scalable: false,
				zoomOnTouch: false,
				zoomOnWheel: false,
				movable: false,
				crop(event) {
					//console.log(event.detail.x);
					//console.log(event.detail.y);
					//console.log(event.detail.width);
					//console.log(event.detail.height);
					//console.log(event.detail.rotate);
					//console.log(event.detail.scaleX);
					//console.log(event.detail.scaleY);
				},
			});
		});

		reader.readAsDataURL(file);
	}); 
}

CroppOptions = {
    minWidth: 512,
    minHeight: 512,
    maxWidth: 1024,
    maxHeight: 1024,
    fillColor: '#fff',
    imageSmoothingEnabled: true,
    imageSmoothingQuality: 'high',
}

$('#Guardar').on('click', function () {   
    var croppedimage = Cropp.getCroppedCanvas(CroppOptions).toDataURL("image/jpeg");
    console.log(croppedimage);

	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	$.ajax({
		type: 'POST',
		url: './Inyector.php',
		data: {Archivo: 'Perfil.php', Tipo: 'Cambiar imagen', Imagen: croppedimage},
		dataType: 'html',
		success: function(data) {
			var Resultado = JSON.parse(data);
			Notiflix.Loading.Remove();

			if (Resultado.error) {
				Notiflix.Notify.Failure(Resultado.error);
				return;
			}

			if (Resultado.success) {
				$("#exampleModalCenter").modal('hide');
				Notiflix.Notify.Success("¡Imagen cambiada!");
				location.reload();
				return;
			}

			Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
			return;
		},
		error: function(data) {
			Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");
			console.log(data);
			return;
		}
	});
});

$('#exampleModalCenter').on('hidden.bs.modal', function (e) {
	if (Cropp) {
		Cropp.destroy();
		Cropp = null;
	}

	output.src = '';
	status.textContent = '';
	document.getElementById('myFile').value = null;
})

	$('#customSwitches').change(function() {
		if (this.checked) {
			State = 1;
		} else {
			State = 0;
		}
		
		// Activa la pantalla de carga
		Notiflix.Loading.Circle('Cargando...');

		$.ajax({
			type: 'POST',
			url: './Inyector.php',
			data: {Archivo: 'Perfil.php', Tipo: 'Modo oscuro', Estado: State},
			dataType: 'html',
			success: function(data) {
				var Resultado = JSON.parse(data);
				Notiflix.Loading.Remove();

				if (Resultado.error) {
					Notiflix.Notify.Failure(Resultado.error);
					return;
				}

				if (Resultado.success) {
					location.reload();
					return;
				}

				Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
				return;
			},
			error: function(data) {
				Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");
				console.log(data);
				return;
			}
		});
    });


// Run pswmeter with options
const myPassMeter = passwordStrengthMeter({
	containerElement: '#pswmeter',
	passwordInput: '#newPass',
	showMessage: true,
	messageContainer: '#pswmeter-message',
	messagesList: [
	  'Inválida',
	  '¡Muy fácil!',
	  'Normal',
	  'Segura',
	  'Muy segura'
	],
	height: 6,
	borderRadius: 0,
	pswMinLength: 6,
	colorScore1: '#FF0000',
	colorScore2: '#fc7703',
	colorScore3: '#36ba2f',
	colorScore4: '#2f97ba'
  });

// Función para cambiar clave desde el perfil del usuario
function CambiarClave() {
	// Se obtienen los campos requeridos
	var currentPass = document.getElementById("currentPass").value;
	var newPass = document.getElementById("newPass").value;
	var repeatPass = document.getElementById("repeatPass").value;

	var Seguridad = myPassMeter.getScore();

	if (currentPass.length == 0) {
		Notiflix.Notify.Failure("¡Debes escribir tu clave actual!");
		return;
	}

	if (newPass.length == 0) {
		Notiflix.Notify.Failure("¡Debes escribir tu nueva clave!");
		return;
	}
	
	if (repeatPass.length == 0) {
		Notiflix.Notify.Failure("¡Debes repetir tu nueva clave!");
		return;
	}

	if (newPass != repeatPass) {
		Notiflix.Notify.Failure("¡Las claves nuevas no coinciden!");
		return;
	}

	if (Seguridad <= 1) {
		Notiflix.Notify.Failure("¡La nueva clave es muy insegura!");
		return;
	}

	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	$.ajax({
		type: 'POST',
		url: './Inyector.php',
		data: {Archivo: 'CambiarClave.php', Clave: hex_sha512(currentPass), NuevaClave: hex_sha512(newPass)},
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
					'¡Éxito!',
					'¡Tu clave ha sido actualizada con éxito!',
					'Aceptar',
					function(){
						document.getElementById("currentPass").value = '';
						document.getElementById("newPass").value = '';
						document.getElementById("repeatPass").value = '';
					}
				);

				return;
			}

			Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
			return;
		},
		error: function(data) {
			Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");
			console.log(data);
			return;
		}
	});
}

// Funcion que se ejecutará al escribir caracteres en el campo 'Clave'
document.getElementById('newPass').addEventListener('input', function() {
	// Obtiene lo escrito en el campo
	Valor = event.target.value;
	  
	// Obtiene los elementos que mostrarán la seguridad de la clave
	var Barra = document.getElementById("pswmeter")
	var Texto = document.getElementById("pswmeter-message")
  
	// Chequea si hay más de un caracter escrito
	  if (Valor.length > 0) {
	  // Chequea si la barra está oculta
	  if (Barra.style.display == 'none') {
		// Muestra los elementos
		Barra.style.display = 'block';
		Texto.style.display = 'block';
	  }
	  } else {
	  // Chequea si la barra está visible
	  if (Barra.style.display == 'block') {
		// Oculta los elementos
		Barra.style.display = 'none';
		Texto.style.display = 'none';
	  }
	}
  });

  // Función para cambiar el email desde el perfil del usuario
function CambiarEmail() {
	// Se obtienen los campos requeridos
	var newEmail = document.getElementById("newEmail").value;
	var repeatEmail = document.getElementById("repeatEmail").value;

	if (newEmail.length == 0) {
		Notiflix.Notify.Failure("¡Debes escribir un nuevo correo!");
		return;
	}

	if (repeatEmail.length == 0) {
		Notiflix.Notify.Failure("¡Debes repetir tu nuevo correo!");
		return;
	}
	
	if (newEmail != repeatEmail) {
		Notiflix.Notify.Failure("¡Los correos ingresados no coinciden!");
		return;
	}

	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	$.ajax({
		type: 'POST',
		url: './Inyector.php',
		data: {Archivo: 'Perfil.php', Tipo: 'Cambiar correo', Correo: newEmail},
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
					'¡Éxito!',
					'¡Se ha enviado un correo de confirmación a tu nuevo correo!',
					'Aceptar',
					function(){
						document.getElementById("newEmail").value = '';
						document.getElementById("repeatEmail").value = '';
					}
				);

				return;
			}

			Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
			return;
		},
		error: function(data) {
			Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");
			console.log(data);
			return;
		}
	});
}