function validar_campos(arreglo) {
    for (let i = 0; i < arreglo.length; i++) {
        if ($("#" + arreglo[i]).val() == "") {
            alert(`El campo ${$("[for=" + arreglo[i] + "]").text()} no puede ir vacío!!!`);
            return false;
        }
    }
    return true;
}

function solicitar_datos() {
    $.ajax({
        url: "./app/controller/consulta.php",
        success: function (respuesta) {
            let respuesta_json = JSON.parse(respuesta);
            let contenido = ``;
            if (respuesta_json[0] == '1') {
                for (let i = 0; i < respuesta_json[1].length; i++) {
                    contenido += `
                        <tr>
                            <th>${respuesta_json[1][i].id}</th>
                            <td>${respuesta_json[1][i].producto}</td>
                            <td>${respuesta_json[1][i].precio}</td>
                            <td>${respuesta_json[1][i].unidad}</td>
                            <td><img src="${respuesta_json[1][i].url}" alt="Imagen producto" style="width: 100px;"></td>
                            <td>${respuesta_json[1][i].fecha_agregado}</td>
                            <td>
                                <button type="button" class="btn btn-warning" onclick="precargar(${respuesta_json[1][i].id})">
                                    Editar
                                </button>
                                <button type="button" class="btn btn-danger" onclick="eliminar(${respuesta_json[1][i].id})">
                                    Eliminar
                                </button>
                            </td>
                        </tr>`;
                }
                $("#contenido_tabla").html(contenido);
            } else {
                contenido = respuesta_json[1];
            }
        }
    });
}

function eliminar(id) {
    let elimina = confirm("¿Seguro que quieres eliminar este producto?");
    if (elimina) {
        $.ajax({
            type: "GET",
            url: "./app/controller/eliminar_producto.php?id=" + id,
            success: function (respuesta) {
                let respuesta_json = JSON.parse(respuesta);
                if (respuesta_json[0] == '1') {
                    solicitar_datos();
                } else {
                    alert(respuesta_json[1]);
                }
            }
        });
    }
}

function precargar(id) {
    $.ajax({
        type: "GET",
        url: "./app/controller/precarga_producto.php?id=" + id,
        success: function (respuesta) {
            let respuesta_json = JSON.parse(respuesta);
            if (respuesta_json[0] == '1') {
                $("#id_act_producto").val(respuesta_json[1].id);
                $("#act_producto").val(respuesta_json[1].producto);
                $("#act_precio").val(respuesta_json[1].precio);
                $("#act_unidad").val(respuesta_json[1].unidad);
                $("#act_url").val(respuesta_json[1].url);
                $("#act_fecha").val(respuesta_json[1].fecha_agregado);
                $("#editarModal").modal('show');
            } else {
                alert(respuesta_json[1]);
            }
        }
    });
}

function actualizar() {
    if (validar_campos([])) {
        let datos = [
            $("#id_act_producto").val(),
            $("#act_producto").val(),
            $("#act_precio").val(),
            $("#act_unidad").val(),
            $("#act_url").val(),
            $("#act_fecha").val()
        ];

        $.ajax({
            type: "POST",
            url: "./app/controller/actualizar_producto.php",
            data: { "datos": datos },
            success: function (respuesta) {
                let respuesta_json = JSON.parse(respuesta);
                if (respuesta_json[0] == 1) {
                    solicitar_datos();
                    $("#editarModal").modal('hide');
                }
                alert(respuesta_json[1]);
            }
        });
    }
}

function agregar_datos() {
    let contenido;
    contenido = [
        $("#agre_producto").val(),
        parseFloat($("#agre_precio").val()),
        parseInt($("#agre_unidades").val()),
        $("#agre_imagen").val(),
        $("#agre_fecha").val()
    ];
    let producto = JSON.stringify(contenido);
    $.ajax({
        type: "POST",
        url: "./app/controller/agregar_producto.php",
        data: { "producto": producto },
        success: function (respuesta) {
            let respuesta_json = JSON.parse(respuesta);
            console.log(respuesta_json);
            $("#agregarModal").modal('hide');
            document.getElementById('agre_producto').value = '';
            document.getElementById('agre_precio').value = '';
            document.getElementById('agre_unidades').value = '';
            document.getElementById('agre_imagen').value = '';
            document.getElementById('agre_fecha').value = '';
            solicitar_datos();
        }
    });
}

$('#btn_actualizar').on('click', function (event) {
    actualizar();
});

solicitar_datos();
