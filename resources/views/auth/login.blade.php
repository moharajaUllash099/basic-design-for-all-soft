<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - {{ config('app.subtitle') }}</title>
    <link href="{{asset('soft/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('soft/fonts/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    {{--<link href="{{asset('soft/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('soft/css/style.css')}}" rel="stylesheet">--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .gray-bg{
            background-color: #d2d6de;
        }
    </style>
</head>
<body class="gray-bg">
<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <img class="img-responsive" src="{{asset('soft/uploads/default/golden_pos.png')}}" alt="golden poss">
        </div>
        <div class="col-md-6">
            <div class="ibox-content">
                @alert(['alerts'=>$alerts])
                @endalert
                {{--validation errors--}}
                @if(count($errors) > 0)
                    {{--@alert(['alerts'=>$errors])
                    @endalert--}}
                    @foreach($errors->all() as $error)
                        @alert(['alerts'=>['error_'=>$error]])
                        @endalert
                    @endforeach
                @endif
                {{--session msg--}}
                @if($message = Session::get('alerts'))
                    {{--@if(session('success_'))--}}
                    @alert(['alerts'=>$message])
                    @endalert
                @endif
                @form_open(['route'=>'login'])
                    @slot('form_body')
                        <div class="form-group">
                            {!! Form::label('email','Email') !!}
                            {!! Form::email('email','admin@admin.com',[
                                'class'         =>  'form-control',
                                'id'            =>  'email',
                                'placeholder'   =>  'Enter email...',
                                'required'      =>  'required',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password','Password') !!}
                            <input class="form-control" id="password" required="required" placeholder="Enter password..." value="admin@admin.com" name="password" type="password">
                            {{--{!! Form::password('password',[
                                'class'         =>  'form-control',
                                'id'            =>  'password',
                                'required'      =>  'required',
                                'placeholder'   =>  'Enter password...',
                                'value'         =>  'admin@admin.com'
                            ]) !!}--}}
                        </div>
                    @endslot
                    @slot('form_footer')
                        {!! Form::submit('Login',["class"=>"btn btn-primary block full-width m-b"]) !!}
                    @endslot
                @endform_open
                <hr style="border-top: 1px solid #126612;margin-right: -20px;margin-left: -20px;">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            Copyright <a target="_blank" href="http://rowshansoft.com"><strong>Rowshan Soft</strong></a>
        </div>
        <div class="col-xs-6 text-right">
            <small>&copy; 2018-{{date('Y')}}</small>
        </div>
    </div>
</div>
</body>
</html>