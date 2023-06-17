<script type="text/javascript" src="../ADMIN/js/tipo_actividad.js"></script>
<br>
<section class="content-header">
    <h3>
        <b> Tipos de actividad <i class="fa fa-leaf"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de actividad</div> <button class="btn btn-danger" onclick="modal_tipo_actividad();"> Nuevo tipo de actividad</button>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_tipo_actividad_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Tipo de actividad</th>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Tipo de actividad</th>
                                    <th>Descripcion</th>
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
    <div class="modal fade" id="modal_nuva_actividad" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Tipo de actividad</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <label for="tipo_actividad">Tipo de actividad</label>
                            <input type="text" maxlength="25" class="form-control" id="tipo_actividad" placeholder="Ingrese tipo de actividad" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" id="descripcion" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="nueva_actividad()"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false">
    <div class="modal fade" id="modal_edit_tipo_actividad" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar tipo actividad</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_tipo_actividad_edit">

                        <div class="col-lg-12">
                            <label for="tipo_actividad_edit">Tipo de actividad</label>
                            <input type="text" maxlength="25" class="form-control" id="tipo_actividad_edit" placeholder="Ingrese tipo de actividad" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="descripcion_edit">Descripcion</label>
                            <textarea class="form-control" id="descripcion_edit" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_tipo_actividad()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_tipo_actividads();
</script>