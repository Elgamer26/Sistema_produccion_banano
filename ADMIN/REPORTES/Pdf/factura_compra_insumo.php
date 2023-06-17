<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../modelo/conection/conect_r.php";

$consulta = 'SELECT
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
WHERE compra_insumo.id_compra_insumo =  "' . $_GET["id"] . '" ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {


    $html = '<img src="../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>COMPRA INSUMO</u></h1></div><br>
   
    <div style="float:right; width:auto;">
    <span><b>Fecha imprimir:</b>  ' . $fecha . '   </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Tipo comprobante:</b>  ' . $row['tipo_comprobante'] . ' </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Numero de compra:</b> ' . $row['numero_compra'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Cantidad:</b> ' . $row['cantidad'] . '  </span>
    </div>

    <div style="float:left; width:auto">
    <span><b>Proveedor:</b> ' . $row['razon'] . '  </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Fecha compra:</b> ' . $row['fecha'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Impuesto:</b> ' . $row['impuesto'] . ' %</span>
    </div>';

    if ($row['estado'] == 0) {

        $html .= ' <center>
        <h2>
            <div style="width:700px; text-align:center;">
                <span style="color:red;"></b> LA COMPRA FUE ANULADA </span>
            </div>
        </h2>
    </center>';
    }



    $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle de compra insumos</u></h2>
            </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
<thead>
     <tr bgcolor="orange">
     <th>Id</th>
     <th>Insumo</th>
     <th>Medida</th>
     <th>Cantidad</th>
     <th>Precio</th>
     <th>Desc. moneda - dolar</th>
     <th>Subtotal</th> 
    </tr>
</thead>';

    $consultacrias = 'SELECT
	detalle_compra_insumo.id_compra_insumo,
	insumos.nombre_i,
	tipo_insumo.tipo_insumo,
	detalle_compra_insumo.cantidad,
	detalle_compra_insumo.medida,
	detalle_compra_insumo.precio,
	detalle_compra_insumo.descuento,
	detalle_compra_insumo.subtotal,
	detalle_compra_insumo.estado 
    FROM
	detalle_compra_insumo
	INNER JOIN insumos ON detalle_compra_insumo.id_insumo = insumos.id_insumo
	INNER JOIN tipo_insumo ON insumos.id_tipo_insumo = tipo_insumo.id_tipo_insumo
    WHERE
    detalle_compra_insumo.id_compra_insumo =  "' . $_GET["id"] . '" ';

    $contadromed = 0;

    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);
    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $contadromed . '</td>
               <td style="text-align:center;">' . $rowmedi['nombre_i'] . ' - ' . $rowmedi['tipo_insumo'] . '</td>
               <td style="text-align:center;">' . $rowmedi['medida'] . '</td>
               <td style="text-align:center;">' . $rowmedi['cantidad'] . '</td>
               <td style="text-align:center;">' . $rowmedi['precio'] . '</td>
               <td style="text-align:center;">' . $rowmedi['descuento'] . '</td>
               <td style="text-align:center;">' . $rowmedi['subtotal'] . '</td>';
    }

    $html .= '</tr>
    <tbody>
    </tbody>
    </table><br>
    
    <div style="float:left; width:auto;">
    <span><b>Subtotal:</b> $ ' .  $row['sub_total'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Iva%:</b> $ ' .  $row['sub_iva'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Total de pago:</b> $ ' .  $row['gran_total'] . ' </span>
    </div>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
