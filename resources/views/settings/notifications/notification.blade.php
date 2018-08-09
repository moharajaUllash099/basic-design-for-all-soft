@extends('layouts.app')

@section('css')
    <style>
        .timeline-item .date{
            width: 15% !important;
            padding-bottom: 12px;
            border-top: 1px solid gainsboro;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @panelWarning(['title'=>'notifications'])
                @slot('body')
                <div class="inspinia-timeline" style="margin-top: -15px">
                    @foreach($notifications as $notify)
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <p>
                                        <?php
                                            $user_info = DB::table('users')->where('id',$notify->uid)->get();
                                            $img = 'default/user.png';
                                            if (isset($user_info[0])){
                                                $img = $user_info[0]->img;
                                            }
                                        ?>
                                        <img src="{{asset('soft/uploads/'.$img)}}" class="w-50 rounded-circle border-violet-1" style="width: 50px !important;margin-top: -25px;">
                                    </p>
                                    <h5>{{ date('d-M-Y h:i:s A',strtotime($notify->created_at)) }}</h5>
                                </div>
                                <div class="col-xs-9 content">
                                    <p class="m-b-xs">
                                        <strong>{{$notify->name}}</strong><br>
                                        ({{get_soft_role($notify->role)}})
                                    </p>
                                    <p>
                                        {{$notify->msg}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endslot

                @slot('footer')
                    <center>
                        {{ $notifications->links() }}
                    </center>
                @endslot
            @endpanelWarning
        </div>
    </div>
@endsection

@section('js')
@endsection