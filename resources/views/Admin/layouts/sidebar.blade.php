  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              

            {{-- <li class="nav-item">
                <a href="#" class="nav-link @if (Request::is('admin/dashboard')) active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li> --}}
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link @if (Request::is('user*')) active @endif">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>Dashboard</p>
                </a>
            </li>
          
           
            <li class="nav-item">
                <a href="{{ route('customer.index') }}" class="nav-link @if (Request::is('user*')) active @endif">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>Cotomer</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link @if (Request::is('user*')) active @endif">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>Product</p>
                </a>
            </li>
        


            @php
            @endphp

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>