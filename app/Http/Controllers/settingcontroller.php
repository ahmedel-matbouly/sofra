<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Setting;

class settingcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Setting $model )
    {
        
        if ($model->all()->count() > 0) {
            $model = Setting::find(1);
        }
        return view('setting.edit', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
     
 
       // $records=new Governorate;
       // $records->name=$request->name;
      //  $records->save();
 
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            
            'facebook_url'  => 'required',
            'twitter_url'   => 'required',
            'instagram_url' => 'required',
            'name'    => 'required',
            'phone'    => 'required',
            'email'    => 'required',
            'text'    => 'required',
            'commission'    => 'required',
        ]);
        if (Setting::all()->count() > 0) {
            Setting::find(1)->update($request->all());
        } else {
            Setting::create($request->all());
        }
        flash()->success('success');
        return back();
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
}
