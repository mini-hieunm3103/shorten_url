@can($permission)
{{--    ngoại trừ action view--}}
    @if($action == 'delete')
        <a href="{{route('admin.'.$module.'.destroy', $data)}}" class="delete-action btn btn-{{$type}}">{{ucwords(__('messages.'.$action, [], 'vi'))}}</a>
    @else
        <a href="{{route('admin.'.$module.'.'.$action, $data)}}" class=" btn btn-{{$type}}">{{ucwords(__('messages.'.$action, [], 'vi'))}}</a>
    @endif
@endcan
