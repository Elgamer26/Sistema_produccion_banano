<script type="text/javascript" src="../ADMIN/js/rol_pagos.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Beneficios del rol de pagos <i class="fa fa-dollar"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de beneficios</div> <button onclick="abrir_modal();" class="btn btn-danger"><i class="fa fa-plus"></i> Nuevo beneficio</button>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_beneficios" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre del beneficio</th>
                                    <th>Valor/porcentaje</th>
                                    <th>Tipo del beneficio</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre del beneficio</th>
                                    <th>Valor/porcentaje</th>
                                    <th>Tipo del beneficio</th>
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
    <div class="modal fade" id="modal_nuevo_beneficio" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo beneficio</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <label for="nombre_beneficio">Nombre beneficio</label>
                            <input type="text" maxlength="150" class="form-control" id="nombre_beneficio" placeholder="Ingrese nombres del beneficio" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-lg-6">
                            <label for="valor_beneficio">Valor</label>
                            <input type="text" maxlength="5" class="form-control" id="valor_beneficio" placeholder="Ingrese porcentaje del beneficio" onkeypress="return filterfloat(event, this);"><br>
                        </div>

                        <div class="col-lg-6">
                            <label for="tipo_beneficio">Tipo beneficio</label>
                            <select id="tipo_beneficio" style="width: 100%" class="tipo_bene form-control">
                                <option value="Ingreso">Ingreso</option>
                                <option value="Egreso">Egreso</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="nuevo_beneficio()"><i class="fa fa-edit"></i> Nuevo</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false">
    <div class="modal fade" id="modal_editar_benificio" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar permiso</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_edit_benefiio"> 

                        <div class="col-lg-12">
                            <label for="nombre_beneficio_edit">Nombre beneficio</label>
                            <input type="text" maxlength="150" class="form-control" id="nombre_beneficio_edit" placeholder="Ingrese nombres del beneficio" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-lg-6">
                            <label for="valor_beneficio_edit">Valor</label>
                            <input type="text" maxlength="5" class="form-control" id="valor_beneficio_edit" placeholder="Ingrese porcentaje del beneficio" onkeypress="return filterfloat(event, this);"><br>
                        </div>

                        <div class="col-lg-6">
                            <label for="tipo_beneficio_edir">Tipo beneficio</label>
                            <select id="tipo_beneficio_edir" style="width: 100%" class="tipo_bene form-control">
                                <option value="Ingreso">Ingreso</option>
                                <option value="Egreso">Egreso</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_beneficio()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(".tipo_bene").select2();
    listra_beneficios();
</script>