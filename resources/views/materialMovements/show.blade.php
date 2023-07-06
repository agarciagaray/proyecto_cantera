<form id="form-material-movement">
    @csrf
    <input type="hidden" class="form-control" name="prod_id" id="prod_id" value="{{ isset($production->id)??'' }}">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Maquina que deposita</label>: {{ $production->Machine->maqn_placa  ??''}}<br>
                <label>Disposito que recibe el material</label>: {{ $production->Device->disp_descripcion ??'' }}<br>
                <label>Material depositado</label>: {{  $production->commodity->matp_descripcion ??'' }}<br>
                <label>Fecha</label>: {{ $production->prod_fecha ?? '' }}<br>
                <label>Número de viaje</label>: {{ $production->prod_numviajes?? '' }}<br>
                <label>Cubicaje</label>: {{ $production->prod_cubicaje?? '' }}<br>
                <label>Volumen</label>: {{ $production->prod_volumen?? '' }} <br>
                <label>Opcion</label>:  @foreach ($production->Options_ as $Option)
                                                 {{$Option->nom_option}}
                                                @endforeach
            </div>
        </div>
    </div>
   
</form>
<hr>
{{--  <button type="button" class="btn btn-danger btn-sm ml-3" onclick="hideModal()">Cancelar</button></div>  --}}
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>