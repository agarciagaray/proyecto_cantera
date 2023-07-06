@foreach ($materials as $material)
<tr id="tr_{{ $material->id }}" @if ($material->mate_estado== 'I') style="color:#e3342f" @endif>
    <td>
        {{ $material->id }}
    </td>
    <td>
        {{ $material->mate_codigo }}
    </td>
    {{--  <td>
        {{ $material->mate_clasificacion }}
    </td>  --}}
    <td>
        {{ $material->mate_descripcion }}
    </td>

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createMaterial({{ $material->id }},true)" type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            @if ($material->mate_estado == 'A')
            <button class="btn btn-primary mr-1"
                onclick="createMaterial({{ $material->id }},false)" type="button">
                <i class="fas fa-edit">
                </i>
            </button>
   
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn {{ $material->mate_estado == 'A' ? 'btn-danger':'btn-success' }}"
                onclick="deleteMaterial({{ $material->id }},'{{ $material->mate_estado == 'A' ? 'I' : 'A' }}')"
                type="button">
                @if ($material->mate_estado == 'A')
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