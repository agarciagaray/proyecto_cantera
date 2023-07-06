<b>Id</b>:
    {{ $options->id }}
<br>
<b>Nombre</b>:
    {{ $options->nom_option }}
<br>
<b>Estado</b>:
{{ $options->estado == 'A' ? 'ACTIVO':'INACTIVO' }}
<hr>
<h2>Detalle</h2>
@foreach ($options->detailOptions as $detailOption)
    <b>Material:</b> {{ $detailOption->Material->mate_descripcion}}<br>
    <b>Porcentaje</b> :{{$detailOption->porcentaje}}<br>
    <b>estado:</b> {{ $detailOption->estado}}
    <hr>
@endforeach
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>