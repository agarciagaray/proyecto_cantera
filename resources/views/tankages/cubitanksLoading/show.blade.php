<form id="form-material-movement">
    @csrf
    <input type="hidden" class="form-control" name="prod_id" id="prod_id" value="{{ isset($machineOb->prod_id)??'' }}">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Compre</label>: {{$cubitanksLoading->Fuelsshopping->ccmb_numremision }}<br>
                <label>Volumen</label>: {{ $cubitanksLoading->cubt_volumen?? '' }}<br>
                <label>Unidad</label>: {{ $cubitanksLoading->cubt_unidad?? '' }}<br>
                <label>Observación</label>: {{ $cubitanksLoading->cubt_observaciones?? '' }}<br>
            </div>
        </div>
    </div>
</form>
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>