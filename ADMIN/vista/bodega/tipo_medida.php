<script type="text/javascript" src="../ADMIN/js/bodega.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado medida <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista medida</div> <botton onclick="nueva_medida();" class="btn btn-danger"> Nueva medida</botton>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_medida_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                    <th>Simbolo</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                    <th>Simbolo</th>

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
    <div class="modal fade" id="modal_nuva_medida" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-save"></i> Nuevo medida</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <label>Tipo de insumo</label>
                            <input type="text" maxlength="50" class="form-control" id="nombre_medida" placeholder="Ingrese nombre medida">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Simbolo medida</label>
                            <input type="text" maxlength="7" class="form-control" id="simbolo_medida" placeholder="Ingrese simbolo medida">
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="nueva_medida_registrar()"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false">
    <div class="modal fade" id="modal_editar_medida" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Ediatr medida</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                    <input type="text" hidden id="id_medida">

                        <div class="col-sm-6 form-group">
                            <label>Tipo de insumo</label>
                            <input type="text" maxlength="50" class="form-control" id="nombre_medida_edit" placeholder="Ingrese nombre medida">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Simbolo medida</label>
                            <input type="text" maxlength="7" class="form-control" id="simbolo_medida_edit" placeholder="Ingrese simbolo medida">
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_medida()"><i class="fa fa-save"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>



<script>
listar_medida_();
</script>