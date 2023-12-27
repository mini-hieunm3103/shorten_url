<li class="mb-3 nav-item {{request()->is(trim(route('admin.'.$name.'.index', [], false), '/*').'*') || request()->is(trim(route('admin.'.$name.'.index', [], false))) ? 'menu-open': false}}">
    <a href="" class="nav-link {{request()->is(trim(route('admin.'.$name.'.index', [], false), '/*').'*') || request()->is(trim(route('admin.'.$name.'.index', [], false))) ? 'active': false}}">
        <i class="nav-icon fas fa-{{$icon ?? $name }}"></i>
        <p>
            {{$title }}
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item ">
            <a href="{{route('admin.'.$name.'.index')}}" class="nav-link {{request()->is(trim(route('admin.'.$name.'.index', [], false), '/*')) || request()->is(trim(route('admin.'.$name.'.index', [], false))) ? 'active': false}}">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Danh Sách</p>
            </a>
        </li>
        @if(checkPermission($name, 'create', true))
            <li class="nav-item">
                <a href="{{route('admin.'.$name.'.create')}}" class="nav-link {{request()->is(trim(route('admin.'.$name.'.create', [], false), '/*')) || request()->is(trim(route('admin.'.$name.'.create', [], false))) ? 'active': false}}">
                    <i class="nav-icon far fa-circle text-warning"></i>
                    <p>Thêm Mới</p>
                </a>
            </li>
        @endif
    </ul>
</li>
