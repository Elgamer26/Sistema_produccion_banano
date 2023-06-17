<script type="text/javascript" src="js/usuario.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Nuevo usuario <i class="fa fa-user"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo usuario</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">
                            
                            <div class="col-sm-6 form-group">
                                <label>Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_oblig"></label>
                                <input type="text" maxlength="20" class="form-control" id="nombres" placeholder="Ingrese nombres" onkeypress="return soloLetras(event)">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Apellidos</label> &nbsp;&nbsp; <label style="color:red;" id="apellido_obliga"></label>
                                <input type="text" maxlength="20" class="form-control" id="apellidos" placeholder="Ingrese apellidos" onkeypress="return soloLetras(event)">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Usuario</label> &nbsp;&nbsp; <label style="color:red;" id="usuario_obliga"></label>
                                <input type="text" maxlength="20" class="form-control" id="usuario" placeholder="Ingrese usuario" onkeypress="return soloLetras(event)">
                            </div>

                            <div class="col-sm-5 form-group">
                                <label>Password</label> &nbsp;&nbsp; <label style="color:red;" id="pass_obliga"></label>
                                <input type="password" maxlength="20" class="form-control" id="password" placeholder="Ingrese password">
                            </div>

                            <div class="col-sm-1 form-group">
                                <label>..........</label>
                                <button onclick="mostrar_usu();" class="btn btn-danger"> <i class="fa fa-eye"></i></button>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Tipo de rol</label> &nbsp;&nbsp; <label style="color:red;" id="rol_obliga"></label>
                                <select class="tipo_rol_usu form-control" id="tipo_rol_usu">
                                </select>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Numero documento</label> &nbsp;&nbsp; <label style="color:red;" id="dcoumento_obliga"></label>
                                <input type="text" maxlength="10" class="form-control" id="numero_docu" placeholder="Ingrese numero documento" onkeypress="return soloNumeros(event)">
                                <label for="" id="cedula_empleado" style="color: red; font-size: 12px;"></label>
                            </div>

                            <div class="col-sm-12 form-group">
                                <label>Foto de usuario</label>&nbsp;&nbsp; <label style="color:orange;">La foto del usuario no es obligatorio</label>
                                <input type="file" class="form-control" id="foto">
                            </div>

                            <br>

                            <div class="col-sm-12 form-group">
                                <button onclick="guardar_usuaio();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Guardar Usuario</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/usuario/nuevo_usuario.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(".tipo_rol_usu").select2();

    listar_rol_usu();

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
</script>