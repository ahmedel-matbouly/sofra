<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Role;
use App\User;
use App\Model\Permission;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $records=User::all();
        return view('user.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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

           'name'=>'required|unique:users,name,'.$id, 
           'password'=>'required|confirmed',   
           'email'=>'required', 
           'roles_list'=>' required|array',          
        ],
        ['name.required'=>'plz require the name',
        'password.confirmed'=>'plz confirm the password',
        'email.required'=>'plz require the email',
        'roles_list.required'=>'plz require the role',
        ] );

        $request->merge(['password'=>bcrypt($request->password)]);
       $records=User::create($request->all());
       $records->roles()->attach($request->roles_list);
       flash()->success("Success");
       return redirect(Route('user.index'));
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
        $model=User::findOrfail($id);

        return view('user.edit',compact('model'));
            
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
        $this->validate($request,[

            'name'=>'required|unique:users,name,'.$id, 
            'password'=>'required|confirmed',   
            'email'=>'required', 
            'roles_list'=>' required|array',          
         ],
         ['name.required'=>'plz require the name',
         'password.confirmed'=>'plz confirm the password',
         'email.required'=>'plz require the email',
         'roles_list.required'=>'plz require the role',
         ] );
    $record=User::findOrfail($id);
    $request->merge(['password'=>bcrypt($request->password)]);
    $record->update($request->all());
    $record->roles()->sync($request->roles_list);
    flash()->success("Success");
    return redirect(Route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $record=User::findOrfail($id);
    $record->delete();
    flash()->success("Delete");
    return redirect(Route('user.index'));
    }
}
