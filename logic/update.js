//---------------------------------Usuarios-------------------------------------

//
function actualizarEstadoUsuario(valor) {
    //
    $.ajax({
        url: 'controllers/update.php',
        type: 'post',
        data: {
            "idUsu": valor,
            "accion": "actualizarEstadoUsuario"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.sql === 1) {
            //
            if (data.estado === 'Activo') {
                //
                toastr.error('Usuario desactivado!');
            } else {
                //
                toastr.success('Usuario activado!');
            }
            //
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
function actualizarEstadoEmpresa(valor) {
    //
    $.ajax({
        url: 'controllers/update.php',
        type: 'post',
        data: {
            "idEmp": valor,
            "accion": "actualizarEstadoEmpresa"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.sql === 1) {
            //
            if (data.estado === 'Activa') {
                //
                toastr.error('Empresa desactivada!');
            } else {
                //
                toastr.success('Empresa activada!');
            }
            //
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
function actualizarEstadoSede(valor) {
    //
    $.ajax({
        url: 'controllers/update.php',
        type: 'post',
        data: {
            "idSed": valor,
            "accion": "actualizarEstadoSede"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.sql === 1) {
            //
            if (data.estado === 'Activa') {
                //
                toastr.error('Sede desactivada!');
            } else {
                //
                toastr.success('Sede activada!');
            }
            //
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
            swal("Atención", "Error al editar la sede!");
        }
    }).fail(function (data_error) {
        console.log(data_error);
        swal("Atención", "Error al conectarse!");
    });
}

//------------------------------------Tvs---------------------------------------

//
function actualizarEstadoTv(valor) {
    //
    $.ajax({
        url: 'controllers/update.php',
        type: 'post',
        data: {
            "idTv": valor,
            "accion": "actualizarEstadoTv"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.sql === 1) {
            //
            if (data.estado === 'Activo') {
                //
                toastr.error('Tv Desactivado!');
            } else {
                //
                toastr.success('Tv Activo!');
            }
            //
        } else {
            //
            swal("Atención", "Error");
        }
    }).fail(function (data_error) {
    });
}

//
function editarTv() {
    //
    var formElement = document.getElementById("formEditarTv");
    formData = new FormData(formElement);
    //
    formData.append('accion', 'editarTv');
    formData.append('idTv', idTvaEditar);
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
            $("#formEditarTv")[0].reset();
            $('#modalEditarTv').modal('hide');
            //
            cargarTablaTvs();
            //
            swal("Atención", "Editado!");
            //
        } else if (data === 2) {
            //
            swal("Atención", "Error al editar el tv!");
        }
    }).fail(function (data_error) {
        console.log(data_error);
        swal("Atención", "Error al conectarse!");
    });
}

//
function actualizarEstadoVideoTv(valor) {
    //
    $.ajax({
        url: 'controllers/update.php',
        type: 'post',
        data: {
            "idVid": valor,
            "accion": "actualizarEstadoVideoTv"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.sql === 1) {
            //
            if (data.estado === 'Activo') {
                //
                toastr.error('Video Desactivado!');
            } else {
                //
                toastr.success('Video Activado!');
            }
            //
        } else {
            //
            swal("Atención", "Error");
        }
    }).fail(function (data_error) {
    });
}

//
function editarVideo() {
    //
    var formElement = document.getElementById("formEditarVideo");
    formData = new FormData(formElement);
    //
    formData.append('accion', 'editarVideo');
    formData.append('idVid', idVideoTvaEditar);
    formData.append('idTv', idTvVideos);
    formData.append('videoA', videoTvA);
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
            $("#formEditarVideo")[0].reset();
            $('#modalEditarVideo').modal('hide');
            //
            cargarVideosTv(idTvVideos);
            //
            swal('Atención','Editado!');
            //
        } else if (data === 2) {
            //
            swal('Atención','Error al editar el video!');
        } else {
            //
            swal('Atención', 'Error al subir el video!');
        }
    }).fail(function (data_error) {
        console.log(data_error);
        alert('Error al conectarse!');
    });
}