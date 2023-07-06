@foreach ($remissionnovs as $remissionnov)
<tr id="tr_{{ $remissionnov->id }}"
    @if ($remissionnov->rmnv_estado == 'I') style="color:#e3342f" @endif>
    <td>
        {{ $remissionnov->id }}
    </td>
    <td>
        {{ $remissionnov->Remission->num_remission  ?? '' }}
    </td>
    <td>
        {{ $remissionnov->Remission->Construction->Client->Person->pers_razonsocial ?? '' }}
    </td>
    <td>
        {{ $remissionnov->Remission->Construction->obra_nombre ?? '' }}
    </td>
    <td>
        {{ $remissionnov->RemissionConcNovelty->cncn_nombre }}
    </td>
    <td>
        @if (isset($detail->Material))
            {{ $detail->Material->mate_descripcion }}
        @endif
    </td>

    <td>
        {{ $remissionnov->rmnv_nuevovalor }}
        @if ($remissionnov->Client)
            <b>Cliente:</b>
            {{ $remissionnov->Client->Person->pers_razonsocial ?? '' }}<br>
            <b>Obra:</b> {{ $remissionnov->Construction->obra_nombre ?? '' }}
        @endif
        {{ $remissionnov->rmnv_fecha }}
    </td>
    <td>
        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $remissionnov->created_at)->format('Y-m-d') }}
    </td>
    <td>
        {{ $remissionnov->rmnv_obs }}
    </td>
    {{-- <td>
        {{ $remissionnov->rmnv_estado }}
    </td> --}}

    <td>

        <button class="btn btn-info btn-sm"
            onclick="createRemissionNovelty({{ $remissionnov->id }},true)"
            type="button">
            <i class="fas fa-eye"  aria-hidden="true"></i>
        </button>

        @if ($remissionnov->rmnv_estado == 'A')
            <button class="btn btn-primary btn-sm mt-1"
                onclick="createRemissionNovelty({{ $remissionnov->id }},false)"
                type="button">
                <i class="fas fa-edit"  aria-hidden="true"></i>
            </button>


            <button class="btn btn-danger btn-sm mt-1"
                onclick="deleteRemissionNovelty({{ $remissionnov->id }},'tr_{{ $remissionnov->id }}')"
                type="button">
                <i class="fas fa-trash"  aria-hidden="true"></i>
            </button>
        @endif


    </td>
    <td> <a class="btn btn-sm" style="background-color: #900C3F;color: #fff"
            href="{{ route('pdfReportRemissionNovelties', $remissionnov->id) }}"
            target="_blank"><i class="fa fa-file-pdf" aria-hidden="true"></i></a>
    </td>
</tr>
@endforeach