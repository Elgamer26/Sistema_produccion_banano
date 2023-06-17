<script type="text/javascript" src="../ADMIN/js/sancion.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Tipos de sanciones <i class="fa fa-warning"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de sanciones</div> <button class="btn btn-danger" onclick="modal_tipo_sncion();"> Nuevo tipo de sancion</button>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_tipo_sancion_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Tipo de sancion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Tipo de sancion</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<form autocomplete="false" id="frm_nueva_sanciones">
    <div class="modal fade" id="modal_nuva_sancion" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Tipo de sancion</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <label for="tipo_sancion">Tipo de sancion</label>
                            <input type="text" maxlength="25" class="form-control" id="tipo_sancion" placeholder="Ingrese tipo de sancion" onkeypress="return soloLetras(event)"><br>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="nueva_sancion()"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false" id="frm_edit_tipo_sancion">
    <div class="modal fade" id="modal_edit_tipo_sancion" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar tipo sancion</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_tipo_sancion">
                        
                        <div class="col-lg-12">
                            <label for="tipo_sancion_edit">Tipo de sancion</label>
                            <input type="text" maxlength="25" class="form-control" id="tipo_sancion_edit" placeholder="Ingrese tipo de sancion" onkeypress="return soloLetras(event)"><br>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_tipo_sancion()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_sancion();
</script>