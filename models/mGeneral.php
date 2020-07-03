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
        $rsp = mysqli_query($con, "select sed.sed_nombre, COUNT(reg.sed_id) as cantidad from registro_entrada_salida reg JOIN sede sed on (reg.sed_id = sed.sed_id) where reg.emp_id = '$idEmp' and reg.reg_fecha between '$fechaInicial' and '$fechaFinal' group by reg.sed_id");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //            
            $totalCantidad = 0;
            $arrayTemp = array();
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                $totalCantidad += (float) $row["cantidad"];       
                //
                array_push($arrayTemp, array(
                    'sql' => 1,
                    'sedes' => $row['sed_nombre'],
                    'cantidad' => (int) $row['cantidad']
                ));
                //                
            }
            //
            $datos[0]['name'] = 'Porcentaje';
            //
            for($i=0;$i<count($arrayTemp);$i++){
                $datos[0]['data'][$i]['name'] = $arrayTemp[$i]['sedes'];
                $datos[0]['data'][$i]['y'] = (float) $arrayTemp[$i]['cantidad'] * 100 / $totalCantidad;
            }
            //
            return $datos;
        } else {
            return $datos[0] = array('sql' => 0);
        }
    }
    //
    function cargarDatosGraficaBarras($idEmp,$fechaInicial,$fechaFinal){
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "SELECT s.sed_nombre, c.ciu_nombre, r.reg_fecha, count(r.reg_id) as c from registro_entrada_salida r join sede s on r.sed_id = s.sed_id join ciudad c on s.ciu_id = c.ciu_id where s.emp_id = '$idEmp' and r.reg_fecha between '$fechaInicial' and '$fechaFinal' group by r.reg_fecha, s.sed_nombre asc");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //            
            $arrayCategorias = array();
            $arraySedes = array();
            $ControlCategorias = 0;
            $ControlSedes = 0;
            $arrayDatos = array();
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                if ($ControlCategorias === 0) {
                //
                $arrayCategorias['fechas'][$ControlCategorias] = $row['reg_fecha'];
                //
                $ControlCategorias++;
                //
                } else if (!in_array($row['reg_fecha'], $arrayCategorias['fechas'])) {
                    //
                    $arrayCategorias['fechas'][$ControlCategorias] = $row['reg_fecha'];
                    //
                    $ControlCategorias++;
                    //
                }
                
                //
                if ($ControlSedes === 0) {
                //
                $arraySedes['sedes'][$ControlSedes] = $row['sed_nombre'];
                //
                $ControlSedes++;
                //
                } else if (!in_array($row['sed_nombre'], $arraySedes['sedes'])) {
                    //
                    $arraySedes['sedes'][$ControlSedes] = $row['sed_nombre'];
                    //
                    $ControlSedes++;
                    //
                }
                //
                
                
                
                //
//                if(!in_array($arrayCategorias, $row['reg_fecha'])){
//                    array_push($arrayCategorias, $row['reg_fecha']);
//                }
                //
//                array_push($arrayDatos, array(
//                    'sedes' => $row['sed_nombre'],                 
//                    'cantidad' => $row['c']                    
//                ));
                //                
            }
            //
//            $datos['categories'] = $arrayCategorias;
//            //
//            for($i=0;$i<count($arrayDatos);$i++){
//                $datos['data'][$i]['name'] = $arrayDatos[$i]['sedes'];
//                $datos['data'][$i]['data'] = (float) $arrayDatos[$i]['cantidad'];
//            }
            //
            print_r($arraySedes);
            print_r($arrayCategorias);
            return $datos;
        } else {
            return $datos[0] = array('sql' => 0);
        }
    }

}
