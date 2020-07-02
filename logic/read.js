//-----------------------------Reloj en vivo------------------------------------
function show5() {
    if (!document.layers && !document.all && !document.getElementById)
        return;
//
    var Digital = new Date();
    var hours = Digital.getHours();
    var minutes = Digital.getMinutes();
    var seconds = Digital.getSeconds();

    var dn = "PM";
    if (hours < 12)
        dn = "AM";
    if (hours > 12)
        hours = hours - 12;
    if (hours == 0)
        hours = 12;

    if (minutes <= 9)
        minutes = "0" + minutes;
    if (seconds <= 9)
        seconds = "0" + seconds;
    //change font size here to your desire
    myclock = hours + ":" + minutes + ":"
            + seconds + " " + dn;
    if (document.layers) {
        document.layers.liveclock.document.write(myclock);
        document.layers.liveclock.document.close();
    } else if (document.all)
        liveclock.innerHTML = myclock;
    else if (document.getElementById)
        document.getElementById("liveclock").innerHTML = myclock;
    setTimeout("show5()", 1000);
}

//------------------------------------------------------------------------------

//
var intervaloHome;

//
$(document).ready(function () {
    //
});

//--------------------------------Configuracion General-------------------------

//
function ruta(valor) {
    //
    if (valor === 'home') {
        //
        window.location.href = "index.php?view=home";
        sessionStorage.location = 'home';
        //
    } else if (valor === 'usuarios') {
        //
        window.location.href = "index.php?view=usuarios";
        sessionStorage.location = 'usuarios';
        //
    } else if (valor === 'empresas') {
        //
        window.location.href = "index.php?view=empresas";
        sessionStorage.location = 'empresas';
        //
    } else if (valor === 'sedes') {
        //
        window.location.href = "index.php?view=sedes";
        sessionStorage.location = 'sedes';
        //
    } else if (valor === 'usuariosE') {
        //
        window.location.href = "index.php?view=usuariosE";
        sessionStorage.location = 'usuariosE';
        //
    } else if (valor === 'sedesE') {
        //
        window.location.href = "index.php?view=sedesE";
        sessionStorage.location = 'sedesE';
        //
    } else if (valor === 'configuracionE') {
        //
        window.location.href = "index.php?view=configuracionE";
        sessionStorage.location = 'configuracionE';
        //
    } else if (valor === 'reportesE') {
        //
        window.location.href = "index.php?view=reportesE";
        sessionStorage.location = 'reportesE';
        //
    } else if (valor === 'graficaChartE') {
        //
        window.location.href = "index.php?view=graficaChartE";
        sessionStorage.location = 'graficaChartE';
        //
    } else if (valor === 'graficaPieE') {
        //
        window.location.href = "index.php?view=graficaPieE";
        sessionStorage.location = 'graficaPieE';
        //
    }
}

