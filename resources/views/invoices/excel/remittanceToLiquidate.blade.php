<table class="table" id="table_remittanceToLiquidate">
    <thead class="table-primary">
        <tr>
            <th width="200px" style="text-align:center">
                <b>Id</b>
            </th>
            <th width="300px" style="text-align:center">
                <b>Nombre obra</b>
            </th>
            <th width="300px" style="text-align:center">
                <b>Razón social</b>
            </th>
            <th width="200px" style="text-align:center">
                <b>Número de remisión</b>
            </th>
            <th width="100px" style="text-align:center">
                <b>Fecha</b>
            </th>
        </tr>
    </thead>
    <tbody >
        @foreach ($remissions as $remission)
        <tr>
            <td style="text-align:center">
                {{ $remission->id }}
            </td>
            <td style="text-align:center">
                {{ $remission->Construction->obra_nombre ?? '' }}
            </td>
            <td style="text-align:center">
                {{ $remission->Society->Person->pers_razonsocial ?? '' }}
                {{--  {{ $remission->Society->Person->pers_primerapell ?? '' }}
                {{ $remission->Society->Person->pers_segapell ?? '' }}
                {{ $remission->Society->Person->pers_primernombre ?? '' }}
                {{ $remission->Society->Person->pers_segnombre ?? '' }}  --}}
            </td>
            <td style="text-align:center">
                {{ $remission->num_remission }}
            </td>
            <td style="text-align:center">
                {{ $remission->remi_fecha }}
            </td>
        </tr>
    @endforeach
    
    </tbody>
</table>