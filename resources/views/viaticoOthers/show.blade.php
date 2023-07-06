<form id="form-material-movement">
    @csrf
    <input type="hidden" class="form-control" name="prod_id" id="prod_id" value="{{ isset($viaticoOther->prod_id)??'' }}">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Maquina</label>: {{$viaticoOther->Machine->maqn_placa }}<br>
                <label>Concepto</label>: {{ $viaticoOther->ConceptPayment->cncp_nombre?? '' }}<br>
                <label>Fecha</label>: {{ $viaticoOther->mqpg_fecha?? '' }}<br>
                <label>Valor pagado</label>: {{ $viaticoOther->mqpg_vlrpagado?? '' }}<br>
                <label>Observación</label>: {{ $viaticoOther->mqpg_obs?? '' }}<br>
            </div>
        </div>

 

    </div>
   
</form>
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>