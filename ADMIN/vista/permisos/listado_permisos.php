<script type="text/javascript" src="../ADMIN/js/permiso.js"></script>
<br>
<section class="content-header">
    <h3>
        <b> Listado de permisos <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de permisos</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_permisos_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Empleado</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th>Tipo permiso</th>
                                    <th>Observacion</th>
                                    <th>Fecha registro</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Empleado</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th>Tipo permiso</th>
                                    <th>Observacion</th>
                                    <th>Fecha registro</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    listar_permisos_empleado();
</script>