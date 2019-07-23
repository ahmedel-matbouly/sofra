<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Client;

class ClientController extends Controller
{
    public function index()
    {
        $records=Client::all();
        return view('clients.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
        $record=Client::findOrfail($id);
        $record->delete();
        flash()->success("Success");
        return redirect(Route('clients.index'));
        
    }
    public function activated($id)
    {
        $client=Client::findOrfail($id);
        $client->activated=1;
        $client->save();
        flash()->success("تم التفعيل");
        return back();
        
    }
    public function deactivated($id)
    {
        $client=Client::findOrfail($id);
        $client->activated=0;
        $client->save();
        flash()->success("تم الايقاف");
        return back();
        
    }
}
