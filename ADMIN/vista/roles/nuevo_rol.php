<script type="text/javascript" src="js/rol.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Nuevo rol de usuario <i class="fa fa-registered"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo rol</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label>Tipo de rol</label>
                                <input type="text" class="form-control" id="tipo_rol_" placeholder="Ingrese tipo de rol" onkeypress="return soloLetras(event)">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Estado</label>
                                <select class="form-control" id="estado_rol">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label for='configuraciones'>Configuraciones</label><br>
                                <input type='checkbox' id='configuraciones'><br>
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

                            <div class="col-sm-12 form-group">
                                <button onclick="registrar_rol();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Guardar rol</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/roles/nuevo_rol.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>