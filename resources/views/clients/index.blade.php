@extends('layouts.app')


@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
        <h1>
            Clients
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
                <h3 class="box-title">Clients</h3>
      
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                  @include('flash::message')
                 @if(count($records))
                <div class="table-responsive">
                    <table class="table table-bordered">
                     
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">name</th>
                                <th class="text-center">email</th>
                                <th class="text-center">address </th>
                                <th class="text-center">img</th>
                                <th class="text-center">phone</th>
                              
                                <th class="text-center">city</th>
                                <th class="text-center">activated</th>
                             
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $records as  $record)
                                <tr id="removable{{$record->id}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$record->name}}</td>
                                <td class="text-center">{{$record->email}}</td>
                                <td class="text-center">{{$record->address}}</td>
                                <td class="text-center">
                                  <img src="{{asset($record->img)}}" style="width:200px; height:100px"><i class="fa fa-edite btn-xs"></i>
                              </td> 
                                <td class="text-center">{{$record->phone}}</td>
                               
                                <td class="text-center">{{$record->city_id}}</td>
                                <td class="text-center">
                                  @if($record->activated )
                                      <a href="clients/{{$record->id}}/deactivated" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> إيقاف</a>
                                  @else
                                      <a href="clients/{{$record->id}}/activated" class="btn btn-xs btn-success"><i class="fa fa-check"></i> تفعيل</a>
                                  @endif
                              </td>
                             
                                <td class="text-center"> {!! Form::model($record,[

                                    'action'=>['ClientController@destroy',$record->id],
                                    'method'=>'delete'
                                  ]) !!}
                                  

                                <button class="btn btn-danger" class="text-center"><i class="fa fa-trash-o"></i> Delete </button>
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