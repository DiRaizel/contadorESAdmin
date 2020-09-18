<?php

//
date_default_timezone_set('America/Bogota');

class tv {

    //
    function cargarTablaTvs($idEmp) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "select tv_id, tv_nombre, tv_estado from tv "
                . "where emp_id = $idEmp");
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
                    'idTv' => $row['tv_id'],
                    'nombre' => $row['tv_nombre'],
                    'estado' => $row['tv_estado']
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
    function actualizarEstadoTv($idTv) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rspE = mysqli_query($con, "select tv_estado from tv where tv_id = "
                . "$idTv");
        //
        if (mysqli_num_rows($rspE) > 0) {
            //
            $row = mysqli_fetch_assoc($rspE);
            //
            $sql = '';
            //
            if ($row['tv_estado'] === 'Inactivo') {
                //
                $sql = "update tv set tv_estado = 'Activo' where tv_id "
                        . "= $idTv";
            } else {
                //
                $sql = "update tv set tv_estado = 'Inactivo' where tv_id"
                        . " = $idTv";
            }
            //
            $rsp = mysqli_query($con, $sql);
            //
            if ($rsp) {
                //
                return $rspA[0] = array('sql' => 1, 'estado' => $row['tv_estado']);
            } else {
                //
                return $rspA[0] = array('sql' => 0);
            }
        }
    }

    //
    function guardarTv($idEmp, $nombre) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $fecha = date("Y-m-d");
        //
        $rsp = mysqli_query($con, "insert into tv values (null, "
                . "$idEmp, '$nombre', 'Activo', '$fecha')");
        //
        return $rsp;
    }

    //
    function cargarTvaEditar($idTv) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "SELECT tv_nombre from tv where tv_id = $idTv");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            $row = mysqli_fetch_assoc($rsp);
            //
            $datos[0] = array(
                'sql' => 1,
                'nombre' => $row['tv_nombre']
            );
            //
            return $datos;
        } else {
            return $datos[0] = array('sql' => 0);
        }
    }

    //
    function editarTv($idTv, $nombre) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "update tv set tv_nombre = '$nombre' where "
                . "tv_id = $idTv");
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
    function guardarVideo($idTv, $orden, $volumen, $video) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $fecha = date("Y-m-d");
        //
        $rsp = mysqli_query($con, "insert into video values (null, $idTv, "
                . "'$video', $volumen, 'Activo', '$fecha', $orden)");
        //
        return $rsp;
    }

    //
    function cargarVideosTv($idTv) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "select vi_id, vi_video, vi_volumen, vi_estado"
                . ", vi_orden from video where tv_id = $idTv");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                array_push($datos, array(
                    'idVid' => $row['vi_id'],
                    'orden' => $row['vi_orden'],
                    'nombre' => $row['vi_video'],
                    'volumen' => $row['vi_volumen'],
                    'estado' => $row['vi_estado']
                ));
            }
        }
        //
        return $datos;
    }

    //
    function actualizarEstadoVideoTv($idVid) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rspE = mysqli_query($con, "select vi_estado from video where vi_id = "
                . "$idVid");
        //
        if (mysqli_num_rows($rspE) > 0) {
            //
            $row = mysqli_fetch_assoc($rspE);
            //
            $sql = '';
            //
            if ($row['vi_estado'] === 'Inactivo') {
                //
                $sql = "update video set vi_estado = 'Activo' where vi_id "
                        . "= $idVid";
            } else {
                //
                $sql = "update video set vi_estado = 'Inactivo' where vi_id"
                        . " = $idVid";
            }
            //
            $rsp = mysqli_query($con, $sql);
            //
            if ($rsp) {
                //
                return $rspA[0] = array('sql' => 1, 'estado' => $row['vi_estado']);
            } else {
                //
                return $rspA[0] = array('sql' => 0);
            }
        }
    }

    //
    function cargarVideoTvaEditar($idVid) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "SELECT vi_video, vi_volumen, vi_orden from "
                . "video where vi_id = $idVid");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            $row = mysqli_fetch_assoc($rsp);
            //
            $datos[0] = array(
                'sql' => 1,
                'video' => $row['vi_video'],
                'volumen' => $row['vi_volumen'],
                'orden' => $row['vi_orden']
            );
            //
            return $datos;
        } else {
            return $datos[0] = array('sql' => 0);
        }
    }

    //
    function editarVideo($idVid, $orden, $volumen, $video) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "update video set vi_video = '$video', "
                . "vi_volumen = $volumen, vi_orden = $orden where vi_id = $idVid");
        //
        return $rsp;
    }

}
