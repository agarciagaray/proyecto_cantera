@foreach ($remissions as $remission)
<tr class="text-center">
    <td>{{ $remission->id }}</td>
    <td>{{ $remission->remi_fecha }}</td>
    <td>{{ $remission->Construction->obra_nombre }}</td>
    <td>{{ $remission->Construction->Client->Person->pers_razonsocial }}</td>
    <td>{{ $remission->Society->Person->pers_razonsocial }}</td>
    <td>{{ $remission->remi_numfactura == null ? 'Sin factura' : 'Con factura #' . $remission->remi_numfactura }}
    </td>

    <td>{{ $remission->num_remission }}</td>
    <td>
        @if (count($remission->remissionNovelties) > 0)
            <input type="checkbox" checked="checked" disabled>
        @endif

    </td>
    <td>
        <a class="btn btn-success mb-2 btn-sm"
            onclick="detailRemission({{ $remission->id }})">
            Detalle
        </a>
    </td>

</tr>
@endforeach
