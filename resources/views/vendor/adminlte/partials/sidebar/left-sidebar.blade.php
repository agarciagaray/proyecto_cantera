<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if (config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">
                <li class="nav-header ">
                    MENÚ PRINCIPAL
                </li>

                {{-- @if ($userAuth->hasAllDirectPermissions(['all'])) --}}
                <li class="nav-item has-treeview">
                    <a class="nav-link" href="">
                        <i class="fas fa-user-lock "></i>
                        <p>Administrador<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a class="nav-link" href="{{ route('listUsers') }}">
                                <i class="fas fa-user-friends "></i>
                                <p>Usuarios</p>
                                {{-- <i class="fas fa-angle-left right"></i> --}}
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a class="nav-link" href="{{ route('listPermissions') }}">
                                <i class="fas fa-user-check "></i>
                                <p>
                                    Permisos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a class="nav-link" href="{{ route('listRoles') }}">
                                <i class="fas fa-user-tag "></i>
                                <p>
                                    Roles
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item has-treeview">
                            <a class="nav-link" href="{{ route('listUserRoles') }}">
                                <i class="fas fa-user-tag "></i>
                                <p>
                                    Asoc de usarios a roles
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a class="nav-link" href="{{ route('listRolPermissions') }}">
                                <i class="fas fa-user-tag "></i>
                                <p>
                                    Asoc de permisos a roles
                                </p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a class="nav-link" href="">
                        <i class="fas fa-tag"></i>
                        <p>Entidades principales<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listClients') }}">
                                <!--p>|----</p-->
                                <i class="fas fa-user-tag"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listSuppliers') }}">
                                <i class="fas fa-user-cog"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listSocieties') }}">
                                <i class="fas fa-people-arrows"></i>
                                <p>Sociedades</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listMaterials') }}">
                                <i class="fab fa-buffer"></i>
                                <p>Materiales</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listCommodities') }}">
                                <i class="fas fa-cubes"></i>
                                <p>Materia prima</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listDevices') }}">
                                <i class="fas fa-weight"></i>
                                <p>Dispositivos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a class="nav-link" href="">
                        <i class="fas fa-microchip"></i>
                        <p>Maquinaria<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listMachines') }}">
                                <i class="fas fa-fan"></i>
                                <p>Máquinas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listMachinesTypes') }}">
                                <i class="fab fa-whmcs"></i>
                                <p>Tipos de máquinas</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listDriver') }}">
                                <i class="fab fa-whmcs"></i>
                                <p>Conductores</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listConcPayments') }}">
                                <i class="fas fa-comments-dollar"></i>
                                <p>Conceptos de pagos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listMachinesMovs') }}">
                                <i class="fas fa-luggage-cart"></i>
                                <p>Movimientos de máquinas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listObsMac') }}">
                                <i class="far fa-comment-dots"></i>
                                <p>Observaciones a maquinaria</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listViaticoOther') }}">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <p>Viáticos y otros valores por máquina</p>
                            </a>
                        </li>



                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a class="nav-link" href="">
                        <i class="fas fa-cash-register"></i>
                        <p>Ventas<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listPriceList') }}">
                                <i class="fas fa-city"></i>
                                <p>Lista de precios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listConstructions') }}">
                                <i class="fas fa-city"></i>
                                <p>Obras</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listRemissions') }}">
                                <i class="far fa-file-alt"></i>
                                <p>Remisiones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listConcNov') }}">
                                <i class="far fa-comment-dots"></i>
                                <p>Conceptos de novedades</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listNovRem') }}">
                                <i class="far fa-edit"></i>
                                <p>Novedades de remisiones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listInvoiceAssignment') }}">
                                <i class="far fa-file-code"></i>
                                <p>Preliquidación</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listPreSettlement') }}">
                                <i class="far fa-file-code"></i>
                                <p>Manejo de preliquidación</p>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listLiquidationRemission') }}">
                                <i class="far fa-file-code"></i>
                                <p>Asignación de factura</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a class="nav-link" href="">
                        <i class="fas fa-gas-pump"></i>
                        <p>Tanqueo<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listFuelDischarge') }}">
                                <i class="fas fa-hand-holding-water"></i>
                                <p>Descargas de combustible</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('listCubitanksLoading') }}">
                                <i class="fas fa-fill-drip"></i>
                                <p>Carga de Cubitanques</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listMachineTanking') }}">
                                <i class="fas fa-tractor"></i>
                                <p>Tanqueo de máquinas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a class="nav-link" href="">
                        <i class="fas fa-pallet"></i>
                        <p>Producción<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Options') }}">
                            <i class="fab fa-whmcs"></i>
                                <p>Opciones de %</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listMaterialMovement') }}">
                                <i class="fas fa-truck-moving"></i>
                                <p>Movimiento de material</p>
                            </a>
                        </li>
                    </ul>         
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cerrarop') }}">
                           <i class="fab fa-searchengin"></i>
                                <p>Aprobacion de porcentajes</p>
                                    
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('conversionesporcentajes') }}">
                            <i class="fab fa-squarespace"></i>
                                <p> Cantidad de materiales en salida</p>
                            </a>
                        </li>
                    </ul>
     
                </li>
               
               
                {{-- <li class="nav-item has-treeview">
                    <a class="nav-link" href="">
                        <i class="fas fa-cogs"></i>
                        <p>Otros procesos<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('listMachineryNovelty') }}">
                                <i class="fas fa-wrench"></i>
                                <p>Novedades de maquinaria</p>
                            </a>
                        </li>

                    </ul>
                </li> --}}
                <li class="nav-item has-treeview">
                    <a class="nav-link" href="#">
                        <i class="fas fa-boxes "></i>
                        <p>Inventario<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inventory') }}">
                                <i class="fas fa-search-dollar"></i>
                                <p>Inventario de tanqueo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('inventoryControl') }}">
                                <i class="fas fa-shapes"></i>
                                <p>Control de inventario</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="fas fa-shapes"></i>
                                <p>Salida material</p>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="fas fa-dolly"></i>
                                <p>Ingreso de Material</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <p>Reportes y consultas<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reportRemissions') }}">
                                <i class="fas fa-search-dollar"></i>
                                <p>Remisiones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reportMaterials') }}">
                                <i class="fas fa-search-dollar"></i>
                                <p>Remisiones por material</p>
                            </a>
                        </li>
                        <li class="nav-item">
                             <a class="nav-link" href="{{ route('reportMaterialOverview') }}">
                                <i class="fas fa-search-dollar"></i>
                                <p>Resumén por material</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reportCommodiesProduction') }}">
                               <i class="fas fa-search-dollar"></i>
                               <p>Resumén por materia prima</p>
                           </a>
                       </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reportMaterialOverviewSociety') }}">
                               <i class="fas fa-search-dollar"></i>
                               <p>Resumén por sociedad, material</p>
                           </a>
                       </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reports') }}">
                                <i class="fas fa-shapes"></i>
                                <p>Tanqueo</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}
            </ul>
        </nav>
    </div>


</aside>
