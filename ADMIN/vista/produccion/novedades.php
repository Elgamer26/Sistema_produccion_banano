<script type="text/javascript" src="../ADMIN/js/novedades.js"></script>
<br>
<section class="content-header">
    <h3>
        <b> Novedades <i class="fa fa-dollar"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de novedades</div> <button class="btn btn-danger" onclick="modal_tipo_novedades();"> Nueva novedad</button>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_tipo_novedades_" class="display responsive nowrap" style="width:100%">
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
    <div class="modal fade" id="modal_nuva_novedades" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nueva novedad</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <label for="tipo_novedades">Nombre de noovedad</label>
                            <input type="text" maxlength="60" class="form-control" id="tipo_novedades" placeholder="Ingrese novedades" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" id="descripcion" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="nueva_novedades()"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false">
    <div class="modal fade" id="modal_edit_tipo_novedades" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar tipo novedades</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_tipo_novedades_edit">

                        <div class="col-lg-12">
                            <label for="tipo_novedades_edit">Tipo de novedades</label>
                            <input type="text" maxlength="25" class="form-control" id="tipo_novedades_edit" placeholder="Ingrese tipo de novedades" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="descripcion_edit">Descripcion</label>
                            <textarea class="form-control" id="descripcion_edit" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_tipo_novedades()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_novedad();
</script>