<?php
//llamos al autoload.php del mpdf
require_once __DIR__ . '/../../vendor/autoload.php';
//aqui llamo la nueva conexion
require_once "../../../modelo/conection/conect_r.php";
session_start();

$id_usu = $_SESSION["id_usu"];

$consulta = 'SELECT * FROM `usuario`
WHERE id_usuario =  "' . $id_usu . '" ';

$consulta_ha = 'SELECT * FROM empresa';
$result_ha = $mysqli->query($consulta_ha);
$foto_ha = mysqli_fetch_assoc($result_ha);

$result = $mysqli->query($consulta);
$fecha = date("Y-m-d");
while ($row = $result->fetch_assoc()) {


    $html = '<img src="../../../' . $foto_ha['foto'] . '" style="width: 220px; float:left" height="90px" width="90px"> 
    <div style="text-align:center;"><h1><u>REPORTE DE INSUMOS</u></h1></div><br>
   
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
    <span><b>Usuario:</b> ' . $row['usuario'] . '  </span>
    </div>';

    $html .= '<div style="width:700px; text-align:center;">
                    <h2><u>Materiales disponibles</u></h2>
            </div>

    <table style="width:100%; border-collapse:collapse;" border="1">
    <thead>
        <tr bgcolor="orange">
        <th>Id</th>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Tipo</th>
        <th>Medida</th>
        <th>Precio</th>        
        <th>Estado</th>
        <th>Cantidad</th> 
        </tr>
    </thead>';

    $consultacrias = 'SELECT
	insumos.id_insumo,
	insumos.codigo_i,
	insumos.nombre_i,
	insumos.marca_i,
	tipo_insumo.tipo_insumo,
	CONCAT_WS( " ", insumos.cantidad, medida.simbolo_m ) AS medida,
	insumos.precio_c,
	insumos.estado,
	insumos.stock_m,
	insumos.eliminado
    FROM
        tipo_insumo
        INNER JOIN insumos ON tipo_insumo.id_tipo_insumo = insumos.id_tipo_insumo
        INNER JOIN medida ON insumos.id_medida = medida.id_medida 
    WHERE
	insumos.eliminado = 1 
	AND insumos.id_tipo_insumo = ' . $_GET["id"] . ' ';
    $contadromed = 0;
    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);
    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $contadromed . '</td>
               <td style="text-align:center;">' . $rowmedi['codigo_i'] . '</td>
               <td style="text-align:center;">' . $rowmedi['nombre_i'] . '</td>
               <td style="text-align:center;">' . $rowmedi['marca_i'] . '</td>
               <td style="text-align:center;">' . $rowmedi['tipo_insumo'] . '</td>
               <td style="text-align:center;">' . $rowmedi['medida'] . '</td>
               <td style="text-align:center;">' . $rowmedi['precio_c'] . '</td>
               <td style="text-align:center;">' . $rowmedi['estado'] . '</td>
               <td style="text-align:center;">' . $rowmedi['stock_m'] . '</td>';
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
