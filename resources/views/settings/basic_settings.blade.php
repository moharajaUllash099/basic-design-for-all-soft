@extends('layouts.app')
<?php
$company = get_basic_setting('company');
$phone = get_basic_setting('phone');
$email = get_basic_setting('email');
$address = get_basic_setting('address');
$currency = get_basic_setting('currency');
$vat = get_basic_setting('vat');
?>
@section('css')
    <link rel="stylesheet" href="{{asset('soft/summernote/css/summernote.css')}}">
    <style>
        textarea{
            resize: none;
        }
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
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @alert(['alerts'=>$alerts])
            @endalert
            {{--validation errors--}}
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    @alert(['alerts'=>['error_'=>$error]])
                    @endalert
                @endforeach
            @endif
            {{--success msg--}}
            @if(session('success_'))
                @alert(['alerts'=>['success_'=>session('success_')]])
                @endalert
            @endif
            {{--error msg--}}
            @if(session('error_'))
                @alert(['alerts'=>['error_'=>session('error_')]])
                @endalert
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            {!! Form::open(['route'=> 'savegeneralSettings']) !!}
            @panelPrimary(['title'=>'General Information'])
            @slot('body')
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#tab-1">Company Info</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#tab-2">Basic Settings</a>
                        </li>
                        {{--<li>
                            <a data-toggle="tab" href="#tab-3">Logo</a>
                        </li>--}}
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('company', 'Company Name') !!} <span style="color: red">*</span>
                                            {!! Form::text('company',$company,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'company',
                                                'required'      =>  'required',
                                                'placeholder'   =>  'Rowshan Soft'
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('phone', 'Phone') !!} <span style="color: red">*</span>
                                            {!! Form::number('phone',$phone,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'phone',
                                                'required'      =>  'required',
                                                'placeholder'   =>  '+880 1533 10 55 64'
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('email', 'Email') !!} <span style="color: red">*</span>
                                            {!! Form::email('email',$email,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'email',
                                                'required'      =>  'required',
                                                'placeholder'   =>  'rowshansoft@gmail.com'
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('address', 'Address') !!} <span style="color: red">*</span>
                                            {!! Form::textarea('address',$address,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'address',
                                                'placeholder'   =>  'Dhaka,Bangladesh',
                                                'rows'          =>  '8'
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('currency', 'Currency') !!} <span style="color: red">*</span>
                                            <?php
                                            $all_currency = [
                                                ''              =>  'Select Your Currency',
                                                'BDT'           =>  '&#2547; - Bangladeshi Taka',
                                                'INR'           =>  '&#8377; - Indian rupee',
                                                'PKR'           =>  '&#8360; - Pakistani rupee',
                                                'USD'           =>  '&#36; - US DOLLAR',
                                            ]
                                            ?>
                                            {!! Form::select('currency',$all_currency,$currency,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'currency'
                                            ]) !!}
                                        </div>
                                        {{--<div class="form-group">
                                            {!! Form::label('vat_id','VAT ID') !!}
                                            {!! Form::text('vat_id',null,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'vat_id'
                                            ]) !!}
                                        </div>--}}
                                        <div class="form-group">
                                            {!! Form::label('vat','VAT') !!}
                                            <div class="input-group">
                                                {!! Form::text('vat',$vat,[
                                                    'class'         =>  'form-control',
                                                    'id'            =>  'vat'
                                                ]) !!}
                                                <div class="input-group-addon">%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div id="tab-3" class="tab-pane">
                            <div class="panel-body">

                            </div>
                        </div>--}}
                    </div>
                </div>
            @endslot
            @slot('footer')
                <p style="height: 25px;">
                    {!! Form::submit('Save Change',["class"=>"btn btn-primary pull-right"]) !!}
                </p>
            @endslot
            @endpanelPrimary
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('soft/summernote/js/summernote.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#address').summernote({
                height: 100,
                placeholder: 'write your company address',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'strikethrough',
                        'superscript','subscript', 'clear']
                    ],
                    ['font', [ 'fontname','fontsize','style','height',/*'color'*/]],
                    ['para', ['ul', 'ol', 'paragraph']],
                    //['link', ['linkDialogShow', 'unlink', 'video','picture']]
                ]
            });
        });
    </script>
@endsection