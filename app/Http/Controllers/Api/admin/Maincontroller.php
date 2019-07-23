<?php

namespace App\Http\Controllers\Api\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\City;
use App\Model\Region;
use App\Model\Category;
use App\Model\Client;
use App\Model\Setting;
use App\Model\Contact;
use App\Model\Product;
use App\Model\Offer;
use App\Model\Resturant;
use App\Model\Payment;
use App\Model\Comment;
use App\Model\Notification;

use Illuminate\Support\Facades\Validator;

class Maincontroller extends Controller
{
 
public function cities()
{
    $cities = City::all();
    return responseJson(1, 'success', $region);
}
public function region(Request $request){   
    $region= Region::where(function ($query) use($request){           
        if($request->has('City_id')){
          $query->where('City_id',$request->City_id) ; 
        }
    })->get();
    return responseJson(1,'success',$region);
}

public function listproduct()
{
    $product = Product::all();
    return responseJson(1, 'success', $product);
}

public function listoffer()
{
    $offer = Offer::all();
    return responseJson(1, 'success', $offer);
}
public function resturant(Request $request){
    $resturant= Resturant::with('categories','cities')->where(function ($query) use($request){
        if($request->has('name')){
            $query->where('name',$request->name);
        }
    })->paginate(10);
    if($resturant->count() < 1){
        return responseJson(0,'حدث خطااء');
    }
    return responseJson(1, 'success', $resturant);
}

public function help(Request $request){
    $help=Comment::with('clients','resturants')->where(function ($query) use($request){
        if($request->has('resturant_id')){
            $query->where('resturant_id',$request->resturant_id);
        }
    })->paginate(10);
    if($help->count() < 1){
        return responseJson(0,'حدث خطااء');
    }
    return responseJson(1, 'تم العمليه  بنجاح', $help);
}

public function payment(){
    $payment= Payment::all();
    return responseJson(1, 'تم العمليه  بنجاح', $payment);
}

public function contact(){
    $contact= Contact::all();
    return responseJson(1, 'تم العمليه  بنجاح', $contact);
}
public function setting(){
    $setting= Setting::all();
    return responseJson(1, 'تم العمليه  بنجاح', $setting);
}
public function notification(){
    $notification= Notification::all();
    return responseJson(1, 'تم العمليه  بنجاح', $notification);
}

}



