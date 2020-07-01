<?php

//
date_default_timezone_set('America/Bogota');

class general {

    //
    function cargarSelectDepartamentos() {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "SELECT dep_id, dep_nombre from departamento "
                . "order by dep_nombre asc");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                array_push($datos, array(
                    'sql' => 1,
                    'idDep' => $row['dep_id'],
                    'nombre' => $row['dep_nombre']
                ));
            }
            //
            return $datos;
        } else {
            return $datos[0] = array('sql' => 0);
        }
    }
    
    //
    function cargarSelectCiudad($idDep) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "SELECT ciu_id, ciu_nombre from ciudad where "
                . "dep_id = $idDep and ciu_estado = 1 order by ciu_nombre asc");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                array_push($datos, array(
                    'sql' => 1,
                    'idCiu' => $row['ciu_id'],
                    'nombre' => $row['ciu_nombre']
                ));
            }
            //
            return $datos;
        } else {
            return $datos[0] = array('sql' => 0);
        }
    }
    //
    function cargarDatosGraficaTorta($idEmp,$fechaInicial,$fechaFinal){
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
         $rsp = mysqli_query($con, "SELECT ciu_id, ciu_nombre from ciudad where "
                . "dep_id = $idDep and ciu_estado = 1 order by ciu_nombre asc");
//        $rsp = mysqli_query($con, "SELECT ciu_id, ciu_nombre from ciudad where "
//                . "dep_id = $idDep and ciu_estado = 1 order by ciu_nombre asc");
//        //
//        $datos = array();
//        //
//        if (mysqli_num_rows($rsp) > 0) {
//            //
//            while ($row = mysqli_fetch_assoc($rsp)) {
//                //
//                array_push($datos, array(
//                    'sql' => 1,
//                    'idCiu' => $row['ciu_id'],
//                    'nombre' => $row['ciu_nombre']
//                ));
//            }
//            //
//            return $datos;
//        } else {
//            return $datos[0] = array('sql' => 0);
//        }
    }

}
