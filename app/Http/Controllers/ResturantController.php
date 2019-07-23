<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Resturant;

class ResturantController extends Controller
{
    public function index()
    {
        $records=Resturant::all();
        return view('resturants.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resturants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
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
    public function update(Request $request, $id)
    {
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Resturant::findOrfail($id);
        $record->delete();
        flash()->success("Success");
        return redirect(Route('resturants.index'));
        
    }
    public function activated($id)
    {
        $resturant=Resturant::findOrfail($id);
        $resturant->activated=1;
        $resturant->save();
        flash()->success("تم التفعيل");
        return back();
        
    }
    public function deactivated($id)
    {
        $resturant=Resturant::findOrfail($id);
        $resturant->activated=0;
        $resturant->save();
        flash()->success("تم الايقاف");
        return back();
        
    }
}
