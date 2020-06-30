<?php

//
date_default_timezone_set('America/Bogota');

class sede {

    //
    function cargarTablaSedes($idUsu, $idEmp) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $sql = '';
        //
        if ($idUsu === 1) {
            //
            $sql = "select s.sed_id, s.sed_nombre, s.sed_estado, c.ciu_nombre, "
                    . "e.emp_nombre from sede s join ciudad c on s.ciu_id = "
                    . "c.ciu_id join empresa e on s.emp_id = e.emp_id "
                    . "order by s.sed_id asc";
        }else{
            //
             $sql = "select s.sed_id, s.sed_nombre, s.sed_estado, c.ciu_nombre, "
                    . "e.emp_nombre from sede s join ciudad c on s.ciu_id = "
                    . "c.ciu_id join empresa e on s.emp_id = e.emp_id where "
                     . "emp_id = $idEmp order by s.sed_id asc";
        }
        //
        $rsp = mysqli_query($con, $sql);
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            $fila = 0;
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                $datos['data'][$fila] = array(
                    'sql' => 1,
                    'idSed' => $row['sed_id'],
                    'nombre' => $row['sed_nombre'],
                    'empresa' => $row['emp_nombre'],
                    'ciudad' => $row['ciu_nombre'],
                    'estado' => $row['sed_estado']
                );
                //
                $fila++;
            }
            //
            return $datos;
        } else {
            return $datos['data'][0] = array('sql' => 0);
        }
    }

    //
    function actualizarEstadoSede($idSed, $estado) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $sql = '';
        //
        if ($estado === '1') {
            //
            $sql = "update sede set sed_estado = 'Activa' where sed_id "
                    . "= $idSed";
        } else {
            //
            $sql = "update sede set sed_estado = 'Inactiva' where sed_id"
                    . " = $idSed";
        }
        //
        $rsp = mysqli_query($con, $sql);
        //
        if ($rsp) {
            //
            return $rspA[0] = array('sql' => 1);
        } else {
            //
            return $rspA[0] = array('sql' => 0);
        }
    }

    //
    function guardarSede($nombre, $empresa, $ciudad) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "insert into sede values (null, "
                . "'$nombre', 'Activa', $ciudad, $empresa)");
        //
        return $rsp;
    }

    //
    function cargarSedeaEditar($idSed) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "SELECT s.sed_nombre, s.ciu_id, s.emp_id, "
                . "c.dep_id from sede s join ciudad c on s.ciu_id = c.ciu_id"
                . " where sed_id = $idSed");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            $row = mysqli_fetch_assoc($rsp);
            //
            $idDep = $row['dep_id'];
            //
            $rspC = mysqli_query($con, "SELECT ciu_id, ciu_nombre from ciudad "
                    . "where dep_id = $idDep and ciu_estado = 1 order by "
                    . "ciu_nombre asc");
            //
            $ciudades = array();
            //
            if (mysqli_num_rows($rsp) > 0) {
                //
                while ($rowC = mysqli_fetch_assoc($rspC)) {
                    //
                    array_push($ciudades, array(
                        'idCiu' => $rowC['ciu_id'],
                        'nombre' => $rowC['ciu_nombre']
                    ));
                }
            }
            //
            $datos[0] = array(
                'sql' => 1,
                'nombre' => $row['sed_nombre'],
                'idEmp' => $row['emp_id'],
                'idCiu' => $row['ciu_id'],
                'idDep' => $row['dep_id'],
                'ciudades' => $ciudades
            );
            //
            return $datos;
        } else {
            return $datos[0] = array('sql' => 0);
        }
    }

    //
    function editarSede($idSed, $nombre, $empresa, $ciudad) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "update sede set sed_nombre = '$nombre', "
                . "emp_id = $empresa, ciu_id = $ciudad where sed_id = $idSed");
        //
        if ($rsp) {
            //
            return 1;
        } else {
            //
            return 2;
        }
    }
    
    //
    function cargarSelectSedes($idEmp) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "SELECT sed_id, sed_nombre from sede where"
                . " sed_estado = 'Activa' and emp_id = $idEmp order by sed_nombre asc");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                array_push($datos, array(
                    'sql' => 1,
                    'idSed' => $row['sed_id'],
                    'nombre' => $row['sed_nombre']
                ));
            }
            //
            return $datos;
        } else {
            //
            return $datos;
        }
    }

}
