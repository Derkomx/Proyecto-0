Notiflix.Report.Init({
	plainText: false,
	svgSize:"50px",
});

// Función para enviar el código de seguridad por correo
function EnviarCodigo() {
	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	$.ajax({
		type: 'POST',
		url: './Inyector.php',
		data: {Archivo: 'Exportar.php', Seccion: 'Enviar codigo'},
		dataType: 'html',
		success: function(data) {
			var Resultado = JSON.parse(data);

			if (Resultado.error) {
				Notiflix.Loading.Remove();
				Notiflix.Notify.Failure(Resultado.error);
				return;
			}

			if (Resultado.success) {
				document.location = 'index.php?Seccion=Exportar';
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


// Función para enviar el código de seguridad por correo
function ConfirmarCodigo() {
	var Codigo = document.getElementById("code").value;

	// Si no se escribió un CUIL, se notifica
	if (Codigo.length == 0) {
		Notiflix.Notify.Failure("¡Debes ingresar el código enviado a tu correo electrónico!");
		return;
	}

	if (Codigo.length != 6) {
		Notiflix.Notify.Failure("¡El código debe tener una longitud de 6 caracteres!");
		return;
	}

	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	$.ajax({
		type: 'POST',
		url: './Inyector.php',
		data: {Archivo: 'Exportar.php', Seccion: 'Activar codigo', Codigo: Codigo},
		dataType: 'html',
		success: function(data) {
			var Resultado = JSON.parse(data);

			if (Resultado.error) {
				Notiflix.Loading.Remove();
				Notiflix.Notify.Failure(Resultado.error);
				return;
			}

			if (Resultado.expirado) {
				Notiflix.Loading.Remove();

				Notiflix.Report.Warning(
					'¡Error!',
					'Este código de seguridad ha expirado. Deberás generar otro nuevamente para poder ingresar. Tén en cuenta que estos códigos solo tienen duración de 15 minutos para poder activarse.',
					'Aceptar',
					
					function(){
						document.location = "index.php?Seccion=Exportar";
					}
				);
			
				return;
			}

			if (Resultado.success) {
				document.location = 'index.php?Seccion=Exportar';
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

// Función para exportar todos los usuarios a Excel
function ExportarUsuarios() {
	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	$.ajax({
		type: 'POST',
		url: './Inyector.php',
		data: {Archivo: 'Exportar.php', Seccion: 'Exportar usuarios'},
		dataType: 'html',
		success: function(data) {
			var Resultado = JSON.parse(data);

			Notiflix.Loading.Remove();

			if (Resultado.error) {
				Notiflix.Loading.Remove();
				Notiflix.Notify.Failure(Resultado.error);
				return;
			}

			if (Resultado.success) {
				console.log(Resultado.success);
				
				var tableData = [{
                    "sheetName": "Usuarios",
                    "data": Resultado.success
                }];

                var options = {
                    fileName: "Usuarios exportados"
                };

				Jhxlsx.export(tableData, options);

				Notiflix.Notify.Success("¡Datos exportados! La descarga ya debería haber comenzado, de lo contrario, lo hará pronto.");
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

// Función para exportar todos los usuarios a Excel
function ExportarContribuyentes() {
	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Cargando...');

	$.ajax({
		type: 'POST',
		url: './Inyector.php',
		data: {Archivo: 'Exportar.php', Seccion: 'Exportar contribuyentes'},
		dataType: 'html',
		success: function(data) {
			var Resultado = JSON.parse(data);

			Notiflix.Loading.Remove();

			if (Resultado.error) {
				Notiflix.Loading.Remove();
				Notiflix.Notify.Failure(Resultado.error);
				return;
			}

			if (Resultado.success) {
				console.log(Resultado.success);
				
				var tableData = [{
                    "sheetName": "Usuarios",
                    "data": Resultado.success
                }];

                var options = {
                    fileName: "Contribuyentes exportados"
                };

				Jhxlsx.export(tableData, options);

				Notiflix.Notify.Success("¡Datos exportados! La descarga ya debería haber comenzado, de lo contrario, lo hará pronto.");
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

function uploadJSON(theJSON) {
	var str = JSON.stringify(theJSON);

	var blob;
	var reader = new FileReader();
	var oMyBlob = new Blob([str], {type : 'application/json'});
	reader.readAsArrayBuffer(oMyBlob);
	reader.onloadend  = function(evt) {
		xhr = new XMLHttpRequest();
		xhr.open("POST", "Inyector.php", true);
				
		XMLHttpRequest.prototype.mySendAsBinary = function(text) {
			var ui8a = new Uint8Array(new Int8Array(text));
			if (typeof window.Blob == "function") {
				blob = new Blob([ui8a]);
			} else {
				var bb = new (window.MozBlobBuilder || window.WebKitBlobBuilder || window.BlobBuilder)();
				bb.append(ui8a);
				blob = bb.getBlob();
			}

			this.send(blob);
		}

		var eventSource = xhr.upload || xhr;
		eventSource.addEventListener("progress", function(e) {
			var position = e.position || e.loaded;
			var total = e.totalSize || e.total;
			var percentage = Math.round((position/total)*100);

			document.getElementById("NotiflixLoadingMessage").textContent = "Subiendo archivo al servidor... " + percentage + "%";

			if (percentage == 100) {
				document.getElementById("NotiflixLoadingMessage").textContent = "Importando datos, espere...";
			}
		});

		xhr.addEventListener('error', function() {
			Notiflix.Loading.Remove();
			Notiflix.Notify.Failure("¡Ocurrió un error al cargar la publicación!");
			return;
		});

		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var Resultado = JSON.parse(this.responseText);
				Notiflix.Loading.Remove();

				if (Resultado.error) {
					Notiflix.Report.Failure(
						'¡Error!',
						Resultado.error,
						'Aceptar'
					);

					return;
				}

				if (Resultado.success) {
					console.log(Resultado.success);
					Notiflix.Report.Success(
						'¡Éxito!',
						'Los contribuyentes faltantes fueron agregados éxitosamente.',
						'Aceptar'
					);

					return;
				}
			}
		};

		xhr.mySendAsBinary(evt.target.result);
	};
}

// Función para exportar todos los usuarios a Excel
function ImportarUsuarios() {
	// Obtener el archivo de Excel
	var Excel = document.getElementById("inpExcel");

	// Se chequea si está el archivo cargado
	if (Excel.files.length == 0) { 
		Notiflix.Notify.Failure("Debes seleccionar un archivo.");
		return;
	}

	// Activa la pantalla de carga
	Notiflix.Loading.Circle('Leyendo archivo...');

	let fileReader = new FileReader();

	fileReader.readAsBinaryString(Excel.files[0]);

	fileReader.onload = (event)=>{
		let data = event.target.result;
		let workbook = XLSX.read(data,{type:"binary"});

		// Hoja actual
		console.log(workbook);

		// Datos de la hoja
		workbook.SheetNames.forEach(sheet => {
			let rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
			console.log(rowObject);
			
			var theJSON = {Archivo: 'Importar.php', Excel: JSON.stringify(rowObject, undefined, 4)};
			uploadJSON(theJSON);
			return;
		});
	}
}

// Inicia los tooltips
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})