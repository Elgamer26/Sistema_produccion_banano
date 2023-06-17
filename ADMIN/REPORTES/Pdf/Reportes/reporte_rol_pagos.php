<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../../modelo/conection/conect_r.php";
session_start();
$id_usu = $_SESSION["id_usu"];

$id = $_GET["id"];
$f_i = $_GET["f_i"];
$f_f = $_GET["f_f"];

$consulta = 'SELECT
rol_pagos.id_empleado,
CONCAT_WS( " ", empleado.nombres, empleado.apellidos ) AS empleado,
empleado.cedula,
empleado.sexo,
empleado.direccion,
empleado.telefono,
empleado.correo 
FROM
rol_pagos
INNER JOIN empleado ON rol_pagos.id_empleado = empleado.id_empleado 
WHERE
rol_pagos.id_empleado = ' . $id . ' 
GROUP BY
rol_pagos.id_empleado';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {

    $html = '<img src="../../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>REPORTE ROL DE PAGOS</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha imprimir:</b>  ' . $fecha . '   </span>              
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Emleado:</b>  ' . $row['empleado'] . ' </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Cedula:</b> ' . $row['cedula'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Sexo:</b> ' . $row['sexo'] . '  </span>
    </div>
    
    <div style="float:left; width:auto">
    <span><b>Direccion:</b> ' . $row['direccion'] . '  </span>
    </div>
    
    <div style="float:left; width:auto">
    <span><b>Telefono:</b> ' . $row['telefono'] . '  </span>
    </div>
    
    <div style="float:left; width:auto">
    <span><b>Correo:</b> ' . $row['correo'] . '  </span>
    </div>';


    $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle rol de pagos</u></h2>
            </div>';


    $sql_rol_t = 'SELECT
    	    rol_pagos.id_rol_pagos,
            rol_pagos.id_empleado, 
            rol_pagos.actividad, 
            rol_pagos.produccion_datos, 
            rol_pagos.fecha_pago, 
            rol_pagos.pagos_actividad, 
            rol_pagos.dias, 
            rol_pagos.total_ingreso, 
            rol_pagos.total_egreso, 
            rol_pagos.neto_pagar
            FROM
            rol_pagos WHERE rol_pagos.id_empleado = ' . $id . ' AND DATE(rol_pagos.fecha_pago) BETWEEN ' . $f_i . ' AND  ' . $f_f . ' ';
    $result_rol_t = $mysqli->query($sql_rol_t);
    $id_rol_pagos = 0;
    while ($row_cli = $result_rol_t->fetch_assoc()) {

        $id_rol_pagos = $row_cli['id_rol_pagos'];

        $html .= '<br>
                <div style="float:left; width:auto">
                <span><b>Actividad:</b> ' . $row_cli['actividad'] . ' - <b>Costo actividad:</b> $/. ' . $row_cli['pagos_actividad'] . '  </span>
                </div>
                
                <div style="float:left; width:auto">
                <span><b>Produccion:</b> ' . $row_cli['produccion_datos'] . '  </span>
                </div>
                               
                <div style="float:left; width:auto">
                <span><b>Fecha rol:</b> ' . $row_cli['fecha_pago'] . '  </span>
                </div>
                    
                <div style="float:left; width:auto">
                <span><b>Neto total:</b> $/. ' . $row_cli['neto_pagar'] . '  </span>
                </div>';


        $html .= '<div style="width:700px; text-align:center;">
                <h3><u>Detalle ingresos</u></h3>
               </div>
        
            <table style="width:100%; border-collapse:collapse;" border="1">
                <thead>
                <tr bgcolor="green">
                <th>#</th>
                <th>Nombre</th>
                <th>Valor</th>    
                </tr>
            </thead>';

        $detalle_ingreso = 'SELECT
        detalle_rol_pago_ingreso.id_rol_pagos, 
        detalle_rol_pago_ingreso.nombre, 
        detalle_rol_pago_ingreso.cantidad
        FROM
        detalle_rol_pago_ingreso WHERE detalle_rol_pago_ingreso.id_rol_pagos = ' . $id_rol_pagos . '';

        $conta_ngreso = 0;
        //aqui estoy pidiendo la conexion y la consulta envio
        $result_ingreso = $mysqli->query($detalle_ingreso);
        while ($row_ingreso = $result_ingreso->fetch_assoc()) {

            $conta_ngreso++;
            $html .= ' <tr>
               <td style="text-align:center;">' . $conta_ngreso . '</td>
               <td style="text-align:center;">' . $row_ingreso['nombre'] . '</td>
               <td style="text-align:center;">$/. ' . $row_ingreso['cantidad'] . '</td> ';
        }
        
        $html .= '</tr>
            <tbody>
            </tbody>
            </table>
            
            <div style="float:left; width:auto">
            <span><b>Total ingreso:</b> $/. ' . $row_cli['total_ingreso'] . '  </span>
            </div>';


            $html .= '<div style="width:700px; text-align:center;">
        <h3><u>Detalle egresos</u></h3>
    </div>

        <table style="width:100%; border-collapse:collapse;" border="1">
            <thead>
            <tr bgcolor="red">
            <th>#</th>
            <th>Nombre</th>
            <th>Valor</th>    
            </tr>
        </thead>';

        $detalle_egreso = 'SELECT
        detalle_rol_pago_egreso.id_rol_pagos, 
        detalle_rol_pago_egreso.nombre, 
        detalle_rol_pago_egreso.cantidad
            FROM
        detalle_rol_pago_egreso WHERE detalle_rol_pago_egreso.id_rol_pagos = ' . $id_rol_pagos . '';

        $conta_egreso = 0;
        //aqui estoy pidiendo la conexion y la consulta envio
        $result_egreso = $mysqli->query($detalle_egreso);
        while ($row_egreso = $result_egreso->fetch_assoc()) {

            $conta_egreso++;
            $html .= ' <tr>
            <td style="text-align:center;">' . $conta_egreso . '</td>
            <td style="text-align:center;">' . $row_egreso['nombre'] . '</td>
            <td style="text-align:center;">$/. ' . $row_egreso['cantidad'] . '</td> ';
        }

        $html .= '</tr>
        <tbody>
        </tbody>
        </table>

        <div style="float:left; width:auto">
        <span><b>Total egreso:</b> $/. ' . $row_cli['total_egreso'] . '  </span>
        </div>

        <br>
        <div style="width:700px; text-align:center;">
                    <h3>---------------------------*****************************---------------------------</h3>
                </div>';
    }
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
