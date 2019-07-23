<?php   

namespace App\Http\Controllers\Api\resturant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Model\Resturant;
use App\Mail\ResetPassword;
use App\Mail\NewPassword;
use App\Model\Token;

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
          'category_id.*' => 'required|exists:categories,id',      
          //'minimal_demand '=>'required',  
          //'delivery_fee '=>'required',      
          //'whatsapp_url '=>'required',        
          'img'=>'required',  
          //'activated  '=>'required',       
          'availability'=>'required|in:open,close',      
           
         
     ]);   
     if($validator->fails())
     {
         
         return responseJson(0,$validator->errors()->first(),$validator->errors());
     }
     $request->merge(['password'=>  bcrypt($request->password)]);
     $resturant=Resturant::with('categories')->create($request->all());

     if ($request->has('categories')) {
        $resturant->categories()->sync($request->categories);
    }
     $resturant->api_token =str_random(60);
     
    
     if ($request->hasFile('img')) {
        $path = public_path();
        $destinationPath = $path . '/resturant/'; // upload path
        $logo = $request->file('img');
        $extension = $logo->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
        $logo->move($destinationPath, $name); // uploading file to given path
        $resturant->update(['img' => 'resturant/' . $name]);
    }
    $resturant->save();
     return responseJson(1,'تم العمليه بنجاح',[
         'api_token'=>$resturant->api_token,
         'resturant'=>$resturant ->load('categories') 
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
  
      $resturant=Resturant::where('phone',$Request->phone)->first();
    //  dd($resturant);
      if($resturant){
          
          if(Hash::check($Request->password,$resturant->password)){
              
              return responseJson(1,'تم العمليه بنجاح',[
         'api_token'=>$resturant->api_token,
         'resturant'=>$resturant 
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

   
        public function resetpassword(Request $request ){
            $validator=  validator()->make($request->all(),[
                'email' => 'required'
            ]);
            if($validator->fails()){
                return responseJson(0, $validator->errors()->first(), $validator->errors());
            }
             $resturant = Resturant::where('email',$request->email)->first();
            if($user){
                $code = rand(1111,9999);
                $update = $resturant->update(['pin_code' => $code]);
                if($update)
                {            
                   //send sms
                    Mail::to($resturant->email)
                        ->send(new ResetPassword($resturant));
                return responseJson(1,'برجاء فحص الايميل',['code_for_test' => $resturant]);
                }else{
                return responseJson(0,'حاول مره اخر , حدث خطاء');
                }
            }else{
                return responseJson(0,'لا يوجد اي حساب بهذا الاسم');
            }
        } 
 
    
        public function newpassword(Request $request){
            $validator=  validator()->make($request->all(),[
                'pin_code' => 'required|min:4',
                'password' => 'required|confirmed',
            ]);
            if($validator->fails()){
                return responseJson(0, $validator->errors()->first(), $validator->errors());
            }
             $Resturant = Resturant::where('pin_code',$request->pin_code)->first();
                if($Resturant)
                {
                   $resturant->update(['pin_code' => null, 'password' => bcrypt($request->password)]);
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
       $user=$request->user()->tokens()->create($request->all());
       return responseJson(1,'تم الاضافه بنجاح' ,$user);
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
       
}
