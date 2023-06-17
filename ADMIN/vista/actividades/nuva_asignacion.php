<script type="text/javascript" src="js/actividades.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
?>

<br>
<section class="content-header">
    <h3>
        <b> Asignacion de actividades a los trabajadores <i class="fa fa-leaf" style="color:green;"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-warning box-solid">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="ibox ibox-warning">
                    <div class="ibox-head">
                        <div class="ibox-title"> Detalle de actividades</div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-5">
                        <div class="ibox ibox-primary">
                            <div class="ibox-head">
                                <div class="ibox-title">Datos del empleado</div>
                            </div>
                            <div class="ibox-body">
                                <div class="row align-items-center">

                                    <div class="col-sm-12 form-group">
                                        <label>Datos del empleado</label> &nbsp;&nbsp; <label style="color:red;" id="empleado_obliga"></label>
                                        <select class="tipo_aaaa form-control" id="datos_empleado" style="width:100%;">
                                        </select>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_oblig"></label>
                                        <input type="text" readonly class="form-control" id="nombres">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Apellidos</label> &nbsp;&nbsp; <label style="color:red;" id="apellido_obliga"></label>
                                        <input type="text" readonly class="form-control" id="apellidos">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Sexo</label>
                                        <input type="text" readonly class="form-control" id="sexo_e">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Telefono</label>
                                        <input type="text" readonly class="form-control" id="telefono_empleado">
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <div class="ibox-body text-center">
                                            <img class="img-circle" id="foto_empleado" white="100px" height="100px">
                                            <h5 class="font-strong m-b-10 m-t-10"><span>Foto del empleado</span></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-7">
                        <div class="ibox ibox-danger">
                            <div class="ibox-head">
                                <div class="ibox-title">Detalle de actividad</div>
                            </div>
                            <div class="ibox-body">
                                <div class="row align-items-center">

                                    <div class="col-sm-8 form-group">
                                        <label>Tipo de actividad</label> &nbsp;&nbsp; <label style="color:red;" id="tipoo_obliga"></label>
                                        <select class="tipo_a form-control" id="tipo_actividad" style="width:100%;">
                                        </select>
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label>Costo de la actividad</label> &nbsp;&nbsp; <label style="color:red;" id="costo_obliga"></label>
                                        <input type="text" maxlength="6" class="form-control" value="0.00" id="costo_acivdad" onkeypress="return filterfloat(event, this);">
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label>Fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_obliga"></label>
                                        <input type="date" class="form-control" id="fecha_asiga" value="<?php echo $fecha; ?>">
                                    </div>

                                    <div class="col-sm-3 form-group">
                                        &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;
                                        <button id="btb_registrar" class="btn btn-success" onclick="registrar_actividdes();"><i class="fa fa-save"></i> Guardar actividad</button>
                                    </div>

                                    <div class="col-sm-2 form-group">
                                        &nbsp;&nbsp;
                                        <button class="btn btn-danger" onclick="cargar_contenido('contenido_principal','vista/actividades/nuva_asignacion.php');"><i class="fa fa-times"></i> Limpiar</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".tipo_aaaa").select2();
    $(".tipo_a").select2();

    listar_trabajador_ac();
    listar_actividades();

    $("#datos_empleado").change(function() {
        var id = $("#datos_empleado").val();
        traer_datos_emplead(id);
    });
</script>