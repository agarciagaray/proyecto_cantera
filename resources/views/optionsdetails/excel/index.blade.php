


<div>
<div class="card card-info">
    <div class="card-header">
        <h1 class="card-title"><b>Porcentajes de salida</b></h1>
    </div>
   <tr style ="width: 300px;text-align:center">

   </tr> 
   </div>
<div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table" id="table-optionsdetails">
                                <thead class="table-primary">
                                    <tr>
                                    <th style="width: 100px;text-align:center">
                                         ID
                                        </th>
                                        <th style="width: 100px;text-align:center">
                                          OPCION
                                        </th>

                                        <th style="width: 100px;text-align:center">
                                           MATERIAL
                                        </th>
                                        <th style="width: 100px;text-align:center">
                                            %
                                        </th>
                                        <th style="width: 100px;text-align:center">
                                          CANTIDAD
                                        </th>
                                        <th style="width: 100px;text-align:center">
                                          TOTAL
                                        </th>
                                      
                                          
                                        <th>
                                            
                                        </th>
                                    <!--    {{-- <th>
                                            Estado
                                        </th> --}}-->
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_optionsdetails" name="tbody_optionsdetails">
                                    @foreach ($porcentajes as $porcentaje)
                                    <tr id="tr_{{ $porcentaje->id }}"
                                    @if ($porcentaje->estado == 'I') style="color:#e3342f" @endif>
                                    <td style="text-align:center">
                                        {{ $porcentaje->Production->id}}
                                    </td>
                                    <td style="text-align:center">
                                        {{
                                            $porcentaje->Production->nom_option
                                        }}
                                    </td>
                                    </tr>
                                    @foreach ($porcentaje->Production->detailOptions as $detail)
                                    <tr>
                                    <td style="text-align:center">

                                        </td>
                                        <td>
                                            
                                            </td>
                                            <td style="text-align:center">
                                                    {{$detail->Material->mate_descripcion}}
                                            </td>
                                            <td style="text-align:center">
                                            {{$detail->porcentaje}}
                                            </td>
                                            <td style="text-align:center">
                                            {{(($detail->porcentaje * $porcentaje->prod_volumen)/100)}}
                                            </td>
                                            @endforeach
                                            <td style="text-align:center">
                                                {{$porcentaje->prod_volumen}}
                                            </td>  
                                            <td style="text-align:center">
                                             
                                            </td>   
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1"
                                                    onclick="ConversionSalida(),true"
                                                        type="button">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                    </button>
                                              </div>
                                            </td>                                       
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            {!!$porcentajes->links()!!}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>