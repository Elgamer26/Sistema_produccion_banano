<script type="text/javascript" src="../ADMIN/js/tipo_permiso.js"></script>
<br>
<section class="content-header">
    <h3>
        <b> Tipos de permisos <i class="fa fa-warning"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de permisos</div> <button class="btn btn-danger" onclick="modal_tipo_permiso();"> Nuevo tipo de permiso</button>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_tipo_permiso_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Tipo de permiso</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Tipo de permiso</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<form autocomplete="false" id="frm_nueva_permisos">
    <div class="modal fade" id="modal_nuva_permiso" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Tipo de permiso</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <label for="tipo_permiso">Tipo de permiso</label>
                            <input type="text" maxlength="25" class="form-control" id="tipo_permiso" placeholder="Ingrese tipo de permiso" onkeypress="return soloLetras(event)"><br>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="nueva_permiso()"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false" id="frm_edit_tipo_permiso">
    <div class="modal fade" id="modal_edit_tipo_permiso" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar tipo permiso</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_tipo_permiso">
                        
                        <div class="col-lg-12">
                            <label for="tipo_permiso_edit">Tipo de permiso</label>
                            <input type="text" maxlength="25" class="form-control" id="tipo_permiso_edit" placeholder="Ingrese tipo de permiso" onkeypress="return soloLetras(event)"><br>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_tipo_permiso()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
   listar_tipo_permisos();
</script>