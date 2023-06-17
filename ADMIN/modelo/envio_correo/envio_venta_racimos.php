<?php
require 'envio_correo.php';
$ME_CO = new envio_correo();

///////////////////
$correo = "";
$id = $_POST["id"];

//aqui llamo la nueva conexion
require_once "../conection/conect_r.php";

$consulta = 'SELECT
venta_racimos.id_venta_racimos,
cliente.nombres,
cliente.apellidos,
cliente.cedula,
cliente.correo,
venta_racimos.num_venta,
venta_racimos.tipo_comprobante,
venta_racimos.impuesto,
venta_racimos.fecha_venta,
venta_racimos.sub_total,
venta_racimos.sub_iva,
venta_racimos.total,
venta_racimos.countt,
venta_racimos.estado 
FROM
venta_racimos
INNER JOIN cliente ON venta_racimos.id_cliente = cliente.id_cliente 
WHERE
venta_racimos.id_venta_racimos =  "' . $id . '" ';

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {


  $html = ' 
    <div style="text-align:center;"><h1><u>VENTA RACIMOS</u></h1></div><br>
   
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

    <div style="float:left; width:auto">
    <span><b>Correo:</b> ' . $row['correo'] . '  </span>
    </div>
    
    <div style="float:left; width:auto;">
    <span><b>Fecha venta:</b> ' . $row['fecha_venta'] . ' </span>
    </div>

    <div style="float:left; width:auto;">
    <span><b>Impuesto:</b> ' . $row['impuesto'] . ' %</span>
    </div>';

  $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Detalle de venta racimos</u></h2>
            </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
    <thead>
        <tr bgcolor="orange">
        <th>Id</th>
        <th>Racimos</th>
        <th>Tipo</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Descuentor</th>
        <th>Subtotal</th> 
        </tr>
    </thead>';

  $consultacrias = 'SELECT
	detall_venta_racimos.id_detalle_venta_racimos,
	lote.nombre_l,
	rasimos_produccion.fecha_ra,
	detall_venta_racimos.tipo,
	detall_venta_racimos.cantidad,
	detall_venta_racimos.precio,
	detall_venta_racimos.descuento,
	detall_venta_racimos.subtotal,
	detall_venta_racimos.estado 
FROM
	detall_venta_racimos
	INNER JOIN rasimos_produccion ON detall_venta_racimos.id_detalle_racimos = rasimos_produccion.id_detalle_produccion_racimos
	INNER JOIN produccion ON rasimos_produccion.id_produccion = produccion.id_produccion
	INNER JOIN lote ON produccion.id_lote = lote.id_lote WHERE detall_venta_racimos.id_venta_racimos =  "' . $id . '" ';

  $contadromed = 0;

  //aqui estoy pidiendo la conexion y la consulta envio
  $resultmedi = $mysqli->query($consultacrias);
  while ($rowmedi = $resultmedi->fetch_assoc()) {

    $contadromed++;
    $html .= ' <tr>
               <td style="text-align:center;">' . $contadromed . '</td>
               <td style="text-align:center;">Lote racimo: ' . $rowmedi['nombre_l'] . ' - Fecha racimo: [' . $rowmedi['fecha_ra'] . ']</td>
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

  $correo = $row['correo'];
}

$sms = "Factura de venta/Racimos";

$resultado = $ME_CO->enviar_correo($correo, $html, $sms);
echo $resultado;

exit();
