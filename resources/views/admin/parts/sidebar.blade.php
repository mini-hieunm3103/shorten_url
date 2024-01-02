<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard.index')}}" class="brand-link">
        <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Shorten URL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('admin.user.show', auth()->user()->id)}}" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                @foreach($modules as $name => $data)
                    @if(checkPermission($name, 'view', true))
                        <li class="nav-header">{{ strtoupper($name).'S' }}</li>
                        {{--                @dd($data['title'], $name, !empty($data['icon']) ? $data['icon'] : $name)--}}
                        @include('admin.parts.menu', [
                            'name' => $name,
                            'title' => $data['title'],
                            'icon' => !empty($data['icon']) ? $data['icon'] : $name,
                        ])
                    @endif
                @endforeach
            </ul>
        </nav>
        <nav class="mt-3 pt-4"  style="border-top: 2px solid #f1e8e8">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent " data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item mb-2" style="margin-left: 4px; ">
                    <a href="{{route('client.links.index')}}" class="nav-link active" style="width: auto; padding: 6px 0; margin: 8px 16px; border: 1px; border-radius: 5px">
                        <i class="nav-icon fas fa-arrow-alt-circle-left"></i>
                        <p>
                            Redirect to client page
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