//
function cargarConfiguraciones() {
    //
    cargarinfoInicio();
    //
    if (sessionStorage.idUsu === undefined) {
        //
        window.location.href = "index.php?view=login";
        sessionStorage.location = 'login';
        //
    } else if (sessionStorage.idUsu === '1') {
        //
        $('#homeMenu').css('display', 'none');
        $('#usuariosEMenu').css('display', 'none');
        $('#sedesEMenu').css('display', 'none');
        $('#configuracionEMenu').css('display', 'none');
        $('#graficasEMenu').css('display', 'none');
        $('#reportesEMenu').css('display', 'none');
    } else {
        //
        $('#usuariosMenu').css('display', 'none');
        $('#empresasMenu').css('display', 'none');
        $('#sedesMenu').css('display', 'none');
        //
        if (sessionStorage.rol === 'Administrador') {
            //
        } else {
            //
            $('#usuariosEMenu').css('display', 'none');
            $('#sedesEMenu').css('display', 'none');
            $('#configuracionEMenu').css('display', 'none');
            $('#reportesEMenu').css('display', 'none');
            $('#reportesMenu').css('display', 'none');
        }
    }
    //
    clearInterval(intervaloHome);
    //
    if (sessionStorage.location === 'home') {
        //
        cargarTablasHome();
        //
        intervaloHome = setInterval(function () {
            //
            cargarTablasHome();
        }, 10000);
        //
        $('#btnHomeMenu').addClass('active');
        //
    } else if (sessionStorage.location === 'usuarios') {
        //
        cargarSelectEmpresas();
        cargarTablaUsuariosS();
        //
        $('#btnUsuariosMenu').addClass('active');
        //
    } else if (sessionStorage.location === 'empresas') {
        //
        cargarSelectDepartamentos();
        cargarTablaEmpresas();
        //
        $('#btnEmpresasMenu').addClass('active');
        //
    } else if (sessionStorage.location === 'sedes') {
        //
        cargarSelectEmpresas();
        cargarSelectDepartamentos();
        cargarTablaSedesS();
        //
        $('#btnSedesMenu').addClass('active');
        //
    } else if (sessionStorage.location === 'usuariosE') {
        //
        cargarSelectSedes(1);
        cargarTablaUsuariosE();
        //
        $('#btnUsuariosEMenu').addClass('active');
        //
    } else if (sessionStorage.location === 'sedesE') {
        //
        cargarSelectDepartamentos();
        cargarTablaSedesE();
        //
        $('#btnSedesEMenu').addClass('active');
        //
    } else if (sessionStorage.location === 'configuracionE') {
        //
        $('#btnConfiguracionEMenu').addClass('active');
        //
    } else if (sessionStorage.location === 'reportesE') {
        //
        cargarSelectSedesR();
        //
        $('#btnReportesEMenu').addClass('active');
        $('#btnExcel').addClass('disabled');
        $('#btnPdf').addClass('disabled');
        //
    } else if (sessionStorage.location === 'graficaChartE') {
        //
        graficaBarras(datos2, categorias, 'titulo');
        //
        $('#btngraficasEMenu').addClass('active');
        $('#graficasEMenu').addClass('menu-open');
        $('#btngraficaChartEMenu').addClass('active');
        //
    } else if (sessionStorage.location === 'graficaPieE') {
        //
        graficaPie(datos1, 'titulo', 'subTitulo');
        //
        $('#btngraficasEMenu').addClass('active');
        $('#graficasEMenu').addClass('menu-open');
        $('#btngraficaPieEMenu').addClass('active');
    }
}

/*-----------------------------------login------------------------------------*/

//
function login() {
    //
    var formElement = document.getElementById("formLogin");
    formData = new FormData(formElement);
    //
    formData.append('accion', 'login');
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        dataType: 'json'
    }).done(function (data) {
        //
        if (data !== 0) {
            //
            sessionStorage.idUsu = data.idUsu;
            sessionStorage.nombres = data.nombres;
            sessionStorage.apellidos = data.apellidos;
            sessionStorage.documento = data.documento;
            sessionStorage.correo = data.correo;
            sessionStorage.rol = data.rol;
            sessionStorage.password = data.password;
            sessionStorage.estado = data.estado;
            sessionStorage.estadoPassword = data.estadoPassword;
            sessionStorage.idEmp = data.idEmp;
            sessionStorage.nombreEmp = data.nombreEmp;
            //
            if (sessionStorage.idUsu == 1) {
                //
                window.location.href = "index.php?view=usuarios";
                sessionStorage.location = 'usuarios';
            } else {
                //
                window.location.href = "index.php?view=home";
                sessionStorage.location = 'home';
            }
        } else {
            //
            swal("Atención", "Credenciales incorretas!");
        }
    }).fail(function (data_error) {
        console.log(data_error);
        swal("Atención", "Error al conectarse!");
    });
}

//
function cerrarSesion() {
    //
    delete sessionStorage.idUsu;
    delete sessionStorage.nombres;
    delete sessionStorage.apellidos;
    delete sessionStorage.documento;
    delete sessionStorage.correo;
    delete sessionStorage.rol;
    delete sessionStorage.password;
    delete sessionStorage.estado;
    delete sessionStorage.estadoPassword;
    delete sessionStorage.idEmp;
    delete sessionStorage.nombreEmp;
    //
    window.location.href = "index.php?view=login";
    sessionStorage.location = 'login';
}

