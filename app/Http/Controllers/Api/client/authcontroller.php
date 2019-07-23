<?php   

namespace App\Http\Controllers\Api\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Model\Client;
use App\Mail\ResetPassword;
use App\Mail\NewPassword;
use App\Model\Token;
use App\Model\Comment;

class authcontroller extends Controller
{
    public function register(Request $request){
        
     $validator= validator()->make($request->all(),
             
     [
          'name'=>'required',   
          'email'=>'required|email|unique:clients',   
          'password'=>'required|confirmed',   
          'phone'=>'required',      
          'city_id'=>'required',
          'address'=>'required', 
          'img'=>'required', 
            
         
     ]);   
     if($validator->fails())
     {
         
         return responseJson(0,$validator->errors()->first(),$validator->errors());
     }
     $request->merge(['password'=>  bcrypt($request->password)]);
     $client=Client::create($request->all());
     $client->api_token =str_random(60);
     if ($request->hasFile('img')) {
        $path = public_path();
        $destinationPath = $path . '/client/'; // upload path
        $logo = $request->file('img');
        $extension = $logo->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
        $logo->move($destinationPath, $name); // uploading file to given path
        $client->update(['img' => 'client/' . $name]);
    }
    $client->save();
     return responseJson(1,'تم العمليه بنجاح',[
         'api_token'=>$client->api_token,
         'client'=>$client  
         ]);
    }
    
    public function login(Request $Request){
        
     $validator= validator()->make($Request->all(),
             
     [
           
          'password'=>'required',     
          'phone'=>'required',   
             
         
     ]);   

     if($validator->fails()){
         
         return responseJson(0,$validator->errors()->first(),$validator->errors());
     }
  
      $client=Client::where('phone',$Request->phone)->first();
    //  dd($client);
      if($client){
          
          if(Hash::check($Request->password,$client->password)){
              
              return responseJson(1,'تم العمليه بنجاح',[
         'api_token'=>$client->api_token,
         'client'=>$client 
          ]);
          }
          else{
                  return responseJson(0,'انت غير مسجل');
          }
          
      }
      else{
           return responseJson(0,'error');
      }
     }

     public function profile(Request $request){
        
        $validator= validator()->make($request->all(),
                
        [ 
             'name'=>'required',   
             'email'=>'required|email|unique:clients',   
             'password'=>'required|confirmed',   
             'phone'=>'required',      
             'city_id'=>'required',
             'address'=>'required', 
             'img'=>'required', 
               
            
        ]);   
        if($validator->fails())
        {
            
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        
        $client=$request->user();
        
        $request->merge(['password'=>  bcrypt($request->password)]);
        $client->update($request->except('img'));
          
     if ($request->hasFile('img')) {
         if(file_exists($client->img))
         unlink($client->img);
        $path = public_path();
        $destinationPath = $path . '/client/'; // upload path
        $logo = $request->file('img');
        $extension = $logo->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
        $logo->move($destinationPath, $name); // uploading file to given path
        $client->update(['img' => 'client/' . $name]);
       }
       $client->save();
       return responseJson(1,'تم العمليه بنجاح',$client);
      }

      public function resetpassword(Request $request ){
        $validator=  validator()->make($request->all(),[
            'email' => 'required'
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
         $client = Resturant::where('email',$request->email)->first();
        if($client){
            $code = rand(1111,9999);
            $update = $client->update(['pin_code' => $code]);
            if($update)
            {            
               //send sms
                Mail::to($client->email)
                    ->send(new ResetPassword($client));
            return responseJson(1,'برجاء فحص الايميل',['code_for_test' => $client]);
            }else{
            return responseJson(0,'حاول مره اخر , حدث خطاء');
            }
        }else{
            return responseJson(0,'لا يوجد اي حساب بهذا الاسم');
        }
    } 


    public function newpassword(Request $request){
        $validator=  validator()->make($request->all(),[
            'code' => 'required|min:4',
            'password' => 'required|confirmed',
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
         $client = Client::where('pin_code',$request->pin_code)->first();
            if($client)
            {
               $client->update(['pin_code' => null, 'password' => bcrypt($request->password)]);
                return responseJson(1,'تم تغير كلمه المرور');
            }
            else{
                return responseJson(0,'هذا الكود غير صالح');
            }
    }

  
       
      public function registertoken(Request $request){
        
        $validator= validator()->make($request->all(),
        [
            'token'=>'required',
            'type'=>'required|in:ios,android'
        ]);
        if($validator->fails())
        {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
       Token::where('token',$request->token)->delete();
       $request->user()->tokens()->create($request->all());
       return responseJson(1,'تم الاضافه بنجاح' );
       }

       public function removetoken(Request $request)
     {
        $validator= validator()->make($request->all(),
                    
       [
             'token'=>'required',   
          ]);   
        if($validator->fails())
        {
          return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
         Token::where('token',$request->token)->delete();
        return responseJson(0,'تم الحذف بنجاح' );
       }
      
       public function help(Request $request){
        
        $validator= validator()->make($request->all(),
                
        [     
             'text'=>'required',         
             'rating'=>'required|in:1,2,3,4,5,6',  
             'clients_id'=>'required', 
             'resturant_id'=>'required',     
               
        ]);   
        if($validator->fails())
        {
            
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $help=Comment::create($request->all());
        $help->save();
        return responseJson(1,'تم العمليه بنجاح',$help);
       }
            
}
