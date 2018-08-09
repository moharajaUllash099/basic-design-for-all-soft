
{!! Form::open( isset($route) ? ['route' => $route] : ['url' => '#']) !!}
    {{ $form_body or '' }}
    @if(!isset($form_footer))
        <hr style="margin-left: -15px;margin-right: -15px;border-top: 1px solid #1ab394">
        {!! Form::submit('Save Change',["class"=>"btn btn-primary pull-right"]) !!}
    @else
        {{$form_footer}}
    @endif
{!! Form::close() !!}
