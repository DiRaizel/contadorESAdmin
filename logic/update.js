//---------------------------------Usuarios-------------------------------------

//
function actualizarEstadoUsuario(valor, valor2) {
    //
    $.ajax({
        url: 'controllers/update.php',
        type: 'post',
        data: {
            "idUsu": valor,
            "estado": valor2,
            "accion": "actualizarEstadoUsuario"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.sql === 1) {
            //
            if (valor2 === 2) {
                //
                swal("Atención", "Usuario desactivado!");
            } else {
                //
                swal("Atención", "Usuario activado!");
            }
            //
            if (sessionStorage.idUsu == 1) {
                //
                cargarTablaUsuariosS();
            } else {
                //
                cargarTablaUsuariosE();
            }
        } else {
            //
            swal("Atención", "Error");
        }
    }).fail(function (data_error) {
    });
}

//
function editarUsuario() {
    //
    var controlE = false;
    //
    if (passwordUsuA !== $('#passworde').val()) {
        //
        if ($('#passworde').val() === $('#passwordCe').val()) {
            //
            controlE = true;
        }
    } else {
        //
        controlE = true;
    }
    //
    if (controlE) {
        //
        var formElement = document.getElementById("formEditarUsuario");
        formData = new FormData(formElement);
        //
        formData.append('accion', 'editarUsuario');
        formData.append('idUsu', idUsuarioaEditar);
        formData.append('correoA', correoUsuA);
        formData.append('idEmp', sessionStorage.idEmp);
        //
        $.ajax({
            url: 'controllers/update.php',
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
                $("#formEditarUsuario")[0].reset();
                $('#modalEditarUsuario').modal('hide');
                //
                if (sessionStorage.idUsu == 1) {
                    //
                    cargarTablaUsuariosS();
                } else {
                    //
                    cargarTablaUsuariosE();
                }
                //
                swal("Atención", "Editado");
                //
            } else if (data === 4) {
                //
                swal("Atención", "El correo ya se encuentra registrado!");
            } else {
                //
                swal("Atención", "Error al editar el usuario!");
            }
        }).fail(function (data_error) {
            console.log(data_error);
            swal("Atención", "Error al conectarse!");
        });
    } else {
        //
        swal("Atención", "Las contraseñas no coinciden!");
    }
}

//---------------------------------Empresas-------------------------------------

//
function actualizarEstadoEmpresa(valor, valor2) {
    //
    $.ajax({
        url: 'controllers/update.php',
        type: 'post',
        data: {
            "idEmp": valor,
            "estado": valor2,
            "accion": "actualizarEstadoEmpresa"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.sql === 1) {
            //
            if (valor2 === 2) {
                //
                swal("Atención", "Empresa desactivada!");
            } else {
                //
                swal("Atención", "Empresa activada!");
            }
            //
            cargarTablaEmpresas();
        } else {
            //
            swal("Atención", "Error");
        }
    }).fail(function (data_error) {
    });
}

//
function editarEmpresa() {
    //
    var formElement = document.getElementById("formEditarEmpresa");
    formData = new FormData(formElement);
    //
    formData.append('accion', 'editarEmpresa');
    formData.append('idEmp', idEmpresaaEditar);
    //
    $.ajax({
        url: 'controllers/update.php',
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
            $("#formEditarEmpresa")[0].reset();
            $('#modalEditarEmpresa').modal('hide');
            //
            cargarTablaEmpresas();
            //
            swal("Atención", "Editada!");
            //
        } else if (data === 2) {
            //
            swal("Atención", "Error al edita la empresa!");
        }
    }).fail(function (data_error) {
        console.log(data_error);
        swal("Atención", "Error al conectarse!");
    });
}

//-----------------------------------Sedes--------------------------------------

//
function actualizarEstadoSede(valor, valor2) {
    //
    $.ajax({
        url: 'controllers/update.php',
        type: 'post',
        data: {
            "idSed": valor,
            "estado": valor2,
            "accion": "actualizarEstadoSede"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.sql === 1) {
            //
            if (valor2 === 2) {
                //
                swal("Atención", "Sede desactivada!");
            } else {
                //
                swal("Atención", "Sede activada!");
            }
            //
            if (sessionStorage.idUsu == 1) {
                //
                cargarTablaSedesS();
            } else {
                //
                cargarTablaSedesE();
            }
        } else {
            //
            swal("Atención", "Error");
        }
    }).fail(function (data_error) {
    });
}

//
function editarSede() {
    //
    var formElement = document.getElementById("formEditarSede");
    formData = new FormData(formElement);
    //
    formData.append('accion', 'editarSede');
    formData.append('idSed', idSedeaEditar);
    formData.append('idUsu', sessionStorage.idUsu);
    formData.append('idEmp', sessionStorage.idEmp);
    //
    $.ajax({
        url: 'controllers/update.php',
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
            $("#formEditarSede")[0].reset();
            $('#modalEditarSede').modal('hide');
            //
            if (sessionStorage.idUsu == 1) {
                //
                cargarTablaSedesS();
            } else {
                //
                cargarTablaSedesE();
            }
            //
            swal("Atención", "Editada!");
            //
        } else if (data === 2) {
            //
            swal("Atención", "Error al edita la sede!");
        }
    }).fail(function (data_error) {
        console.log(data_error);
        swal("Atención", "Error al conectarse!");
    });
}
