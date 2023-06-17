<script type="text/javascript" src="js/empleado.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Nuevo empleado <i class="fa fa-user"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo empleado</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

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

                            <div class="col-sm-12 form-group">
                                <label>Foto de empleado</label>&nbsp;&nbsp; <label style="color:orange;">La foto del empleado no es obligatorio</label>
                                <input type="file" class="form-control" id="foto">
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

    document.getElementById("foto").addEventListener("change", () => {
        var filename = document.getElementById("foto").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto").value = "";
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
</script>