@foreach ($devices as $device)
<tr id="tr_{{ $device->id }}"  @if($device->disp_estado == 'I') style="color:#e3342f" @endif>
    <td>
        {{ $device->id }}
    </td>
    <td>
        {{ $device->disp_descripcion }}
    </td>
    {{-- <td>
        {{ $device->disp_estado }}
    </td> --}}

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createDevice({{ $device->id }},true)" type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            @if ($device->disp_estado == 'A')
            <button class="btn btn-primary mr-1"
                onclick="createDevice({{ $device->id }},false)" type="button">
                <i class="fas fa-edit">
                </i>
            </button>
    
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-danger"
                onclick="deleteDevice({{ $device->id }},'tr_{{ $device->id }}')"
                type="button">
                <i class="fas fa-trash">
                </i>
            </button>
            @endif
        </div>
    </td>
</tr>
@endforeach