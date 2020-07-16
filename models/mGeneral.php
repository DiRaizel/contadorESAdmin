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
    function cargarDatosGraficaTorta($idEmp, $fechaInicial, $fechaFinal) {
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
            for ($i = 0; $i < count($arrayTemp); $i++) {
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

    function cargarDatosGraficaBarras($idEmp, $fechaInicial, $fechaFinal) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $fecha = date("Y-m-d");
        //

        $rsp = mysqli_query($con, "SELECT s.sed_nombre, count(r.reg_id) as c,r.reg_fecha,"
                . "r.sed_id from registro_entrada_salida r join sede s on r.sed_id = s.sed_id "
                . "where s.emp_id = $idEmp and r.reg_fecha BETWEEN '$fechaInicial' and '$fechaFinal' "
                . "group by s.sed_nombre,reg_fecha asc");
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            $datosTemp = array();
            $datosG = array();
            $fechasarray = array();
            $sedessarray = array();
            $controlSedes = 0;
            $controlSedesA = 0;
            $fila = 0;
            //
            $controlSA = 0;
            $controlFSA = 0;
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                if ($controlFSA === 0) {
                    //
                    $fechasarray['fechas'][$controlFSA] = $row['reg_fecha'];

                    //
                    $controlFSA++;
                    //
                } else if (!in_array($row['reg_fecha'], $fechasarray['fechas'])) {
                    //
                    $fechasarray['fechas'][$controlFSA] = $row['reg_fecha'];

                    //
                    $controlFSA++;
                }

                if ($controlSedesA === 0) {
                    //
                    $sedessarray['sedes'][$controlSedesA] = $row['sed_nombre'];
                    $sedessarray['id'][$controlSedesA] = $row['sed_id'];
                    //
                    $controlSedesA++;
                    //
                } else if (!in_array($row['sed_nombre'], $sedessarray['sedes'])) {
                    //
                    $sedessarray['sedes'][$controlSedesA] = $row['sed_nombre'];
                    $sedessarray['id'][$controlSedesA] = $row['sed_id'];

                    //
                    $controlSedesA++;
                }
            }

            for ($i = 0; $i < count($sedessarray["id"]); $i++) {
                //
                for ($j = 0; $j < count($fechasarray["fechas"]); $j++) {
                    //
                    $consult = mysqli_query($con, "SELECT count(*) as cantidad FROM registro_entrada_salida where"
                            . " sed_id = " . $sedessarray["id"][$i] . " and reg_fecha = '" . $fechasarray["fechas"][$j] . "'");
                    while ($rows = mysqli_fetch_assoc($consult)) {
                        //
                        $datosG[$i]['name'] = $sedessarray["sedes"][$i];
                        $datosG[$i]['data'][$j] = (int) $rows['cantidad'];
                    }
                    //
                }
                //
            }

            $datos["fechas"] = $fechasarray["fechas"];
            $datos["series"] = $datosG;

            return $datos;
        } else {
            //
            return $datos;
        }
        //
    }

}
