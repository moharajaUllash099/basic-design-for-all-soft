<pre>
    @if(is_array($d))
        {!! print_r($d) !!}
    @elseif(is_object($d))
        {!! print_r($d) !!}
    @else
        {{ print_r($d) }}
    @endif
</pre>