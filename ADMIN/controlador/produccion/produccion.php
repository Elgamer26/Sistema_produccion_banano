<?php
require '../../modelo/Modelo_produccion.php';
$MPPOR = new Modelo_produccion();
session_start();

///////////////////
if ($_POST["funcion"] === "listar_lotes_select") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MPPOR->listar_lotes_select();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_hectarea") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $data = $MPPOR->listar_hectarea($id);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_tipo_ctividad") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MPPOR->listar_tipo_ctividad();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_empleado") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $data = $MPPOR->listar_empleado($id);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "costro_actividad") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $data = $MPPOR->costro_actividad($id);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_material") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MPPOR->listar_material();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "dato_material") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $data = $MPPOR->dato_material($id);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_insumos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MPPOR->listar_insumos();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "dato_insumos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $data = $MPPOR->dato_insumos($id);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_produccion") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $fecha_inicio = htmlspecialchars($_POST["fecha_inicio"], ENT_QUOTES, 'UTF-8');
        $fecha_fin = htmlspecialchars($_POST["fecha_fin"], ENT_QUOTES, 'UTF-8');
        $dias_dias = htmlspecialchars($_POST["dias_dias"], ENT_QUOTES, 'UTF-8');
        $lote_id = htmlspecialchars($_POST["lote_id"], ENT_QUOTES, 'UTF-8');
        $nombre_produccion = htmlspecialchars($_POST["nombre_produccion"], ENT_QUOTES, 'UTF-8');
        $hectarea_id = htmlspecialchars($_POST["hectarea_id"], ENT_QUOTES, 'UTF-8');

        $hectarea_no = htmlspecialchars($_POST["hectarea_no"], ENT_QUOTES, 'UTF-8');

        $consulta = $MPPOR->crear_produccion($fecha_inicio, $fecha_fin, $dias_dias, $lote_id, $nombre_produccion, $hectarea_id, $hectarea_no);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_actividad") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $id_act = htmlspecialchars($_POST['id_act'], ENT_QUOTES, 'UTF-8');
        $actividad = htmlspecialchars($_POST['actividad'], ENT_QUOTES, 'UTF-8');
        $costo = htmlspecialchars($_POST['costo'], ENT_QUOTES, 'UTF-8');
        $hora = htmlspecialchars($_POST['hora'], ENT_QUOTES, 'UTF-8');
        $costo_hora = htmlspecialchars($_POST['costo_hora'], ENT_QUOTES, 'UTF-8');

        $arraglo_id_act = explode(",", $id_act); //aqui separo los datos
        $arraglo_actividad = explode(",", $actividad); //aqui separo los datos
        $arraglo_costo = explode(",", $costo); //aqui separo los datos 
        $arraglo_hora = explode(",", $hora); //aqui separo los datos
        $arraglo_costo_hora = explode(",", $costo_hora); //aqui separo los datos 

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_id_act); $i++) {
            $consulta = $MPPOR->registrar_detalle_actividad(
                $id,
                $arraglo_id_act[$i],
                $arraglo_actividad[$i],
                $arraglo_costo[$i],
                $arraglo_hora[$i],
                $arraglo_costo_hora[$i]
            );
        }
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_material") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $id_materila = htmlspecialchars($_POST['id_materila'], ENT_QUOTES, 'UTF-8');
        $costo = htmlspecialchars($_POST['costo'], ENT_QUOTES, 'UTF-8');
        $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');

        $arraglo_id_materila = explode(",", $id_materila); //aqui separo los datos
        $arraglo_costo = explode(",", $costo); //aqui separo los datos
        $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos   

        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_id_materila); $i++) {
            $consulta = $MPPOR->registrar_detalle_material(
                $id,
                $arraglo_id_materila[$i],
                $arraglo_costo[$i],
                $arraglo_cantidad[$i]
            );
        }
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "registrar_detalle_insumo") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $id_insumo = htmlspecialchars($_POST['id_insumo'], ENT_QUOTES, 'UTF-8');
        $costo = htmlspecialchars($_POST['costo'], ENT_QUOTES, 'UTF-8');
        $medi_cant = htmlspecialchars($_POST['medi_cant'], ENT_QUOTES, 'UTF-8');

        $medida = htmlspecialchars($_POST['medida'], ENT_QUOTES, 'UTF-8');
        $cantidad = htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8');

        $arraglo_id_insumo = explode(",", $id_insumo); //aqui separo los datos
        $arraglo_costo = explode(",", $costo); //aqui separo los datos
        $arraglo_medi_cant = explode(",", $medi_cant); //aqui separo los datos  
        $arraglo_medida = explode(",", $medida); //aqui separo los datos
        $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos   

        //bucle para contar la medi_cant de datos
        for ($i = 0; $i < count($arraglo_id_insumo); $i++) {
            $consulta = $MPPOR->registrar_detalle_insumo(
                $id,
                $arraglo_id_insumo[$i],
                $arraglo_costo[$i],
                $arraglo_medi_cant[$i],
                $arraglo_medida[$i],
                $arraglo_cantidad[$i]
            );
        }
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "lisrado_produccion") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MPPOR->lisrado_produccion();
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
if ($_POST["funcion"] === "cargar_detalle_acntividades") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MPPOR->cargar_detalle_acntividades($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "cargar_detalle_material") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MPPOR->cargar_detalle_material($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "cargar_detalle_insumoos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MPPOR->cargar_detalle_insumoos($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "cargar_detalle_racimos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MPPOR->cargar_detalle_racimos($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "cargar_detalle_rechasos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MPPOR->cargar_detalle_rechasos($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "cargar_detalle_novedad") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MPPOR->cargar_detalle_novedad($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cancelar_produccion") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $id_hec = htmlspecialchars($_POST["id_hec"], ENT_QUOTES, 'UTF-8');
        $consulta = $MPPOR->cancelar_produccion($id, $id_hec);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "finalizar_produccion_") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $consulta = $MPPOR->finalizar_produccion_($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_reporte_produccion") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MPPOR->listar_reporte_produccion();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "guardar_pocetaje") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $pocentaje_ = htmlspecialchars($_POST["pocentaje_"], ENT_QUOTES, 'UTF-8');
        $id_h_ = htmlspecialchars($_POST["id_h_"], ENT_QUOTES, 'UTF-8');
        $consulta = $MPPOR->guardar_pocetaje($id, $pocentaje_, $id_h_);
        echo $consulta;
    }
    exit();
}
