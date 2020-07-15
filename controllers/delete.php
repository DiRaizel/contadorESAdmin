<?php

//
require '../models/mUsuario.php';
//
//
$mUsuario = new usuario();

//
if ($_POST['accion'] === 'eliminar') {
    //
    $idRel = $_POST['idRel'];
    //
    $rsp = $mUsuario->eliminar($idRel);
    //
    if ($rsp) {
        //
        echo 1;
    }else{
        //
        echo 2;
    }
} 