//
function recuperarPass() {
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: {
            "correo": $('#correoR').val(),
            "accion": "recuperarPass"
        }
    }).done(function (data) {
        //
        if (data === '1') {
            //
            M.toast({html: 'Su contraseña ha sido enviada al correo ingresado!', classes: '#00bfa5 teal accent-4'}, 5000);
        } else if (data === '2') {
            //
            M.toast({html: 'El correo no esta registrado!', classes: '#e53935 red darken-1'}, 5000);
        }
    }).fail(function (data_error) {
    });
}

//------------------------------------Home--------------------------------------

//
function cargarTablasHome() {
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: {
            accion: "cargarTablasHome",
            idUsu: sessionStorage.idUsu,
            idEmp: sessionStorage.idEmp
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.length > 0) {
            //
            var campos = '';
            //
            for (var i = 0; i < data[0].length; i++) {
                //
                campos += '<tr><td>' + data[0][i]['nombreSede'] + '</td>';
                campos += '<td>' + data[0][i]['nombreCiu'] + '</td>';
                campos += '<td>' + data[0][i]['poblacion'] + '</td>';
                campos += '<td>' + data[0][i]['count'] + '</td></tr>';
            }
            //
            $('#bodyTablaSedesHome').html(campos);
            //
            cargarGrafico(data[1]);
        } else {
            //
            $('#bodyTablaSedesHome').html('<tr style="text-align: center;">No hay Registros el dia de hoy...</tr>');
        }
    }).fail(function (data_error) {
    });
}

//
function cargarGrafico(valor) {
    //
    var myChartB = Highcharts.chart('graBarras', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafico de sedes'
        },
        xAxis: {
            categories: valor.nombres
        },
        yAxis: {
            title: {
                text: 'Sedes'
            }
        },
        series: valor.series
    });
}

//-----------------------------------Inicio-------------------------------------

//
function cargarinfoInicio() {
    //
//    if (sessionStorage.imagenEmp !== '') {
//        //
//        $('#imgEmpresa').attr('src', 'imagenes/empresas/' + sessionStorage.imagenEmp);
//    }
    //
    if (sessionStorage.nombreEmp !== '' && sessionStorage.nombreEmp !== undefined) {
        //
        $('#nombreEmp').html(sessionStorage.nombreEmp);
    }
}

//-----------------------------------Usuarios-----------------------------------

//
function cargarTablaUsuariosS() {
    //
    var tabla = $('#tablaUsuarios').DataTable({
        destroy: true,
        ajax: {
            method: "POST",
            url: "controllers/read.php",
            data: {
                accion: "cargarTablaUsuarios",
                idUsu: sessionStorage.idUsu,
                idEmp: sessionStorage.idEmp
            }
        },
        columns: [
            {
                "data": "idUsu"
            },
            {
                "data": "nombre"
            },
            {
                "data": "documento"
            },
            {
                "data": "correo"
            },
            {
                "data": "rol"
            },
            {
                "data": "nombreEmp"
            },
            {
                "data": "nombreSed"
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    //
                    if (JsonResultRow.estado === 'Activo') {
                        //
                        return '<label class="switch"><input onclick="actualizarEstadoUsuario(' + JsonResultRow.idUsu + ')" type="checkbox" checked><span class="slider round"></span></label>';
                    } else {
                        //
                        return '<label class="switch"><input onclick="actualizarEstadoUsuario(' + JsonResultRow.idUsu + ')" type="checkbox"><span class="slider round"></span></label>';
                    }
                }
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return '<button onclick="cargarUsuarioaEditar(' + JsonResultRow.idUsu + ')" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-eUsuario-modal-xl"><i class="fas fa-pen-square"></i></button>';
                }
            }
        ],
        scrollY: '41vh',
        responsive: true,
        language: {
            "url": "libs/json/Spanish.json"
        }
    });
}

