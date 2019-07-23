@extends('layouts.app')


@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
        <h1>
            Orders
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
                <h3 class="box-title">Orders</h3>
      
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
                                <th class="text-center">add_notes</th>
                                <th class="text-center">total</th>
                                <th class="text-center">delivery_fee </th>
                                <th class="text-center">state</th>
                                <th class="text-center">payment</th>
                                <th class="text-center">resturant</th>
                                <th class="text-center">client</th>
                                <th class="text-center">commission</th>
                                <th class="text-center">net</th>
                                <th class="text-center">address</th>
                                <th class="text-center">cost</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $records as  $record)
                                <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$record->add_notes}}</td>
                                <td class="text-center">{{$record->total}}</td>
                                <td class="text-center">{{$record->delivery_fee}}</td>
                                <td class="text-center">{{$record->state}}</td>
                                <td class="text-center">{{$record->payment_id}}</td>
                                <td class="text-center">{{$record->resturant->name}}</td>
                                <td class="text-center">{{$record->client->name}}</td>
                                <td class="text-center">{{$record->commission}}</td>
                                <td class="text-center">{{$record->net}}</td>
                                <td class="text-center">{{$record->address}}</td>
                                <td class="text-center">{{$record->cost}}</td>
                             
                                <td class="text-center"> {!! Form::model($record,[

                                    'action'=>['OrderController@destroy',$record->id],
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