<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function changePassword()
    {
        return view('resetpassword.index');
    }
    public function changePasswordSave(Request $request)
    {
        $messages = [
            'old-password' => 'required',
            'password' => 'required|confirmed',
        ];
        $rules = [
            'old-password.required' => 'كلمة السر الحالية مطلوبة',
            'password.required' => 'كلمة السر مطلوبة',
        ];
        $this->validate($request,$messages,$rules);
        $user = Auth::user();
        if (Hash::check($request->input('old-password'), $user->password)) {
            // The passwords match...
            $user->password = bcrypt($request->input('password'));
            $user->save();
            flash()->success('تم تحديث كلمة المرور');
            return view('resetpassword.index');
        }else{
            flash()->error('كلمة المرور غير صحيحة');
            return view('resetpassword.index');
        }
    }

    public function forgerpassword(){
        return view('auth.passwords.email');
    }

    public function savePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        if($validation->fails()){
            return back()->with('errors', $validation->messages());
        }

        $admin = User::where('email', $request->email)->first();

        if($admin){
            $password = bcrypt($request->password);
            $admin->update(['password' => $password]);
            return back()->with('status', 'Password reset successfully');
        }
    }
}
