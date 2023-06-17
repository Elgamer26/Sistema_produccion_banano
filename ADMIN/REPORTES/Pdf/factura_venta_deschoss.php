<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../modelo/conection/conect_r.php";

$consulta = 'SELECT
venta_desechos.id_venta_desechos,
cliente.nombres,
cliente.apellidos,
cliente.cedula,
venta_desechos.num_venta,
venta_desechos.tipo_comprobante,
venta_desechos.impuesto,
venta_desechos.fecha_venta,
venta_desechos.sub_total,
venta_desechos.sub_iva,
venta_desechos.total,
venta_desechos.countt,
venta_desechos.estado 
FROM
venta_desechos
INNER JOIN cliente ON venta_desechos.id_cliente = cliente.id_cliente
WHERE
venta_desechos.id_venta_desechos =  "' . $_GET["id"] . '" ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {


    $html = '<img src="../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>VENTA DESECHOS</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha imprimir:</b>  ' . $fecha . '   </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Tipo comprobante:</b>  ' . $row['tipo_comprobante'] . ' </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Numero de compra:</b> ' . $row['num_venta'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Cantidad:</b> ' . $row['countt'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Cliente:</b> ' . $row['nombres'] . ' ' . $row['apellidos'] . '   </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Cedula:</b> ' . $row['cedula'] . '  </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Fecha venta:</b> ' . $row['fecha_venta'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Impuesto:</b> ' . $row['impuesto'] . ' %</span>
    </div>';

    if ($row['estado'] == 0) {

        $html .= ' <center>
        <h2>
            <div style="width:700px; text-align:center;">
                <span style="color:red;"></b> LA VENTA DESECHOS FUE ANULADA </span>
            </div>
        </h2>
    </center>';
    }



    $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle de venta desechos</u></h2>
            </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
<thead>
     <tr bgcolor="orange">
     <th>Id</th>
     <th>Desechos</th>
     <th>Tipo</th>
     <th>Cantidad</th>
     <th>Precio</th>
     <th>Descuentor</th>
     <th>Subtotal</th> 
    </tr>
</thead>';

    $consultacrias = 'SELECT
	detall_venta_desechos.id_detalle_venta_desechos,
	lote.nombre_l,
	rechasos_produccion.fecha_re,
	detall_venta_desechos.tipo,
	detall_venta_desechos.cantidad,
	detall_venta_desechos.precio,
	detall_venta_desechos.descuento,
	detall_venta_desechos.subtotal,
	detall_venta_desechos.estado 
FROM
	detall_venta_desechos
	INNER JOIN rechasos_produccion ON detall_venta_desechos.id_detalle_desechos = rechasos_produccion.id_detalle_produccion_rechasos
	INNER JOIN produccion ON rechasos_produccion.id_produccion = produccion.id_produccion
	INNER JOIN lote ON produccion.id_lote = lote.id_lote WHERE detall_venta_desechos.id_venta_desechos =  "' . $_GET["id"] . '" ';

    $contadromed = 0;

    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);
    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $contadromed . '</td>
               <td style="text-align:center;">Lote racimo: ' . $rowmedi['nombre_l'] . ' - Fecha racimo: [' . $rowmedi['fecha_re'] . ']</td>
               <td style="text-align:center;">' . $rowmedi['tipo'] . '</td>
               <td style="text-align:center;">' . $rowmedi['cantidad'] . '</td>
               <td style="text-align:center;">$ ' . $rowmedi['precio'] . '</td>
               <td style="text-align:center;">$ ' . $rowmedi['descuento'] . '</td>
               <td style="text-align:center;">$ ' . $rowmedi['subtotal'] . '</td>';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Subtotal:</b> $/. ' .  $row['sub_total'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Iva%:</b> $/. ' .  $row['sub_iva'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Total de pago:</b> $/. ' .  $row['total'] . ' </span>
    </div>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
