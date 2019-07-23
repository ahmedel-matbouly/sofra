@extends('layouts.app')
@inject('model', 'App\model\City')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
        <h1>
          regions
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
                <h3 class="box-title">list of regions</h3>
      
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                 <a href="{{url(route('region.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i>New region</a>
                 @include('flash::message')
                 @if(count($records))
                <div class="table-responsive">
                    <table class="table table-bordered">
                     
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">City</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $records as  $record)
                                <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$record->name}}</td>
                                <td class="text-center">{{optional($record->city)->name}}</td>
                                <td class="text-center"><a href="{{url(route('region.edit',$record->id))}}" class="btn btn-success"><i class="fa fa-edit"></i>Edit</a></td>
                                <td class="text-center"> {!! Form::model($record,[

                                    'action'=>['RegionController@destroy',$record->id],
                                    'method'=>'delete'
                                  ]) !!}
                                  
                                <button class="btn btn-danger" id="{{$record->id}}" data-token="{{ csrf_token() }}"><i class="fa fa-trash-o"></i> Delete </button>
                                {!! Form::close()!!}
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                   @else
                   <div class="alert alert-danger" role="alert">
                     no data 
                   </div> 
                @endif
              </div>
             
      
          </section>
          
      

@endsection