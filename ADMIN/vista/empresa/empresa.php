<script type="text/javascript" src="js/empresa.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Datos de la empresa <i class="fa fa-home"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Datos de la empresa</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <div class="col-sm-12 form-group">
                                <div class="ibox-body text-center">

                                    <img class="img-circle" id="foto_empresa" white="100px" height="100px">
                                    <h5 class="font-strong m-b-10 m-t-10"><span>Foto de la empresa</span></h5>
                                    <div>
                                        <button class="btn btn-info btn-rounded m-b-5" onclick="cambiar_foto_perfil_empresa();"><i class="fa fa-plus"></i> Cambiar foto</button>
                                        <input type="file" id="foto_nueva" class="form-control">
                                        <input type="text" id="foto_actual" hidden>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Nombre empresa</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_empresa_oblig"></label>
                                <input type="text" maxlength="40" class="form-control" id="nombres_empresa" placeholder="Ingrese nombre empresa">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Ruc</label> &nbsp;&nbsp; <label style="color:red;" id="ruc_obliga"></label>
                                <input type="text" maxlength="13" class="form-control" id="ruc_empresa" placeholder="Ingrese ruc" onkeypress="return soloNumeros(event)">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Direccion</label> &nbsp;&nbsp; <label style="color:red;" id="dirccion_obliga"></label>
                                <input type="text" maxlength="50" class="form-control" id="direccion_empresa" placeholder="Ingrese direccion">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Telefono</label> &nbsp;&nbsp; <label style="color:red;" id="telefono_obliga"></label>
                                <input type="text" maxlength="15" class="form-control" id="telefono_empresa" placeholder="Ingrese telefono" onkeypress="return soloNumeros(event)">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Correo</label> &nbsp;&nbsp; <label style="color:red;" id="correo_obliga"></label>
                                <input type="text" maxlength="50" class="form-control" id="correo_empresa" placeholder="Ingrese correo">
                                <label for="" id="email_correcto" style="color: red;"></label><br>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Propietario</label> &nbsp;&nbsp; <label style="color:red;" id="propietraio_obliga"></label>
                                <input type="text" maxlength="50" class="form-control" id="propietario_empresa" placeholder="Ingrese propietario" onkeypress="return soloLetras(event)">
                            </div>

                            <div class="col-sm-12 form-group">
                                <label>Descripcion</label> &nbsp;&nbsp; <label style="color:red;" id="descripcion_obliga"></label>
                                <textarea cols="3" rows="3" class="form-control" id="descripcion_empresa"></textarea>
                            </div>

                            <div class="col-sm-12 form-group">
                                <button onclick="editra_datos_empresa();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Editar datos</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    traer_datos_de_empresa();

    document.getElementById("foto_nueva").addEventListener("change", () => {
        var filename = document.getElementById("foto_nueva").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto_nueva").value = "";
        }
    });

    $("#correo_empresa").keyup(function() {
        if (this.value != "") {
            document.getElementById('correo_empresa').addEventListener('input', function() {
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