<script type="text/javascript" src="js/empleado.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Hoja de vida empleado <i class="fa fa-file"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Hoja de vida empleado</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <input hidden type="text" id="id_empleado">

                            <div class="col-sm-2 form-group">
                                <label>Ingrese la cedula</label> &nbsp;&nbsp; <label style="color:red;" id="cedula_oblig"></label>
                                <input type="text" maxlength="10" class="form-control" id="cedula_busqueda" placeholder="Ingrese cedula" onkeypress="return soloNumeros(event)">
                            </div>


                            <div class="col-sm-2 form-group">
                                <label>Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_oblig"></label>
                                <input readonly type="text" maxlength="40" class="form-control" id="nombres">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Apellidos</label>
                                <input readonly type="text" maxlength="40" class="form-control" id="apellidos">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Sexo</label>
                                <input readonly type="text" class="form-control" id="sexo_em">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Fecha nacimiento</label>
                                <input readonly type="text" class="form-control" id="fecha_nac">
                            </div>

                            <div class="col-sm-2 form-group">
                                <div class="ibox-body text-center">
                                    <img class="img-circle" id="foto_empleado" white="100px" height="100px">
                                    <h5 class="font-strong m-b-10 m-t-10"><span>Foto del empleado</span></h5>
                                </div>
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Primaria</label> &nbsp;&nbsp; <label style="color:red;" id="primaria_oblig"></label>
                                <input type="text" placeholder="Ingrese nivel estudio" maxlength="50" class="form-control" id="primaria_estudio">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Secundaria</label> &nbsp;&nbsp; <label style="color:red;" id="secundaria_oblig"></label>
                                <input type="text" placeholder="Ingrese nivel estudio" maxlength="50" class="form-control" id="secundaria_estudio">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Superior</label>&nbsp;&nbsp; <label style="color:red;" id="superior_oblig"></label>
                                <input type="text" placeholder="Ingrese nivel estudio" maxlength="50" class="form-control" id="superior_estudio">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Cursos realizados</label> &nbsp;&nbsp; <label style="color:red;" id="cursos_oblig"></label>
                                <input type="text" maxlength="200" class="form-control" id="cursos_relizados" placeholder="Ingrese cursos realizados">
                            </div>

                            <div class="col-sm-3 form-group">
                                <label>Tiene licencia de conducir</label>
                                <select class="form-control" id="licencia_conducir">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Tipo de licencia</label>
                                <input type="text" maxlength="10" class="form-control" id="tipo_licencia" placeholder="Ingrese tipo licencia" maxlength="20">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Ultimo lugar de trabajo</label> &nbsp;&nbsp; <label style="color:red;" id="ultimo_trabajo_oblig"></label>
                                <input type="text" maxlength="100" class="form-control" placeholder="Ultimo lugar de trabajo" id="ultimo_trabajo">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Experiencia laboral</label> &nbsp;&nbsp; <label style="color:red;" id="expe_laboral_oblig"></label>
                                <textarea class="form-control" rows="3" id="expe_laboral"></textarea>
                            </div>

                            <br>

                            <div class="col-sm-12 form-group">
                                <button onclick="guardar_hoja();" class="btn btn-primary" type="button"><i class="fa fa-save"></i> Guardar hoja vida</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/empreado/crear_hoja_vida.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $("#cedula_busqueda").keyup(function() {
        var valor = this.value;
        var funcion = "traer_datos_empleado";

        $.ajax({
            url: "../ADMIN/controlador/empleado/empleado.php",
            type: "POST",
            data: {
                funcion: funcion,
                valor: valor
            },
        }).done(function(resp) {
            if (resp != 0) {
                var data = JSON.parse(resp);
                $("#id_empleado").val(data[0][0]);
                $("#nombres").val(data[0][1]);
                $("#apellidos").val(data[0][2]);
                $("#sexo_em").val(data[0][8]);
                $("#fecha_nac").val(data[0][3]);
                $("#foto_empleado").attr("src", data[0][9]);
            } else {
                $("#id_empleado").val("");
                $("#nombres").val("");
                $("#apellidos").val("");
                $("#sexo_em").val("");
                $("#fecha_nac").val("");
                $("#foto_empleado").attr("src", "img/empleado/empleado.jpg");
            }
        });

    });
</script>