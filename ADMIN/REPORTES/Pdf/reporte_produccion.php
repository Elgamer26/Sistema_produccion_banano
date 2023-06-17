<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../modelo/conection/conect_r.php";

$consulta = 'SELECT
    produccion.id_produccion,
    lote.nombre_l,
    lote.direccion,
    lote.logintud,
    lote.latitud,
    lote.hectarea,
    produccion.fecha_inicio,
    produccion.fecha_fin,
    produccion.dias,
    produccion.estado,
    produccion.eliminar,
    produccion.nombre_prod
    FROM
    produccion
    INNER JOIN lote ON produccion.id_lote = lote.id_lote WHERE produccion.id_produccion =  "' . $_GET["id"] . '" ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$dias = 0;

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {

    $dias = $row['dias'];

    $html = '<img src="../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>REPORTE DE PRODUCCION</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha imprimir:</b>  ' . $fecha . '   </span>              
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Nombre de produccion:</b>  ' . $row['nombre_prod'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Nombre de lote:</b>  ' . $row['nombre_l'] . ' </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Direccion:</b> ' . $row['direccion'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Hectareas:</b> ' . $row['hectarea'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Longitud:</b> ' . $row['logintud'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Latitud:</b> ' . $row['latitud'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Fecha inicio:</b> ' . $row['fecha_inicio'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Fecha fin:</b> ' . $row['fecha_fin'] . '  </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Dias:</b> ' . $row['dias'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Estado:</b> ' . $row['estado'] . ' </span>
    </div>';

    if ($row['estado'] == 'INICIADO') {

        $html .= ' <center>
        <h2>
            <div style="width:700px; text-align:center;">
                <span style="color:blue;"></b> LA PRODUCCION ESTA INICIADA </span>
            </div>
        </h2>
    </center>';
    } else if ($row['estado'] == 'FINALIZADO') {

        $html .= ' <center>
        <h2>
            <div style="width:700px; text-align:center;">
                <span style="color:green;"></b> LA PRODUCCION ESTA FINALIZADA </span>
            </div>
        </h2>
    </center>';
    } else {

        $html .= ' <center>
        <h2>
            <div style="width:700px; text-align:center;">
                <span style="color:red;"></b> LA PRODUCCION FUE CANCELADA </span>
            </div>
        </h2>
    </center>';
    }

    $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle actividades</u></h2>
            </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
            <tr bgcolor="orange">
            <th>Id</th>
            <th>Empleado</th>
            <th>Tipo actividad</th>
            <th>Costo actividad</th>  
            </tr>
        </thead>';

    $detalle_actividad = 'SELECT
	detalle_actividad_porduccion.id_produccion,
	CONCAT_WS( " ", empleado.nombres, empleado.apellidos, "- Sexo: ", empleado.sexo ) AS empleado,
	detalle_actividad_porduccion.actividad,
	detalle_actividad_porduccion.costo 
    FROM
        asignacion_actividad
        INNER JOIN detalle_actividad_porduccion ON asignacion_actividad.id_asignacion_actividad = detalle_actividad_porduccion.id_actividad
        INNER JOIN empleado ON asignacion_actividad.id_empleado = empleado.id_empleado 
    WHERE
	detalle_actividad_porduccion.id_produccion =  "' . $_GET["id"] . '" ';

    $conta_ac = 0;
    $sum_cos_ac = 0;
    //aqui estoy pidiendo la conexion y la consulta envio
    $result_ac = $mysqli->query($detalle_actividad);
    while ($row_ac = $result_ac->fetch_assoc()) {

        $conta_ac++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $conta_ac . '</td>
               <td style="text-align:center;"> ' . $row_ac['empleado'] . '</td>
               <td style="text-align:center;">' . $row_ac['actividad'] . '</td>
               <td style="text-align:center;">$' . $row_ac['costo'] . '</td>';
        $sum_cos_ac += $row_ac['costo'];
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>

    <div style="float:right; width:auto;">
    <span><b>Total de costo actividad:</b> $/. ' .  $sum_cos_ac . ' </span>
    </div>';


    $html .= '<div style="width:700px; text-align:center;">
            <h2><u>Detalle materiales</u></h2>
        </div>

        <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
        <tr bgcolor="orange">
        <th>Id</th>
        <th>Material</th>
        <th>Tipo material</th>
        <th>Costo material</th>  
        <th>Cantidad</th>  
        <th>Total</th>  
        </tr>
        </thead>';

    $detalle_material = 'SELECT
        detalle_material_produccion.id_produccion,
        CONCAT_WS( " ", material.nombre, material.marca ) AS material,
        tipo_material.tipo_material,
        detalle_material_produccion.cantidad,
        detalle_material_produccion.costo,
        (detalle_material_produccion.cantidad * detalle_material_produccion.costo) as total
            FROM
                detalle_material_produccion
                INNER JOIN material ON detalle_material_produccion.id_material = material.id_material
                INNER JOIN tipo_material ON material.id_tipo = tipo_material.id_tipo_material 
            WHERE
        detalle_material_produccion.id_produccion = "' . $_GET["id"] . '" ';

    $conta_mat = 0;
    $sum_cos_ma = 0;
    //aqui estoy pidiendo la conexion y la consulta envio
    $result_ma = $mysqli->query($detalle_material);
    while ($row_ma = $result_ma->fetch_assoc()) {

        $conta_mat++;
        $html .= ' <tr>
                <td style="text-align:center;">' . $conta_mat . '</td>
                <td style="text-align:center;"> ' . $row_ma['material'] . '</td>
                <td style="text-align:center;">' . $row_ma['tipo_material'] . '</td>
                <td style="text-align:center;"> ' . $row_ma['costo'] . '</td>
                <td style="text-align:center;">' . $row_ma['cantidad'] . '</td>
                <td style="text-align:center;">$' . $row_ma['total'] . '</td>';
        $sum_cos_ma += $row_ma['total'];
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>

    <div style="float:right; width:auto;">
    <span><b>Total de costo material:</b> $/. ' .  $sum_cos_ma . ' </span>
    </div>';


    $html .= '<div style="width:700px; text-align:center;">
    <h2><u>Detalle insumos</u></h2>
    </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
    <thead>
    <tr bgcolor="orange">
    <th>Id</th>
    <th>Insumo</th>
    <th>Tipo insumo</th>
    <th>Cant. medida</th>  
    <th>Medida</th>  
    <th>Costo</th>  
    <th>cantidad</th>  
    <th>Total</th>  
    </tr>
    </thead>';

    $detalle_isnumos = 'SELECT
        detalle_insumos_produccion.id_produccion,
        CONCAT_WS( " ", insumos.nombre_i, insumos.marca_i ) AS insumo,
        tipo_insumo.tipo_insumo,
        detalle_insumos_produccion.medida_cantida,
        detalle_insumos_produccion.medida,
        detalle_insumos_produccion.costo,
        detalle_insumos_produccion.cantidad,
        ( detalle_insumos_produccion.costo * detalle_insumos_produccion.cantidad ) AS total 
        FROM
            detalle_insumos_produccion
            INNER JOIN insumos ON detalle_insumos_produccion.id_insumos = insumos.id_insumo
            INNER JOIN tipo_insumo ON insumos.id_tipo_insumo = tipo_insumo.id_tipo_insumo 
        WHERE
        detalle_insumos_produccion.id_produccion = "' . $_GET["id"] . '" ';

    $conta_in = 0;
    $sum_cos_in = 0;
    //aqui estoy pidiendo la conexion y la consulta envio
    $result_in = $mysqli->query($detalle_isnumos);
    while ($row_ma = $result_in->fetch_assoc()) {

        $conta_in++;
        $html .= ' <tr>
            <td style="text-align:center;">' . $conta_in . '</td>
            <td style="text-align:center;"> ' . $row_ma['insumo'] . '</td>
            <td style="text-align:center;">' . $row_ma['tipo_insumo'] . '</td>
            <td style="text-align:center;"> ' . $row_ma['medida_cantida'] . '</td>
            <td style="text-align:center;">' . $row_ma['medida'] . '</td>
            <td style="text-align:center;">$' . $row_ma['costo'] . '</td>
            <td style="text-align:center;">' . $row_ma['cantidad'] . '</td>
            <td style="text-align:center;">$' . $row_ma['total'] . '</td>';
        $sum_cos_in += $row_ma['total'];
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>

    <div style="float:right; width:auto;">
    <span><b>Total de costo insumos:</b> $/. ' .  $sum_cos_in . ' </span>
    </div>';


    $html .= '<div style="width:700px; text-align:center;">
    <h2><u>Detalle novedades de produccion</u></h2>
    </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
    <thead>
    <tr bgcolor="red" style="color:white;">
    <th>Id</th>
    <th>Fecha</th>
    <th>Novedad</th>
    <th>Descripcion</th>  
    <th>Csoto</th>   
    </tr>
    </thead>';

    $detalle_novedad = 'SELECT
        novedad_produccion.id_produccion,
        novedad_produccion.fecha,
        novedad.nombre,
        novedad.descipcion,
        novedad_produccion.costo 
        FROM
            novedad_produccion
            INNER JOIN novedad ON novedad_produccion.id_novedad = novedad.id_novedad 
        WHERE
        novedad_produccion.id_produccion = "' . $_GET["id"] . '" ';

    $conta_no = 0;
    $sum_cos_no = 0;
    //aqui estoy pidiendo la conexion y la consulta envio
    $result_in = $mysqli->query($detalle_novedad);
    while ($row_ma = $result_in->fetch_assoc()) {

        $conta_no++;
        $html .= ' <tr>
            <td style="text-align:center;">' . $conta_no . '</td>
            <td style="text-align:center;"> ' . $row_ma['fecha'] . '</td>
            <td style="text-align:center;">' . $row_ma['nombre'] . '</td>
            <td style="text-align:center;"> ' . $row_ma['descipcion'] . '</td>
            <td style="text-align:center;">$ ' . $row_ma['costo'] . '</td> ';
        $sum_cos_no += $row_ma['costo'];
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>

    <div style="float:right; width:auto;">
    <span><b>Total de costo novedad:</b> $/. ' .  $sum_cos_no . ' </span>
    </div>';


    $html .= '<div style="width:700px; text-align:center;">
    <h2><u>COSTO DE LA PRODUCCION </u></h2>
    </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
    <thead>
    <tr bgcolor="green">
    <th>Observaciones</th>
    <th>Valor</th>   
    </tr>
    </thead>';

    $ttal_cos_a = 0;
    $ttal_cos_m = 0;
    $ttal_cos_i = 0;

    $ttal_cos_a = $sum_cos_ac * $dias;
    $ttal_cos_m = $sum_cos_ma * $dias;
    $ttal_cos_i = $sum_cos_in * $dias;

    $html .= '<tr>
    <td style="text-align:center;">Dias</td>
    <td style="text-align:center;"> ' .  $dias . ' </td> 
    </tr>

    <tr>
    <td style="text-align:center;">Total de costo actividad:</td>
    <td style="text-align:center;"> ' .  $sum_cos_ac . ' = $/. ' .  $ttal_cos_a . ' </td> 
    </tr>

    <tr>
    <td style="text-align:center;">Total de costo material:</td>
    <td style="text-align:center;"> ' .  $sum_cos_ma . ' = $/. ' .  $ttal_cos_m . ' </td> 
    </tr>

    <tr>
    <td style="text-align:center;">Total de costo insumos: </td>
    <td style="text-align:center;"> ' .  $sum_cos_in . ' = $/. ' .  $ttal_cos_i . ' </td>  
    </tr>

    <tr>
    <td bgcolor="red" style="text-align:center;">Total de costo novedad:</td>
    <td style="text-align:center;"> - $/. ' .  $sum_cos_no . ' </td> 
    </tr>

    <tbody>
    </tbody>
    </table><br>';

    $total_total = 0;
    $total_total = $ttal_cos_a +  $ttal_cos_m + $ttal_cos_i - $sum_cos_no;
    
    $html.='<div style="float:right; width:auto;">
    <span><b>Total de la produccion:</b> $/. ' .  $total_total . ' </span>
    </div>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
