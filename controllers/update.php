<?php

//
require '../models/mUsuario.php';
require '../models/mEmpresa.php';
require '../models/mSede.php';
require '../models/mTv.php';

//
$mUsuario = new usuario();
$mEmpresa = new empresa();
$mSede = new sede();
$mTv = new tv();

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
} else if ($_POST['accion'] === 'actualizarEstadoTv') {
    //
    $idTv = $_POST['idTv'];
    //
    $rsp = $mTv->actualizarEstadoTv($idTv);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'editarTv') {
    //
    $idTv = $_POST['idTv'];
    $nombre = $_POST['nombre'];
    //
    $rsp = $mTv->editarTv($idTv, $nombre);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'actualizarEstadoVideoTv') {
    //
    $idVid = $_POST['idVid'];
    //
    $rsp = $mTv->actualizarEstadoVideoTv($idVid);
    //
    echo json_encode($rsp);
    //
} else if ($_POST['accion'] === 'editarVideo') {
    //
    $idVid = $_POST['idVid'];
    $videoA = $_POST['videoA'];
    //
    $file = $_FILES['file'];
    $temp = $_FILES['file']['tmp_name'];
    $video = '';
    //
    if ($temp !== '') {
        //
        $ext = new SplFileInfo($_FILES['file']['name']);
        //
        $video = time() . '.' . $ext->getExtension();
    } else {
        //
        $video = $videoA;
    }
    //
    $idTv = $_POST['idTv'];
    $idEmp = $_POST['idEmp'];
    $orden = $_POST['orden'];
    $volumen = $_POST['volumen'];
    //
    $rsp = $mTv->editarVideo($idVid, $orden, $volumen, $video);
    //
    if ($rsp) {
        //
        if ($video !== '' && $video !== $videoA) {
            //
            if ($videoA !== '') {
                //
                unlink("../videos/empresas/" . $idEmp . '/' . $idTv . '/'. $videoA);
            }
            //
            $ruta = "../videos/empresas/" . $idEmp . '/' . $idTv . '/' . $video;
            //
            if (move_uploaded_file($temp, $ruta)) {
                //
                echo 1;
            } else {
                //
                echo 3;
            }
        } else {
            //
            echo 1;
        }
    } else {
        //
        echo 2;
    }
    //
} 