<div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b>LISTA DE PRECIOS</b></h1>
    </div>
<table id="priceListTable" class="table table-bordered table-striped dataTable dtr-inline priceListTable">
    <thead class="table-primary">
        <tr >
            <th style="width: 100px;text-align:center">
                Id
            </th>
            <th style="width: 300px;text-align:center">
                Material
            </th>
            <th style="width: 300px;text-align:center">
                Cliente
            </th>
            <th style="width: 300px;text-align:center">
                Obra
            </th>
            <th style="width: 100px;text-align:center">
                Precio
            </th>
            <th style="width: 100px;text-align:center">
                Iva
            </th>
            <th style="width: 200px;text-align:center">
                Fecha
            </th>
        </tr>
    </thead>
    <tbody id="tbody_priceList" name="tbody_priceList">
        @foreach ($priceLists as $priceList)
            <tr id="tr_{{ $priceList->id }}" >
                <td @if ($priceList->priceList_estado == 'I') style="background-color:#e1a900;color:white" @endif>
                    {{ $priceList->id }}
                </td>
                <td @if ($priceList->priceList_estado == 'I') style="background-color:#e1a900;color:white" @endif>
                    {{ $priceList->Material->mate_descripcion }}
                </td>
                <td @if ($priceList->priceList_estado == 'I') style="background-color:#e1a900;color:white" @endif>
                    {{ $priceList->Construction->Client->Person->pers_razonsocial }}
                </td>
                <td @if ($priceList->priceList_estado == 'I') style="background-color:#e1a900;color:white" @endif>
                    {{ $priceList->Construction->obra_nombre }}
                </td>
                <td @if ($priceList->priceList_estado == 'I') style="background-color:#e1a900;color:white" @endif>
                    {{ $priceList->precio }}
                </td>
                <td @if ($priceList->priceList_estado == 'I') style="background-color:#e1a900;color:white" @endif>
                    {{ $priceList->iva }}
                </td>
                <td @if ($priceList->priceList_estado == 'I') style="background-color:#e1a900;color:white" @endif>
                    {{ $priceList->created_at }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
