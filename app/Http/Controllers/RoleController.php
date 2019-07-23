<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Role;
use App\Model\User;
use App\Model\Permission;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Role::all();
        return view('role.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
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

           'name'=>' required|unique:roles,name', 
           'display_name'=>' required',   
           'permission_list'=>' required|array'           
        ],
        ['name.required'=>'plz require the name',
        'display_name.required'=>'plz require the display_name',
        'permission_list.required'=>'plz require the permission',
        ] );

    
       $records=Role::create($request->all());
       $records->permissions()->attach($request->permission_list);
       flash()->success("Success");
       return redirect(Route('role.index'));
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
        $model=Role::findOrfail($id);

        return view('role.edit',compact('model'));
            
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
    $record=Role::findOrfail($id);
    $record->update($request->all());
    $record->permissions()->sync($request->permission_list);
    flash()->success("Success");
    return redirect(Route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $record=Role::findOrfail($id);
    $record->delete();
    flash()->success("Delete");
    return redirect(Route('role.index'));
    }
}
