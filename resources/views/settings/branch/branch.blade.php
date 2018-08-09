<?php
$id = (isset($this_record[0])) ? $this_record[0]->id : '';
$name = (isset($this_record[0])) ? $this_record[0]->name : old('name');
$address = (isset($this_record[0])) ? $this_record[0]->address : old('address');
$phone = (isset($this_record[0])) ? $this_record[0]->phone : old('phone');
$email = (isset($this_record[0])) ? $this_record[0]->email : old('email');
$vat_id = (isset($this_record[0])) ? $this_record[0]->email : old('vat_id');
?>
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('soft/summernote/css/summernote.css')}}">
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
        <div class="col-xs-12">
            @panelPrimary(['title'=>'Branch Information'])
                @slot('body')
                    @if(!empty($id))
                    @form_open(['route'=>['updateBranch',$id]])
                    @else
                    @form_open(['route'=>'storeBranch'])
                    @endif
                        @slot('form_body')
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!} <span style="color: red">*</span>
                                        {!! Form::text('name',$name,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'name',
                                            'placeholder'   =>  'Branch Name',
                                            'required'      =>  'required',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('phone', 'Phone') !!} <span style="color: red">*</span>
                                        {!! Form::number('phone',$phone,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'phone',
                                            'placeholder'   =>  'Phone Number',
                                            'required'      =>  'required',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email') !!} <span style="color: red">*</span>
                                        {!! Form::email('email',$email,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'email',
                                            'placeholder'   =>  'Email Address'
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('vat_id', 'Vat ID') !!} <span style="color: red">*</span>
                                        {!! Form::text('vat_id',$vat_id,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'vat_id',
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
                        @endslot
                    @endform_open
                @endslot
            @endpanelPrimary
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('soft/summernote/js/summernote.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#address').summernote({
                height: 200,
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