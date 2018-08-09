@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            {{--success msg--}}
            @if(session('success_'))
                @alert(['alerts'=>['success_'=>session('success_')]])
                @endalert
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h2>Blog Status</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="card card-tile card-xs bg-danger bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="fa fa-user-secret fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">1,359</div>
                        <div class="tile-description">Now Online (Visitor) </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="card card-tile card-xs bg-secondary bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="fa fa-pencil-square fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">0</div>
                        <div class="tile-description">Articles</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="fa fa-commenting fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">0</div>
                        <div class="tile-description">Comments</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="card card-tile card-xs bg-success bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="fa fa-thumbs-up fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">0</div>
                        <div class="tile-description">Likes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h2>Shop Status</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="card card-tile card-xs bg-info bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="fa fa-user-circle-o fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">1,359</div>
                        <div class="tile-description">Registered Customer</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="card card-tile card-xs bg-warning bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="fa fa-product-hunt fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">59</div>
                        <div class="tile-description">Total Product</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="card card-tile card-xs bg-primary text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="fa fa-cart-plus fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">1,359</div>
                        <div class="tile-description">New Orders</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="card card-tile card-xs bg-secondary bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="fa fa-money fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">$7,349.90</div>
                        <div class="tile-description">Today's Sales</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection