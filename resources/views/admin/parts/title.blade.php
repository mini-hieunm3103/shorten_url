@php
$moduleTitle = [
    'user' => 'Người Dùng',
    'url' => 'URL Rút Gọn',
    'tag'=> 'Nhãn Dán'
]
@endphp
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
                    {{titleBlade(request()->route()->getName(), $moduleTitle)}}
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
