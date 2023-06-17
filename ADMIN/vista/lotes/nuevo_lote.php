<script type="text/javascript" src="js/lotes.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Nuevo lote <i class="fa fa-map"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo lote</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <div class="col-sm-6 form-group">
                                <label>Nombre lote</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_oblig"></label>
                                <input type="text" maxlength="20" class="form-control" id="nombre_lote" placeholder="Ingrese nombre lote" onkeypress="return soloLetras(event)">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Direccion lote</label> &nbsp;&nbsp; <label style="color:red;" id="direccion_obliga"></label>
                                <input type="text" maxlength="80" class="form-control" id="direccion" placeholder="Ingrese direccion lote">
                            </div>

                            <div class="col-sm-3 form-group">
                                <label>Hectárea</label> &nbsp;&nbsp; <label style="color:red;" id="hectárea_obliga"></label>
                                <input type="text" maxlength="8" onkeypress="return soloNumeros(event)" class="form-control" id="hectarea" placeholder="Ingrese hectáreas">
                            </div>

                            <div class="col-sm-1 form-group">
                                <label>Agregar</label>
                                <button onclick="ingresar_hectareas();" class="btn btn-primary"><i class="fa fa-check"></i></button>
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Longitud</label> &nbsp;&nbsp; <label style="color:red;" id="Longitud_obliga"></label>
                                <input type="text" value="-2.675577" maxlength="25" class="form-control" id="Longitud" placeholder="Ingrese Longitud">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Latitud</label> &nbsp;&nbsp; <label style="color:red;" id="Latituds_obliga"></label>
                                <input type="text" value="-79.616512" maxlength="25" class="form-control" id="Latitud" placeholder="Ingrese Latitud">
                            </div>

                            <div class="col-sm-4 form-group">
                                <table id="taba_hectareas" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <thead bgcolor="purple" style="color:#fff;">
                                        <tr>
                                            <th>Hectareas</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tbody_taba_hectareasl">

                                    </tbody>

                                    <tfoot bgcolor="purple" style="color:#fff;">
                                        <tr>
                                            <th>Hectareas</th>
                                            <th>Accion</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>

                        <div class="col-sm-3 form-group">
                            <label> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; </label>
                            <button onclick="guardar_lotes();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Guardar lotes</button> -
                            <button onclick="cargar_contenido('contenido_principal','vista/lotes/nuevo_lote.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                        </div>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1292.1282508038546!2d-79.6173749162062!3d-2.6757631865660967!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9032b91297a2c109%3A0x7855897d86511c52!2sNaranjal!5e0!3m2!1ses-419!2sec!4v1646327284067!5m2!1ses-419!2sec" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                        <br>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
</div>

<script>
    function ingresar_hectareas() {

        var hectarea = $("#hectarea").val();
        var hec = "";

        if (hectarea.length == 0) {
            return swal.fire(
                "Campo vacios",
                "Ingrese el numero de hectarea",
                "warning"
            );
        }

        hec = "H" + hectarea;

        if (verificar_hectarea(hec)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "La hectarea '" + hec + "', ya fue agregado al detalle",
                "warning"
            );
        }

        var datos_agg = "<tr>";
        datos_agg += "<td for='id'>" + hec + "</td>"; +
        "</td>";
        datos_agg +=
            "<td><button onclick='remomver_hectrea(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg += "</tr>";

        $("#tbody_taba_hectareasl").append(datos_agg);

        $("#hectarea").val("");
    }

    function remomver_hectrea(t) {
        var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
    }

    function verificar_hectarea(id) {
        let idverificar = document.querySelectorAll(
            "#tbody_taba_hectareasl td[for='id']"
        );
        return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
    }
</script>