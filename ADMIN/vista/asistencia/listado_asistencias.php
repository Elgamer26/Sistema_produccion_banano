<script type="text/javascript" src="../ADMIN/js/asistencias.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado de asistencias <i class="fa fa-calendar" style="color:green;"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de asistencias</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_asistencias_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th> 
                                    <th>Estado asistencia</th>
                                    <th>Estado empleado</th>
                                    <th>Empleado</th>
                                    <th>Foto</th>
                                    <th>Entrada marcada</th>
                                    <th>Salida marcada</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th> 
                                    <th>Estado asistencia</th>
                                    <th>Estado empleado</th>
                                    <th>Empleado</th>
                                    <th>Foto</th>
                                    <th>Entrada marcada</th>
                                    <th>Salida marcada</th>
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
    listar_asistencias();
</script>