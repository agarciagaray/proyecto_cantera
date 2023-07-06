<form id="form-material-movement">
    @csrf
    <input type="hidden" class="form-control" name="prod_id" id="prod_id" value="{{ isset($machineOb->prod_id)??'' }}">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Maquina</label>: {{$machineOb->Machine->maqn_placa }}<br>
                <label>Fecha</label>: {{ $machineOb->mqdt_fecha?? '' }}<br>
                <label>Observación</label>: {{ $machineOb->mqdt_obs?? '' }}<br>
            </div>
        </div>

 

    </div>
   
</form>
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>