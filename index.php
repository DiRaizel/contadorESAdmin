<?php

//
require 'controllers/views.php';
//
$view = new views();
//
include 'views/overalls/head.php';
//
if (isset($_GET['view'])) {
    //
    if ($_GET['view'] === 'home') {
        //
        $view->home();
        //
    } else if ($_GET['view'] === 'login') {
        //
        $view->login();
        //
    } else if ($_GET['view'] === 'usuarios') {
        //
        $view->usuarios();
        //
    } else if ($_GET['view'] === 'empresas') {
        //
        $view->empresas();
        //
    } else if ($_GET['view'] === 'sedes') {
        //
        $view->sedes();
        //
    } else if ($_GET['view'] === 'usuariosE') {
        //
        $view->usuariosE();
        //
    } else if ($_GET['view'] === 'sedesE') {
        //
        $view->sedesE();
        //
    } else if ($_GET['view'] === 'configuracionE') {
        //
        $view->configuracionE();
        //
    } else if ($_GET['view'] === 'reportesE') {
        //
        $view->reportesE();
        //
    } else if ($_GET['view'] === 'graficaChartE') {
        //
        $view->graficaChartE();
        //
    } else if ($_GET['view'] === 'graficaPieE') {
        //
        $view->graficaPieE();
        //
    }
} else {
    //
    $view->login();
}

