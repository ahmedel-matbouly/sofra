<?php

namespace App\Http\Controllers\Api\resturant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\City;
use App\Model\Region;
use App\Model\Category;
use App\Model\Client;
use App\Model\setting;
use App\Model\Contact;
use App\Model\Order;
use App\Model\Token;
use App\Model\Product;
use App\Model\Offer;
use App\Model\Resturant;
use App\Model\Payment;
use App\Model\comment;




use Illuminate\Support\Facades\Validator;



class Maincontroller extends Controller
{
     
    public function contacts(Request $request){
        
        $validator= validator()->make($request->all(),
                
        [
             
             'name'=>'required',   
             'email'=>'required|email|unique:clients',    
             'phone'=>'required',      
             'content'=>'required',
             'type'=>'required|in:complaint,suggestion,inquiry', 
             
        ]);   
        if($validator->fails())
        {
            
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $resturant=auth('resturant')->user()->contacts()->create($request->all());
        return responseJson(1,'تم العمليه بنجاح',$resturant);
      }

    public function product(Request $request){
        
        $validator= validator()->make($request->all(),
                
        [
             'name'=>'required',   
             'description'=>'required',    
             'price'=>'required',      
             'time'=>'required',      
             //'resturant_id '=>'required',  
             'img'=>'required',  
             //'disable '=>'required',            
            
                
              
        ]);   
        if($validator->fails())
        {
            
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
    
        $product = $request->user()->products()->create($request->all());
        
        if ($request->hasFile('img')) {
           $path = public_path();
           $destinationPath = $path . '/product/'; // upload path
           $logo = $request->file('img');
           $extension = $logo->getClientOriginalExtension(); // getting image extension
           $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
           $logo->move($destinationPath, $name); // uploading file to given path
           $product->update(['img' => 'product/' . $name]);
       }
       $product->save();
        return responseJson(1,'تم العمليه بنجاح',$product );
       }

       public function updateproduct(Request $request){
        
        $validator= validator()->make($request->all(),
                
        [
             'name'=>'required',   
             'description'=>'required',    
             'price'=>'required',      
             'time'=>'required',      
             //'resturant_id '=>'required',  
             'img'=>'required',  
             //'disable '=>'required',            
  
        ]);   
        if($validator->fails())
        {   
            
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
    
        $product = $request->user()->products()->find($request->product_id);
     
        $product->update($request->except('img'));
        if($request->hasFile('img')) {
            if(file_exists($product->img))
                unlink($product->img);
           $path = public_path();
           $destinationPath = $path . '/product/'; // upload path
           $logo = $request->file('img');
           $extension = $logo->getClientOriginalExtension(); // getting image extension
           $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
           $logo->move($destinationPath, $name); // uploading file to given path
           $product->img ='product/' . $name;
       }
       $product->save();
        return responseJson(1,'تم العمليه بنجاح',$product );
       }

       public function deleteproduct(Request $request){
        
    
        $product = $request->user()->products()->find($request->product_id);
            if(file_exists($product->img))
                unlink($product->img);
          
       $product->delete();
        return responseJson(1,'تم الحذف بنجاح',$product );
       }

       public function offer(Request $request){
        
        $validator= validator()->make($request->all(),
                
        [
             'name'=>'required',   
             'text'=>'required',    
             'price'=>'required',      
             'start_at'=>'required',    
             'end_at'=>'required',   
             'img'=>'required',  
     
        ]);   
        if($validator->fails())
        {
            
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
    
        $offer = $request->user()->offers()->create($request->all());
        
        if ($request->hasFile('img')) {
           $path = public_path();
           $destinationPath = $path . '/offer/'; // upload path
           $logo = $request->file('img');
           $extension = $logo->getClientOriginalExtension(); // getting image extension
           $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
           $logo->move($destinationPath, $name); // uploading file to given path
           $offer->update(['img' => 'offer/' . $name]);
       }
       $offer->save();
        return responseJson(1,'تم العمليه بنجاح',$offer );
       }
       public function updateoffer(Request $request){
        
        $validator= validator()->make($request->all(),
                
        [
            'name'=>'required',   
            'text'=>'required',    
            'price'=>'required',      
            'start_at'=>'required',    
            'end_at'=>'required',   
            'img'=>'required',  
        ]);   
        if($validator->fails())
        {   
            
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
    
        $offer = $request->user()->offers()->find($request->offer_id);
     
        $offer->update($request->except('img'));
        if($request->hasFile('img')) {
            if(file_exists($offer->img))
                unlink($offer->img);
           $path = public_path();
           $destinationPath = $path . '/offer/'; // upload path
           $logo = $request->file('img');
           $extension = $logo->getClientOriginalExtension(); // getting image extension
           $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
           $logo->move($destinationPath, $name); // uploading file to given path
           $offer->update(['img' => 'offer/' . $name]);
       }
       $offer->save();
        return responseJson(1,'تم العمليه بنجاح',$offer );
       }

       public function deleteoffer(Request $request){
        
    
        $offer = $request->user()->offers()->find($request->offer_id);
       // $offer->delete($request->except('img'));
            if(file_exists($offer->img))
                unlink($offer->img);
          
       $offer->delete();
        return responseJson(1,'تم الحذف بنجاح',$offer );
       }

       public function notifications(){
        $notifications= Notification::all();
        return responseJson(1, 'success', $notifications);
    }

    public function myorders(Request $request){
        $orders=$request->user()->orders()->where(function ($order) use($request){
            if ($request->has('status') and $request->status=='current'){
                $order->where('status','=','accept');
            }
            elseif ($request->has('status') && $request->status=='pending'){
                $order->where('status','=','pending');
            }
            /*else{
                $order->where('status','deliverd');
            }*/
        })->with('clients','products')->latest()->paginate(10);
        return responseJson(1,$request->status,$orders);
     }

       public function showorder(Request $request)
       {
           $order= Order::with('products','clients','resturants.region','resturants.categories')->find($request->order_id);
           return responseJson(1,'تم التحميل',$order);
       }
       public function acceptorder(Request $request)
       {
           $order= $request->user()->orders()->find($request->order_id);
           //dd($order);
           if (!$order)
           {
               return responseJson(0,'لا يمكن الحصول على بيانات الطلب');
           }
           if ($order->state == 'accept')
           {
               return responseJson(1,'تم قبول الطلب');
           }
           $order->update(['state' => 'accept']);
           $client = $order->client;
           //$client = Client::find($order->client_id);
           //dd($client);
           $notification=$client->notifications()->create([
               'title' => 'تم قبول طلبك',
               'body' => 'تم قبول الطلب رقم '.$request->order_id,
               'order_id'=>$order->id,
               
           ]);
           //dd($notification);
           $tokens = $client->tokens()->where('token','!=','')->pluck('token')->toArray();
           if(count($tokens)){
            $title = $notification->title;
            $body = $notification->body;
            $data =[

                'order_id' => $order->id,
                 //'user_type' => 'client',
            ];

            $send = notifyByFireBase($title, $body, $tokens, $data);
            info("firebase result: " . $send);
            //dd($send);
        }
        return responseJson(1,'تم قبول الطلب',$order);
    }



       public function rejectorder(Request $request)
       {

        $order= $request->user()->orders()->find($request->order_id);
        //dd($order);
        if (!$order)
        {
            return responseJson(0,'لا يمكن الحصول على بيانات الطلب');
        }
        if ($order->state == 'reject')
        {
            return responseJson(1,'تم رفض الطلب');
        }
        $order->update(['state' => 'reject']);
        $client = $order->client;
        //$client = Client::find($order->client_id);
        //dd($client);
        $notification=$client->notifications()->create([
            'title' => 'تم رفض طلبك',
            'body' => 'تم رفض الطلب رقم '.$request->order_id,
            'order_id'=>$order->id,
            
        ]);
        //dd($notification);
        $tokens = $client->tokens()->where('token','!=','')->pluck('token')->toArray();
        if(count($tokens)){
         $title = $notification->title;
         $body = $notification->body;
         $data =[

             'order_id' => $order->id,
              //'user_type' => 'client',
         ];

         $send = notifyByFireBase($title, $body, $tokens, $data);
         info("firebase result: " . $send);
         //dd($send);
     }
     return responseJson(1,'تم رفض الطلب',$order);
    }

      public function confirmorder(Request $request)
       {
        $order= $request->user()->orders()->find($request->order_id);
        //dd($order);
        if (!$order)
        {
            return responseJson(0,'لا يمكن الحصول على بيانات الطلب');
        }
        if ($order->state != 'accept')
        {
            return responseJson(1,'تم تاكيد الطلب');
        }
        $order->update(['state' => 'deliverd']);
        $client = $order->client;
        //$client = Client::find($order->client_id);
        //dd($client);
        $notification=$client->notifications()->create([
            'title' => 'تم تاكيد طلبك',
            'body' => 'تم تاكيد الطلب رقم '.$request->order_id,
            'order_id'=>$order->id,
            
        ]);
        //dd($notification);
        $tokens = $client->tokens()->where('token','!=','')->pluck('token')->toArray();
        if(count($tokens)){
         $title = $notification->title;
         $body = $notification->body;
         $data =[

             'order_id' => $order->id,
              //'user_type' => 'client',
         ];

         $send = notifyByFireBase($title, $body, $tokens, $data);
         info("firebase result: " . $send);
         //dd($send);
     }
     return responseJson(1,'تم تاكيد الطلب',$order);
       }

       public function changeState(Request $request)
       {
           $validation = validator()->make($request->all(), [
               'state' => 'required|in:open,close'
           ]);
           if ($validation->fails()) {
               $data = $validation->errors();
               return responseJson(0,$validation->errors()->first(),$data);
           }
           $request->user()->update(['availability' => $request->state]);
           return responseJson(1,'',$request->user());
       }

    public function commissions(Request $request)
    {
        $count = $request->user()->orders()->where('state','accepte')->where(function($q){
            $q->where('state','delivered');
        })->count();
        $total = $request->user()->orders()->where('state','accepte')->where(function($q){
            $q->where('state','delivered');
        })->sum('total');
        $commissions = $request->user()->orders()->where('state','accepte')->where(function($q){
            $q->where('state','delivered');
        })->sum('commission');
        $payments = $request->user()->transactions()->sum('amount');
        $net_commissions = $commissions - $payments;
        $commission = settings()->commission;
        return responseJson(1,'',compact('count','total','commissions','payments','net_commissions','commission'));
    }

}



