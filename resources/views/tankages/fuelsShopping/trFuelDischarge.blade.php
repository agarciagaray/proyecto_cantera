@foreach ($fuelsshoppings as $fuelsshopping)
<tr>
    <td>
        @if (is_null($fuelsshopping->Supplier->Person->pers_razonsocial))
        {{ $fuelsshopping->Supplier->prov_identif }}
        {{ $fuelsshopping->Supplier->Person->pers_primernombre ?? '' }}
        {{ $fuelsshopping->Supplier->Person->pers_segnombre ?? '' }}
        {{ $fuelsshopping->Supplier->Person->pers_primerapell ?? '' }}
        {{ $fuelsshopping->Supplier->Person->pers_segapell ?? '' }}
    @else
        {{ $fuelsshopping->Supplier->prov_identif }}{{ $fuelsshopping->Supplier->Person->pers_razonsocial ?? '' }}
    @endif

    </td>

    <td>{{ $fuelsshopping->ccmb_fechadescarga }}</td>
    <td>{{ $fuelsshopping->ccmb_numremision }}</td>
    <td>{{ $fuelsshopping->ccmb_volumen }}</td>
    <td>{{ $fuelsshopping->ccmb_unidad }}</td>
    <td>{{ $fuelsshopping->ccmb_vlrunidad }}</td>
    <td>{{ $fuelsshopping->ccmb_observaciones }}</td>
    <td class="text-right py-0 align-middle">
        <div class="btn-group btn-group-sm">
            @can('Formulario de Descarga de carrotanque')
                <button class="btn btn-primary mr-1"
                    onclick="createFuelsShoopping({{ $fuelsshopping->id }},false)"><i
                    class="fas fa-edit"></i></button>
            @endcan
            @can('Formulario de Descarga de carrotanque')
                <button class="btn btn-info mr-1"
                    onclick="createFuelsShoopping({{ $fuelsshopping->id }},true)"><i
                    class="fa fa-eye" aria-hidden="true"></i></button>
            @endcan 
            @can('Eliminar de Descarga de carrotanque')
                <button class="btn btn-danger"
                    onclick="deleteFuelsShoopping({{ $fuelsshopping->id }})"><i
                    class="fa fa-trash" aria-hidden="true"></i></button>
            @endcan
        </div>
    </td>
</tr>
@endforeach
