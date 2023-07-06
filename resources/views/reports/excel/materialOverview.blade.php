
<div class="card card-info ">
    <div class="position-absolute top-0 start-0 translate-middle">
        <h1 class="card-title"><b>Resumen por material</b></h1>
    </div>
    

<table class="table" id="table-MaterialMov">
    <thead class="table-primary">
  

        <tr>
            {{-- <th style="width: 120px;text-align:center"><b>Id</b></th> --}}
            <th style="width: 200px;text-align:center"><b>Nombre del material</b></th>
            <th style="width: 200px;text-align:center"><b>Cantidad</b></th>
            <th style="width: 200px;text-align:center"><b>Transporte</b></th>
            <th style="width: 200px;text-align:center"><b>Suministro</b></th>

        </tr>
    </thead>
    @php
        $quantity = 0;
        $totalTransporte = 0;
        $totalSuministro = 0;
    @endphp
    <tbody id="tbody_production">
        @foreach ($materialsOverview as $materialOverview)
            <tr>
                @php $quantity = $quantity + $materialOverview->dtrm_cantdespachada  @endphp
                <td>{{ $materialOverview->mate_descripcion }}</td>
                <td>{{ $materialOverview->dtrm_cantdespachada }}</td>
                @php $totalTransporte = $totalTransporte + $materialOverview->transporte  @endphp
                <td>${{ number_format($materialOverview->transporte, 2) }}</td>
                @php $totalSuministro =$totalSuministro + $materialOverview->suministro  @endphp
                <td>${{ number_format($materialOverview->suministro, 2) }}</td>

            </tr>
        @endforeach
        <tr>
            <td class="text-align:center"><b>Total general</b></td>
            <td class="text-align:center"><b>{{$quantity }}</b></td>
            <td class="text-align:left"><b>${{number_format($totalTransporte,2) }}</b></td>
            <td class="text-align:left"><b>${{number_format($totalSuministro,2) }}</b></td>
        </tr>

    </tbody>
</table>
