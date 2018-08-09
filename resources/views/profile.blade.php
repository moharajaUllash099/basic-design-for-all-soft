<?php
$id = (isset($this_record[0])) ? $this_record[0]->id : '';
$name = (isset($this_record[0])) ? $this_record[0]->name : '';
$img = (isset($this_record[0])) ? $this_record[0]->img : '';
$role = (isset($this_record[0]) && !empty($this_record[0]->role)) ? get_soft_role($this_record[0]->role) : '';
$email = (isset($this_record[0])) ? $this_record[0]->email : '';
$status = (isset($this_record[0])) ? $this_record[0]->status : '';
$block = (isset($this_record[0])) ? $this_record[0]->block : '';

$created_at = (isset($this_record[0])) ? date('d-M-Y',strtotime($this_record[0]->created_at)) : '';
$updated_at = (isset($this_record[0])) ? date('d-M-Y',strtotime($this_record[0]->updated_at)) : '';
?>
@extends('layouts.app')
@section('css')
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
            @panelPrimary(['title'=> $name.' information'])
                @slot('body')
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <div class="contact-box">
                            <a href="javascript:void(0)">
                                <div class="col-sm-4">
                                    <div class="text-center">
                                        @if(!empty(Auth::user()->img))
                                            <img class="img-circle m-t-xs img-responsive" alt="{{$name}} profile image" src="{{ asset('soft/uploads/'.Auth::user()->img) }}">
                                        @else
                                            <img class="img-circle m-t-xs img-responsive" alt="{{$name}} profile image" src="{{ asset('soft/uploads/default/user.png') }}">
                                        @endif
                                        <div class="m-t-xs font-bold">{{$role}}</div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <h3><strong>{{$name}}</strong></h3>
                                    <p>
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i> {{$email}}
                                    </p>
                                    <p>
                                        @if($status == 0)
                                            <span class="badge badge-primary">email verified</span>
                                        @else
                                            <span class="badge badge-danger">email not verified</span>
                                        @endif

                                        @if($block == 0)
                                            <span class="badge badge-primary">login open</span>
                                        @else
                                            <span class="badge badge-danger">login block</span>
                                        @endif
                                    </p>
                                    <p>
                                        Created At : <strong>{{$created_at}}</strong>
                                        @if($created_at != $updated_at)
                                            <br>
                                            Updated at : <strong>{{$updated_at}}</strong>
                                        @endif
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <div class="contact-box" style="padding-bottom: 50px;">
                            @form_upload(['route'=>'updateProfile'])
                            {{--['route'=>'updateAdminProfile']--}}
                            @slot('form_body')
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('name', 'Name') !!} <span style="color: red">*</span>
                                            {!! Form::text('name',$name,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'name',
                                                'placeholder'   =>  'Full Name',
                                                'required'      =>  'required',
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('email','Email') !!} <span style="color: red">*</span>
                                            {!! Form::email('email',$email,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'email',
                                                'placeholder'   =>  'Enter email...',
                                                'required'      =>  'required',
                                            ]) !!}
                                        </div>
                                        <label class="addImg">
                                            <span id="validimg"></span>
                                            <div class="image_preview" id="image_preview1" style="border: 1px dotted;padding: 10px 5px;width: 135px;">
                                                @if(!empty($img))
                                                    <img style="max-width: 250px;max-height: 150px;" src="{{asset('soft/uploads/'.$img)}}" alt="{{$name}}" id="previewing1">
                                                @else
                                                    <img id="previewing1"  src="{{asset('soft/uploads/default/addPic.png')}}" alt="user picture" height="200px" width="150px" style="background-color: lightgray; margin-left: 5px;height: 110px;width: 110px;" class="custom-img-thumbnail" />
                                                @endif
                                                {{--visibility: hidden;--}}
                                                {{Form::file('img',[
                                                    //'style' =>  "margin-top: -20px;",
                                                    'class' =>  'customfile'
                                                ])}}
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('oldpassword','Old Password') !!}
                                            {!! Form::password('oldpassword',[
                                                'class'         =>  'form-control',
                                                'id'            =>  'oldpassword'
                                            ]) !!}
                                            Note: If you don't want to update password live it blank
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('password','new Password') !!}
                                            {!! Form::password('password',[
                                                'class'         =>  'form-control',
                                                'id'            =>  'password'
                                            ]) !!}
                                            Note: Password must be minimum 8 characters long
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('password_confirmation','Confirm Password') !!}
                                            {!! Form::password('password_confirmation',[
                                                'class'         =>  'form-control',
                                                'id'            =>  'newpassword'
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            @endslot
                            @endform_upload
                        </div>
                    </div>
                </div>
                @endslot
            @endpanelPrimary
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $(document).on('change', '.customfile', function(e){
                var addPic = "{{asset('soft/uploads/default/addPic.png')}}";
                $("#validimg").empty(); // To remove the previous error message
                $('img > #previewing1').attr('src',addPic);
                var file = this.files[0];
                if(typeof file == "undefined"){
                    $('#image_preview1 >img').attr('src',addPic);
                }else
                {
                    var imagefile = file.type;
                    var match= ["image/jpeg", "image/jpg","image/png"];
                    if(!((imagefile == match[0]) || (imagefile == match[1])|| (imagefile == match[2]) ))
                    {
                        $('#image_preview1 >img').attr('src',addPic);
                        $("#validimg").html('<span style="color:red">Invalid formet<br>Note: Only jpeg and jpg Images type allowed</span>');
                        return false;
                    }
                    else
                    {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);
                        imgtype = true;
                    }
                }
            });

            function imageIsLoaded(e) {
                $('#previewing1').attr('src', e.target.result);
                $('#previewing1').attr('width', '150px');
                $('#previewing1').attr('height', '200px');
            };
        });
    </script>
@endsection
