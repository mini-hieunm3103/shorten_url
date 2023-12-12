
<div class="content-header ">
    <div class="container-fluid mt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size: 36px">{{(!empty($title) ? $title : 'Dashboard')}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 d-flex align-items-center justify-content-end">
                <ol class="breadcrumb float-sm-right" style="
                font-size: 18px;
                ">
                    @if(!empty($title))
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">Quản Lý Người Dùng</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    @else
                        <li class="breadcrumb-item active">Home</li>
                    @endif
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
