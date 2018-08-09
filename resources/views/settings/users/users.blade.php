@extends('layouts.app')
@section('css')
    <style>
        #users-table_filter{
            text-align: right;
        }
        .pagination{
            margin: 0px;float: right;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-offset-10 col-md-2">
            <a class="btn btn-primary pull-right" style="margin-bottom: 20px" href="{{url('setting/user/new')}}">Create User</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @alert(['alerts'=>$alerts])
            @endalert
            {{--success msg--}}
            @if(session('success_'))
                @alert(['alerts'=>['success_'=>session('success_')]])
                @endalert
            @endif
            @if(session('error_'))
                @alert(['alerts'=>['error_'=>session('error_')]])
                @endalert
            @endif
            {{--@d(['debug'=>$roles])
            @endd--}}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @panelPrimary(['title'=>"user's Information"])
            @slot('body')
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-bordered" id="users-table">
                            <thead>
                            <tr>
                                <th style="width: 25%">Name</th>
                                <th style="width: 25%">Email</th>
                                <th style="width: 20%;text-align: center">Created/Updated at</th>
                                <th style="width: 20%;text-align: center">Status</th>
                                <th style="width: 20%">Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            @endslot
            @endpanelPrimary
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('soft/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('soft/js/datatables.bootstrap.js') }}"></script>

    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: url+'setting/users/datatable',
                columns: [
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'created_at'},
                    {data: 'block'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection