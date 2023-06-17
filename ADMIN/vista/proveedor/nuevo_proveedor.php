<script type="text/javascript" src="js/proveedor.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Nuevo proveedor <i class="fa fa-truck"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo proveedor</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <div class="col-sm-6 form-group">
                                <label>Razon social</label> &nbsp;&nbsp; <label style="color:red;" id="razon_oblig"></label>
                                <input type="text" maxlength="100" class="form-control" id="razons" placeholder="Ingrese razon social">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Ruc</label> &nbsp;&nbsp; <label style="color:red;" id="ruc_obliga"></label>
                                <input type="text" maxlength="13" class="form-control" id="rucs" placeholder="Ingrese ruc" onkeypress="return soloNumeros(event)">
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
                                <input type="text" maxlength="40" class="form-control" id="direccions" placeholder="Ingrese direccion">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Descripcion</label> &nbsp;&nbsp; <label style="color:red;" id="descripcion_obliga"></label>
                                <input type="text" maxlength="100" class="form-control" id="descripcions" placeholder="Ingrese descripcion">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Encargado</label> &nbsp;&nbsp; <label style="color:red;" id="encargado_obliga"></label>
                                <input type="text" maxlength="50" class="form-control" id="encargados" placeholder="Ingrese encargados" onkeypress="return soloLetras(event)">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Sexo</label>
                                <select class="form-control" id="sexo">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>

                            <br>

                            <div class="col-sm-12 form-group">
                                <button onclick="nuevo_proveedor();" class="btn btn-primary" type="button"><i class="fa fa-save"></i> Guardar proveedor</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/proveedor/nuevo_proveedor.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
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