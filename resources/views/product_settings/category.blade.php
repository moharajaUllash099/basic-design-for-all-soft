<?php
$name = (isset($this_record[0])) ? $this_record[0]->name : old('name');
$parent = (isset($this_record[0])) ? $this_record[0]->parent : old('parent');
$img = (isset($this_record[0])) ? $this_record[0]->img : '';
$id = (isset($this_record[0])) ? $this_record[0]->id : '';
?>
@extends('layouts.app')
@section('css')
    <style>
        #category_filter{
            text-align: right;
        }
        .pagination{
            margin: 0px;float: right;
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
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    @panelPrimary(['title'=>'blog Category Information'])
                    @slot('body')
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-bordered" id="cat-table">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Parent Category</th>
                                        <th>Category Name</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endslot
                    @endpanelPrimary
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle" aria-hidden="true"></i> Fields with (*) are required.
                    </div>
                    @panelPrimary(['title'=>(empty($id)) ? 'create Category' : 'update category' ])
                    @slot('body')
                        @if(!empty($id))
                            @form_upload(['route'=> ['updateProductCategory',$id]])
                        @else
                            @form_upload(['route'=>'saveProductCategory']) {{--['route'=> 'saveBlogCat']--}}
                        @endif
                        @slot('form_body')
                            <div class="form-group">
                                {!! Form::label('name', 'Category Name') !!} <span style="color: red">*</span>
                                {!! Form::text('name',$name,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'name',
                                    'placeholder'   =>  'Category Name',
                                    'required'      =>  'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('parent','Parent Category') !!}
                                {!! Form::select('parent',get_soft_category_select(),$parent,[
                                        'class'         =>  'form-control',
                                        'id'            =>  'parent',
                                        'required'      =>  'required',
                                    ]) !!}
                            </div>
                            @if(!empty($img))
                                    <label>
                                        {!! Form::checkbox('remove_img') !!} Remove Picture
                                    </label>
                                <span style="color: red;display: block">
                                    Note : If you upload new file, previous file will delete automatically.
                                </span>
                                <img src="{{asset('soft/uploads/'.$img)}}" class="img-responsive m-b-10" style="border:1px solid gainsboro" alt="cat pictuer">
                            @endif
                            {!! Form::file('img',['id'=>'img']) !!}
                        @endslot
                        @endform_upload
                    @endslot
                    @endpanelPrimary
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('soft/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('soft/js/datatables.bootstrap.js') }}"></script>
    <script>
        $(function() {
            $('#cat-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: url+'product/category/datatable',
                columns: [
                    {data: 'id'},
                    {data: 'parent'},
                    {data: 'name'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection