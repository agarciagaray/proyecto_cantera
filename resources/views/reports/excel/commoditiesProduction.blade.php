<table class="table" id="table-commodiesProduction">
    <thead class="table-primary">
        <tr class="text-center">
            <th style="width: 100px;text-align:center">Fecha</th>
            <th style="width: 200px;text-align:center">Dispositivo</th>
            <th style="width: 200px;text-align:center">Deposita</th>
            <th style="width: 200px;text-align:center">Materia prima</th>
            <th style="width: 150px;text-align:center">Cantidad</th>
            {{-- <th scope="col">Suministro</th> --}}
        </tr>
    </thead>
    <tbody id="table-commodiesProduction-remission">
        @foreach ($commodiesProduction as $key=> $commodity)
            <tr class="text-center">
                <td>{{ $commodity->fecha ?? 'sin datos'}}</td>
                <td>{{ $commodity->dispositivo  ?? 'sin datos'}}</td>
                <td>{{ $commodity->deposita  ?? 'sin datos'}}</td>
                <td>{{ $commodity->materia_prima ?? 'sin datos'}}</td>
                <td>{{ $commodity->entrada  ?? 'sin datos'}}</td>
                {{-- <td>${{ number_format($commodity->suministro, 2) }}</td> --}}
            </tr>
        @endforeach

    </tbody>

</table>
