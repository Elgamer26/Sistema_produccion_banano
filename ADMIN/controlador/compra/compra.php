<?php
require '../../modelo/Model_compra.php';
$MC = new Model_compra();
session_start();

///////////////////
if ($_POST["funcion"] === "listar_proveedor") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MC->listar_proveedor();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "buscar_codi_materil") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $numero = htmlspecialchars($_POST['numero'], ENT_QUOTES, 'UTF-8');
        $consulta = $MC->buscar_codi_materil($numero);

        if ($consulta) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_compra") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $proveedor = htmlspecialchars($_POST["proveedor"], ENT_QUOTES, 'UTF-8');
        $numero_compra = htmlspecialchars($_POST["numero_compra"], ENT_QUOTES, 'UTF-8');
        $comprobante_tipo = htmlspecialchars($_POST["comprobante_tipo"], ENT_QUOTES, 'UTF-8');
        $impuesto = htmlspecialchars($_POST["impuesto"], ENT_QUOTES, 'UTF-8');
        $fecha_compra = htmlspecialchars($_POST["fecha_compra"], ENT_QUOTES, 'UTF-8');
        $txt_totalneto = htmlspecialchars($_POST["txt_totalneto"], ENT_QUOTES, 'UTF-8');
        $txt_impuesto = htmlspecialchars($_POST["txt_impuesto"], ENT_QUOTES, 'UTF-8');
        $txt_a_pagar = htmlspecialchars($_POST["txt_a_pagar"], ENT_QUOTES, 'UTF-8');
        $count = htmlspecialchars($_POST["count"], ENT_QUOTES, 'UTF-8');

        $consulta = $MC->crear_nueva_compra($proveedor, $numero_compra, $comprobante_tipo, $impuesto, $fecha_compra, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $count);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_ompra") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $idpm = htmlspecialchars($_POST['idpm'], ENT_QUOTES, 'UTF-8');
        $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
        $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
        $des = htmlspecialchars($_POST['des'], ENT_QUOTES, 'UTF-8');
        $sutotal = htmlspecialchars($_POST['sutotal'], ENT_QUOTES, 'UTF-8');

        $arraglo_idpm = explode(",", $idpm); //aqui separo los datos
        $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
        $arraglo_precio = explode(",", $precio); //aqui separo los datos
        $arraglo_des  = explode(",", $des); //aqui separo los datos
        $arraglo_sutotal = explode(",", $sutotal); //aqui separo los datos  

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_idpm); $i++) {
            $consulta = $MC->registrar_detalle_compra(
                $id,
                $arraglo_idpm[$i],
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
if ($_POST["funcion"] === "listar_compras_material") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MC->listar_compras_material();
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
if ($_POST["funcion"] === "detalle_de_compra") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MC->detalle_de_compra($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "anular_copra_material") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MC->anular_copra_material($id);
        echo $consulta;
    }
    exit();
}

////////////////////
///////////////////////////////////////////////////////////////////////////
if ($_POST["funcion"] === "buscar_codi_insumo") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $numero = htmlspecialchars($_POST['numero'], ENT_QUOTES, 'UTF-8');
        $consulta = $MC->buscar_codi_insumo($numero);

        if ($consulta) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_compra_insumo") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $proveedor = htmlspecialchars($_POST["proveedor"], ENT_QUOTES, 'UTF-8');
        $numero_compra = htmlspecialchars($_POST["numero_compra"], ENT_QUOTES, 'UTF-8');
        $comprobante_tipo = htmlspecialchars($_POST["comprobante_tipo"], ENT_QUOTES, 'UTF-8');
        $impuesto = htmlspecialchars($_POST["impuesto"], ENT_QUOTES, 'UTF-8');
        $fecha_compra = htmlspecialchars($_POST["fecha_compra"], ENT_QUOTES, 'UTF-8');
        $txt_totalneto = htmlspecialchars($_POST["txt_totalneto"], ENT_QUOTES, 'UTF-8');
        $txt_impuesto = htmlspecialchars($_POST["txt_impuesto"], ENT_QUOTES, 'UTF-8');
        $txt_a_pagar = htmlspecialchars($_POST["txt_a_pagar"], ENT_QUOTES, 'UTF-8');
        $count = htmlspecialchars($_POST["count"], ENT_QUOTES, 'UTF-8');

        $consulta = $MC->crear_nueva_compra_insumo($proveedor, $numero_compra, $comprobante_tipo, $impuesto, $fecha_compra, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $count);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_inumos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $idpm = htmlspecialchars($_POST['idpm'], ENT_QUOTES, 'UTF-8');
        $medida = htmlspecialchars($_POST['medida'], ENT_QUOTES, 'UTF-8');
        $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');
        $precio = htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8');
        $des = htmlspecialchars($_POST['des'], ENT_QUOTES, 'UTF-8');
        $sutotal = htmlspecialchars($_POST['sutotal'], ENT_QUOTES, 'UTF-8');

        $arraglo_idpm = explode(",", $idpm); //aqui separo los datos
        $arraglo_medida = explode(",", $medida); //aqui separo los datos
        $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
        $arraglo_precio = explode(",", $precio); //aqui separo los datos
        $arraglo_des  = explode(",", $des); //aqui separo los datos
        $arraglo_sutotal = explode(",", $sutotal); //aqui separo los datos  

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_idpm); $i++) {
            $consulta = $MC->registrar_detalle_compra_ingreso(
                $id,
                $arraglo_idpm[$i],
                $arraglo_medida[$i],
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
if ($_POST["funcion"] === "listar_compras_insumo") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MC->listar_compras_insumo();
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
if ($_POST["funcion"] === "detalle_de_compra_insumo") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MC->detalle_de_compra_insumo($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "anular_compra_isumo") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MC->anular_compra_isumo($id);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listra_material_select") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MC->listra_material_select();
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

if ($_POST["funcion"] === "listar_isumos_seelct") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MC->listar_isumos_seelct();
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