//
function cargarTablaUsuariosE() {
    //
    var tabla = $('#tablaUsuarios').DataTable({
        destroy: true,
        ajax: {
            method: "POST",
            url: "controllers/read.php",
            data: {
                accion: "cargarTablaUsuarios",
                idUsu: sessionStorage.idUsu,
                idEmp: sessionStorage.idEmp
            }
        },
        columns: [
            {
                "data": "idUsu"
            },
            {
                "data": "nombre"
            },
            {
                "data": "documento"
            },
            {
                "data": "correo"
            },
            {
                "data": "rol"
            },
            {
                "data": "nombreSed"
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    //
                    if (JsonResultRow.estado === 'Activo') {
                        //
                        return '<label class="switch"><input onclick="actualizarEstadoUsuario(' + JsonResultRow.idUsu + ')" type="checkbox" checked><span class="slider round"></span></label>';
                    } else {
                        //
                        return '<label class="switch"><input onclick="actualizarEstadoUsuario(' + JsonResultRow.idUsu + ')" type="checkbox"><span class="slider round"></span></label>';
                    }
                }
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return '<button onclick="cargarUsuarioaEditar(' + JsonResultRow.idUsu + ')" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-eUsuario-modal-xl"><i class="fas fa-pen-square"></i></button>';
                }
            }
        ],
        scrollY: '41vh',
        responsive: true,
        language: {
            "url": "libs/json/Spanish.json"
        }
    });
}

//
var arrayEmpresas = [];

//
function cargarSelectEmpresas() {
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: {
            "accion": "cargarSelectEmpresas"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        arrayEmpresas = data;
        //
        if (data[0].sql === 1) {
            //
            var campos = '<option value="" selected disabled>Selecciona</option>';
            //
            for (var i = 0; i < data.length; i++) {
                //
                campos += '<option value="' + data[i]['idEmp'] + '">' + data[i]['nombre'] + '</option>';
            }
            //
            $('#empresa').html(campos);
        } else {
            //
            $('#empresa').html('<option value="" selected disabled>No hay empresas</option>');
        }
    }).fail(function (data_error) {
    });
}

//
function cargarSelectSedes(valor) {
    //
    let idEmp = 0;
    //
    if (sessionStorage.idUsu == 1) {
        //
        if (valor === 1) {
            //
            idEmp = $('#empresa').val();
        } else {
            //
            idEmp = $('#empresae').val();
        }
    } else {
        //
        idEmp = sessionStorage.idEmp;
    }
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: {
            "empresa": idEmp,
            "accion": "cargarSelectSedes"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.length > 0) {
            //
            var campos = '<option value="" selected disabled>Selecciona</option>';
            //
            for (var i = 0; i < data.length; i++) {
                //
                campos += '<option value="' + data[i]['idSed'] + '">' + data[i]['nombre'] + '</option>';
            }
            //
            if (valor === 1) {
                //
                $('#sede').html(campos);
            } else {
                //
                $('#sedee').html(campos);
            }
        } else {
            //
            if (valor === 1) {
                //
                $('#sede').html('<option value="" selected disabled>No hay sedes</option>');
            } else {
                //
                $('#sedee').html('<option value="" selected disabled>No hay sedes</option>');
            }
        }
    }).fail(function (data_error) {
    });
}

//
var idUsuarioaEditar = 0;
var passwordUsuA = '';
var correoUsuA = '';
var arrayRol = ['Administrador', 'Funcionario'];

