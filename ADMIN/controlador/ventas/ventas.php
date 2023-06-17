<?php
require '../../modelo/Model_ventas.php';
$MV = new Model_ventas();
session_start();

///////////////////
if ($_POST["funcion"] === "listar_clientes") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MV->listar_clientes();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_racimos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MV->listar_racimos();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "traer_datos_racimos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $data = $MV->traer_datos_racimos($id);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_venta") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $clientes = htmlspecialchars($_POST["clientes"], ENT_QUOTES, 'UTF-8');
        $numero_compra = htmlspecialchars($_POST["numero_compra"], ENT_QUOTES, 'UTF-8');
        $comprobante_tipo = htmlspecialchars($_POST["comprobante_tipo"], ENT_QUOTES, 'UTF-8');
        $impuesto = htmlspecialchars($_POST["impuesto"], ENT_QUOTES, 'UTF-8');
        $fecha_compra = htmlspecialchars($_POST["fecha_compra"], ENT_QUOTES, 'UTF-8');
        $txt_totalneto = htmlspecialchars($_POST["txt_totalneto"], ENT_QUOTES, 'UTF-8');
        $txt_impuesto = htmlspecialchars($_POST["txt_impuesto"], ENT_QUOTES, 'UTF-8');
        $txt_a_pagar = htmlspecialchars($_POST["txt_a_pagar"], ENT_QUOTES, 'UTF-8');
        $count = htmlspecialchars($_POST["count"], ENT_QUOTES, 'UTF-8');

        $consulta = $MV->registrar_venta($clientes, $numero_compra, $comprobante_tipo, $impuesto, $fecha_compra, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $count);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_venta_racimos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $idpr = htmlspecialchars($_POST['idpr'], ENT_QUOTES, 'UTF-8');
        $tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8');
        $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
        $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
        $des = htmlspecialchars($_POST['des'], ENT_QUOTES, 'UTF-8');
        $sutotal = htmlspecialchars($_POST['sutotal'], ENT_QUOTES, 'UTF-8');
        $peso = htmlspecialchars($_POST['peso'], ENT_QUOTES, 'UTF-8');

        $arraglo_idpr = explode(",", $idpr); //aqui separo los datos
        $arraglo_tipo = explode(",", $tipo); //aqui separo los datos
        $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
        $arraglo_precio = explode(",", $precio); //aqui separo los datos
        $arraglo_des  = explode(",", $des); //aqui separo los datos
        $arraglo_sutotal = explode(",", $sutotal); //aqui separo los datos 
        $arraglo_peso = explode(",", $peso); //aqui separo los datos  

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_idpr); $i++) {
            $consulta = $MV->registrar_detalle_venta_racimos(
                $id,
                $arraglo_idpr[$i],
                $arraglo_tipo[$i],
                $arraglo_cantidad[$i],
                $arraglo_precio[$i],
                $arraglo_des[$i],
                $arraglo_sutotal[$i],
                $arraglo_peso[$i]
            );
        }
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_ventas_racimos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MV->listar_ventas_racimos();
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

/////////////////////////
if ($_POST["funcion"] === "detalle_de_venta_racimos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MV->detalle_de_venta_racimos($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "anular_venta_racimos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MV->anular_venta_racimos($id);
        echo $consulta;
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_desechos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MV->listar_desechos();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "traer_datos_desechos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $data = $MV->traer_datos_desechos($id);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_venta_desechos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $clientes = htmlspecialchars($_POST["clientes"], ENT_QUOTES, 'UTF-8');
        $numero_compra = htmlspecialchars($_POST["numero_compra"], ENT_QUOTES, 'UTF-8');
        $comprobante_tipo = htmlspecialchars($_POST["comprobante_tipo"], ENT_QUOTES, 'UTF-8');
        $impuesto = htmlspecialchars($_POST["impuesto"], ENT_QUOTES, 'UTF-8');
        $fecha_compra = htmlspecialchars($_POST["fecha_compra"], ENT_QUOTES, 'UTF-8');
        $txt_totalneto = htmlspecialchars($_POST["txt_totalneto"], ENT_QUOTES, 'UTF-8');
        $txt_impuesto = htmlspecialchars($_POST["txt_impuesto"], ENT_QUOTES, 'UTF-8');
        $txt_a_pagar = htmlspecialchars($_POST["txt_a_pagar"], ENT_QUOTES, 'UTF-8');
        $count = htmlspecialchars($_POST["count"], ENT_QUOTES, 'UTF-8');

        $consulta = $MV->registrar_venta_desechos($clientes, $numero_compra, $comprobante_tipo, $impuesto, $fecha_compra, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $count);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_venta_desechos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $idde = htmlspecialchars($_POST['idde'], ENT_QUOTES, 'UTF-8');
        $tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8');
        $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
        $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
        $des = htmlspecialchars($_POST['des'], ENT_QUOTES, 'UTF-8');
        $sutotal = htmlspecialchars($_POST['sutotal'], ENT_QUOTES, 'UTF-8');

        $arraglo_idde = explode(",", $idde); //aqui separo los datos
        $arraglo_tipo = explode(",", $tipo); //aqui separo los datos
        $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
        $arraglo_precio = explode(",", $precio); //aqui separo los datos
        $arraglo_des  = explode(",", $des); //aqui separo los datos
        $arraglo_sutotal = explode(",", $sutotal); //aqui separo los datos  

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_idde); $i++) {
            $consulta = $MV->registrar_detalle_venta_desechos(
                $id,
                $arraglo_idde[$i],
                $arraglo_tipo[$i],
                $arraglo_cantidad[$i],
                $arraglo_precio[$i],
                $arraglo_des[$i],
                $arraglo_sutotal[$i]
            );
        }
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_ventas_desechos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MV->listar_ventas_desechos();
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

/////////////////////////
if ($_POST["funcion"] === "cargar_detalle_venta_deschos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MV->cargar_detalle_venta_deschos($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "anular_venta_desechos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MV->anular_venta_desechos($id);
        echo $consulta;
    }
    exit();
}

