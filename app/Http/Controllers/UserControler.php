<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserControler extends Controller
{
    //show user create form
    public function create(){
        return view('users.register');
    }

    //store user and login
    public function store(Request $request){
        $formFields = $request->validate([
            'name'      => ['required'],
            'email'     => ['required', 'email', Rule::unique('users','email')],
            'password'  => ['required', 'confirmed', 'min:4']
        ]);
        //hash password
        $formFields['password'] = bcrypt($formFields['password']);
        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message','User has been created and loged in successfully');
    }

    //logout user
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been loged out!');
    }

    //bring login form
    public function login(){
        return view('users.login');
    }

    //log in user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required']
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','You are now loged in!');
        }else{
            return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
        }
    }
}
