<div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b>LISTADOS DE OBRAS</b></h1>
    </div>
    <table class="table" id="constructionTable">
    <thead class="table-primary">
        <tr>
            <th  style="width: 120px;text-align:center">
                <b>Id</b>
            </th>
            <th  style="width: 120px;text-align:center">
               <b>Cliente</b>
            </th>
            <th  style="width: 120px;text-align:center">
                <b>Nombre de Obra</b>
            </th>
            <th  style="width: 400px;text-align:center">
                <b>Dirección</b>
            </th>
            <th  style="width: 120px;text-align:center">
                <b>%Sumin.</b>
            </th>
            <th  style="width: 120px;text-align:center">
               <b>%Transp.</b>
            </th>
            <th  style="width: 120px;text-align:center">
               <b>Observaciones</b>
            </th>
        </tr>
    </thead>
    <tbody id="tbody_construction" name="tbody_construction">
        @foreach ($constructions as $construction)
            <tr id="tr_{{ $construction->id }}"
                @if ($construction->obra_estado == 'I') style="color:#e3342f" @endif>
                <td style="text-align:center">
                    {{ $construction->id }}
                </td>
                <td style="text-align:center">
                    {{  $construction->Client->Person->pers_razonsocial ?? '' }}
                </td>
                <td style="text-align:center">
                    {{ $construction->obra_nombre }}
                </td>
                <td style="text-align:center">
                    {{ $construction->Client->Person->State->dpto_nombre }} -
                    {{ $construction->Client->Person->City->ciud_nombre }} -
                    {{ $construction->Client->Person->pers_direccion }}
                </td>
                <td style="text-align:center">
                    {{ $construction->obra_porcsuministro }}
                </td>
                <td style="text-align:center">
                    {{ $construction->obra_porctransporte }}
                </td>
                <td style="text-align:center">
                    {{ $construction->obra_obs }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>