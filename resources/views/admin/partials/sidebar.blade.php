<aside class="main-sidebar">
    <!-- Brand Logo -->
    <a href="#" class="brand-link d-block clearfix">
        <img src="{{ asset('assets/admin') }}/img/logo.png" alt="Lms" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ 123 }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font books -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>{{ __('admin.dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>{{ __('admin.users') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>{{ __('admin.products') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.invoices.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-invoice"></i>
                        <p>{{ __('admin.invoices') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
