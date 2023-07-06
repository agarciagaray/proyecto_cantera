


<b>Id</b>:
@foreach ($porcentajes as $porcentaje)
    {{ $porcentaje->id }}
<br>
<b>Nombre</b>:
$porcentaje->Production->nom_option
<br>
<b>Cantidad</b>:
@foreach ($porcentaje->Production->detailOptions as $detail)
{{$detail->Material->mate_descripcion}}
<hr>
<h2>Materiales</h2>
@foreach ($options->detailOptions as $detailOption)
    <b>Material:</b>     {{$detail->Material->mate_descripcion}}<br>
    <b>Porcentaje</b> :   {{$detail->porcentaje}}<br>
    <b>tttt</b>  {{(($detail->porcentaje * $porcentaje->prod_volumen)/100)}}
    <hr>
@endforeach

<br>
<hr>
<b>Total</b>:
{{$porcentaje->prod_volumen}}
</hr>
@endforeach

<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

