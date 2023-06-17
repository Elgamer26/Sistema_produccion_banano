<?php
//esto es en caso de que no exista la session me llevara al login index
session_start();
if (!isset($_SESSION["id_usu"])) {
    header("location: ../");
}
?>

<!-- TABLA DETALLE_LOTE CREADO -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Sistema de produccion</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="template/admincast/html/dist/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="template/admincast/html/dist/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="template/admincast/html/dist/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="template/admincast/html/dist/assets/css/main.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="plugins/DATATABLES/datatables.min.css">
    <link rel="stylesheet" href="plugins/SELECT2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/flatpickr/flatpickr.min.css">
    <!-- PAGE LEVEL STYLES-->
</head>

<style>
    input[type="checkbox"] {
        position: relative;
        width: 60px;
        height: 30px;
        -webkit-appearance: none;
        background: rgb(168, 168, 168);
        outline: none;
        border-radius: 15px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, .5);
    }

    input:checked[type="checkbox"] {
        background: rgb(0, 123, 255);
    }

    input[type="checkbox"]:before {
        content: "";
        position: absolute;
        width: 30px;
        height: 30px;
        border-radius: 20px;
        top: 0;
        left: 0;
        background: white;
        transition: 0.5s;

    }

    input:checked[type="checkbox"]:before {
        left: 30px;
    }
