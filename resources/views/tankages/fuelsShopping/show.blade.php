<form id="form-material-movement">
    @csrf
    <input type="hidden" class="form-control" name="prod_id" id="prod_id"
        value="{{ isset($machineOb->prod_id) ?? '' }}">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Proveedor</label>: @if (is_null($fuelsshopping->Supplier->Person->pers_razonsocial))
                    {{ $fuelsshopping->Supplier->prov_identif }}
                    {{ $fuelsshopping->Supplier->Person->pers_primernombre ?? '' }}
                    {{ $fuelsshopping->Supplier->Person->pers_segnombre ?? '' }}
                    {{ $fuelsshopping->Supplier->Person->pers_primerapell ?? '' }}
                    {{ $fuelsshopping->Supplier->Person->pers_segapell ?? '' }}
                @else
                    {{ $fuelsshopping->Supplier->prov_identif }}{{ $fuelsshopping->Supplier->Person->pers_razonsocial ?? '' }}
                @endif
                <br>
                <label>Fecha de descarga</label>: {{ $fuelsshopping->ccmb_fechadescarga ?? '' }}<br>
                <label>Número de emisión</label>: {{ $fuelsshopping->ccmb_numremision ?? '' }}<br>
                <label>Volumen</label>: {{ $fuelsshopping->ccmb_volumen ?? '' }}<br>
                <label>Unidad</label>: {{ $fuelsshopping->ccmb_unidad ?? '' }}<br>
                <label>Valor de unidad</label>: {{ $fuelsshopping->ccmb_vlrunidad ?? '' }}<br>
                <label>Observación</label>: {{ $fuelsshopping->ccmb_observaciones ?? '' }}<br>
            </div>
        </div>

        <td>


    </div>

</form>
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>