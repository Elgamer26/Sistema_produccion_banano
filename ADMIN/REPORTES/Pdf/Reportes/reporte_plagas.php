<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../../modelo/conection/conect_r.php";
session_start();
$id_usu = $_SESSION["id_usu"];

$f_i = $_GET["f_i"];
$f_f = $_GET["f_f"];

$consulta = 'SELECT
usuario.id_usuario,
usuario.nombres,
usuario.apellidos,
rol.nombre 
FROM
usuario
INNER JOIN rol ON usuario.id_rol = rol.id_rol WHERE usuario.id_usuario =  ' . $id_usu . ' ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {

    $html = '<img src="../../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>REPORTE DE PLAGAS</u></h1></div><br>
   
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
    <span><b>Rol:</b> ' . $row['nombre'] . '  </span>
    </div>';


    $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle plagas</u></h2>
            </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
            <tr bgcolor="orange">
            <th>Id</th>
            <th>Produccion</th>
            <th>Tipo plaga</th>  
            <th>Fecha</th>
            <th>Observacion</th>
            <th>Estado</th>  
            </tr>
        </thead>';

    $detalle_actividad = 'SELECT
	control_plagas.id_control_plagas,
	CONCAT_WS( " ", " Lote: [", lote.nombre_l, "] - Estado: [", produccion.estado, "] - Fecha inicio: [", produccion.fecha_inicio, "] - Fecha fin: [", produccion.fecha_fin ) AS produccion,
	tipo_plaga.tipo_plaga,
	CONCAT_WS( " ", usuario.nombres, usuario.apellidos ) AS usuario,
	control_plagas.fecha,
	control_plagas.observacion,
	control_plagas.foto,
	control_plagas.estado,
	control_plagas.control_plaga 
    FROM
        control_plagas
        INNER JOIN usuario ON control_plagas.id_usuario = usuario.id_usuario
        INNER JOIN produccion ON control_plagas.id_produccion = produccion.id_produccion
        INNER JOIN lote ON produccion.id_lote = lote.id_lote
        INNER JOIN tipo_plaga ON control_plagas.id_tipo_plaga = tipo_plaga.id_tipo_plaga 
    WHERE
	control_plagas.estado = 1 
	AND control_plagas.fecha BETWEEN ' . $f_i . ' AND ' . $f_f . ' 
    ORDER BY
	control_plagas.id_control_plagas';

    $conta_ac = 0;
    $estado = "";
    //aqui estoy pidiendo la conexion y la consulta envio
    $result_ac = $mysqli->query($detalle_actividad);
    while ($row_ac = $result_ac->fetch_assoc()) {

        if ($row_ac['estado'] == 1) {
            $estado = "Tratado";
        } else {
            $estado = "No tratado";
        }

        $conta_ac++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $conta_ac . '</td>
               <td style="text-align:center;">' . $row_ac['produccion'] . '</td>
               <td style="text-align:center;">' . $row_ac['tipo_plaga'] . '</td>
               <td style="text-align:center;">' . $row_ac['fecha'] . '</td>
               <td style="text-align:center;">' . $row_ac['observacion'] . ' </td>
               <td style="text-align:center;">' . $estado . '</td>';
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
