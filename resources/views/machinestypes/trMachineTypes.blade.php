@foreach ($machinestypes as $machinestype)
<tr id="tr_{{ $machinestype->id }}" @if( $machinestype->tmaq_estado  == 'I') style="color:#e3342f" @endif>
    <td>
        {{ $machinestype->id }}
    </td>
    <td>
        {{ $machinestype->tmaq_nombre }}
    </td>
    {{-- <td>
        {{ $machinestype->tmaq_estado }}
    </td> --}}

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createMachineType({{ $machinestype->id}},true)" type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            @if($machinestype->tmaq_estado  == 'A') 
            <button class="btn btn-primary mr-1"
                onclick="createMachineType({{ $machinestype->id }},false)" type="button">
                <i class="fas fa-edit">
                </i>
            </button>
            
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-danger"
                onclick=" deleteMachineType({{ $machinestype->id }},'tr_{{ $machinestype->id }}')"
                type="button">
                <i class="fas fa-trash">
                </i>
            </button>
            @endif
        </div>
    </td>
</tr>
@endforeach