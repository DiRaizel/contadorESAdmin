<?php

//
date_default_timezone_set('America/Bogota');

class usuario {

    //
    function login($correo, $password) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $sql = '';
        $nombreEmp = 'ingetronik';
        $control = false;
        //
        if ($correo === 'admin@admin') {
            //
            $sql = "SELECT usu_id, usu_nombres, usu_apellidos, usu_documento, "
                    . "usu_correo, usu_rol, usu_password, usu_estado, usu_"
                    . "estado_password, emp_id FROM usuario WHERE usu_correo = "
                    . "'$correo' AND usu_password = '$password'";
        } else {
            //
            $sql = "SELECT u.usu_id, u.usu_nombres, u.usu_apellidos"
                    . ", u.usu_documento, u.usu_correo, u.usu_rol, u.usu_password, "
                    . "u.usu_estado, u.usu_estado_password, u.emp_id, e.emp_nombre "
                    . "FROM usuario u join empresa e on u.emp_id = e.emp_id WHERE "
                    . "u.usu_correo = '$correo' AND u.usu_password = '$password' "
                    . "AND u.usu_estado = 'Activo'";
            //
            $control = true;
        }
        //
        $rsp = mysqli_query($con, $sql);
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            $row = mysqli_fetch_assoc($rsp);
            //
            if ($control) {
                //
                $nombreEmp = $row['emp_nombre'];
            }
            //
            return $datos = array(
                'idUsu' => $row['usu_id'],
                'nombres' => $row['usu_nombres'],
                'apellidos' => $row['usu_apellidos'],
                'documento' => $row['usu_documento'],
                'correo' => $row['usu_correo'],
                'rol' => $row['usu_rol'],
                'password' => base64_decode($row['usu_password']),
                'estado' => $row['usu_estado'],
                'idEmp' => $row['emp_id'],
                'nombreEmp' => $nombreEmp,
                'estadoPassword' => $row['usu_estado_password']
            );
        }
    }

    //
    function recuperarPass($correo) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $sql = "select usu_clave from usuario where usu_correo = '$correo'";
        $rsp = mysqli_query($con, $sql);
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            $row = mysqli_fetch_assoc($rsp);
            //
            $passR = base64_decode($row['usu_password']);
            //            
            require '../libs/PHPMailer/src/PHPMailer.php';
            require '../libs/PHPMailer/src/SMTP.php';
            //instancio un objeto de la clase PHPMailer
            $mail = new PHPMailer(); // defaults to using php "mail()"
            //defino el email y nombre del remitente del mensaje
            $mail->SetFrom('adminIvoy@gmail.com', 'Admin');
            //defino la direccion de email de "reply", a la que responder los mensajes
            //Obs: es bueno dejar la misma direccion que el From, para no caer en spam
            $mail->AddReplyTo("adminIvoy@gmail.com", "Admin");
            //
            $mail->CharSet = "UTF8";
            //le agrego a la clase, indicando el nombre de la persona destinatario
            $mail->AddAddress($correo, "Usuario");
            //agrego un asunto al mensaje
            $mail->Subject = "Recuperacion de password Imnoa";
            //
            $mail->Body = "<b>Su password es $passR</b>";
            //Puedo definir un cuerpo alternativo del mensaje, que contenga solo texto
            $mail->AltBody = "Su password es $passR";
            //
            if (!$mail->Send()) {
                //
                return $mail->ErrorInfo;
            } else {
                //
                return 1;
            }
        } else {
            //
            return 2;
        }
    }

    //
    function cargarTablaUsuarios($idUsu, $idEmp) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $sql = '';
        //
        if ($idUsu === 1) {
            //
            $sql = "SELECT u.usu_id, u.usu_nombres, u.usu_apellidos, "
                    . "u.usu_documento, u.usu_correo, u.usu_rol, u.usu_estado, "
                    . "e.emp_nombre, s.sed_nombre from usuario u join empresa e "
                    . "on u.emp_id = e.emp_id join sede s on u.sed_id = s.sed_id "
                    . "where u.usu_id <> 1";
        } else {
            //
            $sql = "SELECT u.usu_id, u.usu_nombres, u.usu_apellidos, "
                    . "u.usu_documento, u.usu_correo, u.usu_rol, u.usu_estado, "
                    . "e.emp_nombre, s.sed_nombre from usuario u join empresa e "
                    . "on u.emp_id = e.emp_id join sede s on u.sed_id = s.sed_id "
                    . "where e.emp_id = $idEmp";
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
                    'idUsu' => $row['usu_id'],
                    'nombre' => $row['usu_nombres'] . ' ' . $row['usu_apellidos'],
                    'documento' => $row['usu_documento'],
                    'correo' => $row['usu_correo'],
                    'rol' => $row['usu_rol'],
                    'estado' => $row['usu_estado'],
                    'nombreEmp' => $row['emp_nombre'],
                    'nombreSed' => $row['sed_nombre']
                );
                //
                $fila++;
            }
            //
            return $datos;
        } else {
            //
            return $datos['data'][0] = array('sql' => 0);
        }
    }

    //
    function actualizarEstadoUsuario($idUsu, $estado) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $sql = '';
        //
        if ($estado === '1') {
            //
            $sql = "update usuario set usu_estado = 'Activo' where usu_id "
                    . "= $idUsu";
        } else {
            $sql = "update usuario set usu_estado = 'Inactivo' where usu_id"
                    . " = $idUsu";
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
    function guardarUsuario($nombres, $apellidos, $documento, $correo, $rol, $empresa, $sede, $password) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $fecha = date("Y-m-d");
        //
        $rspV = mysqli_query($con, "select usu_id from usuario where "
                . "usu_correo = '$correo'");
        //
        if (mysqli_num_rows($rspV) > 0) {
            //
            return 3;
        } else {
            //
            $rsp = mysqli_query($con, "insert into usuario values (null, "
                    . "'$nombres', '$apellidos', '$documento', '$correo', '$rol', "
                    . "'$password', '$fecha', 'Activo', 'Normal', "
                    . "$empresa, $sede)");
            //
            return 1;
        }
    }

    //
    function cargarUsuarioaEditar($idUsu) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "SELECT usu_nombres, usu_apellidos, "
                . "usu_documento, usu_correo, usu_rol, usu_password, emp_id, "
                . "sed_id from usuario where usu_id = $idUsu");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            $row = mysqli_fetch_assoc($rsp);
            //
            $idEmp = $row['emp_id'];
            //
            $rspS = mysqli_query($con, "SELECT sed_nombre, sed_id from "
                    . "sede where emp_id = $idEmp");
            //
            $sedes = array();
            //
            if (mysqli_num_rows($rspS) > 0) {
                //
                while ($rowS = mysqli_fetch_assoc($rspS)) {
                    //
                    array_push($sedes, array(
                        'idSed' => $rowS['sed_id'],
                        'nombre' => $rowS['sed_nombre']
                    ));
                }
            }
            //
            $datos[0] = array(
                'sql' => 1,
                'nombres' => $row['usu_nombres'],
                'apellidos' => $row['usu_apellidos'],
                'documento' => $row['usu_documento'],
                'correo' => $row['usu_correo'],
                'rol' => $row['usu_rol'],
                'password' => base64_decode($row['usu_password']),
                'idEmp' => $row['emp_id'],
                'idSed' => $row['sed_id'],
                'sedes' => $sedes
            );
            //
            return $datos;
        } else {
            return $datos[0] = array('sql' => 0);
        }
    }

    //
    function editarUsuario($idUsu, $correoA, $nombres, $apellidos, $documento, $correo, $rol, $empresa, $sede, $password) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        if ($correo !== $correoA) {
            //
            $rspV = mysqli_query($con, "select usu_id from usuario where "
                    . "usu_correo = '$correo'");
            //
            if (mysqli_num_rows($rspV) > 0) {
                //
                return 4;
            } else {
                //
                $rsp = mysqli_query($con, "update usuario set usu_nombres = '$nombres', "
                        . "usu_apellidos = '$apellidos', usu_documento = '$documento', "
                        . "usu_correo = '$correo', usu_rol = '$rol', "
                        . "usu_password = '$password', emp_id = $empresa, "
                        . "sed_id = $sede where usu_id = $idUsu");
                //
                if ($rsp) {
                    //
                    return 1;
                } else {
                    //
                    return 2;
                }
            }
        } else {
            //
            $rsp = mysqli_query($con, "update usuario set usu_nombres = '$nombres', "
                        . "usu_apellidos = '$apellidos', usu_documento = '$documento', "
                        . "usu_correo = '$correo', usu_rol = '$rol', "
                        . "usu_password = '$password', emp_id = $empresa, "
                        . "sed_id = $sede where usu_id = $idUsu");
            //
            if ($rsp) {
                //
                return 1;
            } else {
                //
                return 2;
            }
        }
    }

}
