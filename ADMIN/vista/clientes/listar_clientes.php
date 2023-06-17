<script type="text/javascript" src="../ADMIN/js/clientes.js"></script>
<br>
<section class="content-header">
    <h3>
        <b> Listado de clientes <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de clientes</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_clientes_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Sexo</th>
                                    <th>Cedula</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Direccion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Sexo</th>
                                    <th>Cedula</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Direccion</th>
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
    <div class="modal fade" id="modal_editar_cliente" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar cliente</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                    <input type="hidden" id="id_cliente">

                        <div class="col-sm-6 form-group">
                            <label>Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombres_oblig"></label>
                            <input type="text" maxlength="100" class="form-control" id="nombress" placeholder="Ingrese Nombres" onkeypress="return soloLetras(event)">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Apellidos</label> &nbsp;&nbsp; <label style="color:red;" id="apellidos_oblig"></label>
                            <input type="text" maxlength="100" class="form-control" id="apellidoss" placeholder="Ingrese apellidos" onkeypress="return soloLetras(event)">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Cedula</label> &nbsp;&nbsp; <label style="color:red;" id="cedula_obliga"></label>
                            <input type="text" maxlength="10" class="form-control" id="numero_docu" placeholder="Ingrese cedula" onkeypress="return soloNumeros(event)">
                            <label for="" id="cedula_empleado" style="color: red; font-size: 12px;"></label>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Telefono</label> &nbsp;&nbsp; <label style="color:red;" id="telefono_obliga"></label>
                            <input type="text" maxlength="10" class="form-control" id="telefono_p" placeholder="Ingrese telefono" onkeypress="return soloNumeros(event)">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Correo</label> &nbsp;&nbsp; <label style="color:red;" id="correo_obliga"></label>
                            <input type="text" maxlength="30" class="form-control" id="correo_p" placeholder="Ingrese correo">
                            <label for="" id="email_correcto" style="color: red;"></label>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Direccion</label> &nbsp;&nbsp; <label style="color:red;" id="direccion_obliga"></label>
                            <input type="text" maxlength="40" class="form-control" id="direccions" placeholder="Ingrese direccions">
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
                    <button type="button" class="btn btn-primary" onclick="editar_clientes()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_clientes();

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

    $("#correo_p").keyup(function() {
        if (this.value != "") {
            document.getElementById('correo_p').addEventListener('input', function() {
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
</script>