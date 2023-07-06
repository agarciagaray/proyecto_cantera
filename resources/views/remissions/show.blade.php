<h5><b>INFORMACIÓN DE REMISIÓN</b></h5>
<div class="row">
    {{--  <div class="col-12 col-sm-4 mb-3">
        <b>Id Obra:</b> {{ $remission->id_obra }}
    </div>  --}}
    <div class="col-12 col-sm-12 mb-3">
        <b>Nombre de la obra:</b> {{ $remission->Construction->obra_nombre ?? '' }}
    </div>
</div>
<div class="row">
    <div class="col-18 col-sm-9 mb-2">
        <b> Cliente:</b>
        @if(isset($remission->Construction))
            {{ $remission->Construction->Client->Person->pers_razonsocial ?? '' }} -
            {{ $remission->Construction->Client->Person->pers_primerapell ?? '' }}
            {{ $remission->Construction->Client->Person->pers_segapell ?? '' }}
            {{ $remission->Construction->Client->Person->pers_primernombre ?? '' }}
            {{ $remission->Construction->Client->Person->pers_segnombre ?? '' }}
        @endif
    </div>
    <div class="col-18 col-sm-9 mb-2">
        <b>Ident:</b>
        @if(isset($remission->Construction))
            {{ $remission->Construction->Client->Person->pers_identif ?? '' }}
        @endif
    </div>

</div>
<div class="row">
    {{--  <div class="col-12 col-sm-4 mb-3">
        <b>Id Sociedad:</b> {{ $remission->id_society }}
    </div>  --}}
    <div class="col-12 col-sm-7 mb-3">
        <b>Sociedad:</b>
        @if(isset($remission->Society))
            {{ $remission->Society->Person->pers_razonsocial ?? '' }} -
            {{ $remission->Society->Person->pers_primerapell ?? '' }}
            {{ $remission->Society->Person->pers_segapell ?? '' }}
            {{ $remission->Society->Person->pers_primernombre ?? '' }}
            {{ $remission->Society->Person->pers_segnombre ?? '' }}
        @endif
    </div>
    <div class="col-18 col-sm-9 mb-2">
        <b>Ident.:</b>
        @if(isset($remission->Society))
            {{ $remission->Society->Person->pers_identif }}
        @endif
    </div>

</div>
<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <b>Placa del vehiculo:</b>
        @if(isset($remission->Machine))
            {{ $remission->Machine->maqn_placa ?? ''}}
        @endif
    </div>
    <div class="col-18 col-sm-9 mb-2">
        <b>Conductor:</b> {{ $remission->Machine->name_complete}}
    </div>
    <!--//Cambiar por direccion-->
  <!--  <div class="col-18 col-sm-9 mb-2">
        <b>Destino:</b> {{ $remission->destiny }}
    </div>-->
</div>
<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <b>Fecha:</b> {{ $remission->remi_fecha }}
    </div>
    <div class="col-18 col-sm-9 mb-2">
        <b>#Factura:</b> {{ $remission->remi_numfactura }}
    </div>
    <div class="col-12 col-sm-5 mb-3">
        <b>Tipo de pago:</b> @foreach($remission->TipoPago as $tipopago)

             {{$tipopago->descripcion}}
        @endforeach
    </div>
    <div class="col-18 col-sm-9 mb-2">
        <b>Estado:</b> {{ $remission->remi_estado }}
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <b>Observaciones:</b> {{ $remission->remi_obs }}
    </div>
</div>
<h5><b>DETALLE REMISIÓN</b></h5>
<table class="table">
    <thead class="table-primary">
        <tr>
            <th>
                Id Mat
            </th>
            <th>
                Material
            </th>
            <th>
                Und
            </th>
            <th>
                Cant
            </th>

        </tr>
    </thead>
    <tbody>
        @foreach ($remission->detailRemissions as $detail)
            <tr>
                <td>
                    {{ $detail->dtrm_idmaterial }}
                </td>
                <td>
                    @if(isset($detail->Material))
                        {{ $detail->Material->mate_descripcion}}
                    @endif
                </td>
                <td>
                    {{ $detail->Unit->unit_descripcion }}
                </td>
                <td>
                    {{ $detail->dtrm_cantdespachada }}
                </td>


            </tr>
        @endforeach
    </tbody>
</table>
@if(count($remission->remissionNovelties)>0)
<h5><b>NOVEDADES DE REMISIÓN</b></h5>
<table class="table">
    <thead class="table-primary">
        <tr>
            <th>
                Id Mat
            </th>
            <th>
                Material
            </th>
            <th>
                Concepto
            </th>
            <th>
                Valor
            </th>
            <th>
                Observación
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($remission->remissionNovelties as $detail)
            <tr>
                <td>
                    {{ $detail->rmnv_idmaterial }}
                </td>
                <td>
                    @if(isset($detail->Material))

                        {{  $detail->Material->mate_descripcion}}
                     @endif
                </td>
                <td>
                    {{ $detail->RemissionConcNovelty->cncn_nombre}}
                </td>
                <td>
                    @if ($detail->rmnv_idconcepto ==  1)
                        @if(isset($detail->Client))
                            {{  $detail->Client->Person->pers_razonsocial ?? '' }}
                        @endif
                    @elseif ($detail->rmnv_idconcepto == 2)
                        {{$detail->rmnv_nuevovalor }}
                    @else
                        {{  $detail->rmnv_fecha ?? '' }}
                    @endif

                </td>
                <td>
                    {{ $detail->rmnv_obs }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
