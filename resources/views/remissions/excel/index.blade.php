<div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b>REMISIONES</b></h1>
    </div>


<table class="table" id="table-remission">
    <thead class="table-primary">
        <tr>
            <th style="width: 100px;text-align:center">
                <b>ID</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>CLIENTE</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>OBRA</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>SOCIEDAD</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>FECHA</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>NO. DE FACTURA</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>TIPO DE PAGO</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>NO. INTERNO</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>NOV</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>PLACA</b>
            </th>
        </tr>
    </thead>
    <tbody id="tbody_remission" name="tbody_remission">
        @foreach ($remissions as $remission)
            <tr id="tr_{{ $remission->id }}">
                <td  @if($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                    {{ $remission->id }}
                </td>
                <td  @if($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                    {{ $remission->Construction->Client->Person->pers_razonsocial ?? '' }}
                </td>
                <td  @if($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                    {{ $remission->Construction->obra_nombre ?? '' }}
                </td>
                <td  @if($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                    {{ $remission->Society->Person->pers_razonsocial ?? '' }}
                </td>
                <td  @if($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                    {{ $remission->remi_fecha }}
                </td>
                <td  @if($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                    {{ $remission->remi_numfactura }}
                </td>
                <td  @if($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                  @foreach($remission->TipoPago as $tipopago)  {{ $tipopago->descripcion }}
                  @endforeach
                </td>
                <td  @if($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                    {{ $remission->num_remission }}
                </td>
                <td  @if($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                    @if (count($remission->remissionNovelties) > 0)
                        SI
                    @else
                        NO
                    @endif

                </td>
                <td  @if($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white' @endif>
                    {{ $remission->Machine->maqn_placa ?? '' }}
                </td>
            </tr><!--//Crear para que salga la direccion por direccion-->
        @endforeach
    </tbody>
</table>
