


@foreach ($remissions as $remission)


<!--ESTE ES LA RESPUESTA AL FILTRO DE PRELIQUIDACION  #2 -->
    <tr>
        <td class="text-center">
            <input type="checkbox" name="chkFact_{{ $remission->id }}" id="chkFact_{{ $remission->id }}"
                style="margin-left:auto; margin-right:auto;"
                onchange="assignUnassign('chkFact_{{ $remission->id }}',{{ $remission->id }})">
        </td>
        <td class="text-center">
            {{ $remission->id }}
        </td>
        <td class="text-center">
            {{ $remission->Construction->obra_nombre ?? '' }}
        </td>
        <td class="text-center">
            {{ $remission->Society->Person->pers_razonsocial ?? '' }}
            {{ $remission->Society->Person->pers_primerapell ?? '' }}
            {{ $remission->Society->Person->pers_segapell ?? '' }}
            {{ $remission->Society->Person->pers_primernombre ?? '' }}
            {{ $remission->Society->Person->pers_segnombre ?? '' }}
        </td>
        <td class="text-center">
            {{ $remission->num_remission }}
        </td>
        <td class="text-center">
            {{ $remission->remi_fecha }}
        </td>
        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-info mr-1" onclick="createRemissionAssign({{ $remission->id }}, true)"
                    type="button">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </td>
    </tr>
@endforeach
