@foreach ($machinesobs as $machinesob)
<tr id="tr_{{ $machinesob->id }}" @if( $machinesob->mqdt_estado  == 'I') style="color:#e3342f" @endif>
    <td>
        {{ $machinesob->id }}
    </td>
    <td>
        {{ $machinesob->Machine->maqn_placa }}
    </td>
    <td>
        {{ $machinesob->mqdt_fecha }}
    </td>
    <td>
        {{ $machinesob->mqdt_obs }}
    </td>
    {{-- <td>
        {{ $machinesob->mqdt_estado }}
    </td> --}}

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createMachinesObs({{ $machinesob->id }},true)"
                type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            @if($machinesob->mqdt_estado  == 'A')
            <button class="btn btn-primary mr-1"
                onclick="createMachinesObs({{ $machinesob->id }},false)"
                type="button">
                <i class="fas fa-edit">
                </i>
            </button>
           
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-danger"
                onclick="deleteMachineObs({{ $machinesob->id }},'tr_{{ $machinesob->id }}')"
                type="button">
                <i class="fas fa-trash">
                </i>
            </button>
            @endif
        </div>
    </td>
</tr>
@endforeach