<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../modelo/conection/conect_r.php";

$consulta = 'SELECT
compra_material.id_compra_material,
proveedor.razon,
compra_material.numero_compra,
compra_material.tipo_comprobante,
compra_material.impuesto,
compra_material.fecha,
compra_material.sub_total,
compra_material.sub_iva,
compra_material.gran_total,
compra_material.cantidad,
compra_material.estado 
FROM
    compra_material
    INNER JOIN proveedor ON compra_material.proveedor_id = proveedor.id_proveedor 
WHERE compra_material.id_compra_material =  "' . $_GET["id"] . '" ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {


    $html = '<img src="../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>COMPRA MATERIAL</u></h1></div><br>
   
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
                    <h2><u>Detalle de compra material</u></h2>
            </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
<thead>
     <tr bgcolor="orange">
     <th>Id</th>
     <th>Material</th>
     <th>Cantidad</th>
     <th>Precio</th>
     <th>Desc. moneda - dolar</th>
     <th>Subtotal</th> 
    </tr>
</thead>';

    $consultacrias = 'SELECT
    detalle_compra_material.id_detalle_compra_material,
    detalle_compra_material.id_compra_material,
    material.nombre,
    tipo_material.tipo_material,
    detalle_compra_material.cantidad,
    detalle_compra_material.precio,
    detalle_compra_material.descuento,
    detalle_compra_material.subtotal,
    detalle_compra_material.estado 
    FROM
        detalle_compra_material
        INNER JOIN material ON detalle_compra_material.id_material = material.id_material
        INNER JOIN tipo_material ON material.id_tipo = tipo_material.id_tipo_material 
    WHERE
    detalle_compra_material.id_compra_material =  "' . $_GET["id"] . '" ';

    $contadromed = 0;

    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);
    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $contadromed . '</td>
               <td style="text-align:center;">' . $rowmedi['nombre'] . ' - ' . $rowmedi['tipo_material'] . '</td>
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
    <span><b>Subtotal:</b> ' .  $row['sub_total'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Iva%:</b> ' .  $row['sub_iva'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Total de pago:</b> ' .  $row['gran_total'] . ' </span>
    </div>';
}

//esto es para cambiar el tamaño de la hoja
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output();
