<div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b>NOVEDADES DE REMISIONES</b></h1>
    </div>
    
    <table class="table" id="table-remissionNov">
    <thead class="table-primary">
        <tr>
            <th style="width: 20px;text-align:center">
                <b>ID</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>NUM REMISIÓN</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>CONCEPTO</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b> MATERIAL</b>
            </th>
            <th style="width: 600px;text-align:center">
                <b>VALOR</b>
            </th>
            <th style="width: 600px;text-align:center">
                <b>OBSERVACIÓN</b>
            </th>
        </tr>
    </thead>
    <tbody id="tbody_novrem" name="tbody_novrem">
        @foreach ($remissionnovs as $remissionnov)
            <tr id="tr_{{ $remissionnov->id }}" @if ($remissionnov->rmnv_estado == 'I') style="background-color:#e3342f;color:white" @endif>
                <td  @if ($remissionnov->rmnv_estado == 'I') style="background-color:#e3342f;color:white;text-align:justify" @else style="text-align:justify"  @endif>
                    {{ $remissionnov->id }}
                </td>
                <td  @if ($remissionnov->rmnv_estado == 'I') style="background-color:#e3342f;color:white;text-align:justify" @else style="text-align:justify"  @endif>
                    {{ $remissionnov->Remission->num_remission }}
                </td>
                <td  @if ($remissionnov->rmnv_estado == 'I') style="background-color:#e3342f;color:white;text-align:justify" @else style="text-align:justify"  @endif>
                    {{ $remissionnov->RemissionConcNovelty->cncn_nombre }}
                </td>
                <td  @if ($remissionnov->rmnv_estado == 'I') style="background-color:#e3342f;color:white;text-align:justify" @else style="text-align:justify"  @endif>
                    @foreach ($remissionnov->Remission->detailRemissions as $remission)
                        {{$remission->Material->mate_descripcion}}
                    @endforeach
                </td>

                <td  @if ($remissionnov->rmnv_estado == 'I') style="background-color:#e3342f;color:white;text-align:justify" @else style="text-align:justify"  @endif>
                    {{ $remissionnov->rmnv_nuevovalor }}
                    @if ($remissionnov->Client)
                        <b>Cliente:</b>
                        {{ $remissionnov->Client->Person->pers_razonsocial ?? '' }}<br>
                        <b>Obra:</b> {{ $remissionnov->Construction->obra_nombre ?? '' }}
                    @endif
                    {{ $remissionnov->rmnv_fecha }}
                </td>
                <td  @if ($remissionnov->rmnv_estado == 'I') style="background-color:#e3342f;color:white;text-align:justify" @else style="text-align:justify"  @endif>
                    {{ $remissionnov->rmnv_obs }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
