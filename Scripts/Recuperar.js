Notiflix.Report.Init({
    plainText: false,
	svgSize:"50px",
});

// Función al pulsar el botón "Iniciar sesión" para ingresar a una cuenta
function Recupera() {
    // Se obtienen los datos ingresados
    var CUIL = document.getElementById("CUIL").value.replace(/-/gi, '');

    // Si no se escribió un CUIL, se notifica
    if (CUIL.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar un correo!");
        return;
    }

    // Activa la pantalla de carga
    Notiflix.Loading.Circle('Cargando...');

    $.ajax({
        type: 'POST',
        url: './Inyector.php',
        data: { Archivo: 'Recuperar.php', CUIL: CUIL},
        dataType: 'html',
        success: function(data) {

            console.log(data);
            var Resultado = JSON.parse(data);
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
				Notiflix.Report.Success(
					'¡Éxito!',
					'<center>Se ha enviado un correo electrónico a la dirección:<br><br><b>' + Resultado.email + '</b><br><br>Para recuperar tu cuenta, deberás ingresar al link situado en dicho correo!</center>',
					'Aceptar'
				);

				return;
            }
        },
        error: function(data) {
            console.log(data);
        }
    });

}

$(function() {
    $.mask.definitions['~'] = "[+-]";
    $("#CUIL").mask("99-99999999-9", { autoclear: false });

    $("input").blur(function() {
        $("#info").html("Unmasked value: " + $(this).mask());
    }).dblclick(function() {
        $(this).unmask();
    });
});