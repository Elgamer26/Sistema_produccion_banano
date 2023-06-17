<script type="text/javascript" src="js/permiso.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Permisos por empleado <i class="fa fa-user" style="color:red;"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-warning box-solid">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="ibox ibox-warning">
                    <div class="ibox-head">
                        <div class="ibox-title"> Detalle de permisos</div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-4">
                        <div class="ibox ibox-primary">
                            <div class="ibox-head">
                                <div class="ibox-title">Datos del empleado</div>
                            </div>
                            <div class="ibox-body">
                                <div class="row align-items-center">

                                    <div class="col-sm-12 form-group">
                                        <label>Cedula</label> &nbsp;&nbsp; <label style="color:red;" id="dcoumento_obliga"></label>
                                        <input type="text" maxlength="10" class="form-control" id="numero_docu_p" placeholder="Ingrese numero de cedula" onkeypress="return soloNumeros(event)">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_oblig"></label>
                                        <input type="text" readonly class="form-control" id="nombres">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Apellidos</label> &nbsp;&nbsp; <label style="color:red;" id="apellido_obliga"></label>
                                        <input type="text" readonly class="form-control" id="apellidos">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Sexo</label>
                                        <input type="text" readonly class="form-control" id="sexo_e">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Telefono</label>
                                        <input type="text" readonly class="form-control" id="telefono_empleado">
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <div class="ibox-body text-center">
                                            <img class="img-circle" id="foto_empleado" white="100px" height="100px">
                                            <h5 class="font-strong m-b-10 m-t-10"><span>Foto del empleado</span></h5>
                                            <h5 class="font-strong m-b-10 m-t-10"><span id="estado_empleado" style="color:red;"></span></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-8">
                        <div class="ibox ibox-danger">
                            <div class="ibox-head">
                                <div class="ibox-title">Detalle de permisos</div>
                            </div>
                            <div class="ibox-body">
                                <div class="row align-items-center">

                                    <table id="dtVerticalScrollExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                        <thead bgcolor="purple" style="color:#fff;">
                                            <tr>
                                                <th style="width: 20px;">#</th>
                                                <th>Fecha inicio</th>
                                                <th>Fecha fin</th>
                                                <th>Tipo permiso</th>
                                                <th>Observacion</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tbody_detalle_permisos">

                                        </tbody>

                                        <tfoot bgcolor="purple" style="color:#fff;">
                                            <tr>
                                                <th style="width: 20px;">#</th>
                                                <th>Fecha inicio</th>
                                                <th>Fecha fin</th>
                                                <th>Tipo permiso</th>
                                                <th>Observacion</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#numero_docu_p").keyup(function() {
        var valor = this.value;
        var funcion = "traer_empleado_permisos";

        $.ajax({
            url: "../ADMIN/controlador/permiso/permiso.php",
            type: "POST",
            data: {
                funcion: funcion,
                valor: valor
            },
        }).done(function(resp) {
            if (resp != 0) {
                var data = JSON.parse(resp);
                var id = data[0][1];

                $("#nombres").val(data[0][2]);
                $("#apellidos").val(data[0][3]);
                $("#sexo_e").val(data[0][4]);
                $("#telefono_empleado").val(data[0][5]);
                $("#foto_empleado").attr("src", data[0][6]);

                if (data[0][7] == 0) {
                    $("#estado_empleado").html("Trabajador inactivo");
                } else {
                    $("#estado_empleado").html("");
                }
                traer_detalle_permios(id);
            } else {
                $("#nombres").val("");
                $("#apellidos").val("");
                $("#sexo_e").val("");
                $("#telefono_empleado").val("");
                $("#foto_empleado").attr("src", "img/empleado/empleado.jpg");
                $("#estado_empleado").html("");
                $("#tbody_detalle_permisos").empty();
            }
        });
    });

    function traer_detalle_permios(id) {
        funcion = "traer_detalle_permios";
        $.ajax({
            url: "../ADMIN/controlador/permiso/permiso.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id
            },
        }).done(function(resp) {

            if (resp != 0) {

                var data = JSON.parse(resp);
                let count = 0
                var llenat = "";
                var estado = "";

                data["data"].forEach(row => {
                    count++;
                    llenat += `<tr>
                                    <td for='id'>${count}</td>
                                    <td>${row["fecha_inicio"]}</td> 
                                    <td>${row["fecha_fin"]}</td>
                                    <td>${row["tipo_permiso"]}</td>  
                                    <td>${row["obsservacion"]}</td>                         
                                    </tr>`
                    $("#tbody_detalle_permisos").html(llenat);
                });
            }
        });
    }
</script>