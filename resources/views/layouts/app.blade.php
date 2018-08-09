<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - {{--{{ config('app.subtitle') }}--}}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var token = "<?php print_r(csrf_token()) ?>";
        var url = "<?php echo (url('/')) ?>/";
    </script>
    {{--favicons--}}
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{asset('soft/favicon/apple-touch-icon-57x57.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('soft/favicon/apple-touch-icon-114x114.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('soft/favicon/apple-touch-icon-72x72.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('soft/favicon/apple-touch-icon-144x144.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{asset('soft/favicon/apple-touch-icon-60x60.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{asset('soft/favicon/apple-touch-icon-120x120.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{asset('soft/favicon/apple-touch-icon-76x76.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{asset('soft/favicon/apple-touch-icon-152x152.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('soft/favicon/favicon-196x196.png')}}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{asset('soft/favicon/favicon-96x96.png')}}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{asset('soft/favicon/favicon-32x32.png')}}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{asset('soft/favicon/favicon-16x16.png')}}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{asset('soft/favicon/favicon-128.png')}}" sizes="128x128" />
    <meta name="application-name" content="Point of sale - golden shop"/>
    <meta name="msapplication-TileColor" content="#" />
    <meta name="msapplication-TileImage" content="mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    {{--jquery--}}
    <script type="text/javascript" src="{{ asset('soft/jquery/jquery-3.3.1.min.js') }}"></script>
    {{--bootstrap--}}
    <link rel="stylesheet" href="{{ asset('soft/bootstrap/css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ asset('soft/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

    {{--Font Awesome--}}
    <link rel="stylesheet" href="{{ asset('soft/fonts/font-awesome/css/font-awesome.min.css') }}">
    <!-- Batch Icons -->
    <link rel="stylesheet" href="{{ asset('soft/fonts/batch-icons/css/batch-icons.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
    <style>

    </style>
</head>
<body class="top-navigation">
<div id="wrapper">
    <div class="row">
        <nav class="navbar navbar-default navbar-fixed-top damal-nev">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        @if(have_permission([0]))
                        <li class="hidden-xs">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="badge d-badge">99+</span>
                                <div class="notification">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <div class="noti-head text-light bg-damal-green">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <span>Messages (3)</span>
                                        </div>
                                    </div>
                                </div>
                                <ul id="show-notification">
                                    {{--all notifications--}}
                                    <li class="message-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <strong class="text-info">David John</strong>
                                                <div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                </div>
                                                <small class="text-warning">27.11.2015, 15:00</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="message-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <strong class="text-info">David John</strong>
                                                <div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                </div>
                                                <small class="text-warning">27.11.2015, 15:00</small>
                                            </div>
                                        </div>
                                    </li>
                                    {{--all notifications--}}
                                </ul>
                                <div class="noit-footer bg-damal-green text-center">
                                    <a href="" class="text-light">View All</a>
                                </div>
                            </div>
                        </li>
                        @endif
                        @if(have_permission([1,2]))
                        <li class="hidden-xs">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="show_notification">
                                <?php
                                    $total_notifications = DB::table('notifications')->where('status',0)->count();
                                    //$total_notify = ;
                                    $notification_limit = 6;
                                    if($total_notifications > 6){
                                        $notification_limit = $total_notifications;
                                    }else{
                                        $n_limit = $total_notifications+(6-$total_notifications);
                                        $notification_limit = $n_limit;
                                    }
                                    $home_notifications = DB::table('notifications')->limit($notification_limit)->latest()->get();
                                ?>
                                {{--@if($total_notifications > 0)--}}
                                    <span class="{{($total_notifications > 0) ? 'badge d-badge' : '' }}" id="total_new_notification">
                                        @if($total_notifications > 0)
                                            {{$total_notifications}}
                                        @endif
                                    </span>
                                {{--@endif--}}
                                <div class="notification">
                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <div class="noti-head text-light bg-damal-green">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <span>Recent notifications (<span id="recent_noti">{{$total_notifications}}</span>)</span>
                                        </div>
                                    </div>
                                </div>
                                <ul id="show-notification">
                                    {{--all notifications--}}
                                    @foreach($home_notifications as $hn)
                                    <li class="notification-box">
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-3 col-3 text-center p-r-0">
                                                <?php
                                                    $user_info = DB::table('users')->where('id',$hn->uid)->get();
                                                    $img = 'default/user.png';
                                                    if (isset($user_info[0])){
                                                        $img = $user_info[0]->img;
                                                    }
                                                ?>
                                                <img src="{{ asset('soft/uploads/'.$img) }}" class="w-50 rounded-circle border-violet-1" >
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-8 p-l-0">
                                                <strong>{{$hn->name}}</strong>
                                                ({{get_soft_role($hn->role)}})<br>
                                                <small>
                                                    <strong>{{ date('d-M-Y h:i:s A',strtotime($hn->created_at)) }}</strong>
                                                </small>
                                                <div>
                                                    {{$hn->msg}}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    {{--all notifications--}}
                                </ul>
                                <div class="noit-footer bg-damal-green text-center">
                                    <a href="{{url('notifications')}}" class="text-light">View All</a>
                                </div>
                            </div>
                        </li>
                        @endif
                        <li>
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 20px;padding-bottom: 20px;">
                                <div class="profile">
                                    <div class="profile-name pull-left">
                                        {{ Auth::user()->name }}
                                        <span class="caret"></span>
                                    </div>
                                    <div class="profile-picture bg-warning pull-right" style="background-color: #fff !important;">
                                        @if(!empty(Auth::user()->img))
                                            <img src="{{ asset('soft/uploads/'.Auth::user()->img) }}" width="44" height="44">
                                        @else
                                            <img src="{{ asset('soft/uploads/default/user.png') }}" width="44" height="44">
                                        @endif
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu show-profile">
                                <li>
                                    <a href="{{url('/profile')}}">Profile</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-default damal-fixed-top damal-menu-nev">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('') }}">{{--{{ config('app.subtitle') }}--}}</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav d-nav">
                        <li>
                            <a class="{{(isset($active_menu) && $active_menu['name'] == 'dashboard' ) ? 'active' : '' }}" href="{{ url('/') }}">
                                <i class="fa fa-th-large" aria-hidden="true"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"
                               class="dropdown-toggle {{(isset($active_menu) && $active_menu['name'] == 'product_setting' ) ? 'active' : '' }}"
                               data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-product-hunt" aria-hidden="true"></i>
                                Product Setting
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ url('product/category') }}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'product_category' ) ? 'active': '' }}">
                                        Product Category
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ url('product/?/?') }}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'new_page' ) ? 'active': '' }}">
                                        other product related options
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="dropdown-toggle {{(isset($active_menu) && $active_menu['name'] == 'settings' ) ? 'active' : '' }}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                Setting
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ url('setting/general') }}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'general_setting' ) ? 'active': '' }}">
                                        General
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('setting/branch') }}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'all_branch' ) ? 'active': '' }}">
                                        Branch Setup
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ url('setting/users') }}"  class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'users' ) ? 'active': '' }}">
                                        users
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="page-wrapper" class="gray-bg" style="padding-top: 1px">
        {{--breadcrumb--}}
        <section class="breadcrumb-section" style="border-radius: 5px">
            <div class="row">
                <div class="col-lg-4 hidden-xs">
                    <h2>
                        {{ isset($active_menu) ? ucwords(str_replace('_',' ',$active_menu['name'])) : '' }}
                        <small>Control panel</small>
                    </h2>
                </div>
                <div class="col-lg-8 col-xs-12">
                    <div class="btn-group btn-breadcrumb pull-right">
                        <a href="{{ url('/') }}" class="btn btn-default">
                            <i class="glyphicon glyphicon-home"></i>
                        </a>
                        @if(isset($active_menu) && isset($active_menu['name']) && isset($active_menu['link']))
                        <a href="{{ ($active_menu['link'] != 'javascript:void(0)') ? url($active_menu['link']) : 'javascript:void(0)' }}" class="btn btn-default">
                            {{ ucwords(str_replace('_',' ',$active_menu['name'])) }}
                        </a>
                        @endif
                        {{--active_child_menu--}}
                        @if(isset($active_child_menu) && isset($active_child_menu['name']) && isset($active_child_menu['link']))
                            <a href="{{ ($active_child_menu['link'] != 'javascript:void(0)') ? url($active_child_menu['link']) : 'javascript:void(0)' }}" class="btn btn-default">
                                {{ ucwords(str_replace('_',' ',$active_child_menu['name'])) }}
                            </a>
                        @endif
                        {{--grandchild--}}
                        @if(isset($active_grandchild_menu) && isset($active_grandchild_menu['name']) && isset($active_grandchild_menu['link']))
                            <a href="{{ ($active_grandchild_menu['link'] != 'javascript:void(0)') ? url($active_grandchild_menu['link']) : 'javascript:void(0)' }}" class="btn btn-default">
                                {{ ucwords(str_replace('_',' ',$active_grandchild_menu['name'])) }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <div class="wrapper wrapper-content">
            @yield('content')
        </div>
        <div class="footer">
            <div class="pull-right">
                <strong>RS-G-POS-1.0.1</strong>
            </div>
            <div>
                <strong>Copyright</strong> <a target="_blank" href="http://rowshansoft.com"><strong>Rowshan Soft</strong></a> © 2018-{{date('Y')}}
            </div>
        </div>
    </div>
    @if(have_permission([1,2]))
        <script>
            $(document).ready(function () {
                /*window.setInterval(function(){
                    $.get(url+"check_jquery_login", function(data){
                        if(data == 'true'){ //check user is loged in or not
                            $.get(url+"get_total_new_notification", function(data){
                                if (data['status'] == 'success'){
                                    $('#total_new_notification').addClass('badge');
                                    $('#total_new_notification').addClass('d-badge');
                                    $('#total_new_notification').text(data['data']);
                                    $('#recent_noti').text(data['data']);
                                }
                            });
                        }else{
                            location.reload();
                        }
                    });
                }, 1000);//10 second if you want to make it 5 second it will 10000 to 5000

                $('#show_notification').on('click',function () {
                    $('#total_new_notification').text('')
                    //$('#total_new_notification').removeClass('badge');
                    //$('#total_new_notification').removeClass('d-badge');
                });*/

                $('#show_notification').on('click',function () {
                   //console.log('ok')
                    $.get(url+"notification_see", function(data){
                        if (data == 'true'){
                            $('#total_new_notification').removeClass('badge')
                            $('#total_new_notification').removeClass('d-badge')
                            $('#total_new_notification').text('');
                            $('#recent_noti').text('0');
                        }
                    });
                });
            });
        </script>
    {{--@elseif()--}}
        {{--<script>
            $(document).ready(function () {

            });
        </script>--}}
    @endif
    @yield('js')
</div>
</body>
</html>