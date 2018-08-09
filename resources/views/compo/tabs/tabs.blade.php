<div class="tabs-container">
    <style>
        .tabs-container .nav-tabs > li.active {
            background-color: #ffffff !important;
        }
        .tabs-container .panel-body{
            border-radius: 0px 0px 5px 5px;
        }
        .tabs-container .tab-content > .active,
        .tabs-container .pill-content > .active{
            background-color: #fff !important;
        }
    </style>
    <?php
        $li = 1;
        $div = 1;
    ?>
    @if(isset($tabs))
        @if(count($tabs['name']) === count($tabs['body']))
        <ul class="nav nav-tabs">
            @foreach($tabs['name'] as $n)
                <li class="{{($li === 1) ? 'active' : '' }}">
                    <a data-toggle="tab" href="#tab-{{$li}}">{!! $n !!}</a>
                </li>
                <?php $li++; ?>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach($tabs['body'] as $b)
                <div id="tab-{{$div}}" class="tab-pane {{($div === 1) ? 'active' : '' }}">
                    <div class="panel-body">
                        {!! $b !!}
                    </div>
                </div>
                <?php $div++ ?>
            @endforeach
        </div>
        @else
            @alert(['alerts'=>['warning'=>'valid format! but tabs name and body must have equal length']])
            @endalert
            <h3>Ex.</h3>
            <pre>
        <?php
                    print_r([
                        'tabs'  =>  [
                            'name'  =>  [
                                'files','upload'
                            ],
                            'body'  =>  [
                                'table',
                                'form'
                            ]
                        ]
                    ]);
                    ?>
        </pre>
        @endif
    @else
        @alert(['alerts'=>['error'=>'Invalid format']])
        @endalert
        <h3>Valid formet is</h3>
        <pre>
        <?php
             print_r([
                 'tabs'  =>  [
                     'name'  =>  [
                         'files','upload'
                     ],
                     'body'  =>  [
                         'table','form'
                     ]
                 ]
             ]);
        ?>
        </pre>
    @endif
</div>