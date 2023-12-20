@php
@endphp
<div class="content-header ">
    <div class="container-fluid mt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size: 36px">{{ titleBlade(request()->route()->getName(), $modules, $actionArr)['title'] }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 d-flex align-items-center justify-content-end">
                <ol class="breadcrumb float-sm-right" style="
                font-size: 18px;
                ">
                    @php echo titleBlade(request()->route()->getName(), $modules, $actionArr)['lists'] @endphp
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
