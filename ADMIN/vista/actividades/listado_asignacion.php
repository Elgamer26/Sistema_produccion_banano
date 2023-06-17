<script type="text/javascript" src="../ADMIN/js/actividades.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado de asignaciones de actividades <i class="fa fa-users"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de asignaciones de actividades</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_actividades_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado activdad</th>
                                    <th>Estado empleado</th>
                                    <th>Empleado</th>
                                    <th>Estado produccion</th>
                                    <th>Tipo actividad</th>
                                    <th>Costo actividad</th>
                                    <th>Fecha asignacion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado activdad</th>
                                    <th>Estado empleado</th>
                                    <th>Empleado</th>
                                    <th>Estado produccion</th>
                                    <th>Tipo actividad</th>
                                    <th>Costo actividad</th>
                                    <th>Fecha asignacion</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form autocomplete="false">
    <div class="modal fade" id="modal_editar_actividafd" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar asignacion de actividad</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_acitivdad_asig">

                        <div class="col-sm-8 form-group">
                            <label>Tipo de actividad</label> &nbsp;&nbsp; <label style="color:red;" id="tipoo_obliga"></label>
                            <select class="tipo_a form-control" id="tipo_actividad" style="width:100%;">
                            </select>
                        </div>

                        <div class="col-sm-4 form-group">
                            <label>Costo de la actividad</label> &nbsp;&nbsp; <label style="color:red;" id="costo_obliga"></label>
                            <input type="text" maxlength="6" class="form-control" value="0.00" id="costo_acivdad" onkeypress="return filterfloat(event, this);">
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_actividad()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(".tipo_a").select2();
    listar_actividades();

    listar_asignacion_actividad();
</script>