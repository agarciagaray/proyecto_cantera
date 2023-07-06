@foreach ($constructions as $construction)
<tr id="tr_{{ $construction->id }}"  @if ($construction->obra_estado == 'I') style="color:#e3342f" @endif>
    <td>
        {{ $construction->id }}
    </td>
    {{-- <td>
        {{ $construction->obra_idcliente }}
    </td> --}}
    <td>
    {{ $construction->Client->Person->pers_razonsocial ?? '' }}

    </td>
    <td>
        {{ $construction->obra_nombre }}
    </td>
    <td>
        {{ $construction->Client->Person->State->dpto_nombre }} -  {{ $construction->Client->Person->City->ciud_nombre }} <br>
        {{ $construction->Client->Person->pers_direccion }}
    </td>
    <td>
        {{ $construction->obra_porcsuministro }}
    </td>
    <td>
        {{ $construction->obra_porctransporte }}
    </td>
    <td>
        {{ $construction->obra_obs }}
    </td>

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createContruction({{ $construction->id }},true)"
                type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            @if ($construction->obra_estado == 'A')
            <button class="btn btn-primary mr-1"
                onclick="createContruction({{ $construction->id }},false)"
                type="button">
                <i class="fas fa-edit">
                </i>
            </button>
    
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-danger"
                onclick="deleteConstruction({{ $construction->id }},'tr_{{ $construction->id }}')"
                type="button">
                <i class="fas fa-trash">
                </i>
            </button>
            @endif
        </div>
    </td>
</tr>
@endforeach