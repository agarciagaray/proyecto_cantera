<form class="form-send-options">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $options->id ?? '' }}">
    <input type="hidden" class="form-control" name="data[totalOption]" id="totalOption" value="">


    <div class="row">
        <div class="col-12 col-sm-6 mb-3">
            <label for="nom_option" style="font-size: 9pt">Nombre opcion</label>
            <input type="text" class="form-control nom_option" placeholder="Nombre opcion" value="{{ $options->nom_option ?? '' }}" name="nom_option">
          
        </div>

    </div>



    <!-- Caja de nuevo detalle --> <!-- #1 ###########-->
    <div class="div" id="detail" style="border : 1px solid #B8DAFF; margin : 4px 4px 1px 4px;">
        <div class="div" style="margin : 8px 8px 1px 8px;">
            <div class="row">
                <input type="hidden" class="form-control" id="materials_id" value="0">
                <div class="col-9 col-sm-9 mb-3">
                    <label for="idMat" style="font-size: 8pt">Id. Material (NOMBRE DEL MATERIAL)</label>
                    {{-- onchange="getPriceList()" --}}
                    <select class="form-control select2" id="idMat" required>
                        <option value="">Seleccione...</option>
                        @foreach ($materials as $material)
                        <option value="{{ $material->id }}"> {{ $material->mate_descripcion }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3 col-sm-3 ">
                    <label for="idMat" style="font-size: 8pt">Acción</label>
                    <button class="btn btn-primary btn-sm" onclick="addDetail()" type="button" id="addDetailButton">Agregar producto</button>
                </div>
                {{-- <div class="col-12 col-sm-2 mb-3">
                    <label for="porcentaje" style="font-size: 8pt">Cantidad</label>
                    <input type="number" class="form-control" placeholder="Cantidad" id="porcentaje" value="0" min="0"
                        onkeyup="calcSubt()" required >
                </div>
                <div class="col-12 col-sm-3 mb-3">
                    <label for="unidad" style="font-size: 8pt">Unidad</label>
                    <select class="form-control select2" id="unidad" required >
                        <option value="">Seleccione...</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}"> {{ $unit->unit_descripcion }} </option>
                @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-2 mb-3 pt-3">

                <input type="text" class="form-control" placeholder="Precio Unit." id="punit" value="0" min="0" onkeyup="calcSubt()" required>
            </div>

            <input type="text" class="form-control" placeholder="Subtotal" id="subt" value="0" disabled>
        </div> --}}
    </div>
    </div>
    </div>

    <!-- Fin Caja de nuevo detalle --> <!--#2  #######-->
    {{-- <form method="post" id="form-option"> --}}
    <!-- Tabla detalle remision-->
    <div class="card card-info mt-2">
        <div class="card-body p-0" style="display: block;">
            <div class="table-responsive">

                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            {{-- <th>
                                Id Mat
                            </th> --}}
                            <th>
                                Material
                            </th>
                            <th>
                                %
                            </th>
                            <th>
                                Cant
                            </th>
                            <th>

                            </th>
                        </tr>
                    </thead>
                    <!-- Hasta aqui termina la grilla -->

                    <tbody id="tbody_options" name="tbody_options">
                    </tbody>

                    <tfoot class="table-primary" id="totalOption">
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
    <!-- Fin tabla -->
    <div class="row">
        <div class="col-6">
            <button class="btn btn-success" onclick="saveOption()" type="button" id="sendOptionButton">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Cerrar</button>
        </div>
    </div>
</form>

<script>
    var variable_js = '<?php echo $detailsoptions; ?>';

    if (variable_js !== '') {
        var materials = JSON.parse(variable_js);
        var tbody = "";
        materials.detail_options.forEach((element, key) => {
            console.log('element',element);
            tbody += '<tr id="option' + key + '">\n\
                <input class="form-control" value="' + element.options_id + '" name="options[' + key + '][options_id]" id="options_id_' + key + '" type="hidden">\n\
                <input class="form-control" value="' + element.materials_id + '" name="options[' + key + '][dtrm_idmaterial]" id="dtrm_idmaterial_' + key + '" type="hidden">\n\
                <td>\n\
                    <input class="form-control" value="' + element.material.mate_descripcion + '" disabled>\n\
                    <input class="form-control" value="' + element.material.id + '" name="options[' + key + '][materials_id]" id="materials_id' + key + '" type="hidden">\n\
                </td>\n\
                <td>\n\
                    <input class="form-control" value="%" disabled>\n\
                </td>\n\
                <td>\n\
                    <input class="form-control subt" value="' + element.porcentaje + '" name="options[' + key + '][porcentaje]" id="porcentaje' + key + '" type="number" min="0" required pattern="[0-9]+" >\n\
                </td>\n\
                <td ><a class="btn btn-danger" onclick="removeOptionItem('+key+')"><i class="fas fa-trash"></i></a></td>\n\
            </tr>';

        });

        $('#tbody_options').append(tbody);
    }
</script>