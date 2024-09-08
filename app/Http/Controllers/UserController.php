<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{   
    public function showAdminDashboard(){
        if(!Auth::check() || !Auth::user()->isAdmin){
            return redirect('/')->with('error', 'You are not authorized to access the page.');
        }
        $users = User::all();
        return view('admin', ['users' => $users]);
    }

    public function register(Request $request){
        $inputValues = $request->validate([
            'name'=>['required','min:3','max:100'],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>['required','min:8','max:100']
        ]);
        
        $inputValues['password']=bcrypt($inputValues['password']);
        $isAdmin = $request->has('isAdmin') ? 1 : 0;
        if($isAdmin){
            $inputValues["isAdmin"] = 1;
        }
        else{
            $inputValues["isAdmin"] = 0;
        }
        $user= User::create($inputValues);
        return redirect()->back()->with('success', 'User registered successfully!');
    }

    public function login(Request $request){
        $inputValues = $request->validate([
            'loginEmail'=>['required','email'],
            'loginPassword'=>['required','min:8','max:100']
        ]);

        if(auth()->attempt(['email'=>$inputValues['loginEmail'],'password'=>$inputValues['loginPassword']])){
            $request->session()->regenerate();
            $user = auth()->user();
            if($user->isAdmin){
                return redirect('/admin');
            }
            else{
                return redirect('/');
            }
        }

        return redirect()->back()->with('error', 'The provided credentials do not match our records.');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
