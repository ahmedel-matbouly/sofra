<?php

namespace App\Http\Controllers\Api\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\City;
use App\Model\Category;
use App\Model\Client;
use App\Model\Contacts;
use App\Model\Setting;
use App\Model\Token;
use App\Model\Resturant;
use App\Model\order;
use Illuminate\Support\Facades\Validator;
use App\Model\Product;



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
    $client=auth('api')->user()->contacts()->create($request->all());
    return responseJson(1,'تم العمليه بنجاح',$client);
  }
  public function neworder(Request $request)
  {
      $validation = Validator::make($request->all(),[
  
  
           'resturant_id' => 'required|exists:resturants,id',
           'products.*.product_id' => 'required|exists:products,id',
           'products.*.quantity' => 'required',
           'address' => 'required',
           'payment_id' => 'required|exists:payments,id',
           'products.*.special_order'=> 'required',
           'add_notes'=>'required',
      ]);
  
      if ($validation->fails()){
          return responseJson(0, 'Validation ERROR', $validation->messages());
      }
      $resturant=Resturant::find($request->resturant_id);
      if($resturant->availability=='close')
      {
          return responseJson(0, 'عذرا هذا المطعم غير متاح حاليا');
     }
            $order=$request->user()->orders()->create([
              'resturant_id'=>$request->resturant_id,
              'add_notes'   =>$request->add_notes,
              'state'       =>'pending',
              'payment_id'  =>$request->payment_id,
              'address'     =>$request->address,
            ]);
            $cost=0;
            $delivery_fee =$resturant->delivery_fee; 
            foreach($request->products as $p ){
              $product=Product::find($p['product_id']);
               $readyproduct=[
                  $p['product_id']=>[
                      'quantity'=>$p['quantity'],
                      'price'=> $product->price,
                      'special_order'=>(isset($p['special_order'])) ? $p['special_order'] : ''
                  ]
               ]; 
               $order->products()->attach($readyproduct);
               $cost+=($product->price * $p['quantity'] );
            }
            if($cost>=$resturant->minimal_demand){
                $total=$cost + $delivery_fee;
                $commission = settings()->commission*$cost;
                $net = $total-settings()->commission; 
                $update = $order->update([
                   'cost'=>$cost, 
                   'delivery_fee'=>$delivery_fee,
                   'total'=>$total,
                   'commission'=>$commission,
                   'net'=>$net,
                ]);
                $order->save();
               // $request->user()->cart()->detach();
               $notification= $resturant->notifications()->create([
                   'title'=>'لديك طلب جديد',
                   'body'=>$request->user()->name.'لديك طلب جديد من العميل',
                   'order_id'=>$order->id,
               ]);
               $tokens = $resturant->tokens()->where('token', '!=' ,'')->pluck('token')->toArray();
           //fcm(firebaseCloudMessage)
           if (count($tokens)) {
               $title= $notification->title;
               $body = $notification->body;
               $data = [
                   'order_id' => $order->id,
                   //'user_type' => 'restaurant',
               ];
               $send = notifyByFirebase($title, $body, $tokens, $data);
               info("firebase result: " . $send);
               //dd($send);
               //  info("data: " . json_encode($data));
           }
           return responseJson(1,'تم الطلب بنجاح',[
            'order' => $order->fresh()->load('clients','resturants.categories','products','payments'),
        ]);
            }
            else{
                $order->products()->delete();
                $order->delete();
                return responseJson(0,'الطلب لا بد ان يكون اقل من ', $resturant);
   
            }
            return responseJson(1,'تم العمليه بنجاح',$order);
  }

  public function myorder(Request $request){
    $orders=$request->user()->orders()->where(function ($order) use($request){
        if ($request->has('status')&& $request->status=='complet'){
            $order->where('status','!=','pending');
        }
        elseif ($request->has('status')&& $request->status=='current'){
            $order->where('status','pending');
        }
    })->with('products','clients','restaurants.regions')->latest()->paginate(20);
    return responseJson(1,'All My Orders',$orders);
}
public function showorder(Request $request){
    $order=Order::with('products','clients','restaurants.regions')->find($request->order_id);
    return responseJson(1, 'تم التحميل', $order);    }
 public function latestOrder(Request $request){
     //$order=$request->user()->orders()->with('items','client','restaurant.region')->latest()->first();
     $order=Order::where('client_id',$request->user()->id)->with('products','clients','restaurants.regions')->latest()->first();
     if ($order){
         return responseJson(1, 'latestOrder', $order);
     }
         return responseJson(0, 'لا يوجد');
 }

 public function confirmorder(Request $request)
       {
           $order= $request->user()->orders()->find($request->order_id);
           if (!$order)
           {
               return responseJson(0,'لا يمكن الحصول على بيانات الطلب');
           }
           if ($order->state != 'accept')
           {
               return responseJson(1,'تم قبول طلبك');
           }
           $order->update(['state' => 'deliverd']);
           $restraunt = $order->resturant;
           //dd($restraunt);
           $notifications=$restraunt->notifications()->create([
               'title' => 'تم قبول طلبك',
               'body' => 'تم قبول الطلب رقم '.$request->order_id,
               'order_id'=>$order->id,
           ]);
           //dd($notifications);
           $tokens = $restraunt->tokens()->where('token','!=','')->pluck('token')->toArray();
           if(count($tokens)){
            $title = $notifications->title;
            $body = $notifications->body;
            $data =[

                'order_id' => $order->id
                 
            ];

            $send = notifyByFireBase($title, $body, $tokens, $data);
            info("firebase result: " . $send);
           
         
        }
        return responseJson(1,'تم قبول الطلب',$order);
       }

       public function declineorder(Request $request)
       {
           $order= $request->user()->orders()->find($request->order_id);
           if (!$order)
           {
               return responseJson(0,'لا يمكن الحصول على بيانات الطلب');
           }
           if ($order->state != 'accept')
           {
               return responseJson(1,'تم كنسله الطلب');
           }
           $order->update(['state' => 'decline']);
           $restraunt = $order->resturant;
           //dd($restraunt);
           $notifications=$restraunt->notifications()->create([
               'title' => 'تم كنسله طلبك',
               'body' => 'تم كنسله الطلب رقم '.$request->order_id,
               'order_id'=>$order->id,
           ]);
           //dd($notifications);
           $tokens = $restraunt->tokens()->where('token','!=','')->pluck('token')->toArray();
           if(count($tokens)){
            $title = $notifications->title;
            $body = $notifications->body;
            $data =[

                'order_id' => $order->id
                 
            ];

            $send = notifyByFireBase($title, $body, $tokens, $data);
            info("firebase result: " . $send);
           
         
        }
        return responseJson(1,'تم كنسله الطلب',$order);
       }

    


 /*
    public function review(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'rating'          => 'required',
            'text'       => 'required',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);
        if ($validation->fails()) {
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }
        $restaurant = Restaurant::find($request->restaurant_id);
        if (!$restaurant) {
            return responseJson(0, 'لا يمكن الحصول على البيانات');
        }
        $request->merge(['client_id' => $request->user()->id]);
        $clientOrdersCount = $request->user()->orders()
                                     ->where('restaurant_id', $restaurant->id)
                                     ->where('state', 'accept')
                                     ->count();
        if ($clientOrdersCount == 0) {
            return responseJson(0, 'لا يمكن التقييم الا بعد تنفيذ طلب من المطعم');
        }
        $checkOrder = $request->user()->orders()
                              ->where('restaurant_id', $restaurant)
                              ->where('state', 'accept')
                              ->count();
        if ($checkOrder > 0) {
            return responseJson(0, 'لا يمكن التقييم الا بعد بيان حالة استلام الطلب');
        }
        $review = $restaurant->comments()->create($request->all());
        return responseJson(1, 'تم التقييم بنجاح', [
            'review' => $review->load('client','restaurant')
        ]);
    }*/
 
}



