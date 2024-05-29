<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->mobile=$request->mobile;
        $user->gender=$request->gender;
        $user->password=Hash::make($request->password);

        $user->college_id=$request->college_id;
        $user->department_id =$request->department_id;
        $user->discipline_id =$request->discipline_id;
        $user->semester=$request->sem;
        if($request->user=="S")
            $user->assignRole("Student");
        else
            $user->assignRole("Guide");
        $user->save();

        event(new Registered($user));

        Auth::login($user);
        return redirect(route("login"))->with('success',"User Registered");
        // $user->sendEmailVerificationNotification();

    }
    public function login (Request $request) {
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];
         //Validate Inputs Here
        if(!empty($user = User::whereEmail($credentials['email'])->first()))
        {
            if(Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended(route("dashboard"));
            }
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }
    public function logout (Request $request)
    {
        Auth::logout(auth()->user());
       return redirect("/");
    }
    public function forgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
    public function update_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
