<?php
require '../../modelo/Model_rol_pagos.php';
$MRP = new Model_rol_pagos();
session_start();

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_datos_empleado_rol_pagos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $consulta = $MRP->traer_datos_empleado_rol_pagos();
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_bebficios_rol") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MRP->listar_bebficios_rol();
        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';
        }
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_data_rol_pagos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id_empleado = htmlspecialchars($_POST['id_empleado'], ENT_QUOTES, 'UTF-8');
        $id_producion = htmlspecialchars($_POST['id_producion'], ENT_QUOTES, 'UTF-8');

        $consulta = $MRP->traer_data_rol_pagos($id_empleado, $id_producion);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_multas_saciones") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MRP->traer_multas_saciones($id);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_rol_de_pagos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id_em = htmlspecialchars($_POST["id_em"], ENT_QUOTES, 'UTF-8');
        $id_producion = htmlspecialchars($_POST["id_producion"], ENT_QUOTES, 'UTF-8');
        $actividad = htmlspecialchars($_POST["actividad"], ENT_QUOTES, 'UTF-8');
        $produccion_datos = htmlspecialchars($_POST["produccion_datos"], ENT_QUOTES, 'UTF-8');
        $fecha_pago = htmlspecialchars($_POST["fecha_pago"], ENT_QUOTES, 'UTF-8');
        $pago_ac = htmlspecialchars($_POST["pago_ac"], ENT_QUOTES, 'UTF-8');
        $dias_prod = htmlspecialchars($_POST["dias_prod"], ENT_QUOTES, 'UTF-8');
        $total_ingreso = htmlspecialchars($_POST["total_ingreso"], ENT_QUOTES, 'UTF-8');
        $total_egreso = htmlspecialchars($_POST["total_egreso"], ENT_QUOTES, 'UTF-8');
        $txtneto_pagar = htmlspecialchars($_POST["txtneto_pagar"], ENT_QUOTES, 'UTF-8');
        $count_ingreso = htmlspecialchars($_POST["count_ingreso"], ENT_QUOTES, 'UTF-8');
        $count_egreso = htmlspecialchars($_POST["count_egreso"], ENT_QUOTES, 'UTF-8');

        $consulta = $MRP->registrar_rol_de_pagos($id_em, $id_producion, $actividad, $produccion_datos, $fecha_pago, $pago_ac, $dias_prod, $total_ingreso, $total_egreso, $txtneto_pagar, $count_ingreso, $count_egreso);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_ingreso") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
        $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');

        $arraglo_nombre = explode(",", $nombre); //aqui separo los datos
        $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos  

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_nombre); $i++) {
            $consulta = $MRP->registrar_detalle_ingreso(
                $id,
                $arraglo_nombre[$i],
                $arraglo_cantidad[$i]
            );
        }
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_egreso") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
        $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');

        $arraglo_nombre = explode(",", $nombre); //aqui separo los datos
        $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos  

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_nombre); $i++) {
            $consulta = $MRP->registrar_detalle_egreso(
                $id,
                $arraglo_nombre[$i],
                $arraglo_cantidad[$i]
            );
        }
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "pagar_multa_sancion") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $id_multa = htmlspecialchars($_POST['id_multa'], ENT_QUOTES, 'UTF-8');

        $arraglo_id_multa = explode(",", $id_multa); //aqui separo los datos 

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_id_multa); $i++) {
            $consulta = $MRP->pagar_multa_sancion(
                $id,
                $arraglo_id_multa[$i]
            );
        }
        echo $consulta;
    }
    exit();
}

//////////////////////////////
if ($_POST["funcion"] === "sacra_asistencias") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $idasistencia = htmlspecialchars($_POST['idasistencia'], ENT_QUOTES, 'UTF-8');

        $arraglo_idasistencia = explode(",", $idasistencia); //aqui separo los datos 

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_idasistencia); $i++) {
            $consulta = $MRP->sacra_asistencias(
                $id,
                $arraglo_idasistencia[$i]
            );
        }
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_rol_pagos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MRP->listar_rol_pagos();
        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_empleado_rol_pagos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MRP->listar_empleado_rol_pagos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_asistecnis_empleado") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MRP->traer_asistecnis_empleado($id);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}
