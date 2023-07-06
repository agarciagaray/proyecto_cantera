@foreach ($machineObs as $machine)
<tr @if ($machine->mqdt_estado== 'I') style="color:#e3342f" @endif>
    <td>{{ $machine->Machine->maqn_placa }}</td>
    <td>{{ $machine->mqdt_fecha }}</td>
    <td>{{ $machine->mqdt_obs }}</td>
    <td>
        <button class="btn btn-primary btn-sm" onclick="createMachineNovelty({{ $machine->id }},false)"><i class="fas fa-edit"></i></button>
        @if ($machine->mqdt_estado== 'A')
        <button class="btn btn-secondary btn-sm" onclick="createMachineNovelty({{ $machine->id }},true)"><i class="fa fa-eye" aria-hidden="true"></i></button>
  
        <button class="btn btn-danger btn-sm" onclick="deleteMochineNovely({{ $machine->id }})"><i class="fa fa-trash" aria-hidden="true"></i></button>
        @endif
    </td>

</tr>
@endforeach