@foreach ($remissionconcnovelties as $remissionconcnovelty)
<tr id="tr_{{ $remissionconcnovelty->id }}" @if ($remissionconcnovelty->cncn_estado  == 'I') style="color:#e3342f" @endif >
    <td>
        {{ $remissionconcnovelty->id }}
    </td>
    <td>
        {{ $remissionconcnovelty->cncn_nombre }}
    </td>
    {{-- <td>
        {{ $remissionconcnovelty->cncn_estado }}
    </td> --}}

    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-info mr-1"
                onclick="createConceptNovelty({{ $remissionconcnovelty->id }},true)"
                type="button">
                <i class="fas fa-eye">
                </i>
            </button>
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            @if ($remissionconcnovelty->cncn_estado == 'A')
            <button class="btn btn-primary mr-1"
                onclick="createConceptNovelty({{ $remissionconcnovelty->id }},false)"
                type="button">
                <i class="fas fa-edit">
                </i>
            </button>
     
            <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
            <button class="btn btn-danger"
                onclick="deleteConceptNovelty({{ $remissionconcnovelty->id }},'tr_{{ $remissionconcnovelty->id }}')"
                type="button">
                <i class="fas fa-trash">
                </i>
            </button>
            @endif
        </div>
    </td>
</tr>
@endforeach