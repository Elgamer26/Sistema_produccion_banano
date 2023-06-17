<script type="text/javascript" src="../ADMIN/js/tipo_plagas.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado tipos de quimico <i class="fa fa-leaf"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista tipos de quimico</div> <button class="btn btn-danger" onclick="nuevo_tipo_quimico();">Nuevo tipo de quimico</button>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_tipo_quimico" class="display responsive nowrap" style="width:100%">
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
    <div class="modal fade" id="modal_nuevo_tipo_quimico" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo tipo de quimico</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <label for="tipo_quimico">Tipo quimico</label>
                            <input type="text" maxlength="50" class="form-control" id="tipo_quimico" placeholder="Ingrese tipo quimico"><br>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="descripcion">Descripcion</label> &nbsp;&nbsp; <label style="color:red;" id="obsrvacion_obliga"></label>
                            <textarea class="form-control" id="descripcion" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="mueva_tipo_quimico()"><i class="fa fa-save"></i> Nuevo</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false">
    <div class="modal fade" id="modal_eitra_tipo_quimico" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar tipo quimico</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_edit_tipo_quimico">

                        <div class="col-lg-12">
                            <label for="tipo_quimico_edit">Tipo quimico</label>
                            <input type="text" maxlength="50" class="form-control" id="tipo_quimico_edit" placeholder="Ingrese tipo quimico"><br>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="descripcion_edit">Descripcion</label> &nbsp;&nbsp; <label style="color:red;" id="obsrvacion_obliga"></label>
                            <textarea class="form-control" id="descripcion_edit" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_tipo_quimico()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_tipo_quimico();
</script>