<script type="text/javascript" src="js/empleado.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Contrato laboral <i class="fa fa-user"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Contrato laboral</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <div class="col-sm-12 form-group">
                                <label>Hoja de empleado</label> &nbsp;&nbsp; <label style="color:red;" id="emplego_obligggq"></label>
                                <select class="hoja_vida form-control" style="width: 100%" id="empleado_hoja"></select>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Apellidos</label> &nbsp;&nbsp; <label style="color:red;" id="apellido_obliga"></label>
                                <input type="text" maxlength="40" class="form-control" id="apellidos" placeholder="Ingrese apellidos" onkeypress="return soloLetras(event)">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Fecha nacimiento</label> &nbsp;&nbsp; <label style="color:red;" id="fecah_obliga"></label>
                                <input type="date" class="form-control" id="fecha_nacimiento">
                            </div>



                            <br>

                            <div class="col-sm-12 form-group">
                                <button onclick="guardar_empledo();" class="btn btn-primary" type="button"><i class="fa fa-save"></i> Guardar empleado</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/empreado/nuevo_empreado.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(".hoja_vida").select2();

    listar_hoja_empleado();

</script>