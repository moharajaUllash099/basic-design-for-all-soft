@extends('layouts.app')

@section('css')
    <style>
        #branch_table_filter{
            text-align: right;
        }
        .pagination{
            margin: 0px;float: right;
        }
    </style>
@endsection


@section('content')
    <?php
        $permissible_branch = get_basic_setting('permissible_branch');
        $total_open_branch = DB::table('branches')->where('status','0')->count();
    ?>
    @if ($permissible_branch > $total_open_branch)
    <div class="row">
        <div class="col-xs-12 col-md-2 col-md-offset-10">
            <a class="btn btn-primary pull-right" href="{{route('newBranch')}}" style="margin-bottom: 10px">Add Branch</a>
        </div>
    </div>
    @endif
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
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-bordered" id="branch_table" width="100%">
                            <thead>
                            <tr>
                                <th style="width: 20%">Branch Name</th>
                                <th style="width: 40%">Branch Address</th>
                                <th style="width: 10%;text-align: center">Status</th>
                                <th style="width: 15%;text-align: center">Created/Updated at</th>
                                <th style="width: 15%;text-align: right">Action</th>
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
            $('#branch_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: url+'setting/branch/datatable',
                columns: [
                    {data: 'name'},
                    {data: 'address'},
                    {data: 'status'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection