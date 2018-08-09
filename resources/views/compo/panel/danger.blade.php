<div class="panel panel-danger">
    <div class="panel-heading">
        @if(isset($title))
            {{strtoupper($title)}}
        @endif
    </div>
    <div class="panel-body">
        {{$body or ''}}
    </div>
    @if(isset($footer))
        <div class="panel-footer">{{$footer}}</div>
    @endif
</div>