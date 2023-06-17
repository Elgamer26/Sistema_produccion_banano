<script type="text/javascript" src="js/produccion.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
?>

<br>
<section class="content-header">
    <h3>
        <b> Nueva produccion <i class="fa fa-cubes"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nueva produccion</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <div class="col-sm-7 form-group">
                                <label>Nombre de produccion</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_pro_obliig"></label>
                                <input type="text" class="form-control" id="nombre_produccion" placeholder="Nombre de produccion">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Fecha inicio</label>
                                <input type="date" class="form-control" value="<?php echo $fecha; ?>" id="fecha_inicio">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Fecha fin</label>
                                <input type="date" class="form-control" value="<?php echo $fecha; ?>" id="fecha_fin">
                            </div>

                            <div class="col-sm-1 form-group">
                                <label>Dias </label> &nbsp;&nbsp; <label style="color:red;" id="dias_pbñigg"></label>
                                <input type="text" class="form-control" readonly id="dias_dias">
                            </div>

                            <div class="col-sm-9 form-group">
                                <label>Seleccione lote</label> &nbsp;&nbsp; <label style="color:red;" id="lotes_obligg"></label>
                                <select class="lote_id form-control" id="lote_id" style="width:100%">
                                </select>
                            </div>

                            <div class="col-sm-3 form-group">
                                <label>Seleccione hectarea</label> &nbsp;&nbsp; <label style="color:red;" id="hectrea_olbigg"></label>
                                <select class="hectarea_id form-control" id="hectarea_id" style="width:100%">
                                </select>
                            </div>


                            <div class="col-sm-12 form-group">
                                <div class="ibox">
                                    <div class="ibox-head">
                                        <div class="ibox-title">Detalle de produccion</div>
                                    </div>
                                    <div class="ibox-body">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#pill-1-1" data-toggle="tab">Actividades</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#pill-1-2" data-toggle="tab">Materiales</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#pill-1-3" data-toggle="tab">Insumos</a>
                                            </li>

                                        </ul>

                                        <div class="tab-content">

                                            <div class="tab-pane fade show active" id="pill-1-1">

                                                <div class="row">
                                                    <div class="col-sm-3 form-group">
                                                        <label>Seleccione actividad</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_ac_pbligg"></label>
                                                        <select class="activi_id form-control" id="tipo_actividad" style="width:100%">
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-5 form-group">
                                                        <label>Seleccione empleado</label> &nbsp;&nbsp; <label style="color:red;" id="ctividad_pbligg"></label>
                                                        <select class="empleado_id form-control" id="empleado_id" style="width:100%">
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2 form-group">
                                                        <label>Costo de actividad</label>&nbsp;&nbsp; <label style="color:red;" id="costoo_pbligg"></label>
                                                        <input type="text" class="form-control" id="costo_act" value="0.00" readonly>
                                                    </div>

                                                    <div class="col-sm-1 form-group">
                                                        <label>Horas</label>&nbsp;&nbsp; <label style="color:red;" id="hora_obliggg"></label>
                                                        <input type="text" class="form-control" id="horas">
                                                    </div>

                                                    <div class="col-sm-1 form-group">
                                                        <label>Agregar</label>
                                                        <button onclick="ingresar_detalle_actividad();" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                                    </div>

                                                    <table id="tabla_detalle_atividad" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                        <thead bgcolor="purple" style="color:#fff;">
                                                            <tr>
                                                                <th style="width: 20px;">#</th>
                                                                <th>Empleado</th>
                                                                <th>Actividad</th>
                                                                <th>Costo</th>
                                                                <th>Hora</th>
                                                                <th>Costo por hora</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tbody_detalle_atividad">

                                                        </tbody>

                                                        <tfoot bgcolor="purple" style="color:#fff;">
                                                            <tr>
                                                                <th style="width: 20px;">#</th>
                                                                <th>Empleado</th>
                                                                <th>Actividad</th>
                                                                <th>Costo</th>
                                                                <th>Hora</th>
                                                                <th>Costo por hora</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>

                                                </div>

                                            </div>

                                            <div class="tab-pane" id="pill-1-2">

                                                <div class="row">

                                                    <div class="col-sm-5 form-group">
                                                        <label>Seleccione material</label> &nbsp;&nbsp; <label style="color:red;" id="material_pbligg"></label>
                                                        <select class="material_id form-control" id="material_id" style="width:100%">
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2 form-group">
                                                        <label>Costo de material</label>&nbsp;&nbsp; <label style="color:red;" id="cos_mterial_pbligg"></label>
                                                        <input type="text" class="form-control" id="costo_materila" value="0.00" readonly>
                                                    </div>

                                                    <div class="col-sm-2 form-group">
                                                        <label>Disponible</label>&nbsp;&nbsp; <label style="color:red;" id="dispni_obligg"></label>
                                                        <input type="text" class="form-control" id="disponibe_material" readonly>
                                                    </div>

                                                    <div class="col-sm-2 form-group">
                                                        <label>Cantidad</label>&nbsp;&nbsp; <label style="color:red;" id="canti_ma_pbligg"></label>
                                                        <input type="text" maxlength="3" onkeypress="return soloNumeros(event)" class="form-control" id="canti_materal" value="0">
                                                    </div>

                                                    <div class="col-sm-1 form-group">
                                                        <label>Agregar</label>
                                                        <button onclick="ingresar_detalle_material();" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                                    </div>

                                                    <table id="tabla_detalle_material" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                        <thead bgcolor="purple" style="color:#fff;">
                                                            <tr>
                                                                <th style="width: 20px;">#</th>
                                                                <th>Material</th>
                                                                <th>Costo</th>
                                                                <th>Cantidad</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tbody_detalle_material">

                                                        </tbody>

                                                        <tfoot bgcolor="purple" style="color:#fff;">
                                                            <tr>
                                                                <th style="width: 20px;">#</th>
                                                                <th>Material</th>
                                                                <th>Costo</th>
                                                                <th>Cantidad</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>

                                                </div>

                                            </div>

                                            <div class="tab-pane" id="pill-1-3">

                                                <div class="row">

                                                    <div class="col-sm-5 form-group">
                                                        <label>Seleccione insumo</label> &nbsp;&nbsp; <label style="color:red;" id="insumo_pbligg"></label>
                                                        <select class="insumo_id form-control" id="insumo_id" style="width:100%">
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-2 form-group">
                                                        <label>Costo</label>
                                                        <input type="text" class="form-control" id="costo_insumo" value="0.00" readonly>
                                                    </div>

                                                    <div class="col-sm-2 form-group">
                                                        <label>Cant. medida</label>
                                                        <input type="text" class="form-control" id="canti_medida" readonly>
                                                    </div>

                                                    <div class="col-sm-3 form-group">
                                                        <label>Medida</label>
                                                        <input type="text" class="form-control" id="medida_insumo" readonly>
                                                    </div>

                                                    <div class="col-sm-2 form-group">
                                                        <label>Disponible</label>&nbsp;&nbsp; <label style="color:red;" id="dispni_insumo_obligg"></label>
                                                        <input type="text" class="form-control" id="disponibe_insumo" readonly>
                                                    </div>

                                                    <div class="col-sm-2 form-group">
                                                        <label>Cantidad</label>&nbsp;&nbsp; <label style="color:red;" id="canti_insumo_pbligg"></label>
                                                        <input type="text" maxlength="3" onkeypress="return soloNumeros(event)" class="form-control" id="canti_insumo" value="0">
                                                    </div>

                                                    <div class="col-sm-1 form-group">
                                                        <label>Agregar</label>
                                                        <button onclick="ingresar_detalle_insumo();" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                                    </div>

                                                    <table id="tabla_detalle_insumo" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                        <thead bgcolor="purple" style="color:#fff;">
                                                            <tr>
                                                                <th style="width: 20px;">#</th>
                                                                <th>Insumo</th>
                                                                <th>Costo</th>
                                                                <th>Cant. Medida</th>
                                                                <th>Medida</th>
                                                                <th>Cantidad</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody id="tbody_detalle_insumo">

                                                        </tbody>

                                                        <tfoot bgcolor="purple" style="color:#fff;">
                                                            <tr>
                                                                <th style="width: 20px;">#</th>
                                                                <th>Insumo</th>
                                                                <th>Costo</th>
                                                                <th>Cant. Medida</th>
                                                                <th>Medida</th>
                                                                <th>Cantidad</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-12 form-group">
                                <button onclick="guardar_produccion();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Guardar produccion</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/produccion/nueva_produccion.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>

                            <br>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
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

    fecha_date = y + "-" + m + "-" + d;

    $(".lote_id").select2();
    $(".hectarea_id").select2();
    $(".activi_id").select2();
    $(".empleado_id").select2();

    $(".material_id").select2();
    $(".insumo_id").select2();

    listar_lotes_select();
    listar_tipo_ctividad();
    listar_material();
    listar_insumos();

    $("#tipo_actividad").change(function() {
        var id = $("#tipo_actividad").val();
        listar_empleado(parseInt(id));
    });

    $("#lote_id").change(function() {
        var id = $("#lote_id").val();
            listar_hectarea(id);
    });

    $("#empleado_id").change(function() {
        var id = $("#empleado_id").val();
        costro_actividad(parseInt(id));
    });

    $("#material_id").change(function() {
        var id = $("#material_id").val();
        dato_material(parseInt(id));
    });

    $("#insumo_id").change(function() {
        var id = $("#insumo_id").val();
        dato_insumos(parseInt(id));
    });

    $("#fecha_inicio").change(function() {
        var fecha_inicio = $("#fecha_inicio").val();
        var fecha_fin = $("#fecha_fin").val();

        if (fecha_inicio < fecha_date) {
            $("#fecha_inicio").val(fecha_date);
            return Swal.fire(
                "Mensaje de advertencia",
                "La fecha inicio '" +
                fecha_inicio +
                "', es mejor a la fecha actual '" + fecha_date + "'",
                "warning"
            );
        }

        if (fecha_inicio > fecha_fin) {
            $("#dias_dias").val("");
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

        monent(fecha_inicio, fecha_fin);
    });

    $("#fecha_fin").change(function() {
        var fecha_inicio = $("#fecha_inicio").val();
        var fecha_fin = $("#fecha_fin").val();

        if (fecha_inicio > fecha_fin) {
            $("#dias_dias").val("");
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

        monent(fecha_inicio, fecha_fin);
    });

    // Función para calcular los días transcurridos entre dos fechas
    function monent(fecha_inicio, fecha_fin) {
        var fecha1 = moment(fecha_inicio);
        var fecha2 = moment(fecha_fin);
        $("#dias_dias").val(fecha2.diff(fecha1, 'days') + 1);

        var dia = $("#dias_dias").val();

        if (dia > 180) {
            $("#dias_dias").val("");
            return Swal.fire(
                "Mensaje de advertencia",
                "Los dias ingresados superan la produccion de 180 dias, una produccion tiene aproximadamente 180 dias",
                "warning"
            );
        }
    }
</script>