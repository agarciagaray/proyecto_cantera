
<div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b>CONTROL DE INVENTARIO</b></h1>
    </div>

{{-- <table class="table" id="table-inventory-control">
    <thead class="table-primary">
        <tr Style="text-align:center">
            <th style="text-align:center"><b>FECHA</b></th>
            <th style="text-align:center"><b>TIPO DE MOVIMIENTO</b></th>
            <th style="text-align:center"><b>MATERIAL</b></th>
            <th style="text-align:center"><b>+ INVENTARIO</b></th>
            <th style="text-align:center"><b>- VENDIDO</b></th>
            <th style="text-align:center"><b>+ INGRESADO</b></th>

        </tr>
    </thead>
    <tbody>
        @foreach ($materialInventory as $material)

            <tr>

                <td Style="text-align:center" style="width: 150px;text-align:center">{{ $material->prod_fecha }}</td>
                <td Style="text-align:center" style="width: 170px;text-align:center">
                    @if ($material->typeProduction == 'S')
                        SALIDA
                    @elseif ($material->typeProduction == 'I')
                        INVENTARIO
                    @else
                        VENTAS
                    @endif
                </td>
                <td Style="text-align:center" style="width: 150px;text-align:center">
                    {{$material->mate_descripcion}}
                </td>


                <td class="text-center text-success" style="width: 150px;text-align:center">
                    @if ($material->typeProduction == 'S')
                            {{ $material->salida_pro }}
                    @endif
                </td>
                <td class="text-center text-danger" style="width: 150px;text-align:center">
                    @if ($material->typeProduction == null)
                            {{ $material->salida_sale }}
                    @endif
                </td>
                <td class="text-center text-success" style="width: 150px;text-align:center">
                    @if ($material->typeProduction == 'I')
                            {{ $material->salida_pro }}
                    @endif
                </td>

            </tr>
        @endforeach

    </tbody>

</table> --}}
<table class="table" id="table-inventory-control">
    <thead class="table-primary">
        <tr Style="text-align:center">
            {{-- <th style="text-align:center;width: 150px;"><b>#</b></th> --}}
            <th style="text-align:center;width: 150px;"><b>FECHA</b></th>
            <th style="text-align:center;width: 150px;"><b>TIPO DE MOVIMIENTO</b></th>
            <th style="text-align:center;width: 150px;"><b>MATERIAL</b></th>
            <th style="text-align:center;width: 190px;"><b>+ ENTRADA DE INVENTARIO</b></th>
            <th style="text-align:center;width: 170px;color:red"><b>- SALIDA POR VENTAS</b></th>
            <th style="text-align:center;width: 150px;"><b>+ INGRESO MANUAL</b></th>
            <th style="text-align:center;width: 150px;"><b>CANTIDAD FINAL</b></th>

        </tr>
    </thead>
    <tbody>

        @php
            $total = 0;
            $totalres = 0;
            $totalrestante = 0;
        @endphp
        @foreach ($materialInventory as $key => $material)
            <tr style="{{ $key == 0 ? 'background:#343a40;color:white' : '' }}">
                <td class="text-center">
                    {{ \Carbon\Carbon::parse($material->prod_fecha)->format('d/m/Y') }}
                </td>
                <td class="text-center">
                    @if ($material->typeProduction == 'S')
                        SALIDA
                    @elseif ($material->typeProduction == 'I')
                        INVENTARIO
                    @else
                        VENTAS
                    @endif
                </td>
                <td class="text-center">
                    {{ $material->mate_descripcion }}
                </td>

                <td class="text-center text-success">
                    <b>
                        @if ($material->typeProduction == 'S')
                            {{ $material->salida_pro }}
                        @endif
                    </b>
                </td>
                <td class="text-center text-danger">
                    <b>
                        @if ($material->typeProduction == "V")
                            {{ $material->salida_sale }}
                        @endif
                    </b>
                </td>
                <td class="text-center text-success">
                    <b>
                        @if ($material->typeProduction == 'I')
                            {{ $material->salida_pro }}
                        @endif
                    </b>
                </td>
                @php
                    $total += $material->salida_pro;
                    $totalres += $material->salida_sale;
                    $totalrestante = $total - $totalres;
                @endphp
                <td class="text-center {{ $totalrestante > 0 ? 'text-success' : 'text-danger' }}">
                    <b>
                        @if ($material->typeProduction == 'S')
                            {{ $total }}
                        @elseif ($material->typeProduction == 'I')
                            {{ $total }}
                        @else
                            {{ $totalrestante }}
                        @endif
                    </b>
                </td>

            </tr>
        @endforeach

    </tbody>

</table>
