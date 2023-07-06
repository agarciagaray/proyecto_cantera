           
@foreach ($options as $option)


<!--ESTE ES LA RESPUESTA AL FILTRO DE PORCENTAJE #2 -->
    <tr>
        <td class="text-center">
            <input type="checkbox" name="chkFact_{{ $option->id }}" id="chkFact_{{ $option->id }}"
                style="margin-left:auto; margin-right:auto;"
                onchange="OptionUnassign('chkFact_{{ $option->id }}',{{ $option->id }})">
        </td>
        <td class="text-center">
            {{ $option->id }}
        </td>
        <td class="text-center">
            {{ $option->nom_option ?? '' }}
        </td>
    
        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-info mr-1" onclick="createOptionAssign({{ $option->id }}, true)"
                    type="button">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </td>
    </tr>
@endforeach