//
function cargarUsuarioaEditar(valor) {
    //
    idUsuarioaEditar = valor;
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: {
            "idUsu": valor,
            "accion": "cargarUsuarioaEditar"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data[0].sql === 1) {
            //
            $('#documento').val(data[0].documento);
            $('#nombres').val(data[0].nombres);
            $('#apellidos').val(data[0].apellidos);
            $('#correo').val(data[0].correo);
            correoUsuA = data[0].correo;
            //
            let camposR = '<option value="" disabled>Selecciona</option>';
            //
            for (var i = 0; i < arrayRol.length; i++) {
                //
                if (data[0].rol === arrayRol[i]) {
                    //
                    camposR += '<option value="' + arrayRol[i] + '" selected>' + arrayRol[i] + '</option>';
                } else {
                    //
                    camposR += '<option value="' + arrayRol[i] + '">' + arrayRol[i] + '</option>';
                }
            }
            //
            $('#rol').html(camposR);
            //
            let camposE = '<option value="" disabled>Selecciona</option>';
            //
            for (var i = 0; i < arrayEmpresas.length; i++) {
                //
                if (data[0].idEmp === arrayEmpresas[i]['idEmp']) {
                    //
                    camposE += '<option value="' + arrayEmpresas[i]['idEmp'] + '" selected>' + arrayEmpresas[i]['nombre'] + '</option>';
                } else {
                    //
                    camposE += '<option value="' + arrayEmpresas[i]['idEmp'] + '">' + arrayEmpresas[i]['nombre'] + '</option>';
                }
            }
            //
            $('#empresae').html(camposE);
            //
            let camposS = '<option value="0" disabled>Selecciona</option>';
            //
            if (data[0].sedes.length > 0) {
                //
                for (var i = 0; i < data[0].sedes.length; i++) {
                    //
                    if (data[0].idSed === data[0].sedes[i]['idSed']) {
                        //
                        camposS += '<option value="' + data[0].sedes[i]['idSed'] + '" selected>' + data[0].sedes[i]['nombre'] + '</option>';
                    } else {
                        //
                        camposS += '<option value="' + data[0].sedes[i]['idSed'] + '">' + data[0].sedes[i]['nombre'] + '</option>';
                    }
                }
            } else {
                //
                camposS = '<option value="0">No hay sedes</option>';
            }
            //
            $('#sedee').html(camposS);
            $('#passworde').val(data[0].password);
            passwordUsuA = data[0].password;
            //
        } else {
            //
            swal("Atención", "Error al cargar la empresa!");
        }
    }).fail(function (data_error) {
    });
}

//----------------------------------Empresas------------------------------------

//
function cargarTablaEmpresas() {
    //
    var tabla = $('#tablaEmpresas').DataTable({
        destroy: true,
        ajax: {
            method: "POST",
            url: "controllers/read.php",
            data: {
                accion: "cargarTablaEmpresas"
            }
        },
        columns: [
            {
                "data": "idEmp"
            },
            {
                "data": "nombre"
            },
            {
                "data": "nit"
            },
            {
                "data": "ciudad"
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    //
                    if (JsonResultRow.estado === 'Activa') {
                        //
                        return '<label class="switch"><input onclick="actualizarEstadoEmpresa(' + JsonResultRow.idEmp + ')" type="checkbox" checked><span class="slider round"></span></label>';
                    } else {
                        //
                        return '<label class="switch"><input onclick="actualizarEstadoEmpresa(' + JsonResultRow.idEmp + ')" type="checkbox"><span class="slider round"></span></label>';
                    }
                }
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return '<button onclick="cargarEmpresaaEditar(' + JsonResultRow.idEmp + ')" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-eEmpresa-modal-xl"><i class="fas fa-pen-square"></i></button>';
                }
            }
        ],
        scrollY: '41vh',
        responsive: true,
        language: {
            "url": "libs/json/Spanish.json"
        }
    });
}

//
var idEmpresaaEditar = 0;

