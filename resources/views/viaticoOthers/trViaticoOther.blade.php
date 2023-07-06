@foreach ($viaticoOthers as $viaticoOther)
<tr id="tr_{{ $viaticoOther->id}}" @if ( $viaticoOther->mqpg_estado== 'I') style="color:#e3342f" @endif>
    <td>{{  $viaticoOther->Machine->maqn_placa}}</td>
    <td>{{$viaticoOther->ConceptPayment->cncp_nombre}}</td>
    <td>{{$viaticoOther->mqpg_fecha}}</td>
    <td>{{ $viaticoOther->mqpg_vlrpagado }}</td>
    <td>{{ $viaticoOther->mqpg_obs}}</td>
    <td>
        <button class="btn btn-secondary btn-sm" onclick="createMachinePayment({{ $viaticoOther->id }},true)"  type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
        @if ( $viaticoOther->mqpg_estado== 'A')
        <button class="btn btn-primary btn-sm" onclick="createMachinePayment({{ $viaticoOther->id }},false)"  type="button"><i class="fas fa-edit" ></i></button>
        <button class="btn btn-danger btn-sm" onclick="deleteMachinePayment({{ $viaticoOther->id }})"  type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
        @endif
    </td>
</tr>
@endforeach
