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
                alert('Usuario desactivado!');
            } else {
                //
                alert('Usuario activado!');
            }
            //
            if (sessionStorage.idUsu == 1) {
                //
                cargarTablaUsuariosS();
            } else {
                //
                cargarTablaUsuarios();
            }
        } else {
            //
            alert('Error');
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
                alert('Editado!');
                //
            } else if (data === 4) {
                //
                alert('El correo ya se encuentra registrado!');
            } else {
                //
                alert('Error al editar el usuario!');
            }
        }).fail(function (data_error) {
            console.log(data_error);
            alert('Error al conectarse!');
        });
    } else {
        //
        alert('Las contraseñas no coinciden!');
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
                alert('Empresa desactivada!');
            } else {
                //
                alert('Empresa activada!');
            }
            //
            cargarTablaEmpresas();
        } else {
            //
            alert('Error');
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
            alert('Editada!');
            //
        } else if (data === 2) {
            //
            alert('Error al edita la empresa!');
        }
    }).fail(function (data_error) {
        console.log(data_error);
        alert('Error al conectarse!');
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
                alert('Sede desactivada!');
            } else {
                //
                alert('Sede activada!');
            }
            //
            if (sessionStorage.idUsu == 1) {
                //
                cargarTablaSedesS();
            } else {
                //
                cargarTablaSedes();
            }
        } else {
            //
            alert('Error');
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
                cargarTablaSedes();
            }
            //
            alert('Editada!');
            //
        } else if (data === 2) {
            //
            alert('Error al edita la sede!');
        }
    }).fail(function (data_error) {
        console.log(data_error);
        alert('Error al conectarse!');
    });
}
