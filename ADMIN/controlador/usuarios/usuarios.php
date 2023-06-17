<?php
require '../../modelo/Modelousuario.php';
$MU = new Modelousuario();
session_start();

///////////////////////////////////// 
if ($_POST["funcion"] === "logeo") {
    $usu = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
    $pass = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $resutado = $MU->Verifcar_usuario($usu, $pass);
    $data = json_encode($resutado, JSON_UNESCAPED_UNICODE);
    if (count($resutado) > 0) {
        echo $data;
    } else {
        echo 0;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "session") {
    $id_usu = $_POST["id_usu"];
    $id_rol = $_POST["rol"];

    $_SESSION["id_usu"] = $id_usu;
    $_SESSION["id_rol"] = $id_rol;
    echo 1;
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_usuario") {
    if (isset($_SESSION["id_usu"]) && isset($_SESSION["id_rol"])) {
        $id =  $_SESSION["id_usu"];
        $consulta = $MU->traer_datos_usuario($id);
        $datos = json_encode($consulta, JSON_UNESCAPED_UNICODE);
        if (count($consulta) > 0) {
            echo $datos;
        } else {
            echo 0;
        }
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_foto_perfil_user") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id_empe =  $_SESSION["id_usu"];

        $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
        $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');


        //esto es para saber si el file trae datos
        if (is_array($_FILES) && count($_FILES) > 0) {
            if ($ruta_actual != "img/usuarios/user.jpg") {
                $delete = $ruta_actual;
                unlink("../../" . $delete);
            }
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/usuarios/" . $nombrearchivo)) {
                $ruta = "img/usuarios/$nombrearchivo";
                $consulta = $MU->editar_foto_perfil_usuario($id_empe, $ruta);
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
if ($_POST["funcion"] === "cambiar_pass") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id =  $_SESSION["id_usu"];
        $nueva = htmlspecialchars($_POST["nueva"], ENT_QUOTES, 'UTF-8');
        $consulta = $MU->editar_password($id, $nueva);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_datos_perfil") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id =  $_SESSION["id_usu"];
        $nomber = htmlspecialchars($_POST["nomber"], ENT_QUOTES, 'UTF-8');
        $apellido = htmlspecialchars($_POST["apellido"], ENT_QUOTES, 'UTF-8');
        $usurio = htmlspecialchars($_POST["usurio"], ENT_QUOTES, 'UTF-8');

        $consulta = $MU->editar_datos_usuario($id, $nomber, $apellido, $usurio);
        echo $consulta;
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_rl_usu") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MU->listar_tipo_rol();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registra_usuario") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
        $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
        $apellidos = htmlspecialchars($_POST['apellidos'], ENT_QUOTES, 'UTF-8');
        $tipo_rol_usu = htmlspecialchars($_POST['tipo_rol_usu'], ENT_QUOTES, 'UTF-8');
        $numero_docu = htmlspecialchars($_POST['numero_docu'], ENT_QUOTES, 'UTF-8');

        $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
        //esto es para saber si el file trae datos

        if (is_array($_FILES) && count($_FILES) > 0) {
            $ruta = "img/usuarios/$nombrearchivo";
            $consulta = $MU->registra_usuario($nombre, $usuario, $password, $apellidos, $tipo_rol_usu, $numero_docu, $ruta);
            if ($consulta == 1) {
                if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/usuarios/" . $nombrearchivo)) {
                    echo $consulta;
                } else {
                    echo 0;
                }
            } else {
                echo $consulta;
            }
        } else {
            $ruta = "img/usuarios/user.jpg";
            $consulta = $MU->registra_usuario($nombre, $usuario, $password, $apellidos, $tipo_rol_usu, $numero_docu, $ruta);
            echo $consulta;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_usuarios") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MU->listra_usuario();
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
if ($_POST["funcion"] === "estado_usuario") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MU->estado_usuario($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_usuario") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
        $usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
        $apellidos = htmlspecialchars($_POST['apellidos'], ENT_QUOTES, 'UTF-8');
        $tipo_rol_usu = htmlspecialchars($_POST['tipo_rol_usu'], ENT_QUOTES, 'UTF-8');
        $numero_docu = htmlspecialchars($_POST['numero_docu'], ENT_QUOTES, 'UTF-8');

        $consulta = $MU->editar_usuario($id, $nombre, $usuario, $apellidos, $tipo_rol_usu, $numero_docu);
        echo $consulta;
    }
    exit();
}

if ($_POST["funcion"] === "editar_password_usuario") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $nueva = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'); 

        $consulta = $MU->editar_password($id, $nueva);
        echo $consulta;
    }
    exit();
}
