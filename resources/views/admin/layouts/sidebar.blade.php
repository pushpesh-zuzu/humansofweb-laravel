<aside class="main-sidebar sidebar-dark-primary elevation-3">
    <a href="javascript:void(0);" class="brand-link d-flex justify-content-center align-items-center">
        <span class="brand-text font-weight-bold">
            Humans Of Web
        </span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                {{-- Enquiries --}}
                <li class="nav-item">
                    <a href="{{ url('admin/enquiries') }}" class="nav-link {{ Route::currentRouteName() == 'admin.enquiries' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>Enquiries</p>
                    </a>
                </li>


            </ul>
        </nav>
    </div>
</aside>