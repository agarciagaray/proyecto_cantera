@foreach ($options as $options)
<tr id="tr_{{ $options->id }}" @if ($options->estado == 'I') style="color:#e3342f" @endif>
  <td>
    {{ $options->Optionsdetails->options_id ?? '' }}
  </td>
  <td>
    {{ $options->nom_option ?? ''}}
  </td>

  <td>
    {{ $options->estado}}
  </td>
  <td>
    @foreach ($options->detailOptions as $detailOption)
    <b>Material:</b> {{ $detailOption->Material->mate_descripcion}}<br>
    <b>Porcentaje</b> :{{$detailOption->porcentaje}}<br>
    <b>estado:</b> {{ $detailOption->estado}}
    <hr>

    @endforeach
  </td>


  <td class="text-right py-0 align-middle">
    <div class="btn-group btn-group-sm">
      <button class="btn btn-info mr-1" onclick="createOptions({{ $options->id }},true)" type="button">
        <i class="fas fa-eye">
        </i>
      </button>
      <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
      @if ($options->estado == 'A')
      <button class="btn btn-primary mr-1" onclick="createOptions({{ $options->id }},false,'{{ $options->id}}')" type="button">
        <i class="fas fa-edit">
        </i>
      </button>
      <button class="btn btn-danger" onclick="deleteOptions({{ $options->id }},'tr_{{ $options->id }}')" type="button">
        <i class="fas fa-trash">
        </i>
      </button>
      @endif

    </div>
  </td>
</tr>
@endforeach