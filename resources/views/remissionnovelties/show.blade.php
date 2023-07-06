<b>Id</b>:
{{ $remissionnovelty->id }}
<br>
<b>Número de remisión</b>:
{{ $remissionnovelty->Remission->num_remission }}
<br>
<b>Concepto</b>:
{{ $remissionnovelty->RemissionConcNovelty->cncn_nombre }}
<br>

@isset($remissionnovelty->Client)
<b>Nuevo cliente</b>: {{ $remissionnovelty->Client->Person->pers_razonsocial ?? '' }}<br>
@endisset

@isset($remissionnovelty->Construction)
<b>Nueva obra:</b> {{ $remissionnovelty->Construction->obra_nombre ?? '' }}<br>
@endisset

@if($remissionnovelty->rmnv_nuevovalor )
<b>Nuevo volumen</b>:
{{ $remissionnovelty->rmnv_nuevovalor }}
<br>
<b>Documento de bascula</b>:
{{ $remissionnovelty->rmnv_doc_vascula }}
<br>
@endif
@if($remissionnovelty->rmnv_fecha )
<b>Nueva fecha</b>:
{{ $remissionnovelty->rmnv_fecha }}
<br>
@endif
<b>Observaciones</b>:
{{ $remissionnovelty->rmnv_obs }}
<br>
<b>Estado</b>:
{{ $remissionnovelty->rmnv_estado }}
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>