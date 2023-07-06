@foreach ($productions as $production)
                                    <tr id="tr_{{ $production->id }}"
                                    @if ($production->estado == 'I') style="color:#e3342f" @endif>
                                    <td>
                                        {{ $production->Production->id}}
                                    </td>
                                    <td>
                                        {{
                                            $production->Production->nom_option
                                        }}
                                    </td>
                                    </tr>
                                    @foreach ($production->Production->detailOptions as $detail)
                                    <tr>
                                        <td>

                                        </td>
                                        <td>
                                            
                                            </td>
                                            <td>
                                                    {{$detail->Material->mate_descripcion}}
                                            </td>
                                            <td>
                                            {{$detail->porcentaje}}
                                            </td>
                                            <td>
                                            {{(($detail->porcentaje * $production->prod_volumen)/100)}}
                                            </td>
                                            @endforeach
                                            <td>
                                                {{$production->prod_volumen}}
                                            </td>  
                                            <td>
                                             
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