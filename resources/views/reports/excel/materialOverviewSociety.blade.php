

<div class="card card-info">
            <div class="card-header">
                <h1 class="card-title"><b>RESUMEN POR SOCIEDADES</b></h1>
            </div>



<table class="table" id="table-materialsOverviewSociety">
    <thead class="table-primary">
        <tr class="text-center">
            <th style="width: 200px;text-align:center"><b>Razón social</b></th>
            <th style="width: 200px;text-align:center"><b>Número de remisión</b></th>
            <th style="width: 200px;text-align:center"><b>Nombre del material</b></th>
            <th style="width: 200px;text-align:center"><b>Cantidad</b></th>
        </tr>
    </thead>
    <tbody id="table-materialsOverviewSociety-remission">
        @foreach ($materialsOverviewSocieties as $key=> $materialOverview)
            <tr class="text-center">
                <td>{{ $materialOverview->pers_razonsocial}}</td>
                <td>{{ $materialOverview->num_remission ?? ''}} </td>
                <td>{{ $materialOverview->mate_descripcion }}</td>
                <td>{{ $materialOverview->dtrm_cantdespachada }}</td>
            </tr>
        @endforeach

    </tbody>

</table>
