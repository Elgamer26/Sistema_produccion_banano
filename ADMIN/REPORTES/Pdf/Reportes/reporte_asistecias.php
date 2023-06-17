<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../../modelo/conection/conect_r.php";

$consulta = 'SELECT * FROM empleado WHERE estado = 1 AND hoja_vida = 1 AND id_empleado =  ' . $_GET["id"] . ' ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {

    $html = '<img src="../../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>REPORTE DE ASISTENCIAS</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha imprimir:</b>  ' . $fecha . '   </span>              
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Nombres:</b>  ' . $row['nombres'] . ' </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Apellidos:</b> ' . $row['apellidos'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Cedula:</b> ' . $row['cedula'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Sexo:</b> ' . $row['sexo'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Direccion:</b> ' . $row['direccion'] . '  </span>
    </div>';


    $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle asistencias del empleado</u></h2>
            </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
            <tr bgcolor="orange">
            <th>Id</th>
            <th>Estado asistencias</th>
            <th>Fecha marcada</th>
            <th>Fecha salida</th>  
            </tr>
        </thead>';

    $detalle_actividad = 'SELECT
        asistencia.id_asistencia, 
        asistencia.id_empleado, 
        asistencia.fecha_hora_ingreso, 
        asistencia.fecha_hora_salida, 
        asistencia.estado_asistencia
        FROM
            asistencia
        WHERE
            asistencia.id_empleado  =  ' . $_GET["id"] . '
        ORDER BY
        asistencia.id_asistencia DESC ';

    $conta_ac = 0;
    $estada = "";
    //aqui estoy pidiendo la conexion y la consulta envio
    $result_ac = $mysqli->query($detalle_actividad);
    while ($row_ac = $result_ac->fetch_assoc()) {

        if ($row_ac['estado_asistencia'] == 1) {
            $estada = "ENTRADA MARCADA";
        } else {
            $estada = "ENTRADA Y SALIDA MARCADA";
        }

        $conta_ac++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $conta_ac . '</td>
               <td style="text-align:center;"> ' . $estada . '</td>
               <td style="text-align:center;">' . $row_ac['fecha_hora_ingreso'] . '</td>
               <td style="text-align:center;">' . $row_ac['fecha_hora_salida'] . '</td>';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
