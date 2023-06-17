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
    <div style="text-align:center;"><h1><u>REPORTE DE MATERIALES</u></h1></div><br>
   
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
        <th>Color</th>
        <th>Precio</th>        
        <th>Estado</th>
        <th>Cantidad</th> 
        </tr>
    </thead>';

    $consultacrias = 'SELECT
	material.id_material,
	material.codigo,
	material.nombre,
	material.marca,
	tipo_material.tipo_material,
	material.color,
	material.precio,
	material.estado,
	material.eliminado,
	material.stock_m 
    FROM
        tipo_material
        INNER JOIN material ON tipo_material.id_tipo_material = material.id_tipo 
    WHERE
        material.eliminado = 1 and material.id_tipo = ' . $_GET["id"] . ' ';

    $contadromed = 0;

    //aqui estoy pidiendo la conexion y la consulta envio
    $resultmedi = $mysqli->query($consultacrias);
    while ($rowmedi = $resultmedi->fetch_assoc()) {

        $contadromed++;
        $html .= ' <tr>
               <td style="text-align:center;">' . $contadromed . '</td>
               <td style="text-align:center;">' . $rowmedi['codigo'] . '</td>
               <td style="text-align:center;">' . $rowmedi['nombre'] . '</td>
               <td style="text-align:center;">' . $rowmedi['marca'] . '</td>
               <td style="text-align:center;">' . $rowmedi['tipo_material'] . '</td>
               <td style="text-align:center;">' . $rowmedi['color'] . '</td>
               <td style="text-align:center;">' . $rowmedi['precio'] . '</td>
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
