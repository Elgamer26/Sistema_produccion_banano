<script type="text/javascript" src="../ADMIN/js/empresa.js"></script>
<br>
<section class="content-header">
    <h3>
        <b> Listado de respaldos <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de roles</div> <button class="btn btn-danger" onclick="ver_modal_respaldo();"><i class="fa fa-plus"></i> Respaldo</button>
                    </div>
                    <div class="ibox-body">

                        <table id="tbla_respaldp" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Usuario</th>
                                    <th>Hora y fecha</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Usuario</th>
                                    <th>Hora y fecha</th>
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
    <div class="modal fade" id="model_respando_datos" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Realizar respaldo de datos</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <label for="ingres_pass">Ingrese password</label>
                            <input type="password" class="form-control" id="ingres_pass" placeholder="Ingrese el password"><br>
                        </div>

                        <div class="col-lg-12">
                            <label for="conf_pass">confirme password</label>
                            <input type="password" class="form-control" id="conf_pass" placeholder="Confirme el password"><br>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="realizar_respaldo()"><i class="fa fa-save"></i> Realizar respaldo</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_respaldo();
</script>