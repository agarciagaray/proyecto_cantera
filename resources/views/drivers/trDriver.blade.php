                                        @foreach ($drivers as $driver)
                                        <tr id="tr_{{ $driver->id }}"
                                            @if ($driver->conductor_estado == 'I') style="color:#e3342f" @endif>
                                            <td>
                                                {{ $driver->id }}
                                            </td>
                                            <td>
                                            {{$driver->Person->pers_primernombre}}  
                                            {{$driver->Person->pers_segnombre}}
                                            {{$driver->Person->pers_primerapell}}
                                            {{$driver->Person->pers_segapell  ?? '' }}
                                            </td>
                                            <td>
                                                {{$driver->Person->pers_identif }}
                                            </td>
                                                                        
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info mr-1"
                                                        onclick="createDriver( {{ $driver->id }},true)" type="button">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <!-- Aca debo validar si tiene autorizacion para ejecutar el boton -->
                                                    @if ($driver->conductor_estado == 'A')
                                                    <button class="btn btn-primary mr-1"
                                                        onclick="createDriver({{ $driver->id }},false,'{{ $driver->Person->pers_tipoid }}')"
                                                        type="button">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                   
                                                    <button class="btn btn-danger"
                                                        onclick="deleteDriver({{ $driver->id }},'tr_{{$driver->id }}')"
                                                        type="button">
                                                        <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
