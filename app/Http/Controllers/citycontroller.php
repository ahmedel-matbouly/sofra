<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\City;
use App\Model\Region;

class citycontroller extends Controller
{
    public function index()
{
    $records=City::all();
    return view('city.index',compact('records'));
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    return view('city.create');
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

       'name'=>' required'              
    ],
    ['name.required'=>'plz require the name'] );

  // $records=new Governorate;
  // $records->name=$request->name;
 //  $records->save();

   $records=City::create($request->all());

   flash()->success("Success");
   return redirect(Route('city.index'));
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
    $model=City::find($id);

    return view('city.edit',compact('model'));
        
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
$record=City::findOrfail($id);
$record->update($request->all());
flash()->success("Success");
return redirect(Route('city.index'));
}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
$record=City::findOrfail($id);
$record->delete();
flash()->success("Delete");
return redirect(Route('city.index'));
}
}











