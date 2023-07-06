<form id="form-machineOb">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ isset($machineOb->id)?$machineOb->id:'' }}">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Maquina</label>
               <select class="form-control select2" name="mqdt_idmaquina" id="mqdt_idmaquina">
                   @php 
                    $selected = $machineOb->mqdt_idmaquina??'';
                   @endphp
    
                   @foreach($machines as $machine)
                   <option value="{{ $machine->id }}"   {{ $selected === $machine->id ? 'selected' : ''}}>{{ $machine->maqn_placa }}</option>
                   @endforeach
               </select>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fecha</label>
                @php
                    $date = \Carbon\Carbon::now();
                @endphp
                <input type="text" class="form-control" value="{{ $machineOb->mqdt_fecha ?? $date->format('Y-m-d') }}" disabled>
                <input type="hidden" class="form-control" name="mqdt_fecha" id="mqdt_fecha" value="{{ $machineOb->mqdt_fecha ?? $date->format('Y-m-d') }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Observación</label>
                <textarea class="form-control" name="mqdt_obs" id="mqdt_obs" >{{ $machineOb->mqdt_obs?? '' }}</textarea>

            </div>
        </div>

    </div>

    @include('layouts.button',['function'=>'saveMachineOb()'])
</form>