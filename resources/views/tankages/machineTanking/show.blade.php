<label>Maquina</label>: {{ $machineTanking->Machine->maqn_placa?? '' }}<br>
<label>Fecha</label>: {{ $machineTanking->tanq_fecha ?? '' }}<br>
<label>Volumen</label>: {{ $machineTanking->tanq_volumen ?? '' }}<br>
<label>Unidad</label>: {{ $machineTanking->tanq_unidad ?? '' }}<br>
<label>Origen</label>: {{ $machineTanking->tanq_origen ?? '' }}<br>
<label>Observación</label>: {{ $machineTanking->tanq_observaciones ?? '' }}<br>

<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
