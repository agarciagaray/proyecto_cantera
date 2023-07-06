@foreach ($machines as $machine)
<tr id="tr_{{ $machine->id }}"  @if($machine->maqn_estado == 'I') style="color:#e3342f" @endif>
    <td>
        {{ $machine->id }}
    </td>
    <td>
        {{ $machine->maqn_placa }}
    </td>
    <td>
        {{ $machine->MachineType->tmaq_nombre }}
    </td>
    <td>
        {{ $machine->maqn_cubicaje }}
    </td>
    <td>
        {{ $machine->Unit->unit_sigla }}
    </td>
    <td>

        <b>Nombres y apellidos</b><br>
        {{ $machine->name_complete  ?? 'Sin datos'}}<br>
        <b>Número de identificación</b><br>
        {{ $machine->nuip  ?? 'Sin datos' }}
    </td>
    <td>
        {{ $machine->maqn_obs }}
    </td>

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createMachine({{ $machine->id }},true)" type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            @if($machine->maqn_estado == 'A')
            <button class="btn btn-primary mr-1"
                onclick="createMachine({{ $machine->id }},false)" type="button">
                <i class="fas fa-edit">
                </i>
            </button>

            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-danger"
                onclick="deleteMachine({{ $machine->id }},'tr_{{ $machine->id }}')"
                type="button">
                <i class="fas fa-trash">
                </i>
            </button>
            @endif
        </div>
    </td>
</tr>
@endforeach
