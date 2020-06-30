//---------------------------------Usuarios-------------------------------------

//
function guardarUsuario() {
    //
    if ($('#password').val() !== $('#passwordC').val()) {
        //
        swal("Atención", "Las contraseñas no coinciden!");
    } else {
        //
        var formElement = document.getElementById("formNuevoUsuario");
        formData = new FormData(formElement);
        //
        formData.append('accion', 'guardarUsuario');
        //
        if (sessionStorage.idUsu != 1) {
            //
            formData.append('empresa', sessionStorage.idEmp);
        }
        //
        $.ajax({
            url: 'controllers/create.php',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json'
        }).done(function (data) {
            //
            if (data === 1) {
                //
                $("#formNuevoUsuario")[0].reset();
                $('#modalNuevoUsuario').modal('hide');
                //
                if (sessionStorage.idUsu != 1) {
                    //
                    cargarTablaUsuarios();
                } else {
                    //
                    cargarTablaUsuariosE();
                }
                //}
                swal("Atención", "Guardado!");
                //
            } else if (data === 2) {
                //
                swal("Atención", "Error al guardar usuario!");
            } else {
                //
                swal("Atención", "Error correo ya se encuetra registrado!");
            }
        }).fail(function (data_error) {
            console.log(data_error);
            s
            swal("Atención", "Error al conectarse!");
        });
    }
}

//---------------------------------Empresas-------------------------------------

//
function guardarEmpresa() {
    //
    var formElement = document.getElementById("formNuevaEmpresa");
    formData = new FormData(formElement);
    //
    formData.append('accion', 'guardarEmpresa');
    //
    $.ajax({
        url: 'controllers/create.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        dataType: 'json'
    }).done(function (data) {
        //
        if (data === 1) {
            //
            $("#formNuevaEmpresa")[0].reset();
            $('#modalNuevaEmpresa').modal('hide');
            //
            cargarTablaEmpresas();
            //
            swal("Atención", "Guardado!");
            //
        } else if (data === 2) {
            //
            swal("Atención", "Error al Guardar Empresa!");
        }
    }).fail(function (data_error) {
        console.log(data_error);
        swal("Atención", "Error al conectarse!");
    });
}

//------------------------------------Sedes-------------------------------------

//
function guardarSede() {
    //
    var formElement = document.getElementById("formNuevaSede");
    formData = new FormData(formElement);
    //
    formData.append('accion', 'guardarSede');
    formData.append('idUsu', sessionStorage.idUsu);
    formData.append('idEmp', sessionStorage.idEmp);
    //
    $.ajax({
        url: 'controllers/create.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        dataType: 'json'
    }).done(function (data) {
        //
        if (data === 1) {
            //
            $("#formNuevaSede")[0].reset();
            $('#modalNuevaSede').modal('hide');
            //
            cargarTablaSedesS();
            //
            swal("Atención", "Guardado!");
            //
        } else if (data === 2) {
            //
            swal("Atención", "Error al guardar la sede!");
        }
    }).fail(function (data_error) {
        console.log(data_error);
        swal("Atención", "Error al conectarse!");
    });
}
