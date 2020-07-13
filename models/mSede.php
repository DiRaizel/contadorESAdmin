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
                    . "e.emp_nombre, e.emp_id from sede s join ciudad c on s.ciu_id = "
                    . "c.ciu_id join empresa e on s.emp_id = e.emp_id "
                    . "order by s.sed_id asc";
        } else {
            //
            $sql = "select s.sed_id, s.sed_nombre, s.sed_estado, c.ciu_nombre, "
                    . "e.emp_nombre, e.emp_id from sede s join ciudad c on s.ciu_id = "
                    . "c.ciu_id join empresa e on s.emp_id = e.emp_id where "
                    . "e.emp_id = $idEmp order by s.sed_id asc";
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
                    'idEmp' => $row['emp_id'],
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
    function actualizarEstadoSede($idSed) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rspE = mysqli_query($con, "select sed_estado from sede where sed_id = "
                . "$idSed");
        //
        if (mysqli_num_rows($rspE) > 0) {
            //
            $row = mysqli_fetch_assoc($rspE);
            //
            $sql = '';
            //
            if ($row['sed_estado'] === 'Inactiva') {
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
                return $rspA[0] = array('sql' => 1, 'estado' => $row['sed_estado']);
            } else {
                //
                return $rspA[0] = array('sql' => 0);
            }
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
    function guardarConfigSede($idSed, $idEmp, $max) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rspV = mysqli_query($con, "SELECT con_id from configuracion where "
                . "emp_id = $idEmp and sed_id = $idSed");
        //
        $rsp = false;
        //
        if (mysqli_num_rows($rspV) > 0) {
            //
            $rsp = mysqli_query($con, "update configuracion set con_max = $max"
                    . " where emp_id = $idEmp and sed_id = $idSed");
        } else {
            //
            $rsp = mysqli_query($con, "insert into configuracion values (null, "
                    . "$max, $idEmp, $idSed)");
        }
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

    //
    function cargarCofigSede($idSed) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $rsp = mysqli_query($con, "SELECT con_max from configuracion where"
                . " sed_id = $idSed ");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                array_push($datos, array(
                    'sql' => 1,
                    'max' => $row['con_max']
                ));
            }
            //
            return $datos;
        } else {
            //
            return $datos;
        }
    }

    //
    function cargarTablasHome($idEmp) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $fecha = date("Y-m-d");
        //
        $rsp = mysqli_query($con, "SELECT s.sed_nombre, c.ciu_nombre, e.ensa_"
                . "poblacion, count(r.reg_id) as c from registro_entrada_salida"
                . " r join sede s on r.sed_id = s.sed_id join ciudad c on s.ciu"
                . "_id = c.ciu_id join entrada_salida e on r.sed_id = e.sed_id "
                . "where s.emp_id = $idEmp and r.reg_fecha = '$fecha' group by "
                . "s.sed_nombre asc");
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            //
            $datosTemp = array();
            $datosG = array();
            $fila = 0;
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                array_push($datosTemp, array(
                    'sql' => 1,
                    'count' => $row['c'],
                    'nombreSede' => $row['sed_nombre'],
                    'poblacion' => $row['ensa_poblacion'],
                    'nombreCiu' => $row['ciu_nombre']
                ));
                //
                $datosG['nombres'][$fila] = $fecha;
                $datosG['series'][$fila]['name'] = $row['sed_nombre'];
                $datosG['series'][$fila]['data'][0] = (int) $row['ensa_poblacion'];
                //
                $fila++;
            }
            //
            $datos[0] = $datosTemp;
            $datos[1] = $datosG;
            //
            return $datos;
        } else {
            //
            return $datos;
        }
    }

    //
    function generarReporte($idEmp, $fechaI, $fechaF, $sede) {
        //
        require '../models/config.php';
        mysqli_set_charset($con, 'utf8');
        //
        $sql = '';
        //
        if ($sede === 'todo') {
            //
            $sql = "SELECT s.sed_nombre, c.ciu_nombre, r.reg_fecha, count(r.reg"
                    . "_id) as c from registro_entrada_salida r join sede s on "
                    . "r.sed_id = s.sed_id join ciudad c on s.ciu_id = c.ciu_id"
                    . " where s.emp_id = $idEmp and r.reg_fecha between "
                    . "'$fechaI' and '$fechaF' group by r.reg_fecha, s.sed_nombre asc";
        } else {
            //
            $sql = "SELECT s.sed_nombre, c.ciu_nombre, r.reg_fecha, count(r.reg"
                    . "_id) as c from registro_entrada_salida r join sede s on "
                    . "r.sed_id = s.sed_id join ciudad c on s.ciu_id = c.ciu_id"
                    . " where s.emp_id = $idEmp and r.sed_id = $sede and r.reg_"
                    . "fecha between '$fechaI' and '$fechaF' group by r.reg_fecha asc";
        }
        //
        $rsp = mysqli_query($con, $sql);
        //
        $datos = array();
        //
        if (mysqli_num_rows($rsp) > 0) {
            /** Include PHPExcel */
            require_once '../libs/PHPExcel/PHPExcel.php';
//            require_once '../libs/PHPExcel/Reader/Excel2007.php';
            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();
            // Set document properties
            $objPHPExcel->getProperties()->setCreator("Raizel") // Nombre del autor
                    ->setLastModifiedBy("Raizel") //Ultimo usuario que lo modificÃ³
                    ->setTitle("Reporte") // Titulo
                    ->setSubject("Reporte") //Asunto
                    ->setDescription("Reporte") //DescripciÃ³n
                    ->setKeywords("Reporte") //Etiquetas
                    ->setCategory("Reporte excel"); //Categorias
            //estilo excel
            $estiloTituloReporte = array(
                'font' => array(
                    'name' => 'Calibri',
                    'bold' => true,
                    'italic' => false,
                    'strike' => false,
                    'size' => 20,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'rotation' => 0,
                    'wrap' => TRUE
                )
            );
            //
            $estiloTituloColumnas = array(
                'font' => array(
                    'name' => 'Calibri',
                    'bold' => false,
                    'size' => 16,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                    'rotation' => 90,
                    'startcolor' => array(
                        'rgb' => 'A4A4A4'
                    ),
                    'endcolor' => array(
                        'argb' => 'CCCCCC'
                    )
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ),
                    'bottom' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                )
            );
            //
            $estiloInformacion = new PHPExcel_Style();
            $estiloInformacion->applyFromArray(array(
                'font' => array(
                    'name' => 'Calibri',
                    'size' => 16,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => 'ffffff')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                )
            ));
            // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B2', 'Sede')
                    ->setCellValue('C2', 'Ciudad')
                    ->setCellValue('D2', 'Fecha')
                    ->setCellValue('E2', '# Entradas');
            //
            $objPHPExcel->getActiveSheet()->getStyle("B2:E2")->getFont()->setBold(true);
            //
            $i = 3;
            //
            while ($row = mysqli_fetch_assoc($rsp)) {
                //
                array_push($datos, array(
                    'sql' => 1,
                    'count' => $row['c'],
                    'nombreSede' => $row['sed_nombre'],
                    'fecha' => $row['reg_fecha'],
                    'nombreCiu' => $row['ciu_nombre']
                ));
                //
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, $row['sed_nombre'])
                        ->setCellValue('C' . $i, $row['ciu_nombre'])
                        ->setCellValue('D' . $i, $row['reg_fecha'])
                        ->setCellValue('E' . $i, $row['c']);
                //
                $i++;
            }
            //se le dan los estilos al excel
            $posF = $i - 1;
