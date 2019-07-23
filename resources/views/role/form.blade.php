 
@inject('per','App\Model\Permission')
     <div class="form-group">
     <label for="name" >Name</label> 
     {!! Form::text('name',null,[

       'class'=>'form-control'
     ]) !!}    
   </div>
   <div class="form-group">
      <label for="name" >display_name</label> 
      {!! Form::text('display_name',null,[
 
        'class'=>'form-control'
      ]) !!}    
    </div>
    <div class="form-group">
        <label for="name" >description</label> 
        {!! Form::textarea('description',null,[
   
          'class'=>'form-control'
        ]) !!}    
      </div>
      <div class="form-group">

          <label for="name" >permission</label> 
          <br>
           <input id="select_all" type="checkbox"><label for='select_all'>Select All</label>
           <br>
        <div class="row">
            @foreach ($per->all() as $permission)
                <div class="col-sm-3">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" name="permission_list[]" value="{{$permission->id}}"
                    @if ($model->haspermission($permission->name))
                       checked 
                    @endif
                    >
                    {{$permission->display_name}}
                
                  </label> 
                  </div>
                </div>
            @endforeach
        </div>
      </div>
   <div class="form-group">
   <button class="btn btn-primary" type="submit">AddRole</button>  
   </div>
   @push('scripts')
       <script>
         $("#select_all").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
    
});
         </script>
   @endpush