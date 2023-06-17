<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../modelo/conection/conect_r.php";

$consulta = 'SELECT
rol_pagos.id_rol_pagos,
CONCAT_WS(" ",empleado.nombres, empleado.apellidos) as empleado,
empleado.cedula,
empleado.sexo,
empleado.correo,
rol_pagos.actividad,
rol_pagos.produccion_datos,
rol_pagos.fecha_pago,
rol_pagos.pagos_actividad,
rol_pagos.dias,
rol_pagos.total_ingreso,
rol_pagos.total_egreso,
rol_pagos.neto_pagar,
rol_pagos.count_ingreso,
rol_pagos.count_egreso,
rol_pagos.estado 
FROM
rol_pagos
INNER JOIN empleado ON rol_pagos.id_empleado = empleado.id_empleado WHERE rol_pagos.id_rol_pagos =   "' . $_GET["id"] . '" ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {


    $html = '<img src="../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>ROL DE PAGOS</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha imprimir:</b>  ' . $fecha . '   </span>
    </div>    
    <div style="float:left; width:auto;">
    <span><b>Nombre y apellidos:</b>  ' . $row['empleado'] . ' - <b>Sexo:</b>  ' . $row['sexo'] . ' </span>
    </div>
    <div style="float:left; width:auto">
    <span><b>Cedula:</b> ' . $row['cedula'] . '  </span>
    </div>
    <div style="float:left; width:auto">
    <span><b>Correo:</b> ' . $row['correo'] . '  </span>
    </div>
    <div style="float:left; width:auto">
    <span><b>Produccion trabajada:</b> ' . $row['produccion_datos'] . '  </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Actividad:</b> ' . $row['actividad'] . ' </span>
    </div>
    <div style="float:left; width:auto;">
    <span><b>Pago por actividad:</b> ' . $row['pagos_actividad'] . ' </span>
    </div>
    <div style="float:left; width:auto;">
    <span><b>Fecha y hora rol:</b> ' . $row['fecha_pago'] . ' </span>
    </div>';

    $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle rol ingresos</u></h2>
            </div>

        <table style="width:100%; border-collapse:collapse;" border="1">
            <thead>
                <tr bgcolor="green">
                <th>#</th>
                <th>Nombre</th>
                <th>Cantidad</th> 
                </tr>
            </thead>';

    $consult_ingreso = 'SELECT
	detalle_rol_pago_ingreso.id_detalle_ingreso, 
	detalle_rol_pago_ingreso.id_rol_pagos, 
	detalle_rol_pago_ingreso.nombre, 
	detalle_rol_pago_ingreso.cantidad
    FROM
	detalle_rol_pago_ingreso
    WHERE
    detalle_rol_pago_ingreso.id_rol_pagos =  "' . $_GET["id"] . '" ';

    $cont_ingreso = 0;

    //aqui estoy pidiendo la conexion y la consulta envio
    $resul_ingreso = $mysqli->query($consult_ingreso);
    while ($row_i = $resul_ingreso->fetch_assoc()) {

        $cont_ingreso++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $cont_ingreso . '</td>
               <td style="text-align:center; color:green;">' . $row_i['nombre'] . '</td>
               <td style="text-align:center;">' . $row_i['cantidad'] . '</td> ';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Total ingreso:</b>$./ ' .  $row['total_ingreso'] . ' </span>
    </div>';


    $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle rol egreso</u></h2>
            </div>

        <table style="width:100%; border-collapse:collapse;" border="1">
            <thead>
                <tr bgcolor="red">
                <th>#</th>
                <th>Nombre</th>
                <th>Cantidad</th> 
                </tr>
            </thead>';

    $consult_egreso = 'SELECT
	detalle_rol_pago_egreso.id_detalle_rol_pago_egreso, 
	detalle_rol_pago_egreso.id_rol_pagos, 
	detalle_rol_pago_egreso.nombre, 
	detalle_rol_pago_egreso.cantidad
    FROM
	detalle_rol_pago_egreso
    WHERE
    detalle_rol_pago_egreso.id_rol_pagos =  "' . $_GET["id"] . '" ';

    $cont_egreso = 0;

    //aqui estoy pidiendo la conexion y la consulta envio
    $resul_egreso = $mysqli->query($consult_egreso);
    while ($row_e = $resul_egreso->fetch_assoc()) {

        $cont_egreso++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $cont_egreso . '</td>
               <td style="text-align:center; color:red;">' . $row_e['nombre'] . '</td>
               <td style="text-align:center;">' . $row_e['cantidad'] . '</td> ';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Total ingreso:</b>$./ ' .  $row['total_egreso'] . ' </span>
    </div> <br>';

    $html .= ' <table style="width:100%; border-collapse:collapse;" border="1">   
    <thead>
    <tr bgcolor="orange">
    <th>Neto a pagar:</th>
    <th>$/. ' . $row['neto_pagar'] . '</th> 
    </tr>
    </thead> </table><br>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
