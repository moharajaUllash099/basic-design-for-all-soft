<?php
$id = (isset($this_record[0])) ? $this_record[0]->id : '';
$name = (isset($this_record[0])) ? $this_record[0]->name : '';
$img = (isset($this_record[0])) ? $this_record[0]->img : '';
$r = (isset($this_record[0])) ? $this_record[0]->role : '';
$email = (isset($this_record[0])) ? $this_record[0]->email : '';
$status = (isset($this_record[0])) ? $this_record[0]->status : '';
$block = (isset($this_record[0])) ? $this_record[0]->block : '';

$branch = (isset($this_record[0])) ? $this_record[0]->branch : '';

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
                    <div class="col-xs-12 col-lg-4">
                        <div class="contact-box" style="min-height: 240px">
                            <a href="javascript:void(0)">
                                <div class="col-sm-4">
                                    <div class="text-center">
                                        <div class="text-center">
                                            @if(!empty($img))
                                                <img alt="image" class="img-circle m-t-xs img-responsive" src="{{asset('soft/uploads/default/'.$img)}}">
                                            @else
                                                <img alt="image" class="img-circle m-t-xs img-responsive" src="{{asset('soft/uploads/default/user.png')}}">
                                            @endif
                                            <div class="m-t-xs font-bold">{{get_soft_role($r)}}</div>
                                        </div>
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
                                        <strong>Working at : </strong>{{get_branch_name($branch)}}
                                    </p>
                                    <p>
                                        <strong>Created At : </strong>{{$created_at}}
                                        @if($created_at != $updated_at)
                                            <br>
                                            <strong> Updated at : </strong>{{$updated_at}}
                                        @endif
                                        {{set_notification()}}
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-8">
                        <div class="contact-box">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    @if($block == 0)
                                        <a class="btn btn-danger btn-rounded btn-block" href="{{url('setting/user/block/'.$id)}}" onclick="return confirm('Are you sure want to block this user?');">
                                            <i class="fa fa-info-circle"></i> Block this user
                                        </a>
                                    @else
                                        <a class="btn btn-primary btn-rounded btn-block" href="{{url('setting/user/unblock/'.$id)}}" onclick="return confirm('Are you sure want to block this user?');">
                                            <i class="fa fa-info-circle"></i> Unblock this user
                                        </a>
                                    @endif
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <a class="btn btn-danger btn-rounded btn-block" href="{{url('setting/user/delete/'.$id)}}" onclick="return confirm('Are you sure want to delete this user?');">
                                        <i class="fa fa-info-circle"></i> Delete this user
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12"><br></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    @form_open(['route'=>['resetUserPassword',$id]])
                                        @slot('form_body')
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-group">
                                                    {!! Form::label('password','Reset Password') !!}
                                                    {!! Form::password('password',[
                                                        'class'         =>  'form-control',
                                                        'id'            =>  'password'
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-group">
                                                    {!! Form::label('Select branch') !!} <span style="color: red">*</span>
                                                    <?php
                                                    $all_branch = [
                                                        ''      =>  'Select branch',
                                                        '0'      =>  'Principal branch',
                                                    ];
                                                    foreach ($branches as $br){
                                                        $all_branch[$br->id]  =  $br->name;
                                                    }
                                                    ?>
                                                    {!! Form::select('branch',$all_branch,$branch,[
                                                        'class'         =>  'form-control',
                                                        'id'            =>  'branch',
                                                        'required'      =>  'required',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-group">
                                                    {!! Form::label('role','Choose User As') !!} <span style="color: red">*</span>
                                                    @php
                                                        $userRoles = array(
                                                            ''  =>  'Select user role'
                                                        );
                                                    @endphp
                                                    @foreach($roles as $role)
                                                        @if($role->id != 1)
                                                            @php
                                                                $userRoles[$role->id] = ucwords($role->role_type)
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    {!! Form::select('role',$userRoles,$r,[
                                                        'class'         =>  'form-control',
                                                        'id'            =>  'role',
                                                        'required'      =>  'required',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        @endslot
                                    @endform_open
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endslot
            @endpanelPrimary
        </div>
    </div>
@endsection

@section('js')
@endsection