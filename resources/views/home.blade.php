@extends('layouts.app')

@inject('client','App\Model\Client')
@inject('setting','App\Model\Setting')
@inject('city','App\Model\City')
@inject('category','App\Model\Category')
@inject('region','App\Model\Region')
@inject('contact','App\Model\Contact')
@inject('offer','App\Model\Offer')
@inject('product','App\Model\Product')
@inject('resturant','App\Model\Resturant')
@inject('order','App\Model\Order')
@inject('payment','App\Model\Payment')
@inject('role','App\Model\Role')
@inject('user','App\User')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
        <h1>
          Sofra
      
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>

        </ol>
      <br>
      </section>
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">city</span>
                      <span class="info-box-number">{{$city->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

              
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">Client</span>
                      <span class="info-box-number">{{$client->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">Category</span>
                      <span class="info-box-number">{{$category->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">Region</span>
                      <span class="info-box-number">{{$region->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">settings</span>
                      <span class="info-box-number">{{$setting->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">Contacts</span>
                      <span class="info-box-number">{{$contact->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
               
                <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">Offers</span>
                      <span class="info-box-number">{{$offer->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">Product</span>
                      <span class="info-box-number">{{$product->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">Resturant</span>
                      <span class="info-box-number">{{$resturant->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
        
                    <div class="info-box-content">
                      <span class="info-box-text">Order</span>
                      <span class="info-box-number">{{$order->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
          
                      <div class="info-box-content">
                        <span class="info-box-text">Payment</span>
                        <span class="info-box-number">{{$payment->count()}}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
            
                  <div class="info-box-content">
                      <span class="info-box-text">role</span>
                      <span class="info-box-number">{{$role->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
          
                <div class="info-box-content">
                    <span class="info-box-text">user</span>
                    <span class="info-box-number">{{$user->count()}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
               

@endsection



    