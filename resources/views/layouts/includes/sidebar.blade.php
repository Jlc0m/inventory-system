<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- SidebarSearch Form -->
    <form action="{{ route('interior_number') }}" method="GET" class="mt-1">
        <div class="form-inline">
            <div class="input-group">
                <input class="form-control form-control-sidebar" placeholder="Search" aria-label="Search"
                    name="interior_number">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-is-opening menu-open">
                <a href="" class="nav-link text-white">
                    <i class="nav-icon fas fa-solid fa-boxes-stacked"></i>
                    <p>
                        Инвентарь
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('my-cities') }}" class="nav-link">
                            <i class="far fa-solid fa-city nav-icon"></i>
                            <p>Города</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-solid fa-warehouse nav-icon"></i>
                            <p>Склада</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-solid fa-briefcase nav-icon"></i>
                            <p>Офиса</p>
                        </a>
                    </li>
                </ul>


                {{-- <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('inventories.create') }}" class="nav-link">
                            <i class="far fa-solid fa-plus nav-icon"></i>
                            <p>Добавить</p>
                        </a>
                    </li>
                </ul> --}}
            </li>

            {{-- SCAN MENU --}}
            <li class="nav-item menu-is-opening menu-open">
                <a href="#" class="nav-link">
                  <i class="far fa-solid fa-barcode nav-icon"></i>
                  <p>
                    SCAN
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('scan-search') }}" class="nav-link">
                        <i class="fas fa-search nav-icon"></i>
                        <p>Поиск</p>
                      </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('scan-inventory') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Добавить IT-AMS</p>
                    </a>
                  </li>
                </ul>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('scan-inventories-relocate') }}" class="nav-link">
                      <i class="far fa-solid fa-minus nav-icon"></i>
                      <p>Отправить</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('scan-inventories-receive') }}" class="nav-link">
                      <i class="far fa-solid fa-plus nav-icon"></i>
                      <p>Принять</p>
                    </a>
                  </li>
                  </ul>
              </li>
            {{-- // SCAN MENU --}}

            {{--SMALL PRICE INVENTORY--}}
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-solid fa-cookie-bite nav-icon"></i>
                  <p>
                    Малоценка
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('small-price-inventory.create') }}" class="nav-link">
                            <i class="far fa-solid fa-plus nav-icon"></i>
                            <p>Добавить малоценку</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('view-extradition') }}" class="nav-link">
                            <i class="far fa-solid fa-minus nav-icon"></i>
                            <p>Выдать малоценку</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('myLeftovers') }}" class="nav-link">
                            <i class="far fa-solid fa-plus nav-icon"></i>
                            <p>Мои остатки малоценки</p>
                        </a>
                    </li>
                </ul>
              </li>
            {{-- // SMALL PRICE INVENTORY --}}

            
            <li class="nav-item">
                <a href="" class="nav-link text-white">
                    <i class="nav-icon fas fa-solid fa-user-group"></i>
                    <p>
                        Сотрудники
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-solid fa-truck-ramp-box nav-icon"></i>
                            <p>Выдача инвентаря</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('myLeftovers') }}" class="nav-link">
                            <i class="far fa-solid fa-plus nav-icon"></i>
                            <p>Мои остатки малоценки</p>
                        </a>
                    </li>
                </ul>
            </li>

            @can('SuperAdmin')
                <li class="nav-item menu-is-opening menu-open">
                    <a href="" class="nav-link text-white">
                        <i class="nav-icon fas fa-screwdriver-wrench"></i>
                        <p>
                            Администрирование
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-solid fa-truck-ramp-box nav-icon"></i>
                                <p>Setting</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="far fa-solid fa-cart-flatbed nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('countries.index') }}" class="nav-link">
                                <i class="far fa-solid fa-earth-americas nav-icon"></i>
                                <p>Countries</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('companies.index') }}" class="nav-link">
                                <i class="far fa-solid fa-building nav-icon"></i>
                                <p>Companies</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cities.index') }}" class="nav-link">
                                <i class="far fa-solid fa-city nav-icon"></i>
                                <p>Cities</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('offices.index') }}" class="nav-link">
                                <i class="far fa-solid fa-briefcase nav-icon"></i>
                                <p>Offices</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('stocks.index') }}" class="nav-link">
                                <i class="far fa-solid fa-warehouse nav-icon"></i>
                                <p>Stocks</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="far fa-solid fa-bars-progress nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('conditions.index') }}" class="nav-link">
                                <i class="far fa-solid fa-bars-progress nav-icon"></i>
                                <p>Conditions</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('departments.index') }}" class="nav-link">
                                <i class="far fa-solid fa-bars-progress nav-icon"></i>
                                <p>Departments</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="far fa-solid fa-bars-progress nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link">
                                <i class="far fa-solid fa-bars-progress nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
