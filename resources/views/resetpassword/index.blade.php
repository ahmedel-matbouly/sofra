@extends('layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
        <h1>
          resetpassword
        </h1>
        <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>

         
        </ol>
      </section>
  

      <!-- Main content -->

       
      <section class="content">

            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">resetpassword</h3>
      
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                {!! Form::open([
                  'action'=>'AdminController@changePasswordSave',
          'id'=>'myForm',
          'role'=>'form',
          'method'=>'POST'
          ])!!}


          @include('flash::message')
          @include('patials.errors')
          {{--@include('layouts.partials.validation-errors')--}}
          {{--{!! field()->password('old-password','كلمة المرور الحالية') !!}--}}
          <div class="form-group">
              <label class="form-control"> كلمة المرور الحالية</label>
              <input class="form-control" type="password" name="old-password"/>


              <label class="form-control">كلمة المرور الجديدة</label>
              <input class="form-control" type="password" name="password"/>


              <label class="form-control">تأكيد كلمة المرور الجديدة</label>
              <input class="form-control" type="password" name="password_confirmation"/>


            </div>

            <!-- /.box -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
                {!! Form::close()!!}
            </div>

              </div>
             
      
          </section>
          
      

@endsection