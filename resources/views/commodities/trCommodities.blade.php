@foreach ($commodities as $commodity)
<tr id="tr_{{ $commodity->id }}" @if($commodity->matp_estado == 'I') style="color:#e3342f" @endif>
    <td>
        {{ $commodity->id }}
    </td>
    <td>
        {{ $commodity->matp_descripcion }}
    </td>
    {{-- <td>
        {{ $commodity->matp_estado }}
    </td> --}}

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createMateriaPrima({{ $commodity->id }},true)" type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            @if($commodity->matp_estado == 'A')
            <button class="btn btn-primary mr-1"
                onclick="createMateriaPrima({{ $commodity->id }},false)" type="button">
                <i class="fas fa-edit">
                </i>
            </button>
      
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn {{ $commodity->matp_estado == 'A' ? 'btn-danger':'btn-success' }}"
                onclick="deleteCommodity({{$commodity->id }},'{{ $commodity->matp_estado == 'A' ? 'I' : 'A' }}')"
                type="button">
                @if ($commodity->matp_estado == 'A')
                    <i class="fas fa-trash"></i>
                @else
                    <i class="fa fa-check" aria-hidden="true"></i>
                @endif
            </button>
            @endif
        </div>
    </td>
</tr>
@endforeach