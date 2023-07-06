  <div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b> Listado de material en movimiento</b></h1>
    </div>

    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12 col-md-6 mb-2">
                    <button class="btn btn-primary" onclick="createMaterialMovement()" type="button">
                        Crear
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table" id="table-MaterialMov">
                            <thead class="table-primary">
                                <tr>
                                    <th style="width: 120px;text-align:center"><b>Id</b></th>
                                    <th style="width: 120px;text-align:center"><b>Tipo</b></th>
                                    <th style="width: 200px;text-align:center"><b>Deposita</b></th>
                                    <th style="width: 200px;text-align:center"><b>Depositado en</b></th>
                                    <th style="width: 300px;text-align:center"><b>Materia prima</b></th>
                                    <th style="width: 300px;text-align:center"><b>Material</b></th>
                                    <th style="width: 120px;text-align:center"><b>Fecha</b></th>
                                    <th style="width: 300px;text-align:center"><b># de viajes</b></th>
                                    <th style="width: 120px;text-align:center"><b>Cubicaje</b></th>
                                    <th style="width: 120px;text-align:center"><b>Volumen</b></th>
                                </tr>
                            </thead>
                            <tbody id="tbody_production">
                                @foreach ($productions as $production)
                                    {{-- mqmv_estado --}}

                                    <tr >
                                        <td @if ($production->prod_estado == 'I') style="background-color:#e3342f;color:white" @endif >{{ $production->id }}</td>
                                        <td @if ($production->prod_estado == 'I') style="background-color:#e3342f;color:white" @endif>{{ $production->typeProduction }}</td>
                                        <td @if ($production->prod_estado == 'I') style="background-color:#e3342f;color:white" @endif>{{ $production->Machine->maqn_placa ?? '' }}</td>
                                        <td @if ($production->prod_estado == 'I') style="background-color:#e3342f;color:white" @endif>{{ $production->Device->disp_descripcion ?? '' }}</td>
                                        <td @if ($production->prod_estado == 'I') style="background-color:#e3342f;color:white" @endif>{{ $production->Commodity->matp_descripcion ?? '' }}</td>
                                        <td @if ($production->prod_estado == 'I') style="background-color:#e3342f;color:white" @endif>{{ $production->Material->mate_descripcion ?? '' }}</td>
                                        <td @if ($production->prod_estado == 'I') style="background-color:#e3342f;color:white" @endif>{{ $production->prod_fecha }}</td>
                                        <td @if ($production->prod_estado == 'I') style="background-color:#e3342f;color:white" @endif>{{ $production->prod_numviajes }}</td>
                                        <td @if ($production->prod_estado == 'I') style="background-color:#e3342f;color:white" @endif>{{ $production->prod_cubicaje }}</td>
                                        <td @if ($production->prod_estado == 'I') style="background-color:#e3342f;color:white" @endif>{{ $production->prod_volumen }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
