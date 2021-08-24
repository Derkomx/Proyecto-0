function getDataUrl(img) {
    // Create canvas
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    // Set width and height
    canvas.width = img.width;
    canvas.height = img.height;
    // Draw the image
    ctx.drawImage(img, 0, 0);
    return canvas.toDataURL('image/jpeg');
}

// Función al pulsar el botón "Iniciar sesión" para ingresar a una cuenta
function AceptarDatos() {
    // Se obtienen todos los datos ingresados
    var Nombre = document.getElementById("first_name").value;
    var Apellido = document.getElementById("last_name").value;;
    var Telefono = document.getElementById("phone").value;
    var Domicilio = document.getElementById("address").value;
    var Ciudad = document.getElementById("ciudad").value;
    var Postal = document.getElementById("postal").value;
    var Frente = document.getElementById("input-frente").files;

    // Si no se escribió un nombre, se notifica
    if (Nombre.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar un nombre!");
        return;
    }

    // Si no escribió una apellido, se notifica
    if (Apellido.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar tu apellido!");
        return;
    }


    if (Telefono.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar tu número de teléfono!");
        return;
    }

    if (Domicilio.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar tu domicilio!");
        return;
    }

    if (Ciudad.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar tu ciudad/localidad!");
        return;
    }

    if (Postal.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar tu código postal!");
        return;
    }

    if (Frente.length == 0) {
        Notiflix.Notify.Failure("Debes cargar una foto!");
        return;
    }


    // Activa la pantalla de carga
    Notiflix.Loading.Circle('Cargando...');

    $.ajax({
        type: 'POST',
        url: 'Inyector.php',
        data: { Archivo: 'CompletarPerfil.php', Nombre: Nombre, Apellido: Apellido, Telefono: Telefono, Domicilio: Domicilio, Ciudad: Ciudad, Postal: Postal, Frente: getDataUrl(document.getElementById("img-frente")) },
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
                window.location.replace("index.php");
            }

            //document.location = Resultado.location;
        },
        error: function(data) {
            Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");
            console.log(data);
            Notiflix.Loading.Remove();
            return;
        }
    });
}

$(function() {
    $("#input-frente").change(function() {
        if (this.files && this.files[0]) {
            var filerdr = new FileReader();

            filerdr.onload = function(e) {
                var img = new Image();

                img.onload = function() {
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');
                    canvas.width = 800;
                    canvas.height = canvas.width * (img.height / img.width);
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                    // SEND THIS DATA TO WHEREVER YOU NEED IT
                    var data = canvas.toDataURL('image/jpeg');

                    $('#img-frente').attr('src', data);
                    //$('#imgprvw').attr('src', data);//converted image in variable 'data'
                }
                img.src = e.target.result;
            }
            filerdr.readAsDataURL(this.files[0]);
        }
    });
});