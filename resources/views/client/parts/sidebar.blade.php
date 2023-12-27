<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4 ">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard.index')}}" class="brand-link">
        <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Shorten URL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('client/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <nav class="mt-3 pb-1"  style="border-bottom: 2px solid #f1e8e8">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent " data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item mb-2" style="margin-left: 4px; ">
                    <a href="#" class="nav-link active" style="width: auto; padding: 6px 0; margin: 8px 16px; border: 1px; border-radius: 5px">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>
                            Create Shorten URL
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item mb-3" style="margin: 4px;">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item mb-3" style="margin: 4px;border-bottom: 2px solid #f1e8e8">
                    <a href="#" class="nav-link active mb-3" >
                        <i class="nav-icon fas fa-link "></i>
                        <p>
                            Links
                        </p>
                    </a>
                </li>
                <li class="nav-item mb-3" style="margin-left: 4px; ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
