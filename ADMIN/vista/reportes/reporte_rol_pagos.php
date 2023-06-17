<style>
    .contennidor {
        background: gray;
        min-height: 100vh;
    }
</style>
<br>
<section class="content-header">
    <h3>
        <b> Reporte rol de pagos <i class="fa fa-cubes"></i> </b>
    </h3>
</section>
<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Reporte rol de pagos </div>
                    </div>
                    <div class="ibox-body">
                        <div class="row">

                            <div class="col-lg-7">
                                <label>Empledo</label>
                                <select id="empleado" class="cla_empleado form-control">
                                </select>
                            </div>

                            <div class="col-lg-2">
                                <label>Fecha inicio</label>
                                <input type="date" class="form-control" id="fecha_venta_ini"><br>
                            </div>

                            <div class="col-lg-2">
                                <label>Fecha fin</label>
                                <input type="date" class="form-control" id="fecha_venta_fin"><br>
                            </div>

                            <div class="col-lg-1">
                                <label>Buscar</label>
                                <button class="btn btn-primary" onclick="reporte_rol_pagos();"><i class="fa fa-eye"></i></button>
                            </div>

                            <div class="col-lg-12" style="padding: 15px;">
                                <center>
                                    <iframe width="100%" height="100%" class="contennidor" id="iframe_produc"></iframe>
                                </center>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var funcion;
    $(".cla_empleado").select2();

    $(document).ready(function() {
        listar_empleado_rol_pagos();

        var n = new Date();
        var y = n.getFullYear();
        var m = n.getMonth() + 1;
        var d = n.getDate();
        if (d < 10) {
            d = '0' + d;
        }
        if (m < 10) {
            m = '0' + m;
        }

        document.getElementById("fecha_venta_ini").value = y + "-" + m + "-" + d;
        document.getElementById("fecha_venta_fin").value = y + "-" + m + "-" + d;

    });

    function listar_empleado_rol_pagos() {
        funcion = "listar_empleado_rol_pagos";
        $.ajax({
            url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
            type: "POST",
            data: {
                funcion: funcion
            },
        }).done(function(response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var cadena = "";
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena +=
                        "<option value='" + data[i][0] + "'>Empleado: " + data[i][1] + " - Cedula: " + data[i][2] + " - Sexo: " + data[i][3] + "</option>";
                }
                //aqui concadenamos al id del select
                $("#empleado").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#empleado").html(cadena);
            }
        });
    }

    function reporte_rol_pagos() {
        var id = $("#empleado").val();
        if (id.length == 0 || id == '') {
            return Swal.fire(
                "Mensaje de advertencia",
                "No hay tipo de asistecias para buscar",
                "warning"
            );
        }

        var fecha_inicio = $("#fecha_venta_ini").val();
        var fecha_fin = $("#fecha_venta_fin").val();
        if (fecha_inicio > fecha_fin) {
            return Swal.fire(
                "Mensaje de advertencia",
                "La fecha inicio '" +
                fecha_inicio +
                "' es mayor a la fecha final '" +
                fecha_fin +
                "'",
                "warning"
            );
        }

        var ifrm = document.getElementById("iframe_produc");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/reporte_rol_pagos.php?id='" + id + "'&f_i='" + fecha_inicio + "'&f_f='" + fecha_fin + "'");
    }
</script>