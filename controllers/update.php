<?php

//
require '../models/mUsuario.php';
require '../models/mEmpresa.php';
require '../models/mSede.php';

//
$mUsuario = new usuario();
$mEmpresa = new empresa();
$mSede = new sede();

//
if ($_POST['accion'] === 'actualizarEstadoUsuario') {
    //
    $idUsu = $_POST['idUsu'];
    //
    $rsp = $mUsuario->actualizarEstadoUsuario($idUsu);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'actualizarEstadoEmpresa') {
    //
    $idEmp = $_POST['idEmp'];
    //
    $rsp = $mEmpresa->actualizarEstadoEmpresa($idEmp);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'editarEmpresa') {
    //
    $idEmp = $_POST['idEmp'];
    $nombre = $_POST['nombre'];
    $nit = $_POST['nit'];
    $ciudad = $_POST['ciudad'];
    //
    $rsp = $mEmpresa->editarEmpresa($idEmp, $nombre, $nit, $ciudad);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'actualizarEstadoSede') {
    //
    $idSed = $_POST['idSed'];
    //
    $rsp = $mSede->actualizarEstadoSede($idSed);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'editarSede') {
    //
    $idUsu = (int) $_POST['idUsu'];
    //
    $empresa = 0;
    //
    if ($idUsu !== 1) {
        //
        $empresa = $_POST['idEmp'];
    } else {
        //
        $empresa = $_POST['empresa'];
    }
    //
    $idSed = $_POST['idSed'];
    $nombre = $_POST['nombre'];
    $ciudad = $_POST['ciudad'];
    //
    $rsp = $mSede->editarSede($idSed, $nombre, $empresa, $ciudad);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'editarUsuario') {
    //
    $idEmp = (int) $_POST['idEmp'];
    $idUsu = $_POST['idUsu'];
    $correoA = $_POST['correoA'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $documento = $_POST['documento'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    //
    if ($idEmp != 0) {
        //
        $empresa = $idEmp;
    } else {
        //
        $empresa = $_POST['empresa'];
    }
    //
    $sede = $_POST['sede'];
    $password = base64_encode($_POST['password']);
    //
    $rsp = $mUsuario->editarUsuario($idUsu, $correoA, $nombres, $apellidos, $documento, $correo, $rol, $empresa, $sede, $password);
    //
    echo json_encode($rsp);
    //
}