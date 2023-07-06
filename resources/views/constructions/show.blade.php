<b> Nit </b>:
{{ $construction->Client->Person->pers_identif }}
<br>
<b> Nombres y apellidos/Razón social </b>:

{{ $construction->Client->Person->pers_primerapell ?? '' }} {{ $construction->Client->Person->pers_segapell ?? '' }}
{{ $construction->Client->Person->pers_primernombre ?? '' }}
{{ $construction->Client->Person->pers_segnombre ?? '' }}/{{ $construction->Client->Person->pers_razonsocial ?? '' }}
<br>
<b>Nombre de obra</b>:
{{ $construction->obra_nombre }}
<br>
<b>Ciudad</b>:
{{ $construction->Client->Person->City->ciud_nombre }}
<br>
<b>Departamento</b>:
{{ $construction->Client->Person->State->dpto_nombre }}
<br>
<b>Dirección</b>:
{{ $construction->Client->Person->pers_direccion }}
<br>
<b>Procentaje de suministro</b>:
{{ $construction->obra_porcsuministro }}
<br>
<b>Procentaje de transporte</b>:
{{ $construction->obra_porctransporte }}
<br>
<b>Observación</b>:
{{ $construction->obra_obs }}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
