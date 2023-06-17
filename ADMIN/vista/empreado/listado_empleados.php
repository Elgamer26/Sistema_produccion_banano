<script type="text/javascript" src="../ADMIN/js/empleado.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado de empleados <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de empleados</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_empleados_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Hoja de vida</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Sexo</th>
                                    <th>Foto</th>
                                    <th>Fecha nacimiento</th>
                                    <th>Cedula</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Hoja de vida</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Sexo</th>
                                    <th>Foto</th>
                                    <th>Fecha nacimiento</th>
                                    <th>Cedula</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar_empleado" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar empleado</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_empleado_edit">

                        <div class="col-sm-6 form-group">
                            <label>Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_oblig"></label>
                            <input type="text" maxlength="40" class="form-control" id="nombres" placeholder="Ingrese nombres" onkeypress="return soloLetras(event)">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Apellidos</label> &nbsp;&nbsp; <label style="color:red;" id="apellido_obliga"></label>
                            <input type="text" maxlength="40" class="form-control" id="apellidos" placeholder="Ingrese apellidos" onkeypress="return soloLetras(event)">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Fecha nacimiento</label> &nbsp;&nbsp; <label style="color:red;" id="fecah_obliga"></label>
                            <input type="date" class="form-control" id="fecha_nacimiento">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Cedula</label> &nbsp;&nbsp; <label style="color:red;" id="dcoumento_obliga"></label>
                            <input type="text" maxlength="10" class="form-control" id="numero_docu" placeholder="Ingrese numero de cedula" onkeypress="return soloNumeros(event)">
                            <label for="" id="cedula_empleado" style="color: red; font-size: 12px;"></label>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Direccion</label> &nbsp;&nbsp; <label style="color:red;" id="direccion_obliga"></label>
                            <input type="text" maxlength="40" class="form-control" id="direccions" placeholder="Ingrese direccions">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Telefono</label> &nbsp;&nbsp; <label style="color:red;" id="telefono_obliga"></label>
                            <input type="text" maxlength="15" class="form-control" id="telefono_empleado" placeholder="Ingrese telefono" onkeypress="return soloNumeros(event)">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Correo</label> &nbsp;&nbsp; <label style="color:red;" id="correo_obliga"></label>
                            <input type="text" maxlength="50" class="form-control" id="correo_empleado" placeholder="Ingrese correo">
                            <label for="" id="email_correcto" style="color: red;"></label><br>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Sexo</label>
                            <select class="form-control" id="sexo">
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_usuario()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_hoja_vida" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-file"></i> Hoja de vida</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_empleado_hoja">
                        <input hidden type="text" id="id_hoja_vida">

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

                        <div class="col-sm-4 form-group">
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

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_hoja_vida()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar_foto" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #f39c12; color:white;">
                    <h4 class="modal-title"><i class="fa fa-image"></i> Editar foto del empleado</h4>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <input type="number" id="id_foto_emplead" hidden>

                        <div class="col-sm-12 form-group">
                            <div class="ibox-body text-center">

                                <img class="img-circle" id="foto_empleado" white="100px" height="100px">
                                <h5 class="font-strong m-b-10 m-t-10"><span>Foto del empleado</span></h5>
                                <div>
                                    <button class="btn btn-info btn-rounded m-b-5" onclick="editar_foto_empleado();"><i class="fa fa-plus"></i> Cambiar foto</button>
                                    <input type="file" id="foto_new" class="form-control">
                                    <input type="text" id="foto_actu" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_empleado();

    function mostrar_usu() {
        var ver = document.getElementById("password");

        if (ver.type == "password") {
            ver.type = "text";
        } else {
            ver.type = "password";
        }
    }

    $("#numero_docu").keyup(function() {
        if (this.value != "") {
            var cad = document.getElementById("numero_docu").value.trim();
            var total = 0;
            var longitud = cad.length;
            var longcheck = longitud - 1;

            if (cad != "") {
                if (cad !== "" && longitud === 10) {
                    for (i = 0; i < longcheck; i++) {
                        if (i % 2 === 0) {
                            var aux = cad.charAt(i) * 2;
                            if (aux > 9) aux -= 9;
                            total += aux;
                        } else {
                            total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar           
                        }
                    }
                    total = total % 10 ? 10 - total % 10 : 0;
                    if (cad.charAt(longitud - 1) == total) {
                        $(this).css("border", "1px solid green");
                        $("#cedula_empleado").html("");
                        // $("#ocutar_p").show();
                    } else {
                        document.getElementById("cedula_empleado").innerHTML = ("cedula Inválida");
                        $(this).css("border", "1px solid red");
                        // $("#ocutar_p").hide();
                    }
                } else {
                    document.getElementById("cedula_empleado").innerHTML = ("La cedula no tiene 10 digitos");
                    $(this).css("border", "1px solid red");
                    // $("#ocutar_p").hide();
                }
            } else {
                document.getElementById("cedula_empleado").innerHTML = ("Debe ingresra una cedula");
                $(this).css("border", "1px solid red");
            }
        } else {
            $(this).css("border", "1px solid green");
            $("#cedula_empleado").html("");
        }
    });

    $("#correo_empleado").keyup(function() {
        if (this.value != "") {
            document.getElementById('correo_empleado').addEventListener('input', function() {
                campo = event.target;
                //este codigo me da formato email
                email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
                //esto es para validar si es un email valida
                if (email.test(campo.value)) {
                    //estilos para cambiar de color y ocultar el boton
                    $(this).css("border", "1px solid green");
                    $("#email_correcto").html("");
                } else {
                    $(this).css("border", "1px solid red");
                    $("#email_correcto").html("Email incorrecto");
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#email_correcto").html("");
        }
    });

    document.getElementById("foto_new").addEventListener("change", () => {
        var filename = document.getElementById("foto_new").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto_new").value = "";
        }
    });
</script>