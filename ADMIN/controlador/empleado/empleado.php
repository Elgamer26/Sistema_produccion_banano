<?php
require '../../modelo/Model_empleado.php';
$MEE = new Model_empleado();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "registra_empleado") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $apellidos = htmlspecialchars($_POST["apellidos"], ENT_QUOTES, 'UTF-8');
        $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
        $numero_docu = htmlspecialchars($_POST["numero_docu"], ENT_QUOTES, 'UTF-8');
        $direccions = htmlspecialchars($_POST["direccions"], ENT_QUOTES, 'UTF-8');
        $telefono_empleado = htmlspecialchars($_POST["telefono_empleado"], ENT_QUOTES, 'UTF-8');
        $correo_empleado = htmlspecialchars($_POST["correo_empleado"], ENT_QUOTES, 'UTF-8');
        $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');

        $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
        //esto es para saber si el file trae datos

        if (is_array($_FILES) && count($_FILES) > 0) {
            $ruta = "img/empleado/$nombrearchivo";
            $consulta = $MEE->registra_empleado($nombre, $apellidos, $fecha, $numero_docu, $direccions, $telefono_empleado, $correo_empleado, $sexo, $ruta);
            if ($consulta == 1) {
                if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/empleado/" . $nombrearchivo)) {
                    echo $consulta;
                } else {
                    echo 0;
                }
            } else {
                echo $consulta;
            }
        } else {
            $ruta = "img/empleado/empleado.jpg";
            $consulta = $MEE->registra_empleado($nombre, $apellidos, $fecha, $numero_docu, $direccions, $telefono_empleado, $correo_empleado, $sexo, $ruta);
            echo $consulta;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_empleado") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MEE->listra_empleado();
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
if ($_POST["funcion"] === "traer_datos_empleado") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $valor = htmlspecialchars($_POST['valor'], ENT_QUOTES, 'UTF-8');

        $consulta = $MEE->traer_datos_empleado($valor);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "crear_hoja_vida") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $primaria_estudio = htmlspecialchars($_POST["primaria_estudio"], ENT_QUOTES, 'UTF-8');
        $secundaria_estudio = htmlspecialchars($_POST["secundaria_estudio"], ENT_QUOTES, 'UTF-8');
        $superior_estudio = htmlspecialchars($_POST["superior_estudio"], ENT_QUOTES, 'UTF-8');
        $cursos_relizados = htmlspecialchars($_POST["cursos_relizados"], ENT_QUOTES, 'UTF-8');
        $licencia_conducir = htmlspecialchars($_POST["licencia_conducir"], ENT_QUOTES, 'UTF-8');
        $tipo_licencia = htmlspecialchars($_POST["tipo_licencia"], ENT_QUOTES, 'UTF-8');
        $ultimo_trabajo = htmlspecialchars($_POST["ultimo_trabajo"], ENT_QUOTES, 'UTF-8');
        $expe_laboral = htmlspecialchars($_POST["expe_laboral"], ENT_QUOTES, 'UTF-8');

        $consulta = $MEE->registra_hoja_vida($id, $primaria_estudio, $secundaria_estudio, $superior_estudio, $cursos_relizados, $licencia_conducir, $tipo_licencia, $ultimo_trabajo, $expe_laboral);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "estado_empleado") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MEE->estado_empleado($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_empleado") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $apellidos = htmlspecialchars($_POST["apellidos"], ENT_QUOTES, 'UTF-8');
        $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
        $numero_docu = htmlspecialchars($_POST["numero_docu"], ENT_QUOTES, 'UTF-8');
        $direccions = htmlspecialchars($_POST["direccions"], ENT_QUOTES, 'UTF-8');
        $telefono_empleado = htmlspecialchars($_POST["telefono_empleado"], ENT_QUOTES, 'UTF-8');
        $correo_empleado = htmlspecialchars($_POST["correo_empleado"], ENT_QUOTES, 'UTF-8');
        $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');

        $consulta = $MEE->editar_empleado($id, $nombre, $apellidos, $fecha, $numero_docu, $direccions, $telefono_empleado, $correo_empleado, $sexo);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_datos_hoja_vida") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

        $consulta = $MEE->traer_datos_hoja_vida($id);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_hoja_vida") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $id_hoja = htmlspecialchars($_POST["id_hoja"], ENT_QUOTES, 'UTF-8');
        $primaria_estudio = htmlspecialchars($_POST["primaria_estudio"], ENT_QUOTES, 'UTF-8');
        $secundaria_estudio = htmlspecialchars($_POST["secundaria_estudio"], ENT_QUOTES, 'UTF-8');
        $superior_estudio = htmlspecialchars($_POST["superior_estudio"], ENT_QUOTES, 'UTF-8');
        $cursos_relizados = htmlspecialchars($_POST["cursos_relizados"], ENT_QUOTES, 'UTF-8');
        $licencia_conducir = htmlspecialchars($_POST["licencia_conducir"], ENT_QUOTES, 'UTF-8');
        $tipo_licencia = htmlspecialchars($_POST["tipo_licencia"], ENT_QUOTES, 'UTF-8');
        $ultimo_trabajo = htmlspecialchars($_POST["ultimo_trabajo"], ENT_QUOTES, 'UTF-8');
        $expe_laboral = htmlspecialchars($_POST["expe_laboral"], ENT_QUOTES, 'UTF-8');

        $consulta = $MEE->editar_hoja_vida($id, $id_hoja, $primaria_estudio, $secundaria_estudio, $superior_estudio, $cursos_relizados, $licencia_conducir, $tipo_licencia, $ultimo_trabajo, $expe_laboral);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "editar_foto_empleado") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
        $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');

        //esto es para saber si el file trae datos
        if (is_array($_FILES) && count($_FILES) > 0) {
            if ($ruta_actual != "img/empleado/empleado.jpg") {
                $delete = $ruta_actual;
                unlink("../../" . $delete);
            }
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/empleado/" . $nombrearchivo)) {
                $ruta = "img/empleado/$nombrearchivo";
                $consulta = $MEE->editar_foto_empleado($id, $ruta);
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

///////////////////
if ($_POST["funcion"] === "listar_hoja_empleado") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MEE->listar_hoja_empleado();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "listar_reporte_asistecias") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $consulta = $MEE->listar_reporte_asistecias();
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}
