<form id="form-fuels-shopping">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{  $fuelsshopping->id ?? '' }}">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Proveedor (*)</label>
    
               <select class="form-control select2" name="id_supplier" id="id_supplier">
                   @php 
                    $selected =  $fuelsshopping->id_supplier??'';
                   @endphp
        
                   @foreach($suppliers as $supplier)
                   
                   <option value="{{ $supplier->id }}"   {{ $selected === $supplier->id? 'selected' : ''}}>{{ $supplier->Person->pers_razonsocial ?? $supplier->Person->pers_primernombre .' ' .$supplier->Person->pers_segnombre .' ' .$supplier->Person->pers_primerapell .' ' .$supplier->Person->pers_segapell}}</option>
                   @endforeach
               </select>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                @php
                    $date = \Carbon\Carbon::now();
                @endphp
                <label class="control-label">Fecha de descarga (*)</label>
            
                <input type="date" class="form-control" name="ccmb_fechadescarga" id="ccmb_fechadescarga" value="{{ $fuelsshopping->ccmb_fechadescarga ?? $date->format('Y-m-d') }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Número de remisión (*)</label>
                <input type="text" class="form-control" name="ccmb_numremision" id="ccmb_numremision" value="{{ $fuelsshopping->ccmb_numremision ?? '' }}" autocomplete="off">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Volumén (*)</label>
                <input type="number" min="0" class="form-control" name="ccmb_volumen" id="ccmb_volumen" value="{{ $fuelsshopping->ccmb_volumen ?? '' }}" autocomplete="off">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Unidad (*)</label>
                <select class="form-control select2" name="ccmb_unidad" id="ccmb_unidad" autocomplete="off">
                    @php 
                    $selected = $fuelsshopping->ccmb_unidad??'';
                    @endphp
                    {{--  <option value="LT"  {{ $selected === 'LT' ? 'selected' : ''}}>LT - LITROS</option>  --}}
                    <option value="MC"  {{ $selected === 'MC' ? 'selected' : ''}}>MC - METRO CUBICO</option>
                    <option value="GL"  {{ $selected === 'GL' ? 'selected' : ''}}>GL - GALONES</option>
                </select>
                {{-- <input type="number" min="0"  value="{{ $fuelsshopping->ccmb_unidad ?? '' }}"> --}}
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Valor de unidad</label>
                <input type="number" min="0" class="form-control" name="ccmb_vlrunidad" id="ccmb_vlrunidad" value="{{ $fuelsshopping->ccmb_vlrunidad ?? '' }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Observación</label>
                <textarea class="form-control" name="ccmb_observaciones" id="ccmb_observaciones" >{{ $fuelsshopping->ccmb_observaciones?? '' }}</textarea>

            </div>
        </div>

    </div>

    @include('layouts.button',['function'=>'saveFuelsShopping()'])
</form>