//
function cargarEmpresaaEditar(valor) {
    //
    idEmpresaaEditar = valor;
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: {
            "idEmp": valor,
            "accion": "cargarEmpresaaEditar"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data[0].sql === 1) {
            //
            $('#nombre').val(data[0].nombre);
            $('#nit').val(data[0].nit);
            //
            let camposD = '<option value="" disabled>Selecciona</option>';
            //
            for (var i = 0; i < arrayDepartamentos.length; i++) {
                //
                if (data[0].idDep === arrayDepartamentos[i]['idDep']) {
                    //
                    camposD += '<option value="' + arrayDepartamentos[i]['idDep'] + '" selected>' + arrayDepartamentos[i]['nombre'] + '</option>';
                } else {
                    //
                    camposD += '<option value="' + arrayDepartamentos[i]['idDep'] + '">' + arrayDepartamentos[i]['nombre'] + '</option>';
                }
            }
            //
            $('#departamentoe').html(camposD);
            //
            let camposC = '<option value="" disabled>Selecciona</option>';
            //
            for (var i = 0; i < data[0].ciudades.length; i++) {
                //
                if (data[0].idCiu === data[0].ciudades[i]['idCiu']) {
                    //
                    camposC += '<option value="' + data[0].ciudades[i]['idCiu'] + '" selected>' + data[0].ciudades[i]['nombre'] + '</option>';
                } else {
                    //
                    camposC += '<option value="' + data[0].ciudades[i]['idCiu'] + '">' + data[0].ciudades[i]['nombre'] + '</option>';
                }
            }
            //
            $('#ciudade').html(camposC);
            //
        } else {
            //
            swal("Atención", "Error al cargar la empresa!");
        }
    }).fail(function (data_error) {
    });
}

//-----------------------------------Sedes--------------------------------------

//
function cargarTablaSedesS() {
    //
    var tabla = $('#tablaSedes').DataTable({
        destroy: true,
        ajax: {
            method: "POST",
            url: "controllers/read.php",
            data: {
                idUsu: sessionStorage.idUsu,
                idEmp: sessionStorage.idEmp,
                accion: "cargarTablaSedes"
            }
        },
        columns: [
            {
                "data": "idSed"
            },
            {
                "data": "nombre"
            },
            {
                "data": "empresa"
            },
            {
                "data": "ciudad"
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return '<button onclick="cargarCofigSede(' + JsonResultRow.idSed + ',' + JsonResultRow.idEmp + ')" type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-configuracion-modal-xl"><i class="fas fa fa-cogs"></i></button>';
                }
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    //
                    if (JsonResultRow.estado === 'Activa') {
                        //
                        return '<label class="switch"><input onclick="actualizarEstadoSede(' + JsonResultRow.idSed + ')" type="checkbox" checked><span class="slider round"></span></label>';
                    } else {
                        //
                        return '<label class="switch"><input onclick="actualizarEstadoSede(' + JsonResultRow.idSed + ')" type="checkbox"><span class="slider round"></span></label>';
                    }
                }
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return '<button onclick="cargarSedeaEditar(' + JsonResultRow.idSed + ')" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-eSede-modal-xl"><i class="fas fa-pen-square"></i></button>';
                }
            }
        ],
        scrollY: '41vh',
        responsive: true,
        language: {
            "url": "libs/json/Spanish.json"
        }
    });
}

//
function cargarTablaSedesE() {
    //
    var tabla = $('#tablaSedes').DataTable({
        destroy: true,
        ajax: {
            method: "POST",
            url: "controllers/read.php",
            data: {
                idUsu: sessionStorage.idUsu,
                idEmp: sessionStorage.idEmp,
                accion: "cargarTablaSedes"
            }
        },
        columns: [
            {
                "data": "idSed"
            },
            {
                "data": "nombre"
            },
            {
                "data": "ciudad"
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return '<button onclick="cargarCofigSede(' + JsonResultRow.idSed + ',' + JsonResultRow.idEmp + ')" type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-configuracion-modal-xl"><i class="fas fa fa-cogs"></i></button>';
                }
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    //
                    if (JsonResultRow.estado === 'Activa') {
                        //
                        return '<label class="switch"><input onclick="actualizarEstadoSede(' + JsonResultRow.idSed + ')" type="checkbox" checked><span class="slider round"></span></label>';
                    } else {
                        //
                        return '<label class="switch"><input onclick="actualizarEstadoSede(' + JsonResultRow.idSed + ')" type="checkbox"><span class="slider round"></span></label>';
                    }
                }
            },
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return '<button onclick="cargarSedeaEditar(' + JsonResultRow.idSed + ')" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-eSede-modal-xl"><i class="fas fa-pen-square"></i></button>';
                }
            }
        ],
        scrollY: '41vh',
        responsive: true,
        language: {
            "url": "libs/json/Spanish.json"
        }
    });
}

