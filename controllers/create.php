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
if ($_POST['accion'] === 'guardarUsuario') {
    //
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $documento = $_POST['documento'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    $empresa = $_POST['empresa'];
    $sede = $_POST['sede'];
    $password = base64_encode($_POST['password']);
    //
    $rsp = $mUsuario->guardarUsuario($nombres, $apellidos, $documento, $correo, $rol, $empresa, $sede, $password);
    //
    if ($rsp) {
        //
        echo 1;
    } else {
        //
        echo 2;
    }
} else if ($_POST['accion'] === 'guardarEmpresa') {
    //
    $nombre = $_POST['nombre'];
    $nit = $_POST['nit'];
    $ciudad = $_POST['ciudad'];
    //
    $rsp = $mEmpresa->guardarEmpresa($nombre, $nit, $ciudad);
    //
    if ($rsp) {
        //
        echo 1;
    } else {
        //
        echo 2;
    }
    //
} else if ($_POST['accion'] === 'guardarSede') {
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
    $nombre = $_POST['nombre'];
    $ciudad = $_POST['ciudad'];
    //
    $rsp = $mSede->guardarSede($nombre, $empresa, $ciudad);
    //
    if ($rsp) {
        //
        echo 1;
    } else {
        //
        echo 2;
    }
    //
} else if ($_POST['accion'] === 'guardarConfigSede') {
    //
    $idSed = $_POST['idSed'];
    $idEmp = $_POST['idEmp'];
    $max = $_POST['max'];
    //
    $rsp = $mSede->guardarConfigSede($idSed, $idEmp, $max);
    //
    if ($rsp) {
        //
        echo 1;
    } else {
        //
        echo 2;
    }
    //
} else if ($_POST['accion'] === 'guardarTv') {
    //
    $idEmp = $_POST['idEmp'];
    $nombre = $_POST['nombre'];
    //
    $rsp = $mTv->guardarTv($idEmp, $nombre);
    //
    if ($rsp) {
        //
        echo 1;
    } else {
        //
        echo 2;
    }
    //
} else if ($_POST['accion'] === 'guardarVideo') {
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
    }
    //
    $idTv = $_POST['idTv'];
    $idEmp = $_POST['idEmp'];
    $orden = $_POST['orden'];
    $volumen = $_POST['volumen'];
    //
    $rsp = $mTv->guardarVideo($idTv, $orden, $volumen, $video);
    //
    if ($rsp) {
        //
        if ($video !== '') {
            //
            $ruta0 = "../videos/empresas/" . $idEmp;
            $ruta = "../videos/empresas/" . $idEmp . '/' . $idTv;
            //
            $dir = false;
            $dir2 = false;
            //
            if (is_dir($ruta0)) {
                //
                $dir = true;
            } else {
                //
                mkdir($ruta0);
                //
                $dir = true;
            }
            //
            if (is_dir($ruta)) {
                //
                $dir2 = true;
            } else {
                //
                mkdir($ruta);
                //
                $dir2 = true;
            }
            //
            if ($dir && $dir2) {
                //
                if (move_uploaded_file($temp, $ruta . '/' . $video)) {
                    //
                    echo 1;
                } else {
                    //
                    echo 3;
                }
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