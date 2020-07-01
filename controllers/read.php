<?php

//
require '../models/mGeneral.php';
require '../models/mUsuario.php';
require '../models/mEmpresa.php';
require '../models/mSede.php';

//
$mGeneral = new general();
$mUsuario = new usuario();
$mEmpresa = new empresa();
$mSede = new sede();

//
if ($_POST['accion'] === 'login') {
    //
    $correo = $_POST['correo'];
    $password = base64_encode($_POST['password']);
    //
    $rsp = $mUsuario->login($correo, $password);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'cargarTablaUsuarios') {
    //
    $idUsu = (int) $_POST['idUsu'];
    $idEmp = (int) $_POST['idEmp'];
    //
    $rsp = $mUsuario->cargarTablaUsuarios($idUsu, $idEmp);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'cargarTablaEmpresas') {
    //
    $rsp = $mEmpresa->cargarTablaEmpresas();
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'cargarEmpresaaEditar') {
    //
    $idEmp = (int) $_POST['idEmp'];
    //
    $rsp = $mEmpresa->cargarEmpresaaEditar($idEmp);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'cargarSelectEmpresas') {
    //
    $rsp = $mEmpresa->cargarSelectEmpresas();
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'cargarSelectDepartamentos') {
    //
    $rsp = $mGeneral->cargarSelectDepartamentos();
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'cargarSelectCiudad') {
    //
    $idDep = (int) $_POST['idDep'];
    //
    $rsp = $mGeneral->cargarSelectCiudad($idDep);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'cargarTablaSedes') {
    //
    $idUsu = (int) $_POST['idUsu'];
    $idEmp = (int) $_POST['idEmp'];
    //
    $rsp = $mSede->cargarTablaSedes($idUsu, $idEmp);
    //
    echo json_encode($rsp);
} else if ($_POST['accion'] === 'cargarSedeaEditar') {
    //
    $idSed = (int) $_POST['idSed'];
    //
    $rsp = $mSede->cargarSedeaEditar($idSed);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'cargarSelectSedes') {
    //
    $idEmp = (int) $_POST['empresa'];
    //
    $rsp = $mSede->cargarSelectSedes($idEmp);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'cargarUsuarioaEditar') {
    //
    $idUsu = (int) $_POST['idUsu'];
    //
    $rsp = $mUsuario->cargarUsuarioaEditar($idUsu);
    //
    echo json_encode($rsp);
    //
}else if ($_POST['accion'] === 'cargarDatosGraficaTorta') {
    //
    print_r($_REQUEST);
    exit();
    $fechaInicial = $_POST['fechaInicial'];
    $fechaFinal = $_POST['fechaFinal'];
    $idEmp = (int) $_POST['idEmp'];
    //
    $rsp = $mGeneral->cargarDatosGraficaTorta($idEmp,$fechaInicial,$fechaFinal);
} else if ($_POST['accion'] === 'cargarTablasHome') {
    //
    $idUsu = (int) $_POST['idUsu'];
    $idEmp = (int) $_POST['idEmp'];
    //
    $rsp = $mSede->cargarTablasHome($idEmp);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'cargarCofigSede') {
    //
    $idSed = (int) $_POST['idSed'];
    //
    $rsp = $mSede->cargarCofigSede($idSed);
    //
    echo json_encode($rsp);
    //
}