//
var idConfigSede = 0;
var idConfigSedeEmp = 0;

//
function cargarCofigSede(valor, valor2) {
    //
    idConfigSede = valor;
    idConfigSedeEmp = valor2;
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: {
            "idSed": valor,
            "accion": "cargarCofigSede"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.length > 0) {
            //
            $('#max').val(data[0].max);
            //
        } else {
            //
            $('#max').val(0);
        }
    }).fail(function (data_error) {
    });
}

//
var idSedeaEditar = 0;

//
function cargarSedeaEditar(valor) {
    //
    idSedeaEditar = valor;
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: {
            "idSed": valor,
            "accion": "cargarSedeaEditar"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data[0].sql === 1) {
            //
            $('#nombre').val(data[0].nombre);
            //
            let camposE = '<option value="" disabled>Selecciona</option>';
            //
            for (var i = 0; i < arrayEmpresas.length; i++) {
                //
                if (data[0].idEmp === arrayEmpresas[i]['idEmp']) {
                    //
                    camposE += '<option value="' + arrayEmpresas[i]['idEmp'] + '" selected>' + arrayEmpresas[i]['nombre'] + '</option>';
                } else {
                    //
                    camposE += '<option value="' + arrayEmpresas[i]['idEmp'] + '">' + arrayEmpresas[i]['nombre'] + '</option>';
                }
            }
            //
            $('#empresae').html(camposE);
            //
            let camposD = '<option value="" disabled>Selecciona</option>';
            //
            for (var i = 0; i < arrayDepartamentos.length; i++) {
                //
                if (data[0].idDep === arrayDepartamentos[i]['idDep']) {
                    //
                    camposD += '<option value="' + arrayDepartamentos[i]['idDep'] + '" selected>' + arrayDepartamentos[i]['nombre'] + '</option>';
                } else {
                    //
                    camposD += '<option value="' + arrayDepartamentos[i]['idDep'] + '">' + arrayDepartamentos[i]['nombre'] + '</option>';
                }
            }
            //
            $('#departamentoe').html(camposD);
            //
            let camposC = '<option value="" disabled>Selecciona</option>';
            //
            for (var i = 0; i < data[0].ciudades.length; i++) {
                //
                if (data[0].idCiu === data[0].ciudades[i]['idCiu']) {
                    //
                    camposC += '<option value="' + data[0].ciudades[i]['idCiu'] + '" selected>' + data[0].ciudades[i]['nombre'] + '</option>';
                } else {
                    //
                    camposC += '<option value="' + data[0].ciudades[i]['idCiu'] + '">' + data[0].ciudades[i]['nombre'] + '</option>';
                }
            }
            //
            $('#ciudade').html(camposC);
            //
        } else {
            //
            swal("Atención", "Error al cargar la empresa!");
        }
    }).fail(function (data_error) {
    });
}

//---------------------------------General--------------------------------------

//
var arrayDepartamentos = [];

//
function cargarSelectDepartamentos() {
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: {
            "accion": "cargarSelectDepartamentos"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        arrayDepartamentos = data;
        //
        if (data[0].sql === 1) {
            //
            var campos = '<option value="" selected disabled>Selecciona</option>';
            //
            for (var i = 0; i < data.length; i++) {
                //
                campos += '<option value="' + data[i]['idDep'] + '">' + data[i]['nombre'] + '</option>';
            }
            //
            $('#departamento').html(campos);
        } else {
            //
            $('#departamento').html('<option value="" selected disabled>No hay departamentos</option>');
        }
    }).fail(function (data_error) {
    });
}

//
function cargarSelectCiudad() {
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: {
            "idDep": $('#departamento').val(),
            "accion": "cargarSelectCiudad"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data[0].sql === 1) {
            //
            var campos = '<option value="" selected disabled>Selecciona</option>';
            //
            for (var i = 0; i < data.length; i++) {
                //
                campos += '<option value="' + data[i]['idCiu'] + '">' + data[i]['nombre'] + '</option>';
            }
            //
            $('#ciudad').html(campos);
        } else {
            //
            $('#ciudad').html('<option value="" selected disabled>No hay ciudades</option>');
        }
    }).fail(function (data_error) {
    });
}

