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
    <div style="text-align:center;"><h1><u>REPORTE DE COMPRAS INSUMOS</u></h1></div><br>
   
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
                    <h2><u>Detalle compras insumos</u></h2>
            </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
        <thead>
            <tr bgcolor="orange">
            <th>Id</th>
            <th>Razon social</th>
            <th>Tipo comprobante</th>  
            <th>N° compra</th>
            <th>Impuesto</th>
            <th>Fecha</th>  
            <th>Sutotal</th>
            <th>Sub iva</th>
            <th>Total pago</th>   
            </tr>
        </thead>';

    $detalle_actividad = 'SELECT
    compra_insumo.id_compra_insumo,
    proveedor.razon,
    compra_insumo.numero_compra,
    compra_insumo.tipo_comprobante,
    compra_insumo.impuesto,
    compra_insumo.fecha,
    compra_insumo.sub_total,
    compra_insumo.sub_iva,
    compra_insumo.gran_total,
    compra_insumo.cantidad,
    compra_insumo.estado 
    FROM
    compra_insumo
    INNER JOIN proveedor ON compra_insumo.proveedor_id = proveedor.id_proveedor
        WHERE compra_insumo.estado = 1 AND
        compra_insumo.fecha BETWEEN ' . $f_i . ' AND  ' . $f_f . '';

    $conta_ac = 0;
    $sum_cos_ac = 0;
    //aqui estoy pidiendo la conexion y la consulta envio
    $result_ac = $mysqli->query($detalle_actividad);
    while ($row_ac = $result_ac->fetch_assoc()) {

        $conta_ac++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $conta_ac . '</td>
               <td style="text-align:center;">' . $row_ac['razon'] . '</td>
               <td style="text-align:center;">' . $row_ac['tipo_comprobante'] . '</td>
               <td style="text-align:center;">' . $row_ac['numero_compra'] . '</td>
               <td style="text-align:center;">' . $row_ac['impuesto'] . ' %</td>
               <td style="text-align:center;">' . $row_ac['fecha'] . '</td>
               <td style="text-align:center;">$ ' . $row_ac['sub_total'] . '</td>
               <td style="text-align:center;">$ ' . $row_ac['sub_iva'] . '</td>
               <td style="text-align:center;">$ ' . $row_ac['gran_total'] . '</td>';
        $sum_cos_ac += $row_ac['costo'];
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
