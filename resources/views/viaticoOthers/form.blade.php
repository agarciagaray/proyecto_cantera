<form id="form-machine-payment">
    @csrf
    <input type="hidden" class="form-control" name="id" id="id" value="{{ $viaticoOther->id ?? '' }}">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Maquina</label>
               <select class="form-control select2" name="mqpg_idmaquina" id="mqpg_idmaquina">
                   @php 
                    $selected = $viaticoOther->mqpg_idmaquina??'';
                   @endphp
    
                   @foreach($machines as $machine)
                   <option value="{{ $machine->id }}"   {{ $selected === $machine->id ? 'selected' : ''}}>{{ $machine->maqn_placa }}</option>
                   @endforeach
               </select>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Concepto</label>
               <select class="form-control select2" name="mqpg_concepto" id="mqpg_concepto">
                   @php 
                    $selected =  $viaticoOther->mqpg_concepto ??'';
                   @endphp
    
                   @foreach($concepts as $concept)
                   <option value="{{ $concept->id }}"   {{ $selected === $concept->id ? 'selected' : ''}}>{{ $concept->cncp_nombre }}</option>
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
                <input type="text" disabled class="form-control"  value="{{ $viaticoOther->mqpg_fecha ?? $date->format('Y-m-d') }}">
                <input type="hidden" class="form-control" name="mqpg_fecha" id="mqpg_fecha" value="{{ $viaticoOther->mqpg_fecha ?? $date->format('Y-m-d') }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Valor pagado</label>
                <input type="number" min="0" class="form-control" name="mqpg_vlrpagado" id="mqpg_vlrpagado" value="{{ $viaticoOther->mqpg_vlrpagado ?? '' }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Observación</label>
                <textarea class="form-control" name="mqpg_obs" id="mqpg_obs" >{{ $viaticoOther->mqpg_obs?? '' }}</textarea>

            </div>
        </div>

    </div>

    @include('layouts.button',['function'=>'saveMachinePayment()'])
</form>