////----------------------------------------- Graficas -------------------------------------------------////

var datos1 = [{
        name: 'Share',
        data: [
            {name: 'Chrome', y: 61.41},
            {name: 'Internet Explorer', y: 11.84}
        ]
    }];

function cargarDatosGraficaTorta() {
    //
    if ($('#fechaInicialGrafica').val() == "" || $('#fechaFinalGrafica').val() == "") {
        alert("fechas vacias");
    } else {
        $.ajax({
            url: 'controllers/read.php',
            type: 'post',
            data: {
                "accion": "cargarDatosGraficaTorta",
                "fechaInicial": $('#fechaInicialGrafica').val(),
                "fechaFinal": $('#fechaFinalGrafica').val(),
                "idEmp": sessionStorage.idEmp
            },
            dataType: 'json'
        }).done(function (data) {
            //

            //
        }).fail(function (data_error) {

        });
    }
}
;

//
function graficaPie(datos, titulo, subTitulo) {
    //
//          console.log(datos1);
//
    var myChartP = Highcharts.chart('containerGraficaTorta', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: titulo
        },
        subtitle: {
            text: subTitulo
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: datos
    });
}
//    
//console.log("error");
//
////    *************************************************************************
var datos2 = [{
        name: 'Tokyo',
        data: [49.9]
    }];

var categorias = [
    'Jan'
];


function graficaBarras(datos2, categorias, titulo) {
    //
    console.log(datos2);
    var myChartB = Highcharts.chart('containerGraficaColumna', {
        chart: {
            type: 'column'
        },
        title: {
            text: titulo
        },
        xAxis: {
            categories: categorias
        },
        yAxis: {
            title: {
                text: 'Servicios'
            }
        },
        series: datos2
    });
}

//----------------------------------Reportes------------------------------------

//
function generarReporte() {
    //
    var formElement = document.getElementById("formReporte");
    formData = new FormData(formElement);
    //
    formData.append('accion', 'generarReporte');
    formData.append('empresa', sessionStorage.idEmp);
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.length > 0) {
            //
            var campos = '';
            //
            for (var i = 0; i < data.length; i++) {
                //
                campos += '<tr><td>' + data[i]['nombreSede'] + '</td>';
                campos += '<td>' + data[i]['nombreCiu'] + '</td>';
                campos += '<td>' + data[i]['fecha'] + '</td>';
                campos += '<td>' + data[i]['count'] + '</td></tr>';
            }
            //
            $('#bodyTablaReporte').html(campos);
            $("#btnExcel").attr('href', 'reportes/reporte-' + sessionStorage.idEmp + '.xlsx');
            $('#btnExcel').removeClass('disabled');
            $("#btnPdf").attr('href', 'reportes/reporte-' + sessionStorage.idEmp + '.pdf');
            $('#btnPdf').removeClass('disabled');
            //
        } else {
            //
            swal("Atención", "No hay registros en el rango de fechas seleccionado!");
        }
    }).fail(function (data_error) {
        console.log(data_error);
        swal("Atención", "Error al conectarse!");
    });
}


//
function cargarSelectSedesR() {
    //
    $.ajax({
        url: 'controllers/read.php',
        type: 'post',
        data: {
            "empresa": sessionStorage.idEmp,
            "accion": "cargarSelectSedes"
        },
        dataType: 'json'
    }).done(function (data) {
        //
        if (data.length > 0) {
            //
            var campos = '<option value="todo" selected>Todo</option>';
            //
            for (var i = 0; i < data.length; i++) {
                //
                campos += '<option value="' + data[i]['idSed'] + '">' + data[i]['nombre'] + '</option>';
            }
            //
            $('#sede').html(campos);
            //
        } else {
            //
            $('#sede').html('<option value="todo" selected>Todo</option>');
        }
    }).fail(function (data_error) {
    });
}