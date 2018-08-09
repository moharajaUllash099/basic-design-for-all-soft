@foreach($alerts as $key => $value)
<div class="alert
    @if($key == 'success' || $key == 'info' || $key == 'warning' || $key == 'error')
        alert-{{$key}}
    @elseif($key == 'success_')
        alert-success
    @elseif($key == 'info_')
        alert-info
    @elseif($key == 'warning_')
        alert-warning
    @elseif($key == 'error_')
        alert-error
    @endif
">
    @if($key == 'success')
        <i class="fa fa-check-square-o" aria-hidden="true"></i>
    @elseif($key == 'info')
        <i class="fa fa-info-circle" aria-hidden="true"></i>
    @elseif($key == 'warning')
        <i class="fa fa-hand-paper-o" aria-hidden="true"></i>
    @elseif($key == 'error')
        <i class="fa fa-times-circle" aria-hidden="true"></i>
    @elseif($key == 'success_')
        <i class="fa fa-check-square-o" aria-hidden="true"></i>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    @elseif($key == 'info_')
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    @elseif($key == 'warning_')
        <i class="fa fa-hand-paper-o" aria-hidden="true"></i>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    @elseif($key == 'error_')
        <i class="fa fa-times-circle" aria-hidden="true"></i>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    @endif
        {!! $value or '' !!}
</div>
@endforeach
