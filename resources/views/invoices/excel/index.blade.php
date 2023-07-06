
<div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b>MANEJO DE PRELIQUIDACION</b></h1>
    </div>

<table class="table" id="table_asociate_invoice_remission">
    <thead class="table-primary">
        <tr>
            {{--  <th>  --}}
            <th style="width: 100px;text-align:center">
                <b>FACTURA</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>REMISIÓN</b>
            </th>
            <th style="width: 100px;text-align:center">
                <b>FECHA</b>
            </th>
            <th style="width: 300px;text-align:center">
               <b> CLIENTE FACTURAR</b>
            </th>
            <th style="width: 500px;text-align:center">
                <b>OBRA FACTURAR</b>
            </th>
            <th style="width: 300px;text-align:center">
               <b> PRODUCTO</b>
            </th>
            <th style="width: 300px;text-align:center">
               <b> VOLUMÉN FACTURAR</b>
            </th>
            <th style="width: 100px;text-align:center">
                <b>VALOR</b>
            </th>
            <th style="width: 100px;text-align:center">
                <b>SUBTOTAL</b>
            </th>
            <th style="width: 150px;text-align:center">
                <b>%TRANSPORTE</b>
            </th>
            <th style="width: 150px;text-align:center">
                <b>%SUMINNISTRO (IVA)</b>
            </th>
            <th style="width: 150px;text-align:center">
                <b>$- TRANSPORTE</b>
            </th>
            <th style="width: 150px;text-align:center">
                <b>$- SUMINISTRO(IVA)</b>
            </th>

            <th style="width: 100px;text-align:center">
                <b>%IVA</b>
            </th>
            <th style="width: 100px;text-align:center">
                <b>$- IVA</b>
            </th>
            <th style="width: 100px;text-align:center">
                <b>TOTAL REMIS</b>
            </th>
            <th style="width: 100px;text-align:center">
                <b>FECHA</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>CLIENTE REMISIÓN</b>
            </th>
            <th style="width: 300px;text-align:center">
                <b>OBRA REMISIÓN</b>
            </th>
            <th style="width: 200px;text-align:center">
                <b>VOLUMÉN REMISIÓN</b>
            </th>

        </tr>
    </thead>
    <tbody>
        @foreach ($remissions as $value)
            <tr>


            <td style="text-align:center"> @if(isset($value->rem_numfactura)){{ $value->remi_numfactura == null || $value->remi_numfactura == "" ? "SIN FACTURA" : "CON FACTURA"}} @endif</td>

                <td style="text-align:center">{{ $value->num_remission }}</td>
                <td style="text-align:center">{{ $value->fecha_fac }}</td>
                <td style="text-align:center">{{ $value->cliente_fac }}</td>
                <td style="text-align:center">{{ $value->obrafac }}</td>
                <td style="text-align:center">{{ $value->mate_descripcion }}</td>
                <td style="text-align:center">{{ $value->cant_fac }}</td>
                <td style="text-align:center">{{ $value->preciorem }}</td>
                <td style="text-align:center">{{ $value->subtotalrem }}</td>
                <td style="text-align:center">{{ $value->rem_porc_trans ?? '' }}</td>
                <td style="text-align:center">{{ $value->rem_porc_sum ?? '' }}</td>
                <td style="text-align:center">{{ $value->transporterem ?? '' }}</td>
                <td style="text-align:center">{{ $value->suministrorem ?? ''}}</td>
                <td style="text-align:center">{{ $value->porc_iva ?? '' }}</td>
                <td style="text-align:center">{{ $value->valorivarem }}</td>
                <td style="text-align:center">{{ $value->subtotalrem + $value->valorivarem }}</td>
                <td style="text-align:center">{{ $value->fecharem}}</td>
                <td style="text-align:center">{{ $value->clienterem ?? '' }}</td>
                <td style="text-align:center">{{ $value->obra_rem ?? ''}}</td>
                <td style="text-align:center">{{ $value->volumenrem ?? ''}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
