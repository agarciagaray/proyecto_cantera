

<div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b>REMISIONES POR MATERIAL</b></h1>
    </div>
<table class="table">
    <thead class="table-primary">
        <tr>
            <th style="width: 120px">
                <b>Fecha</b>
            </th>
            <th style="">
                <b>Usuario generador del informe</b>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
            <td style="">
                {{ $date }}
            </td>
            <td style="">
                {{ $user->name }}
            </td>
        </tr>
    </tbody>
</table>
<table class="table">
    <thead class="table-primary">
        <tr>
            <th style="width: 300px;">
                <b># Remisión</b>
            </th>
            <th style="width: 300px">
                <b>Sociedad</b>
            </th>
            <th style="width: 200px">
                <b>Material</b>
            </th>
            <th style="width: 100px">
                <b>Cantidad</b>
            </th>
            <th style="width: 130px">
                <b>Unidad</b>
            </th>
            <th style="width: 120px">
                <b>Suministro</b>
            </th>
            <th style="width: 120px">
                <b>Transporte</b>
            </th>
            <th style="width: 120px">
                <b>Fecha</b>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($remissions as $remission)
            @if (count($remission->detailRemissions) > 0)
                @foreach ($remission->detailRemissions as $detail)
                    <tr class="">

                        <td
                            @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;' @endif>
                            {{  $remission->num_remission  }}
                        </td>
                        <td
                            @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                            {{ $remission->Society->Person->pers_razonsocial }}
                        </td>
                        <td
                            @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                            {{ $detail->Material->mate_descripcion }}
                        </td>
                        <td
                            @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                            {{ $detail->dtrm_cantdespachada }}
                        </td>
                        <td
                            @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                            {{ $detail->Unit->unit_sigla }}
                        </td>
                        <td
                            @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                            {{ ($detail->dtrm_cantdespachada * $detail->dtrm_precio * $remission->Construction->obra_porcsuministro) / 100 }}
                        </td>
                        <td
                            @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                            {{ ($detail->dtrm_cantdespachada * $detail->dtrm_precio * $remission->Construction->obra_porctransporte) / 100 }}
                        </td>
                        <td
                            @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                            {{ date('d-m-Y', strtotime($detail->created_at)) }}
                        </td>
                    </tr>
                @endforeach
            @endif
        @endforeach
    </tbody>
</table>
