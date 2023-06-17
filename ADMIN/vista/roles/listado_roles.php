<script type="text/javascript" src="../ADMIN/js/rol.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado de roles <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de roles</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_roles_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<form autocomplete="false" id="frm_edit_rol">
    <div class="modal fade" id="modal_edit_rol" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar rol</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_rol_edit">

                        <div class="col-lg-12">
                            <label for="edit_nombre_rol">Nombre rol</label>
                            <input type="text" class="form-control" id="edit_nombre_rol" placeholder="Ingrese nombres del empleado" onkeypress="return soloLetras(event)"><br>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_rol()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false" id="frm_edit_permiso">
    <div class="modal fade" id="modal_edit_rol_permiso" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar permiso</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_rol_permiso">
                        <input hidden type="text" id="id_permiso">

                        <div class="col-sm-2 form-group">
                            <label for='configuraciones_edit'>Configuraciones</label><br>
                            <input type='checkbox' id='configuraciones_edit'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='respaldos'>Respaldos</label><br>
                            <input type='checkbox' id='respaldos'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='empleados'>Empleados</label><br>
                            <input type='checkbox' id='empleados'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='multas'>Multas</label><br>
                            <input type='checkbox' id='multas'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='asistecias'>Asistencias</label><br>
                            <input type='checkbox' id='asistecias'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='permisos'>Permisos</label><br>
                            <input type='checkbox' id='permisos'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='rol_pagos'>Rol de pagos</label><br>
                            <input type='checkbox' id='rol_pagos'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='bodega'>Bodega</label><br>
                            <input type='checkbox' id='bodega'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='compras'>Compras</label><br>
                            <input type='checkbox' id='compras'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='produccion'>Produccion</label><br>
                            <input type='checkbox' id='produccion'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='ventas'>Ventas</label><br>
                            <input type='checkbox' id='ventas'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='control_plagas'>Control plagas</label><br>
                            <input type='checkbox' id='control_plagas'><br>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for='reportes'>Reportes</label><br>
                            <input type='checkbox' id='reportes'><br>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_permiso()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_roles();
</script>