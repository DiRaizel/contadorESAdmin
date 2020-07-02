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
        $rsp = mysqli_query($con, "SELECT sed_nombre,sed_id FROM sede WHERE emp_id = $idEmp");
//        print_r($rsp);
//        //
        $datos = array();
//        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                $cantidad = 0;
                $totalCantidad = 0;
                $count = mysqli_query($con, "select sed.sed_nombre, COUNT(reg.sed_id) as Cantidad from registro_entrada_salida reg JOIN sede sed on (reg.sed_id = sed.sed_id) where reg.emp_id = '$idEmp' and reg.reg_fecha between '$fechaInicial' and '$fechaFinal' group by reg.sed_id");
                //
                if (mysqli_num_rows($count) > 0) {
                    $rowregistro = mysqli_fetch_assoc($count);
//                    $cantidad = $rowregistro['cantidadRegistro'];
                    $totalCantidad += $rowregistro['Cantidad'];
                }
                //
                if (mysqli_num_rows($count) > 0) {
                    $rowregistro = mysqli_fetch_assoc($count);
//                    $cantidad = $rowregistro['cantidadRegistro'];
                    $cantidad = $rowregistro['Cantidad'];
                }
                //
                echo $totalCantidad;
                //
                array_push($datos, array(
                    'sql' => 1,
                    'sedes' => $row['sed_nombre'],
                    'cantidad' => $cantidad
                ));
            }
            print_r($datos);
            //
            return $datos;
        } else {
            return $datos[0] = array('sql' => 0);
        }
    }

}