//            $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($estiloTituloReporte);
            $objPHPExcel->getActiveSheet()->getStyle('B2:E2')->applyFromArray($estiloTituloColumnas);
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "B3:E" . $posF);
            //
            for ($k = 'B'; $k <= 'E'; $k++) {
                //
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($k)->setAutoSize(TRUE);
            }
            // Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('Reporte');
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            // Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save("../reportes/reporte-$idEmp.xlsx");
            //
            require('../libs/fpdf/fpdf.php');
            //
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            //
            $pdf->Cell(40, 10, 'Empresa', 1, 0, 'C');
            $pdf->SetX(50);
            $pdf->Cell(40, 10, 'Ciudad', 1, 0, 'C');
            $pdf->SetX(90);
            $pdf->Cell(40, 10, 'Fecha', 1, 0, 'C');
            $pdf->SetX(130);
            $pdf->Cell(40, 10, '# Entradas', 1, 0, 'C');
            //
            $pdf->SetFont('Arial', '', 16);
            $x = 10;
            $y = 20;
            //
            for ($k = 0; $k < count($datos); $k++) {
                //
                $pdf->SetXY($x, $y);
                $pdf->Cell(40, 10, utf8_decode($datos[$k]['nombreSede']), 1, 0, 'C');
                $x += 40;
                $pdf->SetXY($x, $y);
                $pdf->Cell(40, 10, utf8_decode($datos[$k]['nombreCiu']), 1, 0, 'C');
                $x += 40;
                $pdf->SetXY($x, $y);
                $pdf->Cell(40, 10, utf8_decode($datos[$k]['fecha']), 1, 0, 'C');
                $x += 40;
                $pdf->SetXY($x, $y);
                $pdf->Cell(40, 10, utf8_decode($datos[$k]['count']), 1, 0, 'C');
                //
                $x = 10;
                $y += 10;
            }
            //
            $pdf->Output('F', "../reportes/reporte-$idEmp.pdf");
            //
            return $datos;
        } else {
            //
            return $datos;
        }
    }

}
