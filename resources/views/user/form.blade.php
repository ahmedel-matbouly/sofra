 
@inject('role','App\Model\Role')

<?php
$roles=$role->pluck('name','id')->toArray();
?>
     <div class="form-group">
     <label for="name" >Name</label> 
     {!! Form::text('name',null,[

       'class'=>'form-control'
     ]) !!}    
   <div class="form-group">
      <label for="email" >email</label> 
      {!! Form::text('email',null,[
 
        'class'=>'form-control'
      ]) !!}    
    </div>
    <div class="form-group">
        <label for="password" >password</label> 
        {!! Form::password('password',[
   
          'class'=>'form-control'
        ]) !!}    
      </div>
      <div class="form-group">
          <label for="password_confirmation" > confirm_password</label> 
          {!! Form::password('password_confirmation',[
     
            'class'=>'form-control'
          ]) !!}    
        </div>
        <div class="form-group">
            <label for="roles_list" > roles_list</label> 
            {!! Form::select('roles_list[]',$roles,null,[
       
              'class'=>'form-control',
              'multiple'=>'multiple'

            ]) !!}    
          </div>
     
   <div class="form-group">
   <button class="btn btn-primary" type="submit">AddUser</button>  
   </div>
  