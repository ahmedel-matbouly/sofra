@extends('layouts.app')
@inject('Model','App\Model\City')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
        <h1>
          regions
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>

         
        </ol>
      </section>
  

      <!-- Main content -->

       
      <section class="content">

            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Edit region</h3>
      
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">

                  {!! Form::model($model,[

                    'action'=>['RegionController@update',$model->id],
                    'method'=>'put'
                  ]) !!}
                  @include('flash::message')
                @include('patials.errors')
                 
                @include('region.form')

                {!! Form::close()!!}
                 
              </div>
             
      
          </section>
          
      

@endsection