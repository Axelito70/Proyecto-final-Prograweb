$(document).ready(function () {

    const input = ["nombre", "apellido", "usuario", "email", "password"];

    function enviar_datos(datos_usuario) {
        let datos = JSON.stringify(datos_usuario);
        $.ajax({
            type: "POST",
            url: "./app/controller/registro_usuario.php",
            data: { "datos": datos },
            success: function (respuesta) {
                let respuesta_json = JSON.parse(respuesta);
                alert(respuesta_json);
                document.getElementById('nombre').value = '';
                document.getElementById('apellido').value = '';
                document.getElementById('usuario').value = '';
                document.getElementById('email').value = '';
                document.getElementById('password').value = '';
            }
        });
    }

    function mostrar_datos() {
        let datos = [];

        for (let i = 0; i < input.length; i++) {
            const valor = $("#" + input[i]).val();
            if ((input[i] === "nombre" || input[i] === "apellido") && !/^[a-zA-Z\s]+$/.test(valor)) {
                alert("El campo " + $("[for=" + input[i] + "]").text() + " solo debe contener letras");
                $("#" + input[i]).focus();
                return;
            } else if (valor !== undefined && valor !== "") {
                datos[i] = valor;
            } else {
                alert("El campo " + $("[for=" + input[i] + "]").text() + " es obligatorio");
                $("#" + input[i]).focus();
                return;
            }
        }
        enviar_datos(datos);
    }

    function validar_vacios() {
        for (let i = 0; i < input.length; i++) {
            const valor = $("#" + input[i]).val();

            if ((input[i] === "nombre" || input[i] === "apellido") && !/^[a-zA-Z\s]+$/.test(valor)) {
                alert("El campo " + $("[for=" + input[i] + "]").text() + " solo debe contener letras");
                $("#" + input[i]).focus();
                return false;
            } else if (input[i] === "password" && !/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]*\.$/.test(valor)) {
                alert("La contraseña debe cumplir con los siguientes requisitos:\n" +
                      "- Al menos una mayúscula\n" +
                      "- Al menos un número\n" +
                      "- Debe terminar con un punto (.)");
                $("#" + input[i]).focus();
                return false;
            } else if (input[i] === "email" && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor)) {
                alert("Email no válido.");
                $("#" + input[i]).focus();
                return false;
            } else if (valor === "") {
                alert("El campo " + $("[for=" + input[i] + "]").text() + " es obligatorio");
                $("#" + input[i]).focus();
                return false;
            }
        }
        return true;
    }

    $('#btn_registro').on('click', function (event) {
        event.preventDefault();
        if (validar_vacios()) {
            mostrar_datos();
        }
    });

});
