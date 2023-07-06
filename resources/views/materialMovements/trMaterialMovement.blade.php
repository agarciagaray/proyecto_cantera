@foreach ($productions as $production)
    <tr @if ($production->prod_estado == 'I') style="color:#e3342f" @endif>
        <td>{{ $production->id }}</td>
        <td>{{ $production->typeProduction }}</td>
        <td>{{ $production->Machine->maqn_placa ?? '' }}</td>
        <td>{{ $production->Device->disp_descripcion ?? '' }}</td>
        <td>{{ $production->Commodity->matp_descripcion ?? '' }}</td>
        <td>{{ $production->Material->mate_descripcion ?? '' }}</td>
        <td>{{ $production->prod_fecha }}</td>
        <td>{{ $production->prod_numviajes }}</td>
        <td>{{ $production->prod_cubicaje }}</td>
        <td>{{ $production->prod_volumen }}</td>
        <td> @foreach ($production->Options_ as $Option)
         {{$Option->nom_option}}
        @endforeach</td>
        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-info mr-1" onclick="createMaterialMovement({{ $production->id }},true)"><i
                        class="fa fa-eye" aria-hidden="true"></i></button>
                @if ($production->prod_estado == 'A')
                    <button class="btn btn-primary mr-1" onclick="createMaterialMovement({{ $production->id }},false)"><i
                            class="fas fa-edit"></i></button>

                    <button class="btn btn-danger" onclick="deleteMaterialMovement({{ $production->id }})"><i
                            class="fa fa-trash" aria-hidden="true"></i></button>
                @endif
            </div>
        </td>
    </tr>
@endforeach
