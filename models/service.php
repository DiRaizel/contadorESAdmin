<?php

//http://localhost/contadorESAdmin/models/service.php?e=1&sd=&tp=3&id=1&res=0

//
date_default_timezone_set('America/Bogota');

//
require 'config.php';

//
$empresa = $_REQUEST["e"];
$sede = $_REQUEST["sd"];

//
if ($sede == '') {
    //
    $sede = 0;
}
//
$rspV = mysqli_query($con, "select ensa_id from entrada_salida where emp_id = "
        . "$empresa and sed_id = $sede");
//
if ($_REQUEST["res"] == '1') {
    //
    if (mysqli_num_rows($rspV) > 0) {
        //
        $rspCV = mysqli_query($con, "select c.con_max, es.ensa_poblacion from "
                . "configuracion c join entrada_salida es on c.emp_id = "
                . "es.emp_id and c.sed_id = es.sed_id where es.emp_id = $empresa and es.sed_id = $sede");
        //
        if (mysqli_num_rows($rspCV) > 0) {
            //
            $rowCV = mysqli_fetch_assoc($rspCV);
            //
            $poblacion = (int) $rowCV['ensa_poblacion'];
            $poblacionMax = (int) $rowCV['con_max'];
            //
            if ($poblacion < $poblacionMax) {
                //
                $rsp = mysqli_query($con, "update entrada_salida set ensa_"
                        . "poblacion = ensa_poblacion + 1 where emp_id = "
                        . "$empresa and sed_id = $sede");
            }
        }
    } else {
        //
        $rsp = mysqli_query($con, "insert into entrada_salida values (null, 1, "
                . "$empresa, $sede)");
    }
    //
    $rspC = mysqli_query($con, "select c.con_max, es.ensa_poblacion from "
            . "configuracion c join entrada_salida es on c.emp_id = "
            . "es.emp_id and c.sed_id = es.sed_id where es.emp_id = $empresa and es.sed_id = $sede");
    //
    if (mysqli_num_rows($rspC) > 0) {
        //
        while ($row = mysqli_fetch_assoc($rspC)) {
            //
            echo '**,' . $row['ensa_poblacion'] . ',' . $row['con_max'];
        }
    }
    //
} else if ($_REQUEST["res"] == '0') {
    //
    if (mysqli_num_rows($rspV) > 0) {
        //
        $rspVP = mysqli_query($con, "select ensa_poblacion from entrada_salida "
                . "where emp_id = $empresa and sed_id = $sede");
        //
        if (mysqli_num_rows($rspVP) > 0) {
            //
            $rowVP = mysqli_fetch_assoc($rspVP);
            //
            $poblacion = (int) $rowVP['ensa_poblacion'];
            //
            if ($poblacion > 0) {
                //
                $rsp = mysqli_query($con, "update entrada_salida set ensa_poblacion = ensa"
                        . "_poblacion - 1 where emp_id = $empresa and sed_id = $sede");
                //
                if ($rsp) {
                    //
                    $rspC = mysqli_query($con, "select c.con_max, es.ensa_poblacion from "
                            . "configuracion c join entrada_salida es on c.emp_id = "
                            . "es.emp_id and c.sed_id = es.sed_id where es.emp_id = $empresa and es.sed_id = $sede");
                    //
                    if (mysqli_num_rows($rspC) > 0) {
                        //
                        while ($row = mysqli_fetch_assoc($rspC)) {
                            //
                            echo '**,' . $row['ensa_poblacion'] . ',' . $row['con_max'];
                        }
                    }
                } else {
                    //
                    echo 'error';
                }
            } else {
                //
                echo 0;
            }
        }
    }
    //
} else if ($_REQUEST["res"] == '2') {
    //
    $rspVP = mysqli_query($con, "select c.con_max, es.ensa_poblacion from "
            . "configuracion c join entrada_salida es on c.emp_id = "
            . "es.emp_id and c.sed_id = es.sed_id where es.emp_id = $empresa "
            . "and es.sed_id = $sede");
    //
    if (mysqli_num_rows($rspVP) > 0) {
        //
        $rowVP = mysqli_fetch_assoc($rspVP);
        //
        echo '**,' . $rowVP['ensa_poblacion'] . ',' . $rowVP['con_max'];
    }
    //
} else if ($_REQUEST["res"] == '3') {
    //
    $rspVP = mysqli_query($con, "select c.con_max, es.ensa_poblacion from "
            . "configuracion c join entrada_salida es on c.emp_id = "
            . "es.emp_id and c.sed_id = es.sed_id where es.emp_id = $empresa "
            . "and es.sed_id = $sede");
    //
    if (mysqli_num_rows($rspVP) > 0) {
        //
        $rowVP = mysqli_fetch_assoc($rspVP);
        //
        $poblacion = (int) $rowVP['ensa_poblacion'];
        $poblacionMax = (int) $rowVP['con_max'];
        $faltan = $poblacionMax - $poblacion;
        //
        echo "**,$faltan,$poblacionMax";
    }
} else if ($_REQUEST["res"] == '4') {
    //
    $rspVP = mysqli_query($con, "select c.con_max, es.ensa_poblacion from "
            . "configuracion c join entrada_salida es on c.emp_id = "
            . "es.emp_id and c.sed_id = es.sed_id where es.emp_id = $empresa "
            . "and es.sed_id = $sede");
    //
    if (mysqli_num_rows($rspVP) > 0) {
        //
        $rowVP = mysqli_fetch_assoc($rspVP);
        //
        $poblacion = (int) $rowVP['ensa_poblacion'];
        $poblacionMax = (int) $rowVP['con_max'];
        //
        if ($poblacion < $poblacionMax) {
            //
            echo '**,1,1';
        } else {
            //
            echo '**,0,0';
        }
    }
}