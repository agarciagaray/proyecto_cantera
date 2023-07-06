<form id="form-cubitanksLoading">
    @csrf
    <input type="hidden" class="form-control" name="cubt_id" id="cubt_id" value="{{ isset($cubitanksLoading->cubt_id)?$cubitanksLoading->cubt_id:'' }}">
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Compra</label>
               <select class="form-control select2" name="cubt_idcompra" id="cubt_idcompra">
                   @php 
                    $selected =  $cubitanksLoading->cubt_idcompra ??'';
                   @endphp
    
                   @foreach($fuelsshoppings as $fuelsshopping)
                   <option value="{{ $fuelsshopping->id }}"   {{ $selected === $fuelsshopping->id ? 'selected' : ''}}>{{ $fuelsshopping->ccmb_numremision }}</option>
                   @endforeach
               </select>

            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Volumen</label>
                <input type="number" min="0" class="form-control" name="cubt_volumen" id="cubt_volumen" value="{{ $cubitanksLoading->cubt_volumen ?? '' }}">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Unidad</label>
                <select class="form-control select2" name="cubt_unidad" id="cubt_unidad">
                    @php 
                    $selected =  $cubitanksLoading->cubt_unidad ??'';
                    @endphp
                    {{--  <option value="LT"  {{ $selected === 'LT' ? 'selected' : ''}}>LT - LITRO</option>  --}}
                    <option value="MC"  {{ $selected === 'MC' ? 'selected' : ''}}>MC - METRO CUBICO</option>
                    <option value="GL"  {{ $selected === 'GL' ? 'selected' : ''}}>GL - GALONES</option>
                </select>
            </div>
        </div>        
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Observación</label>
                <textarea class="form-control" name="cubt_observaciones" id="cubt_observaciones" >{{ $cubitanksLoading->cubt_observaciones?? '' }}</textarea>

            </div>
        </div>

    </div>

    @include('layouts.button',['function'=>'saveCubitanksLoading()'])
</form>