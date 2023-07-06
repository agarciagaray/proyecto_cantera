
<div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b>INVENTARIO DE TANQUEO</b></h1>
    </div>
<table class="table" id="table-inventory">
    <thead class="table-primary">
        <tr class="text-center">
            <th style="text-align:center"><b>VEHICULO</b></th>
            <th style="text-align:center"><b>PLACA</b></th>
            <th style="text-align:center"><b>ORIGEN</b></th>
            <th style="text-align:center"><b>VOLUMÉN</b></th>
            <th style="text-align:center"><b>UNIDAD</b></th>
            <th style="text-align:center"><b>REMISIÓN DE TANQUEO</b></th>
            <th style="text-align:center"><b>FECHA</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inventories as $inventory)
            <tr class="text-center">
                <td style="width: 150px;text-align:center">
                    {{ $inventory->Machine->MachineType->tmaq_nombre ?? '' }}
                </td>
                <td style="width: 150px;text-align:center">{{ $inventory->Machine->maqn_placa ?? '' }}</td>
                <td style="width: 150px;text-align:center">
                    <b>{{ $inventory->tanq_origen }} {{ $inventory->MachineCub->maqn_placa ?? '' }}</b>
                </td>
                <td style="width: 150px;text-align:center"> {{ $inventory->tanq_volumen }}</td>
                <td style="width: 150px;text-align:center">{{ $inventory->tanq_unidad }}</td>
                <td style="width: 2200px;text-align:center">{{ $inventory->Fuelsshopping->ccmb_numremision ?? '' }}</td>
                <td style="width: 150px;text-align:center">{{ $inventory->tanq_fecha ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
