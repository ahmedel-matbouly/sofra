<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\City;
use App\Model\Region;

class RegionController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $records=Region::all();
       return view('region.index',compact('records')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $region = City::pluck('name', 'id')->toArray();
        return view('region.create', compact('region'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'city_id' => 'required'
        
        ],['name.required'=>'plz require the name']);

            $records=Region::create($request->all());
            flash()->success("success");
            return redirect(Route('region.index'));
        }
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model=Region::findOrfail($id);
        
        return view('region.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $records = Region::find($id);
       $records->update($request->all());    
        flash()->success("Success");
        return redirect(Route('region.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $records=Region::findORfail($id);
       $records->delete();
       flash()->success('Delete');
       return redirect(Route('region.index'));
    }
   
}
