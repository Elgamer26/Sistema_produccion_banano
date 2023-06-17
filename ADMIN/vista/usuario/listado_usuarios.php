<script type="text/javascript" src="../ADMIN/js/usuario.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado de usuarios <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de usuarios</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_usuarios_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Usuario</th>
                                    <th>Foto</th>
                                    <th>Fecha registro</th>
                                    <th>Rol</th>
                                    <th>N° documento</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Usuario</th>
                                    <th>Foto</th>
                                    <th>Fecha registro</th>
                                    <th>Rol</th>
                                    <th>N° documento</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<form autocomplete="false" onsubmit="return false" id="frm_edit_usuario">
    <div class="modal fade" id="modal_edit_usuario" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar usuario</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_usuario_edit">

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

                        <div class="col-sm-6 form-group">
                            <label>Tipo de rol</label> &nbsp;&nbsp; <label style="color:red;" id="rol_obliga"></label>
                            <select class="tipo_rol_usu form-control" style="width: 100%" id="tipo_rol_usu">
                            </select>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Numero documento</label> &nbsp;&nbsp; <label style="color:red;" id="dcoumento_obliga"></label>
                            <input type="text" maxlength="10" class="form-control" id="numero_docu" placeholder="Ingrese numero documento" onkeypress="return soloNumeros(event)">
                            <label for="" id="cedula_empleado" style="color: red; font-size: 12px;"></label>
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

<form autocomplete="false" onsubmit="return false" id="frm_edit_permiso">
    <div class="modal fade" id="modal_edit__pasword" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar password</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_usuario_edit_c">

                        <div class="col-sm-10 form-group">
                            <label>Password</label> &nbsp;&nbsp; <label style="color:red;" id="pass_obliga"></label>
                            <input type="password" maxlength="20" class="form-control" id="password_edit_usu" placeholder="Ingrese password">
                        </div>

                        <div class="col-sm-1 form-group">
                            <label>..........</label>
                            <button onclick="mostrar_usu();" class="btn btn-danger"> <i class="fa fa-eye"></i></button>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_password()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(".tipo_rol_usu").select2();
    listar_usuarios();
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
</script>