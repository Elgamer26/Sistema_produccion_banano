<?php
require '../../modelo/Model_tipo_material.php';
$MTM = new Model_tipo_material();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_tipo_material") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->crear_tipo_material($nombre);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_tipo_insumo") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->crear_tipo_insumo($nombre);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_material") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MTM->listar_tipo_material();
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
if ($_POST["funcion"] === "estado_tipo_material") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->estado_tipo_material($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_tipo_material_") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->editar_tipo_material($nombre, $id);
        echo $consulta;
    }
    exit();
}


/////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_insumo") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MTM->listar_tipo_insumo();
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
if ($_POST["funcion"] === "estado_tipo_insumo") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->estado_tipo_insumo($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_tipo_insumo_") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->editar_tipo_insumo_($nombre, $id);
        echo $consulta;
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_tipo_material_comobo") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MTM->listar_tipo_material_comobo();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registra_material_insertar") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $codigos = htmlspecialchars($_POST["codigos"], ENT_QUOTES, 'UTF-8');
        $nombres = htmlspecialchars($_POST["nombres"], ENT_QUOTES, 'UTF-8');
        $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, 'UTF-8');
        $tipo_material = htmlspecialchars($_POST["tipo_material"], ENT_QUOTES, 'UTF-8');
        $color = htmlspecialchars($_POST["color"], ENT_QUOTES, 'UTF-8');
        $precio_venta = htmlspecialchars($_POST["precio_venta"], ENT_QUOTES, 'UTF-8');
        $observacion = htmlspecialchars($_POST["observacion"], ENT_QUOTES, 'UTF-8');
        $decripcion_mterial = htmlspecialchars($_POST["decripcion_mterial"], ENT_QUOTES, 'UTF-8');

        $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
        //esto es para saber si el file trae datos

        if (is_array($_FILES) && count($_FILES) > 0) {
            $ruta = "img/material/$nombrearchivo";
            $consulta = $MTM->registra_material_insertar($codigos, $nombres, $marca, $tipo_material, $color, $precio_venta, $observacion, $decripcion_mterial, $ruta);
            if ($consulta == 1) {
                if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/material/" . $nombrearchivo)) {
                    echo $consulta;
                } else {
                    echo 0;
                }
            } else {
                echo $consulta;
            }
        } else {
            $ruta = "img/material/material.jpg";
            $consulta = $MTM->registra_material_insertar($codigos, $nombres, $marca, $tipo_material, $color, $precio_venta, $observacion, $decripcion_mterial, $ruta);
            echo $consulta;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_n_matrial") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MTM->listar_n_matrial();
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
if ($_POST["funcion"] === "estado_material_b") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->estado_material_b($id, $dato);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_foto_material") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
        $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');

        //esto es para saber si el file trae datos
        if (is_array($_FILES) && count($_FILES) > 0) {
            if ($ruta_actual != "img/material/material.jpg") {
                $delete = $ruta_actual;
                unlink("../../" . $delete);
            }
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/material/" . $nombrearchivo)) {
                $ruta = "img/material/$nombrearchivo";
                $consulta = $MTM->editar_foto_material($id, $ruta);
                echo $consulta;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_material_b") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $codigos = htmlspecialchars($_POST["codigos"], ENT_QUOTES, 'UTF-8');
        $nombres = htmlspecialchars($_POST["nombres"], ENT_QUOTES, 'UTF-8');
        $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, 'UTF-8');
        $tipo_material = htmlspecialchars($_POST["tipo_material"], ENT_QUOTES, 'UTF-8');
        $color = htmlspecialchars($_POST["color"], ENT_QUOTES, 'UTF-8');
        $precio_venta = htmlspecialchars($_POST["precio_venta"], ENT_QUOTES, 'UTF-8');
        $observacion = htmlspecialchars($_POST["observacion"], ENT_QUOTES, 'UTF-8');
        $decripcion_mterial = htmlspecialchars($_POST["decripcion_mterial"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->editar_material_b($id, $codigos, $nombres, $marca, $tipo_material, $color, $precio_venta, $observacion, $decripcion_mterial);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "nuevo_medida") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre_medida = htmlspecialchars($_POST["nombre_medida"], ENT_QUOTES, 'UTF-8');
        $simbolo_medida = htmlspecialchars($_POST["simbolo_medida"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->nuevo_medida($nombre_medida, $simbolo_medida);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_medida_") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MTM->listar_medida_();
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
if ($_POST["funcion"] === "estado_medida") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->estado_medida($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editarr_medida") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre_medida = htmlspecialchars($_POST["nombre_medida"], ENT_QUOTES, 'UTF-8');
        $simbolo_medida = htmlspecialchars($_POST["simbolo_medida"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->editarr_medida($id, $nombre_medida, $simbolo_medida);
        echo $consulta;
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_tipo_insumo_combo") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MTM->listar_tipo_insumo_combo();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "litar_medida") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MTM->litar_medida();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registra_insumo_insertar") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $codigos = htmlspecialchars($_POST["codigos"], ENT_QUOTES, 'UTF-8');
        $nombres = htmlspecialchars($_POST["nombres"], ENT_QUOTES, 'UTF-8');
        $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, 'UTF-8');
        $tipo_insumo = htmlspecialchars($_POST["tipo_insumo"], ENT_QUOTES, 'UTF-8');
        $Cantidad = htmlspecialchars($_POST["Cantidad"], ENT_QUOTES, 'UTF-8');
        $tipo_medidda = htmlspecialchars($_POST["tipo_medidda"], ENT_QUOTES, 'UTF-8');
        $precio_venta = htmlspecialchars($_POST["precio_venta"], ENT_QUOTES, 'UTF-8');
        $observacion = htmlspecialchars($_POST["observacion"], ENT_QUOTES, 'UTF-8');
        $decripcion_mterial = htmlspecialchars($_POST["decripcion_mterial"], ENT_QUOTES, 'UTF-8');

        $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
        //esto es para saber si el file trae datos

        if (is_array($_FILES) && count($_FILES) > 0) {
            $ruta = "img/insumo/$nombrearchivo";
            $consulta = $MTM->registra_insumo_insertar($codigos, $nombres, $marca, $tipo_insumo, $Cantidad, $tipo_medidda, $precio_venta, $observacion, $decripcion_mterial, $ruta);
            if ($consulta == 1) {
                if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/insumo/" . $nombrearchivo)) {
                    echo $consulta;
                } else {
                    echo 0;
                }
            } else {
                echo $consulta;
            }
        } else {
            $ruta = "img/insumo/insumo.jpg";
            $consulta = $MTM->registra_insumo_insertar($codigos, $nombres, $marca, $tipo_insumo, $Cantidad, $tipo_medidda, $precio_venta, $observacion, $decripcion_mterial, $ruta);
            echo $consulta;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_b_insumo") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MTM->listar_b_insumo();
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
if ($_POST["funcion"] === "estado_b_insumos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->estado_b_insumos($id, $dato);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_foto_insumoss") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
        $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');

        //esto es para saber si el file trae datos
        if (is_array($_FILES) && count($_FILES) > 0) {
            if ($ruta_actual != "img/insumo/insumo.jpg") {
                $delete = $ruta_actual;
                unlink("../../" . $delete);
            }
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/insumo/" . $nombrearchivo)) {
                $ruta = "img/insumo/$nombrearchivo";
                $consulta = $MTM->editar_foto_insumoss($id, $ruta);
                echo $consulta;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_insumo_bb") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $codigos = htmlspecialchars($_POST["codigos"], ENT_QUOTES, 'UTF-8');
        $nombres = htmlspecialchars($_POST["nombres"], ENT_QUOTES, 'UTF-8');
        $marca = htmlspecialchars($_POST["marca"], ENT_QUOTES, 'UTF-8');
        $tipo_insumo = htmlspecialchars($_POST["tipo_insumo"], ENT_QUOTES, 'UTF-8');
        $Cantidad = htmlspecialchars($_POST["Cantidad"], ENT_QUOTES, 'UTF-8');
        $tipo_medidda = htmlspecialchars($_POST["tipo_medidda"], ENT_QUOTES, 'UTF-8');
        $precio_venta = htmlspecialchars($_POST["precio_venta"], ENT_QUOTES, 'UTF-8');
        $observacion = htmlspecialchars($_POST["observacion"], ENT_QUOTES, 'UTF-8');
        $decripcion_mterial = htmlspecialchars($_POST["decripcion_mterial"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTM->editar_insumo_bb($id, $codigos, $nombres, $marca, $tipo_insumo, $Cantidad, $tipo_medidda, $precio_venta, $observacion, $decripcion_mterial);
        echo $consulta;
    }
    exit();
}
