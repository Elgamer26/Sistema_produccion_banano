<?php
require '../../modelo/Model_system.php';
$MY = new Model_system();
session_start();

///////////////////////////////////////////
if ($_POST["funcion"] === "traer_datos_dasboard_admin") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $total_empeados = $MY->total_empeados_activos();
        $total_material = $MY->total_maerial();
        $total_insumos = $MY->total_insumos();
        $total_prod_iniciados = $MY->total_prod_iniciados();
        // $total_product_stock = $MS->total_prodctos_stock();
        // $stock_nullo = $MS->total_pro_stok_null();
        // $stock_minimo = $MS->total_pro_stok_minimo();
        // $prod_promocion = $MS->total_productos_tienda_promocion();
        // $total_n_ventas_dia = $MS->total_n_ventas_dia();
        // $gancias_ventas_dia = $MS->gancias_ventas_dia();

        $arreglo[] = array("total_empeados" => $total_empeados, "total_material" => $total_material, "total_insumos" => $total_insumos, "total_prod_iniciados" => $total_prod_iniciados);
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////////////////////////////
if ($_POST["funcion"] === "cinco_tratamintos_materiales") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $datos = $MY->cinco_tratamintos_materiales();
        if (!empty($datos)) {
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

///////////////////////////////////////////
if ($_POST["funcion"] === "cinco_tratamintos_insumos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $datos = $MY->cinco_tratamintos_insumos();
        if (!empty($datos)) {
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

///////////////////////////////////////////
if ($_POST["funcion"] === "traer_permiso_usuario") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id_usu = $_SESSION["id_usu"];
        $id_rol = $_SESSION["id_rol"];

        $datos = $MY->traer_permiso_usuario($id_usu, $id_rol);
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////////////////////////////
if ($_POST["funcion"] === "cargar_grafico_compra_material") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $fecha_inicio = htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8');
        $fecha_fin = htmlspecialchars($_POST['fecha_fin'], ENT_QUOTES, 'UTF-8');

        $datos = $MY->cargar_grafico_compra_material($fecha_inicio, $fecha_fin);
        if (!empty($datos)) {
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

///////////////////////////////////////////
if ($_POST["funcion"] === "cargar_grafico_compra_insumo") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $fecha_inicio = htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8');
        $fecha_fin = htmlspecialchars($_POST['fecha_fin'], ENT_QUOTES, 'UTF-8');

        $datos = $MY->cargar_grafico_compra_insumo($fecha_inicio, $fecha_fin);
        if (!empty($datos)) {
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

///////////////////////////////////////////
if ($_POST["funcion"] === "cargar_grafico_compra_racimos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $fecha_inicio = htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8');
        $fecha_fin = htmlspecialchars($_POST['fecha_fin'], ENT_QUOTES, 'UTF-8');

        $datos = $MY->cargar_grafico_compra_racimos($fecha_inicio, $fecha_fin);
        if (!empty($datos)) {
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

///////////////////////////////////////////
if ($_POST["funcion"] === "cargar_grafico_compra_desechos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $fecha_inicio = htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8');
        $fecha_fin = htmlspecialchars($_POST['fecha_fin'], ENT_QUOTES, 'UTF-8');

        $datos = $MY->cargar_grafico_compra_desechos($fecha_inicio, $fecha_fin);
        if (!empty($datos)) {
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

///////////////////////////////////////////
if ($_POST["funcion"] === "cargar_grafico_produccion") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $fecha_inicio = htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8');
        $fecha_fin = htmlspecialchars($_POST['fecha_fin'], ENT_QUOTES, 'UTF-8');

        $datos = $MY->cargar_grafico_produccion($fecha_inicio, $fecha_fin);
        if (!empty($datos)) {
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}