</style>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="index.php">
                    <span class="brand">Banano
                        <span class="brand-tip">App</span>
                    </span>
                    <span class="brand-mini">BA</span>
                </a>
            </div>
            <div class="flexbox flex-1">

                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                </ul>
                <ul class="nav navbar-toolbar">

                    <li class="dropdown-menu-header">
                        <div>
                            <?php
                            date_default_timezone_set('America/Guayaquil');
                            function fechaC()
                            {
                                $mes = array(
                                    "", "Enero",
                                    "Febrero",
                                    "Marzo",
                                    "Abril",
                                    "Mayo",
                                    "Junio",
                                    "Julio",
                                    "Agosto",
                                    "Septiembre",
                                    "Octubre",
                                    "Noviembre",
                                    "Diciembre"
                                );
                                return date('d') . " de " . $mes[date('n')] . " de " . date('Y');
                            }
                            ?>
                            <small><b>Milagro - </b> <?php echo fechaC(); ?></small>
                        </div>
                    </li>

                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <img class="img-circle" id="foto_user_dos" />
                            <span id="datos_nombres_empleado_2"></span><i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" onclick="editar_usuario_legeado();"><i class="fa fa-user"></i>Perfil</a>
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="controlador/usuarios/cerrar.php" style="background-color: red; color: white;"><i class="fa fa-power-off"></i>Cerrar sesion</a>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>

        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img class="img-circle" id="foto_user_uno" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong">
                            <p id="datos_nombres_empleado"></p>
                        </div><small id="cargo_empreado"></small>
                    </div>
                </div>
                <ul class="side-menu metismenu">

                    <li id="config_in">
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-user"></i>
                            <span class="nav-label">Usuario</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/roles/nuevo_rol.php');">Roles y permisos</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/roles/listado_roles.php');">Listado de roles</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/usuario/nuevo_usuario.php');">Nuevo usuario</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/usuario/listado_usuarios.php');">Listado de usuario</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/empresa/empresa.php');">Empresa</a>
                            </li>

                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/tipo_sancion/tipo_sancion.php');">Tipo de sanciones</a>
                            </li>

                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/permisos/tipo_permisos.php');">Tipo de permisos laboral</a>
                            </li>

                            <li id="respaldos_in">
                                <a style="color: black; background: pink;" onclick="cargar_contenido('contenido_principal','vista/empresa/respaldo.php');">Respaldo de datos</a>
                            </li>

                        </ul>
                    </li>

                    <li id="empleados_in">
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                            <span class="nav-label">Empleados</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/empreado/nuevo_empreado.php');">Registro empleado</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/empreado/crear_hoja_vida.php');">Crear hoja de vida</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/empreado/listado_empleados.php');">Listado de empleado</a>
                            </li>

                            <li id="multas_in">
                                <a style="color: white; background:red;">
                                    <span class="nav-label">Multas - sanciones</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/sanciones/nueva_sancion.php');">Nueva sancion/multa</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/sanciones/listado_sanciones.php');">Listado sancion/multa</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/sanciones/multas_empleado.php');">Multas por empleado</a>
                                    </li>
                                </ul>
                            </li>

                            <li id="asistecias_in">
                                <a style="color: white; background:orange;">
                                    <span class="nav-label">Asistencias</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/asistencia/marcar_entrada.php');">Marcar entrada</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/asistencia/marcar_salida.php');">Marcar salida</a>
                                    </li>

                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/asistencia/listado_asistencias.php');">Listado de asistencias</a>
                                    </li>

                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/asistencia/asistencia_empleado.php');">Asistencia por empleado</a>
                                    </li>

                                    <!-- <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/asistencia/asistencia_empleado.php');">Permisos de trabajo</a>
                                    </li> -->

                                </ul>
                            </li>

                            <li id="permisos_in">
                                <a style="color: white; background:yellowgreen;">
                                    <span class="nav-label">Permisos de trabajo</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/permisos/mueva_permisos.php');">Nuevo permiso</a>
                                    </li>

                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/permisos/listado_permisos.php');">Listado de permisos</a>
                                    </li>

                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/permisos/permisos_emppleados.php');">Permisos de empleados</a>
                                    </li>

                                </ul>
                            </li>

                            <li id="rol_pagos_in">
                                <a style="color: white; background:blue;">
                                    <span class="nav-label">Rol de pagos</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/rol_pagos/benefiios.php');">Beneficios</a>
                                    </li>

                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/rol_pagos/pagos_empleados.php');">Pagos a empleados</a>
                                    </li>

                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/rol_pagos/lstado_pagos.php');">Listado de pagos</a>
                                    </li>

                                </ul>
                            </li>

                        </ul>
                    </li>

                    <li id="bodega_in">
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-home"></i>
                            <span class="nav-label">Bodega</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">

                            <li>
                                <a style="color: white; background:orange;">
                                    <span class="nav-label">Tipo de material</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/bodega/tipo_material.php');">Nuevo tipo de material</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/bodega/listado_tipo_material.php');">Listado tipo de material</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a style="color: white; background:orange;">
                                    <span class="nav-label">Tipo de insumo</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">

                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/bodega/tipo_medida.php');">Tipo de medida</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/bodega/tipo_insumo.php');">Registro tipo de insumo</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/bodega/listado_tipo_insumo.php');">Listado tipo insumo</a>
                                    </li>
                                </ul>
                            </li>



                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/bodega/registro_material.php');">Registro material</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/bodega/listado_material.php');">Listado de material</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/bodega/registro_insumo.php');">Registro insumo</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/bodega/listado_insumoss.php');">Listado de insumo</a>
                            </li>
                        </ul>
                    </li>

                    <li id="compras_in">
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-shopping-cart"></i>
                            <span class="nav-label">Compras</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/proveedor/nuevo_proveedor.php');">Proveedor</a>
                            </li>

                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/proveedor/listado_proveedor.php');">Listado de proveedor</a>
                            </li>

                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/compra/nueva_compra.php');">Nueva compra material</a>
                            </li>

                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/compra/listado_compra_material.php');">Lista compras material</a>
                            </li>

                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/compra/nueva_compra_insumo.php');">Nueva compra insumo</a>
                            </li>

                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/compra/listado_compra_insumo.php');">Lista compras insumo</a>
                            </li>
                        </ul>
                    </li>

                    <li id="produccion_in">
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-cubes"></i>
                            <span class="nav-label">Produccion</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">

                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/tipo_actividad/tipo_actividades.php');">Tipo de actividad/labores</a>
                            </li>

                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/produccion/novedades.php');">Novedades</a>
                            </li>

                            <li>
                                <a style="color: white; background:yellowgreen;">
                                    <span class="nav-label">Actividades</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/actividades/nuva_asignacion.php');">Nueva asignacion</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/actividades/listado_asignacion.php');">Listado de asignaciones</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a style="color: white; background:green;">
                                    <span class="nav-label">Lotes</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/lotes/nuevo_lote.php');">Nueva lote</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/lotes/listado_lotes.php');">Listado de lotes</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a style="color: white; background:#00AAE4;">
                                    <span class="nav-label">Produccion</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/produccion/nueva_produccion.php');">Nueva produccion</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/produccion/listado_produccion.php');">Listado de produccion</a>
                                    </li>
                                    <li>
                                        <a style="color: white; background:red;" onclick="cargar_contenido('contenido_principal','vista/produccion/novedad_produccion.php');">Registro novedad</a>
                                    </li>
                                    <li>
                                        <a style="color: white; background:red;" onclick="cargar_contenido('contenido_principal','vista/produccion/listado_novedad_produccion.php');">Listado de novedades</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a style="color: black; background:yellow;">
                                    <span class="nav-label">Cintas</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/cintas/tipo_cintas.php');">Tipos de cintas</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/cintas/registro_cintas.php');">Registro de cintas</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a style="color: white;">
                                    <span class="nav-label">Racimos o desechos</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/desecho/nueva_desecho.php');">Nuevo racimos/desechos</a>
                                    </li>
                                    <li>
                                        <a style="color: white; background:orange;" style="color: white;" onclick="cargar_contenido('contenido_principal','vista/desecho/listad_racimos.php');">Listado racimos</a>
                                    </li>
                                    <li>
                                        <a style="color: white; background:red;" style="color: white;" onclick="cargar_contenido('contenido_principal','vista/desecho/listado_desecho.php');">Listado desechos</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li id="ventas_in">
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-shopping-cart"></i>
                            <span class="nav-label">Ventas</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a style="color: white;">
                                    <span class="nav-label">Clientes</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/clientes/nuevo_clientes.php');">Nuevo cliente</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/clientes/listar_clientes.php');">Listado de clientes</a>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a style="color: white; background: orange;">
                                    <span class="nav-label">Racimos</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/ventas/ventas_racimos.php');">Cajas</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/ventas/listado_ventas_racimos.php');">Listado ventas</a>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a style="color: white; background: red;">
                                    <span class="nav-label">Desechos</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-3-level collapse">
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/ventas/ventas_desechos.php');">Desechos</a>
                                    </li>
                                    <li>
                                        <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/ventas/listado_ventas_desechos.php');">Listado ventas</a>
                                    </li>

                                </ul>
                            </li>

                        </ul>
                    </li>

                    <li id="control_plagas_in">
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-eyedropper"></i>
                            <span class="nav-label">Control de plagas</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a style="color: white; background: red;" onclick="cargar_contenido('contenido_principal','vista/plagas/tipo_plagas.php');">Tipo de plaga</a>
                            </li>
                            <li>
                                <a style="color: white; background: orange;" onclick="cargar_contenido('contenido_principal','vista/plagas/tipo_quimico.php');">Tipo de quimico</a>
                            </li>
                            <li>
                                <a style="color: white; background: yellowgreen;" onclick="cargar_contenido('contenido_principal','vista/plagas/tipo_tratamiento.php');">Tipo de tratamiento</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/plagas/registro_plagas.php');">Registro de plagas</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/plagas/listado_plagas.php');">Listado de plagas</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/plagas/nuevo_tratamiento_pagas.php');">Tratamiento de plagas</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/plagas/listado_tratamiento_pagas.php');">Listado trata. de plagas</a>
                            </li>

                        </ul>
                    </li>

                    <li id="reportes_in">
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-file"></i>
                            <span class="nav-label">Reportes</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/reportes/reportes_materiaales.php');">Reportes materiales</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/reportes/reportes_insumos.php');">Reportes insumos</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/reportes/reportes_produccion.php');">Reportes produccion</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/reportes/reportes_asstecias.php');">Reportes asistencias</a>
                            </li>

                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/reportes/reportes_compras.php');">Reportes compras materiales</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/reportes/reportes_compras_insumos.php');">Reportes compras insumos</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/reportes/reportes_venta_racimos.php');">Reportes ventas racimos</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/reportes/reportes_venta_rechazos.php');">Reportes ventas rechazos</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/reportes/reporte_plagas.php');">Reportes plagas</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/reportes/reporte_tratamientos.php');">Reportes de tratamientos</a>
                            </li>
                            <li>
                                <a style="color: white;" onclick="cargar_contenido('contenido_principal','vista/reportes/reporte_rol_pagos.php');">Reportes rol de pagos</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>

        <div class="content-wrapper" id="contenido_principal">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-success color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong" id="numer_trabajadores"></h2>
                                <div class="m-b-5">Trabajadores</div><i class="ti-user widget-stat-icon"></i>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-info color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong" id="total_material"></h2>
                                <div class="m-b-5">Materiales</div><i class="ti-notepad widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-warning color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong" id="total_insumos"></h2>
                                <div class="m-b-5">Insumos</div><i class="ti-bag widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-danger color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong" id="total_prod_iniciados"></h2>
                                <div class="m-b-5">Producciones iniciadas</div><i class="ti-map widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Top 5 materiales mas comprados para uso de la bananera</div>
                            </div>
                            <div class="ibox-body">
                                <div class="chart_trata">
                                    <canvas id="areaChart_1"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Top 5 insumos mas comprados para uso de la bananera</div>
                            </div>
                            <div class="ibox-body">
                                <div class="chart_trata_2">
                                    <canvas id="areaChart_2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">
                                    Grafico compra de material
                                </div>

                            </div>
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-3">
                                        Fecha inicio
                                        <input type="date" class="form-control" id="fecha_compra_material_ini"><br>
                                    </div>
                                    <div class="col-lg-5 col-md-3">
                                        Fecha fin
                                        <input type="date" class="form-control" id="fecha_compra_material_fin"><br>
                                    </div>
                                    <div class="col-lg-1 col-md-3">
                                        ver
                                        <button type="button" onclick="ver_grafica_compra_material();" class="btn btn-danger"><i class="fa fa-eye"></i> Ver</button>
                                    </div>

                                </div>
                                <div class="chart_compra_material_3">
                                    <canvas id="areaChart_3"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">
                                    Grafico compra de insumo
                                </div>

                            </div>
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-3">
                                        Fecha inicio
                                        <input type="date" class="form-control" id="fecha_compra_insumo_ini"><br>
                                    </div>
                                    <div class="col-lg-5 col-md-3">
                                        Fecha fin
                                        <input type="date" class="form-control" id="fecha_compra_insumo_fin"><br>
                                    </div>
                                    <div class="col-lg-1 col-md-3">
                                        ver
                                        <button type="button" onclick="ver_grafica_compra_insumo();" class="btn btn-danger"><i class="fa fa-eye"></i> Ver</button>
                                    </div>

                                </div>
                                <div class="chart_compra_insumo_4">
                                    <canvas id="areaChart_4"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">
                                    Grafico venta de cajas
                                </div>

                            </div>
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-3">
                                        Fecha inicio
                                        <input type="date" class="form-control" id="fecha_venta_racimos_ini"><br>
                                    </div>
                                    <div class="col-lg-5 col-md-3">
                                        Fecha fin
                                        <input type="date" class="form-control" id="fecha_venta_racimos_fin"><br>
                                    </div>
                                    <div class="col-lg-1 col-md-3">
                                        ver
                                        <button type="button" onclick="ver_grafica_venta_racimos();" class="btn btn-danger"><i class="fa fa-eye"></i> Ver</button>
                                    </div>

                                </div>
                                <div class="chart_venta_racimos_5">
                                    <canvas id="areaChart_5"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">
                                    Grafico venta de desechos
                                </div>

                            </div>
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-3">
                                        Fecha inicio
                                        <input type="date" class="form-control" id="fecha_venta_desechos_ini"><br>
                                    </div>
                                    <div class="col-lg-5 col-md-3">
                                        Fecha fin
                                        <input type="date" class="form-control" id="fecha_venta_desechos_fin"><br>
                                    </div>
                                    <div class="col-lg-1 col-md-3">
                                        ver
                                        <button type="button" onclick="ver_grafica_venta_desechos();" class="btn btn-danger"><i class="fa fa-eye"></i> Ver</button>
                                    </div>

                                </div>
                                <div class="chart_venta_desechos_6">
                                    <canvas id="areaChart_6"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">
                                    Grafico de produccion
                                </div>

                            </div>
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-3">
                                        Fecha inicio
                                        <input type="date" class="form-control" id="fecha_produccion_ini"><br>
                                    </div>
                                    <div class="col-lg-5 col-md-3">
                                        Fecha fin
                                        <input type="date" class="form-control" id="fecha_produccion_fin"><br>
                                    </div>
                                    <div class="col-lg-1 col-md-3">
                                        ver
                                        <button type="button" onclick="ver_grafica_produccion();" class="btn btn-danger"><i class="fa fa-eye"></i> Ver</button>
                                    </div>

                                </div>

                                <div class="col-lg-12 col-md-3">
                                    <div class="chart_produccion_7">
                                        <canvas id="areaChart_7"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>



                </div>

            </div>

        </div>

        <footer class="page-footer">
            <div class="font-13">2018 © <b>AdminCAST</b> - All rights reserved.</div>
            <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
        </footer>
    </div>
    </div>


    <div class="preloader-backdrop">
        <div class="page-preloader">Cargando</div>
    </div>

    <script src="template/admincast/html/dist/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="template/admincast/html/dist/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="template/admincast/html/dist/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="template/admincast/html/dist/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="template/admincast/html/dist/assets/js/app.min.js" type="text/javascript"></script>

    <script src="plugins/sweetalert2/sweetalert2.all.min.js" type="text/javascript"></script>
    <script src="plugins/DATATABLES/datatables.min.js"></script>
    <script src="plugins/SELECT2/js/select2.min.js"></script>

    <!-- /// esto es para el usuario -->
    <script src="js/usuario.js" type="text/javascript"></script>
    <script src="js/system.js" type="text/javascript"></script>
    <script src="plugins/Chart/chart.min.js" type="text/javascript"></script>
    
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/flatpickr/flatpickr.js"></script>

    <script>
        traer_datos_dasboard_admin();
        elimira_plata_off();

        function elimira_plata_off() {

            var n = new Date();
            var y = n.getFullYear();
            var m = n.getMonth() + 1;
            var d = n.getDate();
            if (d < 10) {
                d = '0' + d;
            }
            if (m < 10) {
                m = '0' + m;
            }

            fech_fin = y + "-" + m + "-" + d;

            var funcion = "trata_fin_plaga";

            $.ajax({
                url: "../ADMIN/controlador/plagas/plagas.php",
                type: "POST",
                data: {
                    funcion: funcion,
                    fech_fin: fech_fin
                },
            }).done(function(response) {
                console.log(response);
            });
        }

        $(document).ready(function() {
            var n = new Date();
            var y = n.getFullYear();
            var m = n.getMonth() + 1;
            var d = n.getDate();
            if (d < 10) {
                d = '0' + d;
            }
            if (m < 10) {
                m = '0' + m;
            }

            document.getElementById("fecha_compra_material_ini").value = y + "-" + m + "-" + d;
            document.getElementById("fecha_compra_material_fin").value = y + "-" + m + "-" + d;

            document.getElementById("fecha_compra_insumo_ini").value = y + "-" + m + "-" + d;
            document.getElementById("fecha_compra_insumo_fin").value = y + "-" + m + "-" + d;

            document.getElementById("fecha_venta_racimos_ini").value = y + "-" + m + "-" + d;
            document.getElementById("fecha_venta_racimos_fin").value = y + "-" + m + "-" + d;

            document.getElementById("fecha_venta_desechos_ini").value = y + "-" + m + "-" + d;
            document.getElementById("fecha_venta_desechos_fin").value = y + "-" + m + "-" + d;

            document.getElementById("fecha_produccion_ini").value = y + "-" + m + "-" + d;
            document.getElementById("fecha_produccion_fin").value = y + "-" + m + "-" + d;

            traer_datos_usuario();
            cargar_grafico_cinco_materiales();
            cargar_grafico_cinco_insumos();
            traer_permiso_usuario();


            ////////////////////
            var hora1 = ("04:29:01").split(":"),
                hora2 = ("02:28:56").split(":"),
                t1 = new Date(),
                t2 = new Date();

            t1.setHours(hora1[0], hora1[1], hora1[2]);
            t2.setHours(hora2[0], hora2[1], hora2[2]);

            //Aquí hago la resta
            t1.setHours(t1.getHours() - t2.getHours(), t1.getMinutes() - t2.getMinutes(), t1.getSeconds() - t2.getSeconds());

            //Imprimo el resultado
            console.log(t1.getHours());
        });

        ////// esto es para la vista y validaciones
        function cargar_contenido(contenedor, contenido) {
            $("#" + contenedor).load(contenido);
        }

        function cargar_grafico_cinco_materiales() {
            var tipo_grafico = 'bar';
            var nombre_grafico = 'Barra'
            funcion = "cinco_tratamintos_materiales"
            $.ajax({
                url: "../ADMIN/controlador/system/system.php",
                type: "POST",
                data: {
                    funcion: funcion
                },
            }).done(function(response) {
                if (response != 0) {
                    var nombre_pr = [];
                    var cantidad = [];
                    var colores = [];
                    var data = JSON.parse(response);
                    for (var i = 0; i < data.length; i++) {
                        nombre_pr.push(data[i][1]);
                        cantidad.push(data[i][2]);
                        colores.push(colores_rgb());
                    }
                    mostrar_graficos_cinco_materiales_(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores);
                } else {
                    $("canvas#areaChart_1").remove();
                }
            });
        }

        function mostrar_graficos_cinco_materiales_(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores) {
            //esto es para desctuir el grafico porque sale un error
            $("canvas#areaChart_1").remove();
            $("div.chart_trata").append('<canvas id="areaChart_1" style="height:50px; !important width:50px; !important"></canvas>');
            ///este es el grafico

            var ctx = document.getElementById('areaChart_1').getContext('2d');
            var myChart = new Chart(ctx, {
                type: tipo_grafico,
                data: {
                    labels: nombre_pr,
                    datasets: [{
                        label: nombre_grafico,
                        data: cantidad,
                        backgroundColor: colores,
                        borderColor: colores,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        ///////////
        function cargar_grafico_cinco_insumos() {
            var tipo_grafico = 'line';
            var nombre_grafico = 'Linea'
            funcion = "cinco_tratamintos_insumos"
            $.ajax({
                url: "../ADMIN/controlador/system/system.php",
                type: "POST",
                data: {
                    funcion: funcion
                },
            }).done(function(response) {
                if (response != 0) {
                    var nombre_pr = [];
                    var cantidad = [];
                    var colores = [];
                    var data = JSON.parse(response);
                    for (var i = 0; i < data.length; i++) {
                        nombre_pr.push(data[i][1]);
                        cantidad.push(data[i][2]);
                        colores.push(colores_rgb());
                    }
                    mostrar_graficos_cinco_insumos_(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores);
                } else {
                    $("canvas#areaChart_2").remove();
                }
            });
        }

        function mostrar_graficos_cinco_insumos_(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores) {
            //esto es para desctuir el grafico porque sale un error
            $("canvas#areaChart_2").remove();
            $("div.chart_trata_2").append('<canvas id="areaChart_2" style="height:50px; !important width:50px; !important"></canvas>');
            ///este es el grafico

            var ctx = document.getElementById('areaChart_2').getContext('2d');
            var myChart = new Chart(ctx, {
                type: tipo_grafico,
                data: {
                    labels: nombre_pr,
                    datasets: [{
                        label: nombre_grafico,
                        data: cantidad,
                        backgroundColor: colores,
                        borderColor: colores,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        //////////grafica compra material
        function ver_grafica_compra_material() {

            var fecha_inicio = $("#fecha_compra_material_ini").val();
            var fecha_fin = $("#fecha_compra_material_fin").val();

            if (fecha_inicio > fecha_fin) {
                return Swal.fire(
                    "Mensaje de advertencia",
                    "La fecha inicio '" +
                    fecha_inicio +
                    "' es mayor a la fecha final '" +
                    fecha_fin +
                    "'",
                    "warning"
                );
            }

            var tipo_grafico = 'bar';
            var nombre_grafico = 'Barra'

            var funcion = "cargar_grafico_compra_material"
            $.ajax({
                url: "../ADMIN/controlador/system/system.php",
                type: "POST",
                data: {
                    funcion: funcion,
                    fecha_inicio: fecha_inicio,
                    fecha_fin: fecha_fin,
                },
            }).done(function(response) {
                if (response != 0) {
                    var nombre_pr = [];
                    var cantidad = [];
                    var colores = [];
                    var data = JSON.parse(response);
                    for (var i = 0; i < data.length; i++) {
                        nombre_pr.push(data[i][4]);
                        cantidad.push(data[i][3]);
                        colores.push(colores_rgb());
                    }
                    mostrar_grafica_compra_material(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores);
                } else {
                    $("canvas#areaChart_3").remove();
                }
            });
        }

        function mostrar_grafica_compra_material(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores) {
            //esto es para desctuir el grafico porque sale un error
            $("canvas#areaChart_3").remove();
            $("div.chart_compra_material_3").append('<canvas id="areaChart_3" style="height:50px; !important width:50px; !important"></canvas>');
            ///este es el grafico

            var ctx = document.getElementById('areaChart_3').getContext('2d');
            var myChart = new Chart(ctx, {
                type: tipo_grafico,
                data: {
                    labels: nombre_pr,
                    datasets: [{
                        label: nombre_grafico,
                        data: cantidad,
                        backgroundColor: colores,
                        borderColor: colores,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        //////////grafica compra material
        function ver_grafica_compra_insumo() {

            var fecha_inicio = $("#fecha_compra_insumo_ini").val();
            var fecha_fin = $("#fecha_compra_insumo_fin").val();

            if (fecha_inicio > fecha_fin) {
                return Swal.fire(
                    "Mensaje de advertencia",
                    "La fecha inicio '" +
                    fecha_inicio +
                    "' es mayor a la fecha final '" +
                    fecha_fin +
                    "'",
                    "warning"
                );
            }

            var tipo_grafico = 'bar';
            var nombre_grafico = 'Barra'

            var funcion = "cargar_grafico_compra_insumo"
            $.ajax({
                url: "../ADMIN/controlador/system/system.php",
                type: "POST",
                data: {
                    funcion: funcion,
                    fecha_inicio: fecha_inicio,
                    fecha_fin: fecha_fin,
                },
            }).done(function(response) {
                if (response != 0) {
                    var nombre_pr = [];
                    var cantidad = [];
                    var colores = [];
                    var data = JSON.parse(response);
                    for (var i = 0; i < data.length; i++) {
                        nombre_pr.push(data[i][3]);
                        cantidad.push(data[i][2]);
                        colores.push(colores_rgb());
                    }
                    mostrar_grafica_compra_insumo(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores);
                } else {
                    $("canvas#areaChart_4").remove();
                }
            });
        }

        function mostrar_grafica_compra_insumo(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores) {
            //esto es para desctuir el grafico porque sale un error
            $("canvas#areaChart_4").remove();
            $("div.chart_compra_insumo_4").append('<canvas id="areaChart_4" style="height:50px; !important width:50px; !important"></canvas>');
            ///este es el grafico

            var ctx = document.getElementById('areaChart_4').getContext('2d');
            var myChart = new Chart(ctx, {
                type: tipo_grafico,
                data: {
                    labels: nombre_pr,
                    datasets: [{
                        label: nombre_grafico,
                        data: cantidad,
                        backgroundColor: colores,
                        borderColor: colores,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        //////////grafica venta racimos
        function ver_grafica_venta_racimos() {

            var fecha_inicio = $("#fecha_venta_racimos_ini").val();
            var fecha_fin = $("#fecha_venta_racimos_fin").val();

            if (fecha_inicio > fecha_fin) {
                return Swal.fire(
                    "Mensaje de advertencia",
                    "La fecha inicio '" +
                    fecha_inicio +
                    "' es mayor a la fecha final '" +
                    fecha_fin +
                    "'",
                    "warning"
                );
            }

            var tipo_grafico = 'doughnut';
            var nombre_grafico = 'Dona'

            var funcion = "cargar_grafico_compra_racimos"
            $.ajax({
                url: "../ADMIN/controlador/system/system.php",
                type: "POST",
                data: {
                    funcion: funcion,
                    fecha_inicio: fecha_inicio,
                    fecha_fin: fecha_fin,
                },
            }).done(function(response) {
                if (response != 0) {
                    var nombre_pr = [];
                    var cantidad = [];
                    var colores = [];
                    var data = JSON.parse(response);
                    for (var i = 0; i < data.length; i++) {
                        nombre_pr.push(data[i][0]);
                        cantidad.push(data[i][1]);
                        colores.push(colores_rgb());
                    }
                    mostrar_grafica_venta_racimos(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores);
                } else {
                    $("canvas#areaChart_5").remove();
                }
            });
        }

        function mostrar_grafica_venta_racimos(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores) {
            //esto es para desctuir el grafico porque sale un error
            $("canvas#areaChart_5").remove();
            $("div.chart_venta_racimos_5").append('<canvas id="areaChart_5" style="height:50px; !important width:50px; !important"></canvas>');
            ///este es el grafico

            var ctx = document.getElementById('areaChart_5').getContext('2d');
            var myChart = new Chart(ctx, {
                type: tipo_grafico,
                data: {
                    labels: nombre_pr,
                    datasets: [{
                        label: nombre_grafico,
                        data: cantidad,
                        backgroundColor: colores,
                        borderColor: colores,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        //////////grafica venta desechos
        function ver_grafica_venta_desechos() {

            var fecha_inicio = $("#fecha_venta_desechos_ini").val();
            var fecha_fin = $("#fecha_venta_desechos_fin").val();

            if (fecha_inicio > fecha_fin) {
                return Swal.fire(
                    "Mensaje de advertencia",
                    "La fecha inicio '" +
                    fecha_inicio +
                    "' es mayor a la fecha final '" +
                    fecha_fin +
                    "'",
                    "warning"
                );
            }

            var tipo_grafico = 'pie';
            var nombre_grafico = 'Pastes'

            var funcion = "cargar_grafico_compra_desechos"
            $.ajax({
                url: "../ADMIN/controlador/system/system.php",
                type: "POST",
                data: {
                    funcion: funcion,
                    fecha_inicio: fecha_inicio,
                    fecha_fin: fecha_fin,
                },
            }).done(function(response) {
                if (response != 0) {
                    var nombre_pr = [];
                    var cantidad = [];
                    var colores = [];
                    var data = JSON.parse(response);
                    for (var i = 0; i < data.length; i++) {
                        nombre_pr.push(data[i][0]);
                        cantidad.push(data[i][1]);
                        colores.push(colores_rgb());
                    }
                    mostrar_grafica_venta_desechos(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores);
                } else {
                    $("canvas#areaChart_6").remove();
                }
            });
        }

        function mostrar_grafica_venta_desechos(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores) {
            //esto es para desctuir el grafico porque sale un error
            $("canvas#areaChart_6").remove();
            $("div.chart_venta_desechos_6").append('<canvas id="areaChart_6" style="height:50px; !important width:50px; !important"></canvas>');
            ///este es el grafico

            var ctx = document.getElementById('areaChart_6').getContext('2d');
            var myChart = new Chart(ctx, {
                type: tipo_grafico,
                data: {
                    labels: nombre_pr,
                    datasets: [{
                        label: nombre_grafico,
                        data: cantidad,
                        backgroundColor: colores,
                        borderColor: colores,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        //////////grafica produccion
        function ver_grafica_produccion() {

            var fecha_inicio = $("#fecha_produccion_ini").val();
            var fecha_fin = $("#fecha_produccion_fin").val();

            if (fecha_inicio > fecha_fin) {
                return Swal.fire(
                    "Mensaje de advertencia",
                    "La fecha inicio '" +
                    fecha_inicio +
                    "' es mayor a la fecha final '" +
                    fecha_fin +
                    "'",
                    "warning"
                );
            }

            var tipo_grafico = 'line';
            var nombre_grafico = 'Linea'

            var funcion = "cargar_grafico_produccion"
            $.ajax({
                url: "../ADMIN/controlador/system/system.php",
                type: "POST",
                data: {
                    funcion: funcion,
                    fecha_inicio: fecha_inicio,
                    fecha_fin: fecha_fin,
                },
            }).done(function(response) {
                if (response != 0) {
                    var nombre_pr = [];
                    var cantidad = [];
                    var colores = [];
                    var data = JSON.parse(response);
                    for (var i = 0; i < data.length; i++) {
                        nombre_pr.push(data[i][3]);
                        cantidad.push(data[i][4]);
                        colores.push(colores_rgb());
                    }
                    mostrar_grafica_produccion(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores);
                } else {
                    $("canvas#areaChart_7").remove();
                }
            });
        }

        function mostrar_grafica_produccion(nombre_pr, cantidad, tipo_grafico, nombre_grafico, colores) {
            //esto es para desctuir el grafico porque sale un error
            $("canvas#areaChart_7").remove();
            $("div.chart_produccion_7").append('<canvas id="areaChart_7" style="height:50px; !important width:50px; !important"></canvas>');
            ///este es el grafico

            var ctx = document.getElementById('areaChart_7').getContext('2d');
            var myChart = new Chart(ctx, {
                type: tipo_grafico,
                data: {
                    labels: nombre_pr,
                    datasets: [{
                        label: nombre_grafico,
                        data: cantidad,
                        backgroundColor: colores,
                        borderColor: colores,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        //////
        /// par los graficos
        function colores_rgb() {
            var coolor = "(" + generar_numero(255) + "," + generar_numero(255) + "," + generar_numero(255) + ")";
            return "rgb" + coolor;
        }

        function generar_numero(numero) {
            return (Math.random() * numero).toFixed(0);
        }




        ////loader
        function mostar_loader_datos(alerta) {
            var texto = null;
            var mostrar = false;

            switch (alerta[0]) {
                case "datos":
                    texto = alerta[1];
                    mostrar = true;
                    break;
            }
            if (mostrar) {
                Swal.fire({
                    title: alerta[2],
                    html: texto,
                    allowOutsideClick: false,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
            }
        }

        function cerrar_loader_datos(alerta) {
            var tipo = null;
            var texto = null;
            var mostrar = false;

            switch (alerta[0]) {
                case "exito":
                    tipo = alerta[1];
                    texto = alerta[2];
                    mostrar = true;
                    break;

                case "existe":
                    tipo = alerta[1];
                    texto = alerta[2];
                    mostrar = true;
                    break;

                case "error":
                    tipo = alerta[1];
                    texto = alerta[2];
                    mostrar = true;
                    break;

                default:
                    swal.close();
                    break;
            }
            if (mostrar) {
                Swal.fire({
                    position: "center",
                    icon: tipo,
                    text: texto,
                    showConfirmButton: true,
                    allowOutsideClick: false,
                });
            }
        }

        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";
            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }
            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return swal.fire(
                    "No se permiten numeros!!",
                    "Solo se permiten letras",
                    "warning"
                );
            }
        }

        function soloNumeros(e) {
            var key = window.event ? e.which : e.keyCode;
            if (key < 48 || key > 57) {
                return swal.fire(
                    "No se permiten letras!!",
                    "Solo se permiten numeros",
                    "warning"
                );
            }
        }

        ////
        //funcion para validar decimales
        function filterfloat(evt, input) {
            var key = window.Event ? evt.which : evt.keyCode;
            var chark = String.fromCharCode(key);
            var tempvalue = input.value + chark;
            if (key >= 48 && key <= 57) {
                if (filter(tempvalue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                if (key == 8 || key == 13 || key == 0) {
                    return false;
                } else if (key === 46) {
                    if (filter(tempvalue) === false) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return swal.fire(
                        "No se permiten letras!!",
                        "Solo se permiten numeros decimales",
                        "warning"
                    );
                }
            }
        }

        function filter(__val__) {
            var preg = /^([0-9]+\.?[0-9]{0,2})$/;
            if (preg.test(__val__) === true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>


<div class="modal fade" id="modal_ediat_contra" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">

                <h4 class="modal-title" style="text-align: center;"><B> DATOS DE USUARIO</B></h4>
            </div>
            <div class="modal-body">

                <div class="ibox-body text-center">

                    <img class="img-circle" id="foto_user_tres" white="100px" height="100px">

                    <h5 class="font-strong m-b-10 m-t-10"><span id="nombre_usuaio_edit"></span></h5>

                    <div>
                        <button class="btn btn-info btn-rounded m-b-5" onclick="cambiar_foto_perfil_user();"><i class="fa fa-plus"></i> Cambiar foto</button>
                        <input type="file" id="foto_perfoil" class="form-control">
                        <input type="text" id="foto_delte" hidden>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label>Nombre</label>
                        <input class="form-control" id="nombre_edit" type="text" placeholder="Ingrese nombre">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>Apellido</label>
                        <input class="form-control" id="apellido_edit" type="text" placeholder="Ingrese apellido">
                    </div>

                    <div class="col-sm-5 form-group">
                        <label>Usuario</label>
                        <input class="form-control" id="usuario_edit" type="text" placeholder="Ingrese usuario">
                    </div>

                    <div class="col-sm-4 form-group">
                        <label>Numero documento</label>
                        <input class="form-control" id="documento_edit" type="text" readonly>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Editar datos</label>
                        <button onclick="editar_usuario_perfil();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Editar datos</button>
                    </div>

                    <div class="col-sm-5 form-group">
                        <label>Password actual</label>
                        <input class="form-control" id="pass_base" type="password" placeholder="Ingrese password actual">
                        <input id="pass_base_oculto" hidden>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label>Nuevo password</label>
                        <input class="form-control" id="pass_edit" type="password" placeholder="Ingrese password nuevo">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label>Editar password</label>
                        <button onclick="editar_contra();" class="btn btn-warning" type="button"><i class="fa fa-edit"></i> Editar password</button>
                    </div>
                </div>

            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            </div>

        </div>
    </div>
</div>