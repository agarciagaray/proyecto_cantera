
<div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b>GENERACION DE REPORTES POR CLIENTES</b></h1>
    </div>

<table class="table">
    <thead class="table-primary">
        <tr>
            <th style="width: 120px;text-align:center">
                <b>Fecha</b>
            </th>
            <th style="width:1000px;text-align:center">
                <b>Usuario generador del informe</b>
            </th>
            <th style="width:400px;text-align:center">
            </th>
            <th style="width:400px;text-align:center">
            </th>
            <th style="text-align:center">
            </th>
            <th style="text-align:center">

            </th>

        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
            <td style="text-align:center">
                {{ $date }}
            </td>
            <td style="width:1000px;text-align:center">
                {{ $user->name }}
            </td>
            <td style="width:400px;text-align:center">

            </td>
            <td style="width:400px;text-align:center">

            </td>
            <td style="text-align:center">

            </td>
            <td style="text-align:center">

            </td>
            {{-- <td style="text-align:center">
                <b>SOCIEDAD</b>
            </td> --}}

        </tr>
    </tbody>
</table>
@php
$cantidad = 0;
@endphp
<table class="table" id="table-inventory" style="margin-top:30px;margin-button:30px;">
    <thead class="table-primary">
        <tr class="text-center">
            <th scope="col" style="width: 120px;text-align:center"><b>FECHA</b></th>
            <th scope="col" style="width: 120px;text-align:center"><b># REMISIÓN</b></th>
            <th scope="col" style="width: 600px;text-align:center"><b>CLIENTE</b></th>
            <th scope="col" style="width: 400px;text-align:center"><b>OBRA</b></th>
            <th scope="col" style="width: 300px;text-align:center"><b>TIPO DE PAGO</b></th>
            <th scope="col" style="width: 200px;text-align:center"><b>PLACA</b></th>
            <th scope="col" style="width: 200px;text-align:center"><b>DESTINO</b></th>      
            <th scope="col" style="width: 300px;text-align:center"><b>SOCIEDAD</b></th>
            <th style="width: 200px;text-align:center">
                <b>MATERIAL</b>
            </th>
            <th style="width: 120px;text-align:center">
                <b>CANT</b>
            </th>
            <th style="width: 120px;text-align:center">
                <b>UND</b>
            </th>
            <th style="width: 120px;text-align:center">
                <b>P/U</b>
            </th>
            <th style="width: 200px;text-align:center">
                <b>SUBTOTAL</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>SUMISTRO</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>IVA</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>TRANSPORTE</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>TOTAL</b>
            </th>
           
        </tr>
    </thead>
    <tbody>
        @foreach ($remissions as $remission)
            <tr class="text-center">
                <td
                    @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                    {{ $remission->remi_fecha }}</td>
                <td
                    @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                    {{ $remission->id }}</td>
                <td
                    @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 550px;text-align:center' @else style='width: 400px;text-align:center' @endif>
                    {{ $remission->Construction->Client->Person->pers_razonsocial }}</td>
                <td
                    @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 400px;text-align:center' @else style='width: 400px;text-align:center' @endif>
                    {{ $remission->Construction->obra_nombre }}</td>
                    <td
                    @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                    @foreach ($remission->TipoPago as $tipopago)
                    {{$tipopago->descripcion}}
                    @endforeach</td><!-- Arreglar-->
                <td
                    @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                    {{ $remission->Machine->maqn_placa }}</td>
                <td
                    @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                    {{ $remission->destiny }}</td>
               

                {{-- <td> --}}
                {{-- <table class="table "> --}}
                {{-- <thead class="table-primary">
                            <tr>
                            </tr>
                            <tr>
                            </tr>
                        </thead> --}}
                {{-- <tbody> --}}
                @if (count($remission->detailRemissions) > 0)
                    @foreach ($remission->detailRemissions as $detail)
                        {{ $cantidad += $detail->dtrm_cantdespachada }}
                        {{-- <tr> --}}
                        <td  @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                            {{ $remission->Society->Person->pers_razonsocial }}
                        </td>
                        <td  @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                            {{ $detail->Material->mate_descripcion }}
                        </td>
                        <td  @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                            {{ $detail->dtrm_cantdespachada }}
                        </td>
                        <td  @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                            {{ $detail->Unit->unit_sigla }}
                        </td>
                        <td  @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                            {{ number_format($detail->dtrm_precio, 2) }}
                        </td>
                        <td  @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                            {{ number_format($detail->subtotal, 2) }}
                        </td>
                        <td  @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                            {{ number_format($detail->suministro, 2) }}
                        </td>
                        <td @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                            {{ number_format($detail->valor_iva, 2) }}
                        </td>
                        <td @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                            {{ number_format($detail->transporte, 2) }}
                        </td>
                        <td @if ($remission->remi_estado == 'AN') style='background-color:#e1a900;color:white;width: 200px;text-align:center' @else style='width: 200px;text-align:center' @endif>
                            {{ number_format($detail->subtotal + $detail->valor_iva, 2) }}
                        </td>
                      
                        {{-- </tr> --}}
                        {{-- <tbody> --}}

 



                    @endforeach
                @else
                    {{-- <tr> --}}

                    <td style="text-align:center">
                        <b>Sin datos</b>
                    </td>
                    <td style="text-align:center">
                        <b>Sin datos</b>
                    </td>
                    {{-- </tr> --}}
                @endif
                {{-- </tbody>
                    </table> --}}
                {{-- </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
<table class="table">
    <thead class="table-primary">
        <tr>
            <th style="width: 120px;text-align:center">
                <b>Total M3</b>
            </th>
            <th style="text-align:center">
                <b>{{ $cantidad }}</b>
            </th>
            <th style="width: 120px;text-align:center">
                <b>Total de viajes</b>
            </th>
            <th style="text-align:center">
                <b> {{ count($remissions) }}</b>
            </th>
        </tr>
    </thead>

</table>
