<script type="text/javascript" src="../ADMIN/js/tipo_plagas.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado tipos de tratamiento <i class="fa fa-leaf"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista tipos de tratamiento</div> <button class="btn btn-danger" onclick="nuevo_tipo_tratamiento();">Nuevo tio de tratamiento</button>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_tipo_tratamientos" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
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
    <div class="modal fade" id="modal_nuevo_tipo_tratamiento" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo tipo de tratamiento</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <label for="tipo_tratamiento">Tipo tratamiento</label>
                            <input type="text" maxlength="50" class="form-control" id="tipo_tratamiento" placeholder="Ingrese ntipo tratamiento" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="descripcion_trat">Descripcion</label> &nbsp;&nbsp; <label style="color:red;" id="obsrvacion_obliga"></label>
                            <textarea class="form-control" id="descripcion_trat" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="mueva_tipo_tratamiento()"><i class="fa fa-save"></i> Nuevo</button>
                </div>
            </div>
        </div>
    </div>
</form>


<form autocomplete="false">
    <div class="modal fade" id="modal_eitra_tipo_tratamiento" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar tipo tratamiento</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_tipo_trata">

                        <div class="col-lg-12">
                            <label for="tipo_tar_edit">Tipo tratamiento</label>
                            <input type="text" maxlength="50" class="form-control" id="tipo_tar_edit" placeholder="Ingrese ntipo tratamiento" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="descripcion_edit_trata">Descripcion</label>
                            <textarea class="form-control" id="descripcion_edit_trata" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_tipo_tratamiento()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_tipo_tratamiento();
</script>