@foreach ($preSettlements as $settlement)
<tr @if ($settlement->status == 'A') style="color:#e3342f" @endif>
    <td class="text-center">{{ $settlement->id }}</td>
    <td class="text-center">
        @if(isset($settlement->Remission))
            {{ $settlement->Remission->id }}
        @endif
   </td>
    <td class="text-center">{{ $settlement->Construction->obra_nombre }}</td>
    <td class="text-center">{{ $settlement->Construction->Client->Person->pers_razonsocial }}</td>
    <td class="text-center">
        @if(isset($settlement->Remission))
            {{ $settlement->Remission->num_remission }}
        @endif
    </td>
    <td class="text-center">{{ $settlement->date }}</td>
    <td class="text-center">{{ $settlement->status }}</td>

    <td class="text-center">
        @if ($settlement->status == 'SF')
            <a class="btn btn-danger btn-primary"
                onclick="editSettlement({{ $settlement->id }})"
                title="Anular"><i class="fa fa-ban" aria-hidden="true"></i></a>
        @endif

    </td>

</tr>
@endforeach

{{--  @foreach ($preSettlements as $settlement)
<tr @if ($settlement->status == 'A') style="color:#e3342f" @endif>
    <td class="text-center">{{ $settlement->id }}</td>
    <td class="text-center">
        @if(isset($settlement->Remission))
            {{ $settlement->Remission->id }}
        @endif
    </td>
    <td class="text-center">
        @if(isset($settlement->Construction))
            {{ $settlement->Construction->obra_nombre }}
        @endif
    </td>
    <td class="text-center">
        @if(isset($settlement->Construction))
            {{ $settlement->Construction->Client->Person->pers_razonsocial }}
        @endif
    </td>
    <td class="text-center">
        @if(isset($settlement->Remission))
            {{ $settlement->Remission->num_remission }}
        @endif
    </td>
    <td class="text-center">{{ $settlement->date }}</td>
    <td class="text-center">{{ $settlement->status }}</td>
    <td class="text-center">
        @if ($settlement->status == 'SF')
            <a class="btn btn-success btn-primary"
                onclick="editSettlement({{ $settlement->id }})"
                title="Anular"><i class="fa fa-ban" aria-hidden="true"></i></a>
        @endif

    </td>

</tr>
@endforeach  --}}