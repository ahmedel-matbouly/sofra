 

@inject('Model','App\Model\City')
     <div class="form-group">
     <label for="name" >Name</label> 
     {!! Form::text('name',null,[

       'class'=>'form-control'
     ]) !!}    
   </div>
   <div class="form-group">
    <label for="name" >City</label> 
    {!! Form::select('city_id',$model->pluck('name','id')->toArray(),null, [

      'class'=>'form-control'
    ]) !!}    
  </div>
   <div class="form-group">
   <button class="btn btn-primary" type="submit">AddRegion</button>  
   </div>
   