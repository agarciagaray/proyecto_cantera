@foreach ($remissions as $remission)
    <tr id="tr_{{ $remission->id }}"
        @if ($remission->remi_estado == 'I') style="color:#e3342f" 
    @elseif ($remission->remi_estado == 'AN')
    style="color:#e1a900" @endif
        class="text-center">
        <td>
            {{ $remission->id }}
        </td>
        <td>
            {{ $remission->Construction->Client->Person->pers_razonsocial ?? '' }}<br>
        </td>
        <td>
            {{ $remission->Construction->obra_nombre ?? '' }}
        </td>
        <td>
            {{ $remission->Society->Person->pers_razonsocial ?? '' }}<br>
            {{-- {{ $remission->Society->Person->pers_primerapell ?? '' }}
        {{ $remission->Society->Person->pers_segapell ?? '' }}
        {{ $remission->Society->Person->pers_primernombre ?? '' }}
        {{ $remission->Society->Person->pers_segnombre ?? '' }} --}}
        </td>
        <td>
            {{ $remission->remi_fecha }}
        </td>
        <td>
            {{ $remission->remi_numfactura }}
        </td>
        <td>
            {{ $remission->num_remission }}
        </td>
        <td class="text-center">
            @if (count($remission->remissionNovelties) > 0)
                <input type="checkbox" checked="checked" disabled>
            @endif

        </td>
        <td>
            {{ $remission->Machine->maqn_placa ?? '' }}
        </td>
        <td class="text-right py-0 align-middle">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-info mr-1 btm-sm" onclick="createRemission({{ $remission->id }}, true)"
                    type="button">
                    <i class="fas fa-eye"></i>
                </button>
                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                <!--button class="btn btn-primary mr-1" onclick="createRemission({{ $remission->id }}, false)" type="button">
                                    <i class="fas fa-edit"></i>
                                </button-->
                <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                @if ($remission->remi_estado == 'A')
                    <button class="btn btn-warning mr-1 btm-sm" onclick="cancelRemission({{ $remission->id }}, true)"
                        title="Anular remisión" type="button">
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                @endif
                <a class="btn btn-danger btm-sm" target="_black" type="button"
                    href="{{ route('referralReceipt', $remission->id) }}">
                    <i class="fa fa-file-pdf"aria-hidden="true"></i>
                </a>
                {{-- @if ($remission->remi_estado == 'A')
                <button class="btn btn-danger"
                    onclick="deleteRemission({{ $remission->id }})"
                    type="button">
                    <i class="fas fa-trash"></i>
                </button>
            @endif --}}

            </div>
        </td>
    </tr>
@endforeach
