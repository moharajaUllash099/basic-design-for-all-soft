@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-6 col-lg-offset-3 col-md-offset-3">
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
        </div>
    </div>

    <div class="row">
        <crenter></crenter>
        <div class="col-xs-6 col-lg-offset-3 col-md-offset-3">
            @panelPrimary(['title'=> 'CREATE new admin'])
                @slot('body')
                    @form_open(['route'=>'storeUserInfo'])
                        @slot('form_body')
                            <div class="form-group">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name',null,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'name',
                                    'placeholder'   =>  'Full Name',
                                    'required'      =>  'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Select branch') !!}
                                <?php
                                    $all_branch = [
                                        ''      =>  'Select branch',
                                        '0'      =>  'Principal branch',
                                    ];
                                    foreach ($branches as $br){
                                        $all_branch[$br->id]  =  $br->name;
                                    }
                                ?>
                                {!! Form::select('branch',$all_branch,null,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'branch',
                                    'required'      =>  'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('role','Choose User As') !!}
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
                                {!! Form::select('role',$userRoles,null,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'role',
                                    'required'      =>  'required',
                                ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email','Email') !!}
                                {!! Form::email('email',null,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'email',
                                    'placeholder'   =>  'Enter email...',
                                    'required'      =>  'required',
                                ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password','Password') !!}
                                {!! Form::password('password',[
                                    'class'         =>  'form-control',
                                    'id'            =>  'password',
                                    'required'      =>  'required',
                                ]) !!}
                            </div>
                        @endslot
                    @endform_open
                @endslot
            @endpanelPrimary
        </div>
    </div>
